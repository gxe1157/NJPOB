<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Msite_ads extends MY_Controller
{

/* model name goes here */
public $mdl_name = 'mdl_msite_ads';
public $store_controller = 'msite_ads';

public $column_rules = array(
        array('field' => 'item_title', 'label' => 'Item Title', 'rules' => 'required|max_length[240]'),
        array('field' => 'item_url', 'label' => 'Item URL', 'rules' => ''),
        array('field' => 'item_price', 'label' => 'Item Price', 'rules' => 'required'),
        array('field' => 'item_description', 'label' => 'Item Description', 'rules' => 'required'),
        array('field' => 'ad_id', 'label' => 'Ad ID', 'rules' => 'required'),
        array('field' => 'page_order', 'label' => 'Page Order', 'rules' => 'required'),
        array('field' => 'status', 'label' => 'Status', 'rules' => 'required'),
);

/* use like this.. in_array($key, $columns_not_allowed ) === false ) */
public  $columns_not_allowed = array( 'create_date' );
public $default = array();


function __construct() {
    parent::__construct();

    /* Manage panel */
    $update_id = $this->uri->segment(3);
    $this->default['headline']   = !is_numeric($update_id) ?
                                    "Manage Ads" : "Update Ad Details";        
    $this->default['add_button'] = "Add New Email";
    $this->default['flash'] = $this->session->flashdata('item');
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   =================================================== */

function manage()
{
    
    $data['columns']      = $this->get('item_title'); // get form fields structure
    $data['add_items']    = true;

    if( $data['columns']->num_rows() == 0 ){
        $all_categories = $this->_custom_query('SELECT * FROM msite_categories');
        if( $all_categories->num_rows() == 0 ){
            $data['add_items'] = false;
            $this-> _set_flash_danger_msg('New Items can not be added until at least one Category have been created.<br>Go to Manage Categories and click on "Add New Category".');
        }
    }

    $data['custom_jscript'] = [ 'sb-admin/js/datatables.min',
                                'public/js/site_loader_datatable',
                                'public/js/format_flds'];    

    $data['default']   = $this->default;    
    $data['page_url'] = "manage";
    $data['redirect_url']   = base_url().$this->uri->segment(1)."/create";
    $data['update_id']      = "";

    $this->load->module('templates');
    $this->templates->admin($data);    
}


function create()
{
    
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect($this->store_controller.'/manage');
    }

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();
            // make search friendly url
            $data['item_url'] = url_title( $data['item_title'] );
            if(is_numeric($update_id)){
                //update the item details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The item details were sucessfully updated");
            } else {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new item
                // $flash_msg
                $this->_set_flash_msg("The item was sucessfully added");
            }
            redirect($this->store_controller.'/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    // init select option for drop drop downs
    list ($drop_down_title ,$plan, $first_cat_title ) =$this->init_select_opts();
    $data['drop_down_title'] = $drop_down_title;
    $data['plan'] = $plan;
    $data['first_cat_title'] = $first_cat_title;

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


function delete( $update_id )
{
    $this->_numeric_check($update_id);
    
    $submit = $this->input->post('submit', TRUE);
    if( $submit =="Cancel" ){
        redirect($this->store_controller.'/create/'.$update_id);
    } elseif( $submit=="Yes - Delete item" ){
        /* get item title from msite_ads table */
        $row_data = $this->fetch_data_from_db($update_id);
        $data['item_title'] = $row_data['item_title'];

        $this->_process_delete($update_id);
        $this->_set_flash_msg("The item ".$data['item_title'].", was sucessfully deleted");

        redirect($this->store_controller.'/manage');
    }

}

function _process_delete( $update_id )
{
    /* delete item */
     $this->_delete( $update_id );
}

function deleteconf( $update_id )
{
    $this->_numeric_check($update_id);
    
    /* get item title and small img from msite_ads table */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['item_title'] = $row_data['item_title'];
    $data['headline']  = "Delete Item";
    $data['page_url'] = "deleteconf";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);
}

function view( $update_id )
{
    $this->_numeric_check( $update_id );
    // fetch item details for pubic page
    $data = $this->fetch_data_from_db( $update_id );

    // build breadcrumbs_data
    $preview = $this->uri->segment(4) == 'preview' ? true : false; // from msite_ads update - no breadcrumbs on preview
    $breadcrumbs_data['template'] = 'public_bootstrap';
    $breadcrumbs_data['current_page_title'] = $data['item_title'];
    $breadcrumbs_data['breadcrumbs_array'] = $preview ? '' :  $this->_generate_breadcrumbs_array($update_id);

    $data['breadcrumbs_data'] = $breadcrumbs_data;  //pass this array to data
    $data['headline']  = "";
    $data['view_module'] = "msite_ads";
    $data['page_url'] = "view";
    $data['update_id'] = $update_id;

    $this->_render_view('public_bootstrap', $data);
}


function init_select_opts()
{
    $all_categories = $this->_custom_query('SELECT * FROM msite_categories
                                           ORDER BY parent_cat_id');

    foreach ($all_categories->result() as $key => $value) {
      // echo $key." id | ".$value->id." Pid | ".$value->parent_cat_id."<br>";
          if( $value->parent_cat_id == 0 ){
            $parent_cat_title[] = [ 'title'=>$value->cat_title, 'id'=>$value->id];
            $drop_down_title[$value->cat_title] = $value->cat_title;
          }
    }

    foreach ($parent_cat_title as $key=> $parent) {
      // echo  $key."  | ".$parent['id']."  | ".$parent['title']."<br>";
      /* get first parent select options */
      if( $key == 0 ) $first_cat_title =  $parent['title'];


      foreach ($all_categories->result() as $key => $value) {
        if( ($parent['id'] == $value->parent_cat_id) ){
          $plan[ $parent['title'] ][$value->cat_title] = $value->cat_title;
        }
      }
    }
    // $this->lib->checkArray($plan, 1);
    //	echo $plan[$plan_selected][0]."<br>";
    return array( $drop_down_title ,$plan, $first_cat_title );
}


function _get_item_id_from_item_url($item_url)
{
    $query   = $this->get_where_custom('item_url', $item_url);
    $num_row = $query->num_rows();

    // show_error('Page was found........... ' );
    if($num_row == 0 ) show_404();

    $item_id = $this->_get_first_record( $query, 'id');
    return $item_id;
}

function _get_sub_cat_id( $col, $update_id, $table, $orderby )
{
  $query = $this->model_name->get_view_data_custom($col, $update_id, $table, $orderby);
  $sub_cat_id = $this->_get_first_record( $query, 'cat_id');
  return $sub_cat_id;
}

function _get_cat_data($col, $update_id, $table, $orderby)
{
  $query = $this->model_name->get_view_data_custom($col, $update_id, $table, $orderby);
  $sub_cat_title = $this->_get_first_record( $query, 'cat_title');
  $sub_cat_url = $this->_get_first_record( $query, 'category_url');
  return array( $sub_cat_title, $sub_cat_url );
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
