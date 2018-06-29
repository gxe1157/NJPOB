<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_legislative_outreach extends MY_Model
{  

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here
    $table = "legislative_outreach";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function get_legislative_id($update_id=null)
{
    $this->db->select('
        legislative_outreach.id,
        legislative_outreach.user_id,
        legislative_outreach.first_name,
        legislative_outreach.last_name,
        legislative_outreach.middle_name,
        legislative_outreach.address1,
        legislative_outreach.address2,
        legislative_outreach.city,
        legislative_outreach.state,
        legislative_outreach.zip,
        legislative_outreach.occupation,
        legislative_outreach.phone,
        legislative_outreach.cell_phone,
        legislative_outreach.dob,
        legislative_outreach.email,
        user_main.email as useremail,
        user_main.first_name as userfirst,
        user_main.last_name as userlast
    ');

    $this->db->from('legislative_outreach');
    $this->db->join('user_main', 'user_main.id = legislative_outreach.user_id', 'left');

    /* Display only one per userid */
    if( uri_string() == 'legislative_outreach/manage' )
        $this->db->group_by('user_id');
    /* Display all by user_id */
    if( is_numeric($update_id) )
        $this->db->where( array("legislative_outreach.user_id"=> $update_id) );    


    $query = $this->db->get();
    return $query;
}   

// function update_data( $table_name, $table_data, $user_id)
// {
//   /* Check if user_id in table */
//   if( empty($user_id) ) $user_id = 0; //die('----- user_id is empty ------');

//   $this->db->where('id', $user_id);
//   $query=$this->db->get($table_name);
//   $num_rows = $query->num_rows();
  
//   if($num_rows>0){
//       /* update by user_id */    
//       $table_data['modified_date']= time();      
//       $table_data['admin_id'] = $user_id;
//       $this->db->where('id', $user_id);
//       $this->db->update( $table_name, $table_data);

//       $rows_updated = $this->db->affected_rows();
//       return $rows_updated;          
//   } else {
//       /* insert new record */
//       die( 'User_id: '.$user_id.' for table ['.$table_name.'] tried Illegal record insert | Prg: users_application |');
//   }    
//   /*-*/    
// }



/* ===============================================
    David Connelly's work from mdl_perfectmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class
