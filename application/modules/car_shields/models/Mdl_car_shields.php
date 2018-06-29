<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_car_shields extends MY_Model
{  

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here
    $table = "car_shields";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function insert_data( $site_payments, $car_shields )
{
  // update payment table
  $table1  = 'site_payments';
  $table2  = 'car_shields';

  $this->db->trans_start();
      /* insert payments array */
      $site_payments['user_id']  = $car_shields['user_id'];
      $this->db->insert( $table1, $site_payments);

      /* insert car_shields array */
      $this->db->insert( $table2, $car_shields);    
      /* get record id number after insert completed */ 
      $new_insert_id = $this->db->query('SELECT LAST_INSERT_ID() as last_id')->row()->last_id;
  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE) {
      /*-*/    
      // generate an error... or use the log_message() function to log your error
      //send email with payment information to webmaster        

      quit('payment posting failed...... ');
      redirect( $this->main_controller.'/user_payment_declined');
  }
  return $new_insert_id;
}



function get_shield_id($user_id=null)
{
    // SELECT * FROM car_shields INNER JOIN user_main ON car_shields.user_id=user_main.id;
    /* example of 3 table join */ 
    // $this->db->select('*');
    // $this->db->join('table2', 'table2.ID = table1.ID');
    // $this->db->join('table3', 'table3.ID = table1.ID');
    // $this->db->from('table1');    

    $this->db->select('
        car_shields.id,
        car_shields.user_id,
        car_shields.make,
        car_shields.model,
        car_shields.model_year,
        car_shields.plate_no,
        car_shields.vin_no,
        car_shields.shield_no,
        car_shields.status,
        car_shields.create_date,
        user_main.email,
        user_main.first_name,
        user_info.social_sec,
        user_info.driver_lic
    ');

    $this->db->join('user_main', 'user_main.id = car_shields.user_id', 'left');
    $this->db->join('user_info', 'user_info.id = car_shields.user_id', 'left');
    $this->db->from('car_shields');


    if( is_numeric($user_id) )
        $this->db->where( array("car_shields.user_id"=> $user_id) );    

    $query = $this->db->get();
    return $query;

}   


/* ===============================================
    David Connelly's work from mdl_perfectmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */


}// end of class
