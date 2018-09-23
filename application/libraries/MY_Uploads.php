<?php
 
class MY_Uploads extends MY_Controller {

private $upload_img_base =null;
private $table_name = null;
private $controller = null;
private $upload_path = null;
private $required_docs = null;
private $update_id = null;

//class constructor to load all required files
function __construct()
{
    parent::__construct();
    $this->upload_img_base ='./upload/';

    $this->source_id = $this->input->post('manage_rowid', TRUE) != null ? $this->input->post('manage_rowid', TRUE) : 0;   
    $this->required_docs = $this->input->post('required_docs', TRUE);
    $this->update_id = $this->input->post('img_id', TRUE);   

    $this->controller = $this->input->post('controller', TRUE);
    $this->table_name = $this->get_table_name($this->controller);  
    $this->upload_path = $this->_build_upload_folder($this->controller);

}

function ajax_remove_one()
{
// ddf($this->update_id.' | '.$this->table_name,1);
    $query = $this->model_name->get_view_data_custom('id', $this->update_id, $this->table_name, null);
    $result_set = $query->result();
    $file_name = $result_set[0]->image;
// dd($result_set);

    $user_id = $result_set[0]->userid;
    $file_location = $this->upload_path.$file_name;

    /* remove file and update mysql */
    $img_parse = explode('_', $file_name);
    $data = $this->_delete_file($file_location);
    $data['remove_name'] = $img_parse[1];

    $rows_deleted = 0;
    if($data['success'] == 1){
        $rows_deleted = $this->model_name->_delete($this->update_id, $this->table_name);

        $flash_message = $rows_deleted > 0 ?
          $data['remove_name']." was sucessfully removed" : "Error: ".$data['remove_name']." was not removed." ;
        $flash_type = $rows_deleted > 0 ? 'success':'danger';

        /* build alert message for client side */
        list( $image_list, $users_images) = $this->_get_image_info($user_id, $this->source_id, $this->required_docs, $this->table_name);
        $data['alert_mess'] = $this->set_message(count($image_list), count($users_images));
    }
    echo json_encode($data);
    return;
}

function ajax_upload_one()
{
    sleep(1);
    /* get admin_id logged in */
    $user = $this->ion_auth->user()->row();
    $admin_id = $user->id;    
    $user_id    = $this->input->post('member_id', TRUE); 
    $position   = $this->input->post('position', TRUE);
    $parent_cat = $this->input->post('parent_cat', TRUE);    
    $caption    = $this->input->post('caption', TRUE);    
    // ddf($user_id.' | '.$position.' | '.$parent_cat.' | '.$caption);

    /* set image name and add ext name */
    $uploaded_file = explode('.', $_FILES['file']['name'][$position]);

    $img_prefix = $user_id.'-'.$this->source_id;    
    $imagename  = $img_prefix.'_'.$uploaded_file[0];
    $imagename .= '.'.$uploaded_file[1];

    /* check mysql for active_image */
    $is_uploaded = $this->_is_already_uploaded($imagename, $this->upload_path);

    if( $is_uploaded == false ){  
        $this->load->library('upload', $config);

        $vector = $_FILES['file'];
        foreach($vector as $key1 => $value1)
            foreach($value1 as $key2 => $value2)
                $result[$key2][$key1] = $value2;

        $_FILES["file"]["name"] = $result[$position]["name"];
        $_FILES["file"]["type"] = $result[$position]["type"];
        $_FILES["file"]["tmp_name"] = $result[$position]["tmp_name"];
        $_FILES["file"]["error"] = $result[$position]["error"];
        $_FILES["file"]["size"] = $result[$position]["size"];

        $config["upload_path"]   = $this->upload_path;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['max_size']      = '2048';
        $config['overwrite']     = true;
        $config['file_name']     = $imagename; // set the name here

        $this->upload->initialize($config);

        if( $this->upload->do_upload('file') ) {
          $data = $this->upload->data();
          $table_data = [
             'caption' => $caption,
             'userid' => $user_id,
             'source_id' => $this->source_id,             
             'parent_cat' => $parent_cat,             
             'image' => $data['file_name'],
             'orig_name' => $data['client_name'],
             'path' => $data['full_path'],
             'size' => $data['file_size'],
             'width_height' => $data['image_size_str'],
             'admin_id' => $admin_id // should be login admin
          ];

          $response['error_mess'] = '';

          if(is_numeric($this->update_id)){
              //update details
              $table_data['modified_date'] = time();            
              $rows_updated = $this->model_name->update($this->update_id, $table_data, $this->table_name);
              $response['record_id'] = $this->update_id;
              $response['success'] = $rows_updated > 0 ? 1: 2;
              $response['image_position'] = $position;              
          } else {
              //insert a new record    
              $table_data['create_date'] = time();
              $response['record_id'] = $this->model_name->insert($table_data, $this->table_name);
              $response['success'] = $response['record_id'] > 0 ? 1: 2;
              $results_set = $this->_get_uploaded_images($user_id, $this->source_id, $this->table_name )->num_rows();
              $response['image_position'] = $results_set -1;
          }

          $response['caption'] = $caption;
          $response['full_path'] = $data['full_path'];
          $response['client_name'] = $data['client_name'];
          $response['image_date'] = convert_timestamp( time(), 'datepicker_us');
          $response['file_name'] = $data['file_name'];

          /* build alert message for client side */
          list( $image_list, $users_images) =
             $this->_get_image_info($user_id, $this->source_id, $this->required_docs, $this->table_name);
          $response['alert_mess'] = $this->set_message(count($image_list), count($users_images));

        } else {
          // display errors
          $return_message = "<p>The filetype/size you are attempting to upload is not allowed. The max-size for files is ".$config['max_size']." kb and accepted file formats are ".$config['allowed_types'].".</p>";
          $response['success'] = 0;
          $response['errors_array'] = $return_message;
          $response['error_array_console'] = $this->upload->data();
        }

    } else {
          $return_message = "<p>File is already uploaded.";
          $response['success'] = 0;
          $response['error_mess'] = $return_message;
    }

    $response['is_uploaded'] = $is_uploaded;
    $response['upload_path'] = $this->upload_path;    // use to debug
    echo json_encode($response);
    return;
}

function _is_already_uploaded($imagename, $img_path)
{
    $mysql_query =
         "SELECT * FROM ".$this->table_name." WHERE `image` = '".$imagename."'";

    $result_set  = $this->model_name->_custom_query($mysql_query)->result();

    $is_found = count($result_set)>0 ? true : false;
    if( $is_found == false){
        /* check if image is on drive and remove if found */
        $file_location  = $img_path.$imagename;
        $this->_delete_file($file_location);
    }
    return $is_found;
}

function get_table_name()
{
    $table = $this->controller."_upload";
    return $table;   
}

function _delete_file($file_location)
{
    /* delete image file */
    $data['success'] = 1;
    $data['error_mess'] = '';

    if( file_exists( $file_location ) && !is_dir($file_location) ){
        if (!unlink($file_location)) {
            // send to log and email......
            $return_message = 'Error: File did not delete. Nofity Developer. ';
            $data['success'] = 0;
            $data['error_mess'] = $return_message;
        }
    }
    return $data;
}

function _build_upload_folder()
{
    $prd_folder  = $this->controller."/";
    $upload_path = $this->upload_img_base.$prd_folder;
    return $upload_path;
}

function _get_image_info($userid, $manage_rowid, $required_docs, $table_name)
{
    /* Check userid account to verify passcode here */
    $image_list = array();
    $users_images = array();
    $image_check_list = array();

    /* Get image categories parent_cat_id = 1 is Site User Required Documents  */
    $query = $this->model_name->get_view_data_custom('parent_cat_id', $required_docs, 'site_upload_categories', 'cat_title');

    foreach($query->result() as $row){
        $image_list[$row->id] = $row->cat_title;
        $image_check_list[$row->cat_title] = 0;
    }

    /* echo "image_list: ".count($image_list); */
    if( count($image_list) > 0 )  {
      /* assign images to categories */
      $query =$this->_get_uploaded_images($userid, $manage_rowid,$table_name );

      foreach($query->result() as $row){
          $role = $image_list[$row->parent_cat];
          $img_prefix = explode("_", $row->image);
          $img_userid = explode("-", $img_prefix[0]);

          /* minimize image name conflicts by verifing userid attached to image name.*/
          if( $userid != $img_userid[0] ){
              die('.......... ERROR .............. prg: site_users | '.$row->image);
              $users_images[ $role ] = array( $row->id, '');
          } else {
              $path = [];
              $parse_parth = explode('/', $row->path);
              $start = count($parse_parth)-3;
              $end   = count($parse_parth);
              for( $i=$start; $i<$end; $i++ )
                   $path[] = $parse_parth[$i];

              $image_path = join('/', $path);   
              $users_images[ $role ] = array( $row->id, $img_prefix[1], $row->image, $row->create_date, $image_path );
              $image_check_list[ $role ] ='1';
          }
      }
    }

    return array($image_list, $users_images);
}

function _get_uploaded_images($userid, $manage_rowid,$table_name ){
    $where = ['userid' => $userid, 'source_id' => $manage_rowid];
    $order_by = null;
    $query = $this->model_name->get_where_multiple($where, $order_by, $table_name);

    return $query;
}

function set_message($image_list_count, $users_images_count)
{
    $set_mess ='<div class="col-md-12 alert alert-danger">';
    $missing_uploads = $image_list_count - $users_images_count;

    $type =  $missing_uploads == 0 ? 'success':'info';      
    $message ='<div class="col-md-12 alert alert-'.$type.'">';

    $docs = $missing_uploads == 1 ? 'document' : 'documents'; 
    if($missing_uploads < 1 ) {
      $message .='Congratulations!. All required documets have been uploaded. Your application will now be processed.';  
    } else {
      $message .= 'You are required to provide '.$image_list_count.' documents for verification. Our records show we still need you to send '.$missing_uploads.' '.$docs;  
    }
    $message .='</div>';

    return $message;
}

/* --------------------------------------------------------------------------- */
function build_upload_data( $update_id, $manage_rowid, $table_name, $required_docs )
{

    $data['custom_jscript'] = ['public/js/site_init',      
                               'public/js/member-portal',
                               'public/js/upload-image',
                               'public/js/model_js'
                              ];

    $required_docs = empty($required_docs) ? 1 : $required_docs; 
    list( $image_list, $users_images) =
        $this->_get_image_info($update_id, $manage_rowid, $required_docs, $table_name );

    $data['alert_mess'] = $this->set_message(count($image_list), count($users_images));

    $data['image_list'] = $image_list;
    $data['users_images'] = $users_images;
    $data['base_url'] = base_url();

    return $data;
}


} //end MyUpload_lib
