<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Users_application extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'mdl_users_application';
public $main_controller = 'users_application';

public $column_rules = [];
public $is_law_officer = null;
private $user = [];

function __construct() {
    parent::__construct();

    /* is user logged in */
    $this->load->module('auth');
    if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
    $this->user = $this->ion_auth->user()->row();

    $this->load->helper('users_application/form_flds_helper');
    list( $this->form_tables, $this->users, $this->user_address,
          $this->user_mail_to, $this->user_info, $this->user_employment_le,
          $this->user_employment_prv_sector, $this->user_children ) = get_table_data();

    $this->is_law_officer =
          substr($this->user->membership_level,0,3) == 'LE_' ? 1 : 0; 
}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function ajax_validate( )
{
    /* Get fld_group number */    
    $fld_group = $this->input->post('fld_group', TRUE);
    /* Note: Param not in get_fields because input values not wanted */
    list( $Select_option, $fld_group1, $fld_group2, $fld_group3, $fld_group4 ) = get_fields();

    /* remove validation rules */
    if( $fld_group == 'fld_group3' && $fld_group3[12]['input_value'] != 'Yes' ) {
        foreach ($$fld_group as $key => $array ){
	       	if( $array['fld_group'] == 'prv_' )
		       		$fld_group3[$key]['rules'] = '';
        }
    }

    $car_shield = $this->is_law_officer;
    if( $fld_group == 'fld_group2' && $car_shield == true ) {
        foreach ($$fld_group as $key => $array ){
            if( $array['fld_group'] == 'ss' || $array['fld_group'] == 'ssc' )
                    $fld_group2[$key]['rules'] = '';
        }
    }

    /* $$ contains the value of the fld_group for setting rules */
    $this->column_rules = $$fld_group;

    /* Validate form here 0 = failed and 1 = passed */
    $this->load->library('form_validation');
    $this->form_validation->set_rules( $this->column_rules );

    if($this->form_validation->run() == TRUE) {
        /* if Validation on fld_group3 is successful then form is complete */
        $job_completed = $fld_group == 'fld_group3' ? true : false;
        $this->update_user_account($fld_group, $job_completed);
        echo 1;       // passed        

    } else {
        $error_fldname='';
        /*  $row as each individual field array  */
        foreach($this->column_rules as $row){
            $field = $row['field'];                     // getting field name
            $error = form_error($field);                // getting error for field name
            if($error){
               $error_fldname = $field.'_error_mess';
               $errors_array[$error_fldname] = $error;  // Add errrors to $errors_array   
            } 
        }
        $temp = json_encode($errors_array);
        echo strip_tags($temp,'<p>');
    }
}

function ajax_save_exit()
{
    /* Get fld_group number */    
    $fld_group = $this->input->post('fld_group', TRUE);
    $job_completed = false;    
    $this->update_user_account($fld_group, $job_completed);

    $flash_msg = $this->model_name->get_view_data_custom(
                'title', 'save_exit_application', 'site_messages', null)->row(); 
    $this->session->set_userdata('logout_msg', $flash_msg);

    /* Send Email */
    $this->load->library('MY_Email_send');
    $email_to = $this->input->post( 'email', TRUE);    
    $type = 'memFormNotComplete';
    $variables = null;
    $this->my_email_send->send_admin_email($email_to, $type, $variables);

    echo 1;       // passed    
}

function youraccount_profile()
{
    $this->index('update_profile');
}

function index($update_profile=null)
{

    $results = $this->model_name->fetch_form_data( $this->user->id );
    list( $Select_option, $fld_group1, $fld_group2, $fld_group3, $fld_group4, $fld_group5 ) = get_fields($results);

    $data['Select_option']  = $Select_option;
    $data['fld_group1']     = $fld_group1;
    $data['fld_group2']     = $fld_group2;
    $data['fld_group3']     = $fld_group3;
    $data['fld_group4']     = $fld_group4;
    $data['fld_group5']     = $fld_group5; //children

    $data['update_profile']   = empty($update_profile) ? false : true;

    /* If required, decode Social Sec and confirm */ 
    $data['car_shield'] = $this->is_law_officer;

    if( $data['car_shield'] == false ){
        /* decode Social Sec */ 
        $ss_number = $data['fld_group2'][1]['input_value'];
        $ss_number = $this->site_security->_decode_ss($ss_number,1);
        $data['fld_group2'][1]['input_value'] =  $ss_number;
        $data['fld_group2'][2]['input_value'] =  $ss_number;
    }

    $data['is_law_officer'] = $this->is_law_officer;
    $data['user_children_data'] = $this->model_name->get_view_data_custom('user_id', $this->user->id, 'user_children', null);

    $data['menu_level']     = 1;
    $data['custom_jscript'] = [ 'sb-admin/js/bootstrapValidator.min',
                                'public/js/site_init',
                                'public/js/member_app',
                                'public/js/site_user_children',
                                'public/js/model_js',
                                'public/js/format_flds' 
                              ];    

    $data['page_url']       = 'user_signup';
    $data['page_title']     = 'Membership Registration';
    $data['image_repro']    = '';
    $data['left_side_nav']  = false;
    $data['view_module']    = 'users_application';
    $data['title']          = 'Membership Registration';

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function _build_select_query($table_name, $field_array)
{
    $query_line = '';
    foreach ($field_array as $value) {
        $query_line .= $table_name.'.'.$value.', ';
    }
    return $query_line;
}


function update_user_account($fld_group, $job_completed)
{   
    switch ($fld_group) {
      case 'fld_group1':
            $this->_update_from_post('user_address', $this->user_address );
            $this->_update_from_post('user_mail_to', $this->user_mail_to );
            $this->_update_from_post('user_info', $this->user_info);
            $this->_update_from_post('users', $this->users);
       break;

      case 'fld_group2':
            $this->_update_from_post('user_info', $this->user_info);

       break;

      case 'fld_group3':
            $this->_update_from_post('user_employment_le', $this->user_employment_le);
            $this->_update_from_post('user_employment_prv_sector', $this->user_employment_prv_sector);
            if( $job_completed == true ) { 
                $this->model_name->update_data('users', array('app_completed_date' => time()) ); 

                /* Send Email */
                $this->load->library('MY_Email_send');
                $email_to = $this->input->post( 'email', TRUE);    
                $type = 'memFormCompleted';
                $variables = null;
                $this->my_email_send->send_admin_email($email_to, $type, $variables);
            }    
       break;

      default:
          echo 'Switch Error........................';
       break;
    } 

}

function _update_from_post( $table_name, $field_names = array())
{
    /* Get data from post inputs */
    $table_data = [];
    foreach ($field_names as $field_name) {
        $value =  $this->input->post( $field_name, TRUE);
        if( !empty($value) ){
            /* If field is date field the format for SQL */
            if( substr($value,2,1) =='/' && substr($value,5,1) =='/'  )
                $value = SQLformat_date($value);

          $table_data[$field_name] = $value;
        }
    }

    /* Update into mysql here */
    $this->model_name->update_data($table_name, $table_data );    
    unset($table_data);
}



/* ===============================================
    Call backs go here...
  =============================================== */



/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
