<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Youraccount extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_youraccount';
public $main_controller = 'youraccount';

public $flash_msg = '';
public $default = [];

function __construct( ) {
    parent::__construct();
    $this->default['flash'] = $this->session->userdata('item');
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function welcome()
{
    $this->load->module('auth');
    $user = $this->ion_auth->user()->result()[0];

    // $data['flash'] = $this->session->flashdata('item');
    list( $data['status'], $data['user_avatar'],
          $data['member_id'], $data['fullname'], $data['member_level'] ) = get_login_info($user->id); 

    $data['default'] = $this->default;
    $data['menu_level'] = 1;
    $data['custom_jscript'] = ['public/js/site_init',
                               'public/js/site_user_details',
                               'public/js/member-portal',
                               'public/js/model_js',
                              ];

    $data['page_url'] = 'welcome';
    $data['page_title'] = 'Member Portal';
    $data['image_repro'] = '';
    $data['left_side_nav'] = true;
    $data['view_module'] = 'youraccount';
    $data['title'] = "Welcome. You are logged in.";
    $data['update_id'] = $user->id;
    
    $this->load->module('templates');
    $this->templates->public_main($data);     
}

function check_password_ajax()
{
    $this->load->module('site_security');
    $userid = $this->site_security->_make_sure_logged_in();

    $results_set = $this->model_name->get_view_data_custom('id', $userid, 'user_login', null)->result();
    $pword_on_table = $results_set[0]->password;

    $old_password = $this->input->post('old_password', TRUE);
    $result = $this->site_security->_verify_hash($old_password, $pword_on_table);

    if ($result==TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

function complete_application()
{

    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();

    $data['flash'] = $this->session->flashdata('item');
    $data['menu_level'] = 1;

    $data['custom_jscript'] = [];
    $data['page_url'] = 'complete_application';
    $data['page_title'] = 'Member Portal';
    $data['image_repro'] = '';
    $data['left_side_nav'] = '';
    $data['view_module'] = 'youraccount';
    $data['title'] = "Welcome. You are logged in.";

    $this->load->module('templates');
    $this->templates->public_main($data);     
}

function site_404page()
{
    $data['page_url'] = 'site_404page';
    $data['view_module'] = 'partials';
    $data['page_title'] = 'Member Portal';    
    $data['title'] = "Membership Login";
    $data['left_side_nav'] = false;
    $data['custom_jscript'] = [];
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
