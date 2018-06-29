<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_msite_buy_ads extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here
    $table = "msite_buy_ads";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function insert_ad_purchase($payments, $ad_bought, $buyer_name ){
  // update payment table
  $table1  = 'site_payments';
  // buyer account
  $table2  = 'msite_accounts';
  // update buy_ad table
  $table3  = 'msite_buy_ads';

  $this->db->trans_start();
    $this->db->insert( $table1, $payments);
    $payment_id = $this->_get_insert_id('get_last_id');

    $this->db->insert( $table2, $buyer_name);
    $buyer_id = $this->_get_insert_id('get_last_id');

    /* update ad_bought array */
    $ad_bought['payment_id']    = $payment_id;
    $ad_bought['buyer_id']      = $buyer_id; 

    $this->db->insert( $table3, $ad_bought);    
    $ad_id = $this->_get_insert_id('get_last_id');

  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE)
  {
      // generate an error... or use the log_message() function to log your error
      "<h3>Problem with payment... Please contact us....<h3>";
  }

  return $ad_id;
}



/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class

