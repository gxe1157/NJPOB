<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_admin_terms_conditions extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_site_admin_terms_conditions';
public $main_controller = 'site_admin_terms_conditions';


public $column_rules = [];

// used like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default = array();

function __construct() {
    parent::__construct();

    $this->load->helper('site_admin_terms_conditions/form_flds_helper');
    $this->column_rules = get_fields();

    /* page settings */
    $this->default['page_title'] = "Manage Terms and Conditions";    
    $this->default['headline'] = !is_numeric($update_id) ? "Manage Terms and Conditions" : "Update Terms and Conditions";        
    $this->default['page_header'] = !is_numeric($update_id) ? "Add New Terms and Conditions" : "Update Terms and Conditions";

    $this->default['page_nav'] = "Terms and Conditions";         
    $this->default['add_button']  = "Add New Terms and Conditions";
    $this->default['flash'] = $this->session->flashdata('item');

}



/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function manage()
{
    
    $data['custom_jscript'] = [ 'sb-admin/js/datatables.min',
                                'public/js/site_loader_datatable',
                                'public/js/format_flds'];    

    $data['columns']  = $this->get('title'); // get form fields structure
    $data['default']  = $this->default;    
    $data['page_url'] = "manage";

    $this->load->module('templates');
    $this->templates->admin($data);    
}


function create()
{
     
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect( $this->main_controller.'/manage');
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();            
            $data['admin_id'] = $this->default['admin_id'];

            if(is_numeric($update_id)){
                //update record
                $data['modified_date'] = time();
                $update_rec = $this->_update($update_id, $data);
                $flash_message = $update_id > 0 ? "The Terms and Conditions have been successfully updated. " : "Terms and Conditions update has <b>failed</b>. ";
            } else {
                //insert a new record
                $data['create_date'] = time();  // timestamp for database
                $update_id = $this->_insert($data);
                $flash_message = $update_id > 0 ?
                 "The Terms and Conditions were sucessfully added" : "Add new Terms and Conditions to database has <b>failed</b>. ";
            }
            if($flash_message)
               $this->_set_flash_msg($flash_message);        

            redirect( $this->main_controller.'/create/'.$update_id);
        } // end $this->form_validation
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['default'] = $this->default;  
    $data['columns_not_allowed'] = $this->columns_not_allowed;
    $data['fld_data'] = $this->_build_flds();

    $data['custom_jscript'] = [ 'sb-admin/js/jquery.cleditor.min',
                                'public/js/site_loader_cleditor',
                                'public/js/model_js',
                                'public/js/format_flds'];    

    $data['page_url'] = "create";
    $data['update_id'] = $update_id;

    $this->load->module('templates');
    $this->templates->admin($data);    

}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    

    /* get account title from store_accounts table */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['title'] = $row_data['title'];            
    $rows_deleted = $this->_delete( $update_id );

    $flash_message = $update_id > 0 ? 'The Terms and Conditions titled "'.$data['title'].'" was successfully deleted. ' : 'Delete Terms and Conditions has <b>failed</b>. ';

    if($flash_message)
       $this->_set_flash_msg($flash_message);        

    redirect( $this->main_controller.'/manage');
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
