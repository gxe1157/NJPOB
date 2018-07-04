<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_users extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_site_users';
public $main_controller = 'site_users';

public $column_pword_rules  = array(
        array('field' => 'current_password', 'label' => 'Current Password',
              'rules' => 'required|min_length[7]|max_length[35]|callback_current_pword[user_login.password]'),
        array('field' => 'password', 'label' => 'Password',
              'rules' => 'required|min_length[7]|max_length[35]'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password',
              'rules' => 'required|matches[password]')
);

public $column_children_rules  = array(
        array( 'field' => 'child_fname', 'label' => 'First Name', 'rules' => 'max_length[100]' ),         
        array( 'field' => 'child_lname', 'label' => 'Last Name', 'rules' => 'max_length[100]' ),          
        array( 'field' => 'child_dob', 'label' => 'Date of Birth','rules' => 'max_length[100]' ),
        array( 'field' => 'child_gender', 'label' => 'Gender', 'rules' => 'max_length[100]')   
);


// used like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default = array();

function __construct() {
    parent::__construct();

    /* is user logged in */
    $this->load->module('auth');
    if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');

    /* Set admin mode */
    $this->default['admin_mode'] = $this->ion_auth->is_admin() ? 'admin_portal':'member_portal';

    $this->load->helper('site_users/form_flds_helper');
    list( $this->Select_option, $this->column_rules ) = get_fields();
    list( $this->users,
          $this->user_address,
          $this->user_mail_to,
          $this->user_info,
          $this->user_family,
          $this->user_employment_le,
          $this->user_employment_prv_sector,
          $this->user_children ) = get_table_data();

     /* page settings */
    $update_id = $this->uri->segment(3);
    $this->default['page_title'] = "Manage Members";        
    $this->default['page_header']   = !is_numeric($update_id) ? "Manage Members" : "Update Member Details";
    $this->default['add_button'] = "Add New Memeber";
    $this->default['page_nav']   = "Manage Members";         

    $this->default['flash'] = $this->session->flashdata('item');
    $this->default['set_dir_path'] =
        (uri_string() == 'password_reset' || uri_string() == 'member_profile') ? 1 : 2;

}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   ==================================================== */

function index()
{
    /* ion_auth users page */
    redirect('auth/index');
}

function manage()
{
     $data['custom_jscript'] = ['sb-admin/js/datatables.min',
                                'public/js/site_loader_datatable'
                               ];    

    $data['columns']  = $this->get('last_name'); // get data from table
    $data['default']  = $this->default;    
    $data['page_url'] = "manage";

    $this->load->module('templates');
    $this->templates->admin($data);        
}

function remove_child_record()
{
    $update_id   = $this->input->post('id', TRUE);      
    // $response['remove_line'] = $this->input->post('remove_line', TRUE);          

    $rows_deleted = $this->_delete( $update_id, 'user_children' );

    $response['flash_message'] = $rows_deleted > 0 ?
        "Record was successfully removed." : "Removing record has failed.<br>Please notify the website administrator.";

    $response['flash_type'] = $rows_deleted > 0 ? "success" : "danger";
    $response['success'] = $rows_deleted > 0 ? '1' : '0';            
    $response['errors_array'] = $response['flash_message'] ;    

    echo json_encode($response);                                    

}

