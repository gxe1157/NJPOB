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
      // generate an error... or use the log_message() function to log your error
      //send email with payment information to webmaster        

      quit('payment posting failed...... ');
      redirect( $this->main_controller.'/user_payment_declined');
  }

  return $new_insert_id;
}



function get_shield_id($user_id=null)
{
    // SELECT * FROM car_shields INNER JOIN users ON car_shields.user_id=users.id;
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
        users.email,
        users.first_name,
        user_info.social_sec,
        user_info.driver_lic
    ');

    $this->db->join('users', 'users.id = car_shields.user_id', 'left');
    $this->db->join('user_info', 'user_info.id = car_shields.user_id', 'left');
    $this->db->from('car_shields');


    if( is_numeric($user_id) )
        $this->db->where( array("car_shields.user_id"=> $user_id) );    

    $query = $this->db->get();
    return $query;

}   

function _post_payment()
{
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

    return [$site_payments, $car_shields];
}


/* ===============================================
    David Connelly's work from mdl_perfectmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */


}// end of class
