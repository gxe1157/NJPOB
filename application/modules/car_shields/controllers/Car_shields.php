<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Car_shields extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_car_shields';
public $main_controller = 'car_shields';

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

    // /* is user logged in */
    // $this->default = login_init();    

    /* get user data */
    // $table_name = 'car_shields';
    $update_id = $this->uri->segment(3);
    // $results_set =
    //    $this->model_name->get_view_data_custom('id', $update_id,$table_name, null)->result();

    $this->load->helper('car_shields/form_flds_helper');
    $this->column_rules = get_fields();

    /* user status */
    // $this->default['username'] = count($results_set) > 0 ? $results_set[0]->username : '';    
    // $this->default['user_status'] = count($results_set) > 0 ? $results_set[0]->status : '';
    // $this->default['user_is_delete'] = count($results_set) > 0 ? $results_set[0]->is_deleted : 0;

    /* page settings */
    $this->default['page_title'] = "Manage Car Shields";    
    $this->default['headline'] = !is_numeric($update_id) ? "Manage Car Shields" : "Update Car Shield Details";
    $this->default['page_header'] = !is_numeric($update_id) ? "Add New Car Shield" : "Update Car Shield Details";
    $this->default['page_nav'] = "Car Shield Accounts";         

    $this->default['add_button']  = "Add New Car Shield";

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

    $this->load->module('templates');
    $this->templates->admin($data);        
}