function add_child_record()
{
    $user_id = $this->site_security->_get_user_id(); 

    $this->load->library('form_validation');
    $this->form_validation->set_rules( $this->column_children_rules );

    if($this->form_validation->run() == TRUE) {
        $data = $this->input->post(null, TRUE);
        unset($data['base_url']);

        $data['child_dob'] = SQLformat_date($data['child_dob']);
        $data['user_id'] = $user_id;

        //insert a new item
        $rows_next_id = $this->_insert($data, 'user_children');
        $response['flash_message'] = $rows_next_id > 0 ?
            "Inserting new record was successful." : "Inserting new record has failed.<br>Please notify the website administrator.";

        $response['flash_type'] = $rows_next_id > 0 ? "success" : "danger";
        $response['success'] = $rows_next_id > 0 ? '1' : '0';            
        $response['errors_array'] = '' ;    

        if( $rows_next_id > 0 ){
            $line = '';

            $query = $this->model_name->get_view_data_custom('user_id', $user_id, 'user_children', null);
            $num_rows = $query->num_rows();

            $line .= '<tr id="line_'.$rows_next_id.'"><td>'.$num_rows.'</td>';
            $line .= '<td>'.$data['child_fname'].'</td>';
            $line .= '<td>'.$data['child_lname'].'</td>';
            $line .= '<td>'.format_date($data['child_dob']).'</td>';
            $line .= '<td>'.$data['child_gender'].'</td>';
            $line .= '<td><a href="javascript: remove_name('.$rows_next_id.')" class="btn btn-sm btn-danger btnRemoveForm">Remove</a></td>';
            $response['table_lines'] = $line;        
        }

    } else {
        $errors_array = [];
        /*  $row as each individual field array  */
        foreach($this->column_children_rules as $row){
            $field = $row['field'];                     // getting field name
            $error = form_error($field);                // getting error for field name
            if($error) $errors_array[$field] = $error;  // Add errrors to $errors_array   
        }
        $validation_errors = implode( $errors_array);

        $response['flash_message'] = $validation_errors;
        $response['success'] =  '0';                
        $response['errors_array'] = $errors_array;        
    }
    echo json_encode($response);                                

}


function save_changes_ajax()
{
    $errors_array = [];
    $response=[];
dd($_POST);

    $fld_group = $this->input->post('fld_group', TRUE);
    $update_id = $this->input->post('id', TRUE);
    $fld_arr = $this->$fld_group;

    /* Filter the column rules */
    foreach ($this->column_rules as $index => $array) {
        $chk_value = $array['field'];
        if ( !in_array($chk_value, $fld_arr) ) {
            unset( $this->column_rules[$index]);
        } else {
            if( $this->column_rules[$index]['field'] == 'social_sec' )
                $this->column_rules[$index]['rules'] ='';

            $this->column_rules[$index]['input_value'] = $_POST[$chk_value];
        }
    }

    /* Validate form here 0 = failed and 1 = passed */
    /* Reminder - must have at least one field with rules */
    $this->load->library('form_validation');
    $this->form_validation->set_rules( $this->column_rules );

    if($this->form_validation->run() == TRUE) {
        /* exception - over ride */
            if($fld_group == 'user_family')  $fld_group = 'user_info';
        /* exception - over ride */

        $rows_updated = $this->_update_user_tables($fld_group, $fld_arr, $update_id );
        $response['flash_message'] = $rows_updated > 0 ?
            "Record details have been updates." : "Record details did not update.<br>Please notify the website administrator.";

        $response['flash_type'] = $rows_updated > 0 ? "success" : "warning";
        $response['success'] =  '1';            
        $response['errors_array'] = $fld_arr;        
    } else {
        /*  $row as each individual field array  */
        foreach($this->column_rules as $row){
            $field = $row['field'];                     // getting field name
            $error = form_error($field);                // getting error for field name
            if($error) $errors_array[$field] = $error;  // Add errrors to $errors_array   
        }
        $validation_errors = implode( $errors_array);

        $response['flash_message'] = $validation_errors;
        $response['success'] =  '0';                
        $response['errors_array'] = $errors_array;        
    }
    echo json_encode($response);                                
}

function update_user()
{
    $user = $this->ion_auth->user()->result()[0];
    $update_id = is_numeric($this->uri->segment(3)) ?
            $this->uri->segment(3) : $user->id; 

    /* fetch user application data */
    $result_set = $this->model_name->fetch_form_data($update_id);

    $data['columns'] = $result_set[0];
    $ss_number = $data['columns']->social_sec;
    $ss_number = $this->site_security->_decode_ss($ss_number);
    $data['columns']->social_sec =  $ss_number;
    
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($update_id);    

    $data['Select_option']  = $this->Select_option;

    $data['users'] = $this->users;
    $data['user_address'] = $this->user_address;
    $data['user_mail_to'] = $this->user_mail_to;
    $data['user_info'] = $this->user_info;    
    $data['user_family'] = $this->user_family;        
    $data['user_employment_le'] = $this->user_employment_le;    
    $data['user_employment_prv_sector'] = $this->user_employment_prv_sector;        

    $data['user_children'] = $this->user_children;        
    $data['user_children_data'] = $this->model_name->get_view_data_custom('user_id', $update_id, 'user_children', null);

    $data['custom_jscript'] = ['public/js/site_init',
                               'public/js/member-portal',
                               'public/js/site_user_details',
                               'public/js/site_user_children',                               
                               'public/js/model_js',
                               'public/js/format_flds'
                              ];    

    $data['default']   = $this->default;  
    $data['columns_not_allowed'] = $this->columns_not_allowed;
    $data['labels']    = $this->_get_column_names('label');
    $data['input_type']= $this->_get_input_type();    

    $data['page_url']  = "create";
    $data['update_id'] = $update_id;
    $data['base_url']  = base_url();

    /* Update member page */
    if( uri_string() == 'member_profile') {
        /* member manager */
        $data['page_title'] = $this->default['page_title'];
        $data['menu_level'] = 1;
        $data['image_repro'] = '';
        $data['left_side_nav'] = true;
        $data['nav_module']= 'youraccount/';
        $data['cancel'] = 'cancel_member_manage';

        $data['view_module'] = "site_users";    
        $this->load->module('templates');
        $this->templates->public_main($data);
    } else {

        $data['mode'] = 'admin_member_profile';
        $data['cancel'] = 'cancel';

        $this->load->module('templates');
        $this->templates->admin($data);
    }

}

