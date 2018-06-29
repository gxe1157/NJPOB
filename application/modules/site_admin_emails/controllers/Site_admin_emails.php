<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_admin_emails extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_site_admin_emails';
public $main_controller = 'site_admin_emails';


public $column_rules = array(
    array('field' => 'type', 'label' => 'Email Type', 'rules' => 'required'),
    array('field' => 'admin_email', 'label' => 'Admin Email', 'rules' => 'required|valid_email'),
    array('field' => 'from', 'label' => 'From', 'rules' => 'required|valid_email'),
    array('field' => 'subject', 'label' => 'Subject Line', 'rules' => 'required'),
    array('field' => 'body', 'label' => 'Body', 'rules' => 'required'),    
);

// use like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default = array();

function __construct() {
    parent::__construct();

    /* Manage panel */
    $update_id = $this->uri->segment(3);
    $this->default['headline']     = !is_numeric($update_id) ? "Manage Emails" : "Update Email Details";        
    $this->default['add_button']   = "Add New Email";
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

    $data['columns']   = $this->get('type'); // get form fields structure
    $data['default']   = $this->default;    
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

            if(is_numeric($update_id)){
                //update the account details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The email details were sucessfully updated");
            } else {
                //insert a new account
                $data['create_date'] = time();  // timestamp for database
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new account
                // $flash_msg 
                $this->_set_flash_msg("The email was sucessfully added");
            }
            redirect( $this->main_controller.'/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

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


function _process_delete( $update_id )
{
    /* delete account colors */
    // $this->model_name->_delete_for_account( $update_id, 'store_account_colors');
    /* delete account sizes */
    // $this->model_name->_delete_for_account( $update_id, 'store_account_sizes');

    /* delete bic_pic and small_pic ( unlink ) */
    // $data = $this->fetch_data_from_db($update_id);
    // $big_pic = $data['big_pic'];
    // $small_pic = $data['small_pic'];
    // $big_pic_path = './public/big_pic/'.$big_pic;
    // $small_pic_path = './public/small_pic/'.$small_pic;  

    /* remove the images */
    // if(file_exists($big_pic_path)) {
    //     unlink($big_pic_path);
    // } 

    // if(file_exists($small_pic_path)) {
    //     unlink($small_pic_path);
    // }  

    /* delete account */
     $this->_delete( $update_id );
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    
    $submit   = $this->input->post('submit', TRUE);
    $redirect_url = base_url().$this->uri->segment(1);

    if( $submit =="Cancel" ){
        redirect( $redirect_url.'/create/'.$update_id);
    } elseif( $submit=="Yes - Delete Email" ){
        /* get account title from store_accounts table */
        $row_data = $this->fetch_data_from_db($update_id);
        $data['type'] = $row_data['type'];            
        $this->_process_delete($update_id);
        $this->_set_flash_msg("The email type: ".$data['type'].", was sucessfully deleted");
        redirect( $redirect_url.'/manage' );
    }

}

function deleteconf( $update_id )
{
    $this->_numeric_check($update_id);    
    
    /* get account title and small img from store_accounts table */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['type'] = $row_data['type'];            
    // $data['small_img']  = $row_data['small_pic'];

    $data['default']      = $this->default;  
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
