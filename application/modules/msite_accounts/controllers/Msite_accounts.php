<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Msite_accounts extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'Mdl_msite_accounts';
var $store_controller = 'msite_accounts';

var $column_rules = array(
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'lastn_ame', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'company_name', 'label' => 'Company', 'rules' => ''),
        array('field' => 'address1', 'label' => 'Address1', 'rules' => 'required'),
        array('field' => 'address2', 'label' => 'Address2', 'rules' => ''),        
        array('field' => 'city', 'label' => 'City', 'rules' => 'required'),        
        array('field' => 'state', 'label' => 'State', 'rules' => 'required'),        
        array('field' => 'zip', 'label' => 'Zip', 'rules' => 'required'),        
        array('field' => 'country', 'label' => 'Country', 'rules' => ''),        
        array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),        
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
        array('field' => 'comment', 'label' => 'Comments', 'rules' => '')        
);


var $column_pword_rules  = array(
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[7]|max_length[35]'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]')

);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var $columns_not_allowed = array( 'create_date' );
var $default = [];


function __construct() {
    parent::__construct();

    /* Manage panel */
    $update_id = $this->uri->segment(3);
    $this->default['headline'] = !is_numeric($update_id) ?
                   "Manage Accounts" : "Update Customer Details";        
    $this->default['add_button']   = "Add New Account";
    $this->default['flash'] = $this->session->flashdata('item');    
}



/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function manage()
{
    
    $data['columns']      = $this->get('company_name'); // get form fields structure
    $data['redirect_url'] = base_url().$this->uri->segment(1)."/create";    
    $data['add_button']   = "Add New Customer";
    $data['custom_jscript'] = [ 'sb-admin/js/datatables.min',
                                'public/js/site_loader_datatable',
                                'public/js/format_flds'];    

    $data['default']   = $this->default;    
    $data['page_url'] = "manage";
    $data['update_id']    = "";    

    $this->load->module('templates');
    $this->templates->admin($data);    

}


function create()
{
     
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect( $this->store_controller.'/manage');
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();            
            if(is_numeric($update_id)){
                //update the account details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The account details were sucessfully updated");
            } else {
                //insert a new account
                $data['create_date'] = time();  // timestamp for database
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new account
                // $flash_msg 
                $this->_set_flash_msg("The account was sucessfully added");
            }
            redirect( $this->store_controller.'/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['columns_not_allowed'] = $this->columns_not_allowed;
    $data['labels']    = $this->_get_column_names('label');        

    $data['default'] = $this->default;  
    $data['columns_not_allowed'] = $this->columns_not_allowed;
    $data['labels'] = $this->_get_column_names('label');
    $data['custom_jscript'] = [ 'sb-admin/js/jquery.cleditor.min',
                                'public/js/site_loader_cleditor',
                                'public/js/format_flds'];    

    $data['page_url'] = "create";
    $data['update_id'] = $update_id;

    $this->load->module('templates');
    $this->templates->admin($data);    

}

function update_password()
{
    
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if( !is_numeric($update_id) ){
        $this->_set_flash_msg("Account password can not be updated at this time.");        
        redirect( $this->store_controller.'/manage');
    } elseif( $submit == "Cancel" ) {
        redirect( $this->store_controller.'/create/'.$update_id);
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
            $this->_update($update_id, $data);
            $this->_set_flash_msg("The account password was sucessfully updated");
            redirect( $this->store_controller.'/create/'.$update_id);
        }
    }

    $data['headline']  = "Update Account Password";
    $data['headtag']   = "Update Form";     
    $data['page_url'] = "update_password";
    $data['update_id'] = $update_id;

    $this->_render_view('admin', $data);
}

function _process_delete( $update_id )
{
    /* delete account */
     $this->_delete( $update_id );
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    
    $submit = $this->input->post('submit', TRUE);

    if( $submit =="Cancel" ){
        redirect('msite_accounts/create/'.$update_id);
    } elseif( $submit=="Yes - Delete Account" ){
        /* get account title from msite_accounts table */
        $row_data = $this->fetch_data_from_db($update_id);
        $data['firstname'] = $row_data['firstname'];            
        $this->_process_delete($update_id);
        $this->_set_flash_msg("The account ".$data['firstname'].", was sucessfully deleted");

        redirect('msite_accounts/manage');
    }

}

function deleteconf( $update_id )
{
    $this->_numeric_check($update_id);    
    
    /* get account title and small img from msite_accounts table */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['firstname'] = $row_data['firstname'];            
    // $data['small_img']  = $row_data['small_pic'];

    $data['headline']  = "Delete Item";        
    $data['page_url'] = "deleteconf";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);    
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
