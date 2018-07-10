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
        users.email as useremail,
        users.first_name as userfirst,
        users.last_name as userlast
    ');

    $this->db->from('legislative_outreach');
    $this->db->join('users', 'users.id = legislative_outreach.user_id', 'left');

    /* Display only one per userid */
    if( uri_string() == 'legislative_outreach/manage' )
        $this->db->group_by('user_id');
    /* Display all by user_id */
    if( is_numeric($update_id) )
        $this->db->where( array("legislative_outreach.user_id"=> $update_id) );    


    $query = $this->db->get();
    return $query;
}   

function build_table_row(&$response, $user_id, $id )
{
    $id = $response['new_update_id'] ? : $id;

    $query = $this->model_name->get_where($user_id, 'users')->row();
    $fullname = $query->first_name.' '.$query->last_name;

    $voter_fname = $this->input->post('first_name', TRUE);
    $voter_lname = $this->input->post('last_name', TRUE);
    $voter_city  = $this->input->post('city', TRUE);
    $voter_email = $this->input->post('email', TRUE);

    $line = '';
    $line .='<td class="right">'.$fullname.'</td>';   
    $line .='<td class="right">'.$voter_fname.' '.$voter_lname.'</td>';
    $line .='<td class="right">'.$voter_city.'</td>';
    $line .='<td class="right">'.$voter_email.'</td>';
    $line .='<td class="center">
        <a class="btn btn-danger btn-sm btnConfirm actionBtn" id="delete-danger"
        href="http://localhost/njpob/legislative_outreach/delete/'.$id.'">
        <i class="fa fa-trash fa-fw"></i> Remove
        </a>
        <button class="btn btn-info btn-sm btn-edit actionBtn" id="'.$id.'/'.$user_id.'" onClick="javascript: editBtn(this)"><i class="fa fa-pencil fa-fw"></i> Edit</button></td>';

    return $line;
}



/* ===============================================
    David Connelly's work from mdl_perfectmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class