function member_manage()
{
    $this->load->library('MY_Form_model');    
    $user_id = $this->user->id; //$this->site_security->_make_sure_logged_in();
    $data = $this->build_data( $user_id );
    $data = $this->my_form_model->admin_member_portal_view( $data );

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function car_shield_upload($manage_rowid=null)
{
    $update_id  = $this->user->id; //$this->site_security->_make_sure_logged_in();

    $this->load->library('MY_Uploads');   
    $table_name = 'car_shields_upload';
    $required_docs = 10;
    $data = $this->my_uploads->build_upload_data( $update_id, $manage_rowid,$table_name, $required_docs);

    $data['required_docs'] = $required_docs;     
    $data['manage_rowid'] = $manage_rowid;     
    $data['menu_level'] = '1';
    
    // $this->default['page_nav'] = "Manage Car Shield Upload";    
    $data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";
    $data['page_title'] = 'Car Shield Upload';
    $data['module'] = "car_shields";

    $data['view_module'] = 'car_shields';
    $data['page_url'] = "car_shield_upload";

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function build_data( $user_id )
{
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($user_id);
    list($data['ss_required'], $data['dl_required'] ) = $this->remove_rules($user_id);

    $data['base_url'] = base_url();           
    $data['page_title'] = $this->default['page_title'];           
    $data['max_shields'] = 4;
    
    /* get car shiled data */
    $data['columns'] = $this->model_name->get_shield_id($user_id);

    /* Get image categories parent_cat_id = 1 is Site User Required Documents  */
    $required_docs = 10;
    $results_set = $data['columns']->result();
    $data['document_status'] = $this->_upload_status_update($required_docs, $user_id , $results_set);

    $data['redirect_base']= base_url().$this->uri->segment(1);
    $data['default'] = $this->default;  
    $data['view_module'] = "car_shields";    
    $data['page_url'] = "manage";
    $data['custom_jscript'] = [ 'public/js/site_init',
                                'public/js/car_shield',
                                'public/js/member-portal',    
                                'public/js/model_js',
                                'public/js/format_flds'];

    return $data;
}   

function _upload_status_update($required_docs, $userid, $results_set=array())
{
    /* Get image categories parent_cat_id = 1 is Site User Required Documents  */
    $parent_cat = $this->model_name->get_view_data_custom('parent_cat_id', $required_docs, 'site_upload_categories', 'cat_title')->result();

    $show_image_status = [];    
    foreach ($results_set as $key => $value) {
        $image_status[$value->id] = $this->_get_upload_info($userid, $parent_cat, $value->id);
    }

    return $image_status;
} 

function _get_upload_info($userid, $parent_cat, $manage_rowid)
{
    foreach($parent_cat as $row){
        $image_list[$row->id] = $row->cat_title;
        $image_check_list[$row->cat_title] = $row->cat_title.": <span style='color: red'> Pending</span> <br />";
    }

    /* assign images to categories */
    $where = ['userid' => $userid, 'source_id' => $manage_rowid];
    $order_by = null;
    $table_name='car_shields_upload';
    $query = $this->model_name->get_where_multiple($where, $order_by, $table_name)->result();

    foreach ($query as $key => $value) {
        $role = $image_list[$value->parent_cat];
        $image_check_list[$role] =
                 $role.": <span style='color: green'> Received</span> <br />"; 
    }

    foreach ($image_check_list as $key => $value) {
        $output_str .= $value;        
    }
    return $output_str;
}

function process_payment()
{
    $submit = $this->input->post('submit', TRUE);
    if($submit=='Cancel')
        redirect( $this->main_controller.'/member_manage');

    $user_id = $this->user->id; //$this->site_security->_make_sure_logged_in();
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($user_id);

    list($data['ss_required'], $data['dl_required'] ) = $this->remove_rules($user_id);

    $this->load->library('form_validation');
    $this->form_validation->set_rules( $this->column_rules ); 

    if($this->form_validation->run() == TRUE) {
        /* process paypal payment here */
        $source_page = 'car_shields';

        /* Payment Method Goes Here */
        $this->load->module('pay_pal');
        /* ENV is localhost or live */
        ENV != 'live' ? $this->pay_pal->test_mode($source_page) : $this->pay_pal->process_paypal($source_page);

        quit('why am I here ...........');
    }

    $data['gateway_name'] = 'PayPal';
    $data['menu_level'] = 1;
    $data['left_side_nav'] = false;
    $data['nav_module']= 'youraccount/';
    $data['cancel_button_url'] = base_url()."youraccount/welcome";    

    $data['columns'] = $this->column_rules;   
    $data['view_module'] = "car_shields";    
    $data['page_url'] = "car_shield_neworder";
    $data['custom_jscript'] = [];

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function post_payment()
{
    /* payment */
    $site_payments['transactionid'] = $_SESSION['transactionid'];
    $site_payments['itemnumber']    = 
                    isset($_SESSION['itemnumber']) != null ? $_SESSION['itemnumber']: null;
    $site_payments['trans_type']    = $_SESSION['itemname'];
    $site_payments['pay_method']    = $_SESSION['gateway_name'];
    $site_payments['amount']        = $_SESSION['totalamount'];
    $site_payments['username']      = 
                    isset($_SESSION['username']) != null ? $_SESSION['username']: null;
    $site_payments['cc_email']      = $_SESSION['cc_email'];    
    $site_payments['create_date']   = time();  // timestamp for database

    /* Add new car shield */
    $car_shields['make'] = $_SESSION['make'];
    $car_shields['model'] = $_SESSION['model'];
    $car_shields['color'] = $_SESSION['color'];
    $car_shields['model_year'] = $_SESSION['model_year'];
    $car_shields['plate_no'] = $_SESSION['plate_no'];
    $car_shields['vin_no'] = $_SESSION['vin_no'];
    $car_shields['user_id'] = $_SESSION['user_id'];
    $car_sheilds['shield_no'] = '0';
    $car_sheilds['status'] = '1';     // 0- not ordered, 1 - pending, 2 - approved
    $car_shields['admin_id'] = '0';
    $car_shields['create_date'] = time(); 
    $car_shields['transactionid'] = $_SESSION['transactionid'];

    /* Insert and update mysql here */
    $new_insert_id = $this->model_name->insert_data( $site_payments, $car_shields );

    $this->load->library('MY_Form_model');
    $this->my_form_model->update_user_info($user_id);

    /* Send Email */
    $query = $this->model_name->get_shield_id($user_id)->result();
    $email = $query[0]->email;
    $transactionid = $site_payments['transactionid'];

    if( ENV == 'live') {
        $this->send_mail($email, 'car_shield', $transactionid);     
    }
    // redirect( $this->main_controller.'/payment_accepted');
    $this->payment_accepted($transactionid, $email, $new_insert_id);
}

function payment_accepted( $transactionid, $email, $new_insert_id)
{
    $data['transactionid'] = $transactionid;
    $data['email'] = $email;    
    $data['new_insert_id'] = $new_insert_id;    
    $data['page_title'] = 'Payment Processing: Complete ';
    $data['view_module']= 'car_shields';
    $data['page_url']   = 'payment_accepted';     
    $this->_show_page($data);
}

function payment_declined()
{
    $data['page_title'] = 'Payment Processing: Declined';
    $data['view_module']= 'car_shields';
    $data['page_url']   = 'payment_declined';     
    $this->_show_page($data);
}

function _show_page($data)
{
    $data['custom_jscript'] = [];  
    $data['view_nav']   = '';
    $data['nav_option'] = '';  // name of mysql to use. leave empty if none
    $data['image_repro']= '';
    $data['left_side_nav'] =  false;    

    $this->load->module('templates');
    $this->templates->public_main($data);    

}

function remove_rules($user_id)
{
    // get userinfo data 
    $col    = 'id';
    $table  = 'user_info';
    $orderby= null;
    $results_set = $this->model_name->get_view_data_custom(
                            $col, $user_id, $table, $orderby)->result();

    /* remove validation rules */
    $dl_required  = empty( $results_set[0]->driver_lic ) ? 1 : 0;
    if( $dl_required == 0 ) {
        unset($this->column_rules[6]);  // remove rule for driver lic        
    }

    $ss_required = empty( $results_set[0]->social_sec ) ? 1 : 0;
    if( $ss_required == 0 ) {
        unset($this->column_rules[7]);  // remove rule for social_sec
        unset($this->column_rules[8]);  // remove rule for ss_confirm
    }
    /* end remove validation rules */
    return [$ss_required, $dl_required ];
}


// 
function delete( $id )
{
    $this->_numeric_check($id);    
    // $this->_security_check();
    $rows_updated = $this->_delete($id);

    $flash_message = $rows_updated > 0 ?
      "Car Shield was sucessfully deleted" : "Car Shield failed to be deleted";
    $flash_type = $rows_updated > 0 ? 'success':'danger';
    $this->_set_flash_msg($flash_message, $flash_type);      

    redirect( $this->main_controller.'/member_manage');
}


function ajax_upload_one()
{
    $this->load->library('MY_Uploads');
    $this->my_uploads->ajax_upload_one();
    unset($_SESSION['item']);    
}

function ajax_remove_one()
{
    $this->load->library('MY_Uploads');
    $this->my_uploads->ajax_remove_one();
    unset($_SESSION['item']);
}


function modal_fetch_ajax()
{
    $user_id = $this->input->post('userId', TRUE);
    $this->load->library('MY_Form_model');
    $response = $this->my_form_model->modal_fetch();
    $response['mysqlRows']->driver_lic = $data['driver_lic'];
       
    echo json_encode($response);                
    return;    
}

function modal_post_ajax()
{
    quit(88);
    $this->load->library('MY_Form_model');
    $update_id = $this->input->post('rowId', TRUE);
    unset($_POST['rowId']);

    $user_id = $this->site_security->_get_user_id();    
    $this->remove_rules($user_id);

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
