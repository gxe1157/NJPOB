<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_users_registration extends MY_Model
{

function __construct( )
{
    parent::__construct();

}

function get_table()
{
	// table name goes here	
  // $table = "users_registration";
  // return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function insert_data()
{
  $this->load->module('auth');

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

  /* Step 2 - new user */
  $email_temp = explode('@', $_SESSION['email']);
  $username   = $email_temp[0];
  $password   = 'Smokey{2012}';
  $email      = $_SESSION['email'];

  $additional_data = array(
      'first_name' => $_SESSION['first_name'],
      'last_name'  => $_SESSION['last_name'],
      'middle'     => $_SESSION['middle_name'],        
      'phone'      =>  $_SESSION['phone'],
      'admin_id'   => 0,        
      'membership_level' => $_SESSION['itemnumber']
  );
  $group = array('2'); // Sets user to admin.

  $this->db->trans_start();
      /* new user */
      $user_id = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

      /* update payments array */
      $site_payments['user_id']  = $user_id;
      $this->db->insert('site_payments', $site_payments);

      /* Create with tables with user_id and hold for future updates */
      $reserved_table_rows = array('user_address', 'user_mail_to', 'user_info',
       'user_employment_le', 'user_employment_prv_sector' );

      foreach ($reserved_table_rows as $table ) {
        $this->db->insert( $table, array('user_id' => $user_id, 'create_date' => time() ));
      }  
  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE) {
      // generate an error... or use the log_message() function to log your error
      fatal_error( 'Mdl_users_registration : 1102' );

      $this->load->library('MY_Email_send');
      $mess_code = 'Database failed to save entry at Mdl_users_registration : 1102';
      $this->my_email_send->email_report($mess_ecode);          

      redirect( $this->main_controller.'/user_payment_declined');
  }

/* Set session data */
  $newdata = array(
      'user_id'   => $user_id,
      'logged_in' => TRUE
  );
  
  $this->session->set_userdata($newdata);       

}




/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class