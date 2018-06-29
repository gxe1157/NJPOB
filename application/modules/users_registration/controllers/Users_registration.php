<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Users_registration extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_users_registration';
var $main_controller = 'users_registration';

var $column_rules = array(
    array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
    array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
    array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),
    array('field' => 'email', 'label' => 'Email','rules' => 'required|valid_email|is_unique[user_login.email]'),
    array('field' => 'confirmEmail', 'label' => 'Confirm E-Mail Address', 'rules' => 'required|valid_email'),
    array('field' => 'agree_terms',
          'label' => 'I agree to the following: Terms and Conditions', 'rules' => 'required'),
    array('field' => 'itemname', 'label' => 'Membership payment plan was not selected', 'rules' => 'required'),
);

    
    // $this->form_validation->set_rules('domain_name','Domain Name','required|is_unique[domains.domain_name]',array('is_unique' => 'This %s already exists.'));

function __construct() {
    parent::__construct();


}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function index()
{
//    $this->_security_check();  

    $Selected_plan = $this->input->post('selected_plan', TRUE);
    $sql_items = 'SELECT * FROM membership_plans
                  WHERE `mem_plan_level` = "'.$Selected_plan.'"';

    $data['plans'] = $this->_custom_query($sql_items)->result();

    $data['gateway_name'] = 'PayPal';
    $data['custom_jscript'] = ['sb-admin/js/bootstrapValidator.min',
                               'public/js/model_js',
                               'public/js/user_register_app',
                               'public/js/format_flds'     
                              ];

    $data['page_url'] = 'user_register';
    $data['page_title'] = 'Membership Registration';
    $data['image_repro'] = '';
    $data['left_side_nav'] = false;
    $data['view_module'] = 'users_registration';
    $data['title'] = "Membership Registration";

    $this->load->module('templates');
    $this->templates->public_main($data);
}


function check_user_ajax()
{
    // Get the username from request
    $email = $_POST['email'];
    // Check its existence (for example, execute a query from the database) ...
    $table = 'user_login';
    $orderby = '';
    $results = $this->model_name->get_view_data_custom('email', $email, $table, $orderby);
    $isAvailable = $results->num_rows()>0 ? false : true;

    // Finally, return a JSON
    echo json_encode(array(
          'valid' => $isAvailable,
        ));
}


function process_payment()
{
    $this->_security_check();  

    // process changes
    $this->load->library('form_validation');
    $this->form_validation->set_rules( $this->column_rules ); 

    if($this->form_validation->run() == TRUE) {
        /* process paypal payment here */
        $source_page = 'users_registration';

        /* Payment Method Goes Here */
        $this->load->module('pay_pal');
        /* ENV is localhost or live */
        ENV != 'live' ? $this->pay_pal->test_mode($source_page) : $this->pay_pal->process_paypal($source_page);
    } else {
        /* Form validation failed */  
        $_POST['selected_plan'] = $this->input->post('itemnumber', TRUE);
        $this->index();
    }

} /* end- process_payment */


function post_payment()
{
    $this->load->module('site_security');  

    /* Step 1 - payments */
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


    /* Step 2 - insert new record */
    $user_login['username']    = '';
    $user_login['email']       = $_SESSION['email'];
    $user_login['password']    = $this->site_security->_hash_string('Smokey{2012}');

    $user_login['security_code'] = $_SESSION['transactionid'];
    $user_login['create_date'] = time();  // timestamp for database

    /* Step 3 - insert new record */
    $user_main['first_name']   = $_SESSION['first_name'];
    $user_main['last_name']    = $_SESSION['last_name'];
    $user_main['middle_name']  = $_SESSION['middle_name'];
    $user_main['phone']        = $_SESSION['phone'];
    $user_main['email']        = $_SESSION['email'];
    $user_main['membership_level'] = $_SESSION['itemnumber'];
    $user_main['create_date']  = time();  // timestamp for database
    $user_main['admin_id']     = 0;

    /* Insert into mysql here */
    $this->model_name->insert_data( $site_payments, $user_login, $user_main );

    /* Send Email */
    if( ENV == 'live') {
        $email = $user_main['email'];  
        $this->send_mail($email, 'registration_paid', $site_payments['transactionid']);     
        $this->send_mail($email, 'activate', $site_payments['transactionid']);     
    }
    redirect( $this->main_controller.'/payment_accepted');

}


function payment_accepted()
{
    $data['page_title'] = 'Payment Processing: Complete ';
    $data['view_module']= 'users_registration';
    $data['page_url']   = 'user_payment_accepted';     
    $this->_show_page($data);
}


function payment_declined()
{
    $data['page_title'] = 'Payment Processing: Declined';
    $data['view_module']= 'users_registration';
    $data['page_url']   = 'user_payment_declined';     
    $this->_show_page($data);
}

function _show_page($data)
{

    $data['tranactionid'] = $_SESSION['transactionid'];    
    $data['email'] = $_SESSION['email'];    

    /* destroy $_SESSION['session_keys'] wich has paypal data */
    foreach ($_SESSION['session_keys'] as $key => $value) {
        unset($_SESSION[$value]);
    }
    unset($_SESSION['session_keys']);          

    $data['custom_jscript'] = [];  
    $data['view_nav']   = '';
    $data['nav_option'] = '';  // name of mysql to use. leave empty if none
    $data['image_repro']= '';
    $data['left_side_nav'] =  false;    

    $this->load->module('templates');
    $this->templates->public_main($data);    

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
