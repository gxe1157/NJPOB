<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_users_registration extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    // $table = "users_registration";
    // return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function insert_data( $payments, $user_login, $user_main )
{
  // user_login
  $table1  = 'user_login';
  // update payment table
  $table2  = 'site_payments';
  // user_main
  $table3  = 'user_main';

  $this->db->trans_start();
      $this->db->insert( $table1, $user_login);
      $user_id = $this->model_name->_get_insert_id();

      /* update payments array */
      $payments['user_id']  = $user_id;
      $this->db->insert( $table2, $payments);

      /* update user_main array */
      $user_main['user_id'] = $user_id;
      $this->db->insert( $table3, $user_main);    

      /* Create with tables with user_id and hold for future updates */
      $reserved_table_rows = array('user_address', 'user_mail_to', 'user_info',
       'user_employment_le', 'user_employment_prv_sector' );

      foreach ($reserved_table_rows as $table ) {
        $this->db->insert( $table, array('user_id' => $user_id, 'create_date' => time() ));
      }  

  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE) {
      /*-*/    
      // generate an error... or use the log_message() function to log your error
      // redirect to payment did not go through.. Start over.            
      fatal_error( 'user_registration : 1102' );

      // redirect( $this->main_controller.'/user_payment_declined');
  }
  
  /* Set session data */
  $newdata = array(
      'user_id'   => $user_id,
      'email'     => $user_login['email'],
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