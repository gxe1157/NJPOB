<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Membership_plans extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_membership_plans';
public $main_controller = 'membership_plans';

public $default= [];
private $user= [];

function __construct() {
    parent::__construct();

    /* is user logged in */
    $this->load->module('auth');
    if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
    $this->user = $this->ion_auth->user()->row();    

    /* Manage panel */
    $update_id = $this->uri->segment(3);
    $this->load->helper('membership_plans/form_flds_helper');
    $this->column_rules = get_fields();

    /* page settings */
    $this->default['page_title'] = "Manage Membership Plans";    
    $this->default['headline'] = !is_numeric($update_id) ? "Manage Membership Plans" : "Update Membership Plan Details";
    $this->default['page_header'] = !is_numeric($update_id) ? "Add Membership Plan" : "Update Membership Plan Details";
    $this->default['page_nav'] = "Membership Plans";         

    $this->default['add_button']  = "Add Membership Plan";

    $this->default['flash'] = $this->session->flashdata('item');
    $this->default['admin_mode'] = $this->session->admin_mode;
}



/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function manage()
{
    $update_id = $this->uri->segment(3);
    $data = $this->build_data();

    $data['cancel_button_url'] = base_url()."membership_plans/manage";
    
    $data['columns']   = $this->get('mem_plan_level'); // get form fields structure
    $data['page_url'] = "manage";

    $this->load->module('templates');
    $this->templates->admin($data);        
}

function build_data()
{
    $data['page_title'] = $this->default['page_title'];           
    $data['redirect_base']= base_url().$this->uri->segment(1);
    $data['default'] = $this->default;  
    $data['view_module'] = "membership_plans";    
    $data['custom_jscript'] = [ 'sb-admin/js/datatables.min',
                                'public/js/site_init',
                                'public/js/site_loader_datatable'
                              ];
    return $data;
}    

function create()
{
    // dd($_POST);

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if( $submit == "Cancel" )
        redirect( $this->main_controller.'/manage');

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();            
            $data['admin_id'] = $this->user->id;

            if(is_numeric($update_id)){
                //update the item details
                $data['modified_date'] = time();
                $rows_updated = $this->_update($update_id, $data);
                $flash_message = $rows_updated > 0 ?
                  "The Memebership Plan details were sucessfully updated" : "Memebership Plan selected failed to be updated";
                $flash_type = $rows_updated > 0 ? 'success':'danger';
            } else {
                //insert a new item
                $data['create_date'] = time();
                $update_id = $this->_insert($data);
                $flash_message = $update_id > 0 ?
                  "New Memebership Plan was sucessfully added" : "New Memebership Plan failed to be added";
                $flash_type = $update_id > 0 ? 'success':'danger';
            }

            $this->_set_flash_msg($flash_message, $flash_type);      
            redirect($this->main_controller.'/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $fetch['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $fetch['columns'] = $this->fetch_data_from_post();
    }
    $data = $this->build_data( $user_id );

    $this->load->library('MY_Form_helpers');
    $data = $this->my_form_helpers->build_columns($data, $fetch, $this->column_rules);

    $data['default'] = $this->default;  
    $data['action'] = is_numeric($update_id) ? 'Update Record' : 'Submit';
    $data['custom_jscript'] = [ 'sb-admin/js/jquery.cleditor.min',
                                'public/js/site_loader_cleditor',
                                'public/js/model_js',
                                'public/js/format_flds'];    

    $data['update_id'] = $update_id;
    $data['cancel']     = 'manage_admin';
    $data['page_url']   = "create";

    $this->load->module('templates');
    $this->templates->admin($data);    

}


function delete( $update_id )
{
    $this->_numeric_check($update_id);    
quit(99);

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