function _update_user_tables( $table_name, $field_names = array(), $update_id)
{
    /* Get data from post inputs */
    $table_data = array();
    foreach ($field_names as $field_name) {
        $value =  $this->input->post( $field_name, TRUE);

        if( !empty($value) ){
            /* If field is date field the format for SQL */
            if( substr($value,2,1) =='/' && substr($value,5,1) =='/'  )
                    $value = SQLformat_date($value);

            if($field_name == 'social_sec')
                    $value = $this->site_security->_encrypt_string($value);

          $table_data[$field_name] = $value;
        }
    }
    /* Update into mysql here */
    $rows_updated = $this->model_name->update_data($table_name, $table_data, $update_id );    
    return $rows_updated;
    unset($table_data);
}

function _get_input_type() 
{
    foreach ($this->column_rules as $key => $value) {
      $field  = $this->column_rules[$key]['field'];
      $data[$field] = $this->column_rules[$key]['input_type']."|".$this->column_rules[$key]['input_options'];
    }
    return $data;
}

function change_account_status( $update_id, $status )
{
    /* unsuspend = 1, suspend = 2 */
    $this->_numeric_check($update_id);    
    // $this->_security_check();    
    $table_data = ['status' => $status];
    $this->model_name->update_data( 'user_login', $table_data, $update_id );  
    if( $status == 1)
        $this->_set_flash_msg("The user account was sucessfully re-activated");

    redirect( $this->main_controller.'/update_user/'.$update_id);
}


function update_password()
{
    $this->site_security->_make_sure_logged_in();        
    $update_id = is_numeric($this->uri->segment(3)) ?
             $this->uri->segment(3) : $this->site_security->_get_user_id(); 

    $submit = $this->input->post('submit', TRUE);
    if ($submit=="Cancel_member_manage")
        redirect('youraccount/welcome');

    if( !is_numeric($update_id) ){
        redirect( $this->main_controller.'/manage');
    } elseif( $submit == "Cancel" ) {
        redirect( $this->main_controller.'/update_user/'.$update_id);
    } 

    if( $submit == "Submit" ) {
        // process changes

        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_pword_rules );

        if($this->form_validation->run() == TRUE) {
            $password = $this->input->post('password', TRUE);
            $this->load->module('site_security');
            $data['password'] = $this->site_security->_hash_string($password);
            //update the account details
            $this->_set_flash_msg("Your password was sucessfully updated.");

            if(uri_string() == 'password_reset') {
                $rows_affected = 
                    $this->model_name->update_data( 'user_login', $data, $update_id );

                $this->load->module('youraccount');
                $this->youraccount->_end_session();
                redirect( 'youraccount/login');
            } else {
                redirect( $this->main_controller.'/create/'.$update_id);
            }

        }
    }

    $result_set = $this->model_name->fetch_form_data($update_id);    
    $data['columns'] = $result_set[0];
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($update_id);    

    $data['default']  = $this->default;    
    $data['page_url']  = "update_password";
    $data['update_id'] = $update_id;

    /* Update member page */
    if( uri_string() == 'password_reset') {
        /* member manager */
        $data['page_title'] = $this->default['page_title'];
        $data['custom_jscript'] = ['public/js/site_init',
                                   'public/js/member-portal',
                                   'public/js/model_js'             
                                  ];            
        // $data['mode'] = 'password_reset';
        $data['menu_level'] = 1;
        $data['image_repro'] = '';
        $data['left_side_nav'] = true;
        $data['nav_module']= 'youraccount/';
  
        $data['cancel'] = 'Cancel_member_manage';
        $data['form_location'] = base_url()."password_reset";

        $data['view_module'] = "site_users";    
        $this->load->module('templates');
        $this->templates->public_main($data);
    } else {
        $data['page_title'] = $this->default['page_title'];
        $data['cancel'] = 'Cancel';

        $data['view_module'] = "site_users";    
        $this->load->module('templates');
        $this->templates->admin($data);
    }
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    $submit = $this->input->post('submit', TRUE);

    if( $submit =="Cancel" ){
        redirect( $main_controller.'/update_user/'.$update_id);
    } elseif( $submit=="Yes - Delete Account" ){
        /* get account title from site_users table */
        $row_data = $this->fetch_data_from_db($update_id);
        $data['firstname'] = $row_data['firstname'];            
        // $this->_process_delete($update_id);
        $this->_set_flash_msg("The account ".$data['firstname'].", was sucessfully deleted");

        redirect( $main_controller.'/manage');
    }

}

