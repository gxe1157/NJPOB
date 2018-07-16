<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Business_listings extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_business_listings';
public $main_controller = 'business_listings';

public $column_rules = [];

// used like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default= [];
private $user= [];

function __construct() {
    parent::__construct();

    /* is user logged in */
    $this->load->module('auth');
    if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
    $this->user = $this->ion_auth->user()->row();    

    $update_id = $this->uri->segment(3);
    $this->load->helper('business_listings/form_flds_helper');
    $this->column_rules = get_fields();

    /* page settings */
    $this->default['page_title'] = "Manage Business Network";    
    $this->default['headline'] = !is_numeric($update_id) ? "Manage Business Network" : "Update Business Network Details";
    $this->default['page_header'] = !is_numeric($update_id) ? "Add New Business Network" : "Update Business Network Details";
    $this->default['page_nav'] = "Business Network";         

    $this->default['add_button']  = "Add New Business";

    $this->default['flash'] = $this->session->flashdata('item');
    $this->default['admin_mode'] = $this->session->admin_mode;
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   ==================================================== */

function manage_admin()
{
    $user_id = $this->uri->segment(3);
    $data = $this->build_data($user_id);

    $data['cancel_button_url'] = base_url()."site_users/manage";
    
    $data['columns'] = $this->model_name->get_business($user_id);
    $data['page_url'] = "manage";

    $this->load->module('templates');
    $this->templates->admin($data);        
}

function member_manage()
{
    $this->load->library('MY_Form_model');

    $user_id = $this->user->id; //$this->site_security->_make_sure_logged_in();
    $data = $this->build_data( $user_id );
    $data['update_id']=$user_id;
        
    $data['bus_categories'] = $this->model_name->build_dropdowns('business_categories');

    $data = $this->my_form_model->admin_member_portal_view( $data );
    $data['columns'] = $this->model_name->get_business($user_id);
    $data['page_url'] = "manage";

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function build_data( $user_id )
{
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($user_id);

    $data['page_title'] = $this->default['page_title'];           
    $data['redirect_base']= base_url().$this->uri->segment(1);
    $data['default'] = $this->default;  
    $data['view_module'] = "business_listings";    
    $data['custom_jscript'] = [ 'sb-admin/js/jquery.cleditor.min',
                                'public/js/site_loader_cleditor',
                                'public/js/site_init',
                                'public/js/business_listings',
                                'public/js/upload-modal-image',
                                'public/js/member-portal',    
                                'public/js/model_js',
                                'public/js/format_flds'];

    return $data;
}    

function create()
{
    $user_id = $this->user->id; //$this->site_security->_make_sure_logged_in();    
    $update_id = $this->uri->segment(3);

    $cancel = $this->input->post('cancel', TRUE);
    if( $cancel == "member_manage" || $cancel == "manage_admin")
        redirect($this->main_controller.'/'.$cancel.'/'.$user_id);

    $submit = $this->input->post('submit', TRUE);
    $show_panel = $this->input->post('show_panel', TRUE);
    $panel_id = $this->uri->segment(4) ? $this->uri->segment(4) : $show_panel;

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();
            $data['user_id'] = $user_id;
            unset($data['error_mess']);            

            // make search friendly url
            // $data['item_url'] = url_title( $data['item_title'] );
            if(is_numeric($update_id)){
                //update the item details
                $rows_updated = $this->_update($update_id, $data);
                $flash_message = $rows_updated > 0 ?
                  "The Business details were sucessfully updated" : "Business selected failed to be updated";
                $flash_type = $rows_updated > 0 ? 'success':'danger';
            } else {
                //insert a new item
                $update_id = $this->_insert($data);
                $flash_message = $update_id > 0 ?
                  "New Business was sucessfully added" : "New Business failed to be added";
                $flash_type = $update_id > 0 ? 'success':'danger';
            }
            $panel_id = empty($panel_id) ? '' : '/'.$panel_id;
            $this->_set_flash_msg($flash_message, $flash_type); 
            redirect($this->main_controller.'/create/'.$update_id.$panel_id);

        } else {
            // echo validation_errors();
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
    $data['bus_categories'] = $this->model_name->build_dropdowns('business_categories');

    /* Get uploaded images by userid and update_id */
    $this->load->library('MY_Uploads');
    $result_set  = $this->my_uploads->_get_uploaded_images($user_id, $update_id, 'business_listings_upload');    
    $data['images_list'] = $result_set->result();

    $panel_id = $this->uri->segment(4) != null ? $this->uri->segment(4) : $_POST['show_panel'];

    $data['show_panel'] = empty($panel_id) ? 'panel1': $panel_id;
    $data['li_upload'] = is_numeric($update_id) ? '' : 'class="disabled"';

    $data['action'] = is_numeric($update_id) ? 'Update Record' : 'Submit';
    $data['manage_rowid'] = $update_id;
    $data['member_id'] = $user_id;
    $data['module'] = $this->main_controller;
    $data['base_url'] = base_url();
    $data['update_id'] = $update_id;

    /* Update member page */
    if( $this->default['admin_mode'] == 'admin_portal' ) {
        /* member manager */
        $data['return_url'] = "business_listings/manage_admin/".$user_id;
        $data['cancel']     = 'manage_admin';
        $data['page_url']   = "create";

        $this->load->module('templates');
        $this->templates->admin($data);
    } else {
        $this->load->library('MY_Form_model');    
        $data = $this->my_form_model->admin_member_portal_view( $data );

        /* member manager */
        $data['return_url'] = "business_listings/member_manage";
        $data['cancel']     = 'member_manage';
        $data['page_url']   = "create";

        $this->load->module('templates');
        $this->templates->public_main($data);
    }

}


function delete( $id )
{
    $this->_numeric_check($id);    
    // $this->_security_check();
    $rows_updated = $this->_delete($id);

    $flash_message = $rows_updated > 0 ?
      " Business selected was sucessfully deleted" : "Business selected failed to be deleted";
    $flash_type = $rows_updated > 0 ? 'success':'danger';
    $this->_set_flash_msg($flash_message, $flash_type);      

    redirect( $this->main_controller.'/member_manage');
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


function modal_fetch_ajax()
{
    $this->load->library('MY_Form_model');
    $table_name = 'business_listings_upload';
    $response = $this->my_form_model->modal_fetch($table_name);
    echo json_encode($response);                
    return;    
}

function modal_post_ajax()
{
    $this->load->library('MY_Form_model');

    $update_id = $this->input->post('rowId', TRUE);
    unset($_POST['rowId']);
    $data['caption'] = $this->input->post('caption',true);
    $rows_updated =$this->model_name->update($update_id, $data, 'business_listings_upload');

    if($rows_updated>0) {
       $response['success'] = 1;
       $response['new_caption'] = $data['caption'];
    } else {
       $response['success'] = 0;
       $response['flash_message'] = "The caption field was not updated.";      
    }

    echo json_encode($response);                
    return;    
}


function _modal_post_ajax()
{
    $this->load->library('MY_Form_model');

    $update_id = $this->input->post('rowId', TRUE);
    unset($_POST['rowId']);
    $user_id = $this->site_security->_get_user_id();    

    $response = $this->my_form_model->modal_post($update_id, $user_id, $this->column_rules);
    echo json_encode($response);                
    return;    
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
