<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_business_listings extends MY_Model
{  

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here
    $table = "business_listings";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function get_business($user_id=null)
{
    // SELECT * FROM car_shields INNER JOIN users ON car_shields.user_id=users.id;
    /* example of 3 table join */ 
    // $this->db->select('*');
    // $this->db->join('table2', 'table2.ID = table1.ID');
    // $this->db->join('table3', 'table3.ID = table1.ID');
    // $this->db->from('table1');    

    $this->db->select('
        business_listings.id,
        business_listings.user_id,
        business_listings.business,
        business_listings.bus_category,
        business_listings.specialization,
        business_listings.city,                        
        business_listings.state,                                
        users.email,
        users.first_name,
    ');

    $this->db->join('users', 'users.id = business_listings.user_id', 'left');
    $this->db->from('business_listings');


    if( is_numeric($user_id) )
        $this->db->where( array("business_listings.user_id"=> $user_id) );    

    $query = $this->db->get();
    return $query;

}   

function build_dropdowns( $table )
{
    $mysql_query = "select * from ".$table;
    $results_set = $this->_custom_query($mysql_query);

    $dropdown_options = ['' => "Select ...."];
    foreach ($results_set->result() as $key => $value) {
        $dropdown_options[] = $value->category;
    }

    return  $dropdown_options;
}

function update_data( $table_name, $table_data, $user_id)
{
  /* Check if user_id in table */
  if( empty($user_id) ) $user_id = 0; //die('----- user_id is empty ------');

  $this->db->where('id', $user_id);
  $query=$this->db->get($table_name);
  $num_rows = $query->num_rows();
  
  if($num_rows>0){
      /* update by user_id */    
      $table_data['modified_date']= time();      
      $table_data['admin_id'] = $user_id;
      $this->db->where('id', $user_id);
      $this->db->update( $table_name, $table_data);

      $rows_updated = $this->db->affected_rows();
      return $rows_updated;          
  } else {
      /* insert new record */
      die( 'User_id: '.$user_id.' for table ['.$table_name.'] tried Illegal record insert | Prg: Car shield |');
  }    
  /*-*/    
}


/* ===============================================
    David Connelly's work from mdl_perfectmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class