function _process_delete( $update_id )
{
    /* delete related table */

    /* remove the images */
    // if(file_exists($big_pic_path)) {
    //     unlink($big_pic_path);
    // } 

    /* delete account */
     $this->_delete( $update_id );
}


function modal_fetch_ajax()
{
    $this->load->library('MY_Form_model');
    $response = $this->my_form_model->modal_fetch();
    echo json_encode($response);                
    return;    
}

function modal_post_ajax()
{
    $this->load->library('MY_Form_model');

    $update_id = $this->input->post('rowId', TRUE);
    unset($_POST['rowId']);
    $user_id = $this->site_security->_get_user_id();    

    $response = $this->my_form_model->modal_post($update_id, $user_id, $this->column_rules);
    echo json_encode($response);                
    return;    
}

function ajax_upload_one()
{
    $this->load->library('MY_Uploads');
    $this->my_uploads->ajax_upload_one();
}

function ajax_remove_one()
{
    $this->load->library('MY_Uploads');
    $this->my_uploads->ajax_remove_one();

}

function member_upload($manage_rowid=null)
{

    $update_id  = $this->site_security->_make_sure_logged_in();
    $manage_rowid = $manage_rowid != null ? $manage_rowid : 0;  

    $this->load->library('MY_Uploads');   
    $table_name = 'site_users_upload';
    $required_docs = 1;
    $data = $this->my_uploads->build_upload_data( $update_id, $manage_rowid,$table_name, $required_docs);

    $data['required_docs'] = $required_docs;     
    $data['manage_rowid'] = $manage_rowid;     

    $data['menu_level'] = 1;
    $data['image_repro'] = '';
    $data['left_side_nav'] = true;
    $data['nav_module']= 'youraccount/';
    $data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";
    $data['page_title'] = 'Upload Files';
    $data['module'] = "site_users";
    // $data['default'] = $this->default;    

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function manage_uploads()
{
    $update_id = $this->uri->segment(3);
    quit('site_users/manage_uploads| 99');

    // $data = $this->build_data( $update_id, 'users_upload', '1' );
    // checkArray($data,0);
    $this->load->module('templates');
    $this->templates->admin($data);
}


/* ===============================================
    Call backs go here...
  =============================================== */

function current_pword(){
    $error_msg = "Current Password is not Valid.";

    $userid = $this->site_security->_make_sure_logged_in();
    $results_set = $this->model_name->get_view_data_custom('id', $userid, 'user_login', null)->result();

    $pword_on_table = $results_set[0]->password;
    $old_password = $this->input->post('current_password', TRUE);
    //echo "<h4>current_password".$old_password."password".$pword_on_table."</h4>";

    $result = $this->site_security->_verify_hash($old_password, $pword_on_table);

    if ($result == false) {
        echo "<h4>current_password".$old_password."password".$pword_on_table."</h4>";
        $this->form_validation->set_message('current_pword', $error_msg);        
    }
    return $result;

}




/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
