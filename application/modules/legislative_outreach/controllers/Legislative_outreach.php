<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Legislative_outreach extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_legislative_outreach';
public $main_controller = 'legislative_outreach';

public $column_rules = [];

// used like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default = [];
private $user = null;


function __construct() {
    parent::__construct();

    /* is user logged in */
    $this->load->module('auth');
    if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
    $this->user = $this->ion_auth->user()->row();    

    $update_id = $this->uri->segment(3);
    $this->load->helper('legislative_outreach/form_flds_helper');
    $this->column_rules = get_fields();

    /* user status */
    // $this->default['username'] = count($results_set) > 0 ? $results_set[0]->username : '';   
    // $this->default['user_status'] = count($results_set) > 0 ? $results_set[0]->status : '';
    // $this->default['user_is_delete'] = count($results_set) > 0 ?
    //        $results_set[0]->is_deleted : 0;


    /* page settings */
    $this->default['page_title'] = "Manage Legislative Out Reach";    
    $this->default['headline'] = !is_numeric($update_id) ? "Manage Legislative Out Reach" : "Update Voter Details";
    $this->default['page_header'] = !is_numeric($update_id) ? "Add New Voter" : "Update Voter Details";
    $this->default['page_nav'] = "Legislative Out Reach";         

    $this->default['add_button']  = "Add New Voter";

    $this->default['flash'] = $this->session->flashdata('item');
    $this->default['admin_mode'] = $this->session->admin_mode;
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   ==================================================== */

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

    $user_id  = $this->input->post('update_id', TRUE);; // update_id is Member ID
    $admin_id = $this->user->id;

    $update_id  = $this->input->post('rowId', TRUE); // update row
    
    unset($_POST['rowId']);

    $response = $this->my_form_model->modal_post($update_id, $user_id, $this->column_rules, null);

    $response['table_lines']=
        $this->model_name->build_table_row( $response, $user_id, $update_id);

    echo json_encode($response);                
    return;    
}


function manage_admin()
{
    $user_id = $this->uri->segment(3);
    $data = $this->build_data($user_id);

    $data['cancel_button_url'] = base_url()."site_users/manage";

    $this->load->module('templates');
    $this->templates->admin($data);        
}

function manage() 
{
    $data = $this->build_data();

    $this->load->module('templates');
    $this->templates->admin($data);        
}

function member_manage()
{
    $this->load->library('MY_Form_model');    
    $user_id = $this->user->id; //$this->site_security->_make_sure_logged_in();

    $data = $this->build_data( $user_id );
    $data['update_id'] = $user_id;
    $data = $this->my_form_model->admin_member_portal_view( $data );

    $this->load->module('templates');
    $this->templates->public_main($data);

}

function build_data( $user_id )
{
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($user_id);

    $data['page_title'] = $this->default['page_title'];       
    $data['columns'] = $this->model_name->get_legislative_id($user_id);
    $data['redirect_base']= base_url().$this->uri->segment(1);
    $data['default'] = $this->default;
    $data['base_url']   = base_url();

    $data['view_module'] = "legislative_outreach";    
    $data['page_url'] = "manage";
    $data['custom_jscript'] = [ 'public/js/site_init',
                                'public/js/legistlative_outreach',
                                'public/js/member-portal',    
                                'public/js/model_js',
                                'public/js/format_flds'];
    return $data;
}    


// 
function delete( $id )
{
    $this->_numeric_check($id);    
    // $this->_security_check();
    $rows_updated = $this->_delete($id);

    $flash_message = $rows_updated > 0 ?
      "Voter was sucessfully deleted" : "Voter failed to be deleted";
    $flash_type = $rows_updated > 0 ? 'success':'danger';
    $this->_set_flash_msg($flash_message, $flash_type);      

    redirect( $this->main_controller.'/member_manage');
}



/* ===============================================
    Callbacks go here
  =============================================== */



/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */



} // End class Controller
