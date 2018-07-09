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
    array('field' => 'email', 'label' => 'Email','rules' => 'required|valid_email|is_unique[users.email]'),
    array('field' => 'confirmEmail', 'label' => 'Confirm E-Mail Address', 'rules' => 'required|valid_email'),
    array('field' => 'agree_terms',
          'label' => 'I agree to the following: Terms and Conditions', 'rules' => 'required'),
    array('field' => 'itemname', 'label' => 'Membership payment plan was not selected', 'rules' => 'required'),
);

private $user = [];

function __construct() {
    parent::__construct();
    $this->load->module('auth');
    // $this->user = $this->ion_auth->user()->row();
}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function index()
{
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
    $table = 'users';
    $results = $this->model_name->get_view_data_custom('email', $email, $table, null);
    $isAvailable = $results->num_rows()>0 ? false : true;

    // Finally, return a JSON
    echo json_encode( array('valid' => $isAvailable) );
}


function process_payment()
{
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
    /* Insert into mysql here */
    $this->model_name->insert_data();

    /* Send Email */
    $this->load->library('MY_Email_send');
    $email_to = $_SESSION['email'];  
    $type = 'registration_paid';
    $variables = null;    
    $this->my_email_send->send_admin_email($email_to, $type, $variables);
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

function exit_after_payment()
{
    $flash_msg = $this->model_name->get_view_data_custom(
                'title', 'save_check_email', 'site_messages', null)->row(); 
    $this->session->set_userdata('logout_msg', $flash_msg);

    /* Send Email */
    $this->load->library('MY_Email_send');
    $email_to = $users['email'];  
    $type = 'activate';
    $variables = array($_SESSION['transactionid']);

    redirect('auth/logout'); 
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
