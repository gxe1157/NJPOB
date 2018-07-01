<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_users extends MY_Controller
{

/* model name goes here */
public $mdl_name = 'Mdl_upload_categories';
public $main_controller = 'site_users';

public $column_pword_rules  = [];

// used like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default = array();

function __construct() {
    parent::__construct();
    if( $this->default['is_admin'] != 1 )
    {
        //checkField('You are not an ADMIN! This area is restricted to admin only.', 1);
    }
    $this->default['page_nav'] = "Manage User Upload";
    $this->default['flash']    = $this->session->flashdata('item');
    $this->default['admin_mode'] = $this->session->admin_mode; 
    quit(99);
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   ==================================================== */

// function member_upload($manage_rowid=null)
// {
 
//     $update_id  = $this->site_security->_make_sure_logged_in();
//     $manage_rowid = $manage_rowid != null ? $manage_rowid : 0;  
//     $data = $this->build_data( $update_id, $manage_rowid, 'users_upload', '1'  );

//     $data['menu_level'] = 1;
//     $data['image_repro'] = '';
//     $data['left_side_nav'] = true;
//     $data['nav_module']= 'youraccount/';
//     $data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";
//     $data['page_title'] = 'Upload Files';
//     $data['module'] = "site_users";
//     // $data['default'] = $this->default;    

//     $this->load->module('templates');
//     $this->templates->public_main($data);
// }

// function manage_uploads()
// {
//     $update_id = $this->uri->segment(3);
//     quit('site_users/manage_uploads| 99');

//     $data = $this->build_data( $update_id, 'users_upload', '1' );
//     // checkArray($data,0);
//     $this->load->module('templates');
//     $this->templates->admin($data);
// }

// function car_shield_upload($manage_rowid=null)
// {
//     $update_id  = $this->site_security->_make_sure_logged_in();
//     $data = $this->build_data( $update_id, $manage_rowid, 'car_shields_upload', '10' );

//     $data['manage_rowid'] = $manage_rowid;     
//     $data['menu_level'] = '1';
//     $this->default['page_nav'] = "Manage Car Shield Upload";    
//     $data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";
//     $data['page_title'] = 'Car Shield Upload';
//     $data['module'] = "car_shields";

// //o_o
//     $data['view_module'] = 'car_shields'; //site_upload/site_users/car_shield_upload
//     $data['page_url'] = "car_shield_upload";

//     $this->load->module('templates');
//     $this->templates->public_main($data);
// }

// function build_data( $update_id, $manage_rowid, $table_name, $required_docs=null )
// {
//     list( $data['status'], $data['user_avatar'],
//           $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($update_id);

//     $data['custom_jscript'] = [
//           'public/js/member-portal',
//           'public/js/upload-image',
//           'public/js/model_js'
//            ];

//     $required_docs = empty($required_docs) ? 1 : $required_docs; 
//     list( $image_list, $users_images, $missing_uploads, $image_check_list ) =
//           $this->_get_image_info($update_id, $manage_rowid, $required_docs, $table_name );

//     $data['alert_mess'] =
//           $this->set_message( $missing_uploads, $this->default['is_deleted'], $data['status']);

//     $data['show_buttons'] = $default['is_deleted'] ? false : true;
//     $data['form_type']  = 0;    
//     $data['image_list'] = $image_list;
//     $data['users_images'] = $users_images;
//     $data['userid'] = $update_id;
//     $data['default']  = $this->default;
//     $data['base_url'] = base_url();
    
//     $data['view_module'] = 'site_upload';
//     $data['page_url'] = "manage_uploads";

//     return $data;
// }

// function _get_image_info($userid, $manage_rowid, $required_docs, $table_name)
// {
//     /* Check userid account to verify passcode here */
//     $image_list = array();
//     $users_images = array();
//     $image_check_list = array();

//     /* Get image categories parent_cat_id = 1 is Site User Required Documents  */
//     $query = $this->model_name->get_view_data_custom('parent_cat_id', $required_docs, 'site_upload_categories', 'cat_title');

//     foreach($query->result() as $row){
//         $image_list[$row->id] = $row->cat_title;
//         $image_check_list[$row->cat_title] = 0;
//     }

//     /* echo "image_list: ".count($image_list); */
//     if( count($image_list) > 0 )  {
//       /* assign images to categories */
//       $where = ['userid' => $userid, 'source_id' => $manage_rowid];
//       $order_by = null;
//       $query = $this->model_name->get_where_multiple($where, $order_by, $table_name);

//       foreach($query->result() as $row){
//           $role = $image_list[$row->parent_cat];
//           $img_prefix = explode("_", $row->image);
//           $img_userid = explode("-", $img_prefix[0]);

//           /* minimize image name conflicts by verifing userid attached to image name.*/
//           if( $userid != $img_userid[0] ){
//               die('.......... ERROR .............. prg: site_users | '.$row->image);
//               $users_images[ $role ] = array( $row->id, '');
//           } else {
//               $path = [];
//               $parse_parth = explode('/', $row->path);
//               $start = count($parse_parth)-3;
//               $end   = count($parse_parth);
//               for( $i=$start; $i<$end; $i++ )
//                    $path[] = $parse_parth[$i];

//               $image_path = join('/', $path);   
//               $users_images[ $role ] = array( $row->id, $img_prefix[1], $row->image, $row->create_date, $image_path );
//               $image_check_list[ $role ] ='1';
//           }
//       }
//     }

//     $missing_uploads = count($image_list) - count($users_images);
//     return array($image_list, $users_images, $missing_uploads, $image_check_list);
// }

// function set_message( $missing_uploads, $is_deleted, $status)
// {
//       $set_mess ='';

//       if( $is_deleted ){
//           $set_mess = '<div class="col-md-12 alert alert-danger">
//                   <strong>Alert!</strong> This user account has been Deleted.
//               </div>';
//       } else if( $status == 2 ) {
//           $set_mess = '<div class="col-md-12 alert alert-warning">
//                   <strong>Alert!</strong> This user account has been Suspened.
//               </div>';
//       } else if( $missing_uploads>0  ) {
//           $set_mess = '<div class="col-md-12 alert alert-info">
//                   <strong>Alert!</strong> There are still some required documents that need to be uploaded.
//               </div>';
//       }
//       return $set_mess;

// }

/* ===============================================
    Call backs go here...
  =============================================== */





/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
