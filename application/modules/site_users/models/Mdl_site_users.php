<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_site_users extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "users";
    return $table;
}



/* ===================================================
    Add custom model functions here
   =================================================== */

function fetch_form_data( $user_id=null )
{
    $this->db->select('
      users.*,
      user_address.*,
      user_mail_to.*,
      user_info.*,
      user_employment_le.*,
      user_children.*,
      user_employment_prv_sector.*,
    ');


    $this->db->join('user_address','user_address.id = users.id', 'left');
    $this->db->join('user_mail_to','user_mail_to.id = users.id', 'left');
    $this->db->join('user_info','user_info.id = users.id', 'left');
    $this->db->join('user_employment_le','user_employment_le.id = users.id', 'left');
    $this->db->join('user_children','user_children.id = users.id', 'left');
    $this->db->join('user_employment_prv_sector', 'user_employment_prv_sector.id = users.id', 'left');

    $this->db->from('users');

    if( is_numeric($user_id) )
        $this->db->where( array("users.id"=> $user_id) );    

    $query = $this->db->get();
    $result_set = $query->result();
    return $result_set;
}   
         
function update_data( $table_name, $table_data, $user_id )
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
      die( 'User_id: '.$user_id.' for table ['.$table_name.'] tried Illegal record insert | Prg: users_application |');
  }    

  /*-*/    
}


/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class