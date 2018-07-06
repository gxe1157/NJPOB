<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{

public $default = [];


function __construct()
{
  parent::__construct();
    
  $this->load->module('site_security');
  $this->load->library('form_validation');
  $this->form_validation->CI =& $this;

  /* ===============================================================
     model name is assigned from $this->mdl_name to  'model_name' which is a constant
     =============================================================== */
   if( $this->mdl_name != 'mdl_' ) $this->load->model( $this->mdl_name, 'model_name');
   /* Check Logged in Status */
   $this->default = login_init();
}

/* ===============================================
   Add DRY funtions  // Added By Evelio Velez 04-2017
   =============================================== */

function send_mail( $email, $type, $mess_ecode)
{
    if( ENV != 'live')  return false;

    $results_set = $this->model_name->get_view_data_custom('type', $type, 'site_admin_emails', null)->result();

    $admin_email = $results_set[0]->admin_email;
    $from        = $results_set[0]->from;
    $subject     = $results_set[0]->subject;
    $message     = $results_set[0]->body;

    $domain  = base_url();
    $message = sprintf($message, $domain, $mess_ecode);

    $this->load->library('email');
    $this->email->from( $from, $user_id);
    $this->email->to($email);
    $this->email->cc($admin_email);

    $this->email->subject($subject);
    $this->email->message($message);

    $this->email->send();

    // if ( ! $this->email->send()) {
    //         // Generate log error
    // }
}


function _security_check()
{
    // ! - line below is not active - !
    // $this->site_security->_make_sure_is_admin();
}

function _numeric_check($update_id)
{
    if( !is_numeric($update_id) )
        redirect('site_security/not_allowed');
}

function _set_flash_msg($flash_msg, $type = 'success')
{
    $value = '<div class="alert alert-'.$type.'" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
}

function _set_flash_danger_msg($flash_msg)
{
    $value = '<div style="border: 5px solid #578EBE; padding:10px; background-color: #f7d1b2; color: #000; font-size: 1.25em;">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
}


function _get_column_names( $key_value )  // we will use for $key_value only "field" or "label"
{
    foreach ($this->column_rules as $key => $value) {
        if( $key_value == 'field' ) {
            $data[] = $this->column_rules[$key][$key_value];
        } else {
            $field  = $this->column_rules[$key]['field'];
            $data[$field] = $this->column_rules[$key]['label'];
        }
    }
    return $data;
}


function fetch_data_from_post()
{
    $field_names = $this->_get_column_names('field');
    $data = $this->model_name->_fetch_data_from_post($field_names);

    return $data;
}

function fetch_data_from_db($update_id)
{
    $field_names = $this->_get_column_names('field');
    $data = $this->model_name->_fetch_data_from_db($update_id, $field_names);

    if( !isset($data) ) {
        redirect( 'store_items/manage');
    }
    return $data;
}

function _get_cat_title( $update_id )
{
    $data = $this->fetch_data_from_db( $update_id );
    $cat_title = $data['cat_title'];
    return $cat_title;
}

function _get_first_record( $q, $id)  // This controller does not need a model
{
        $result_set = $q->result();
        return  $result_set[0]->$id;
}


function search()
{

    $query = $_REQUEST['query'];
    // $term = $this->input->post('term', TRUE);
    $stmt = "SELECT id, email, first_name, last_name FROM users 
             WHERE email LIKE '%".$query."%' limit 10";

    $query = $_REQUEST['query'];

    $results_set=$this->model_name->_custom_query($stmt);
    foreach ($results_set->result() as $key => $row) {
        $json[] = $row->first_name.' '.$row->last_name.' | '.$row->email;
    }

    //RETURN JSON ARRAY
    echo json_encode ($json);

}

function _build_flds()
{
    $is_req_output ='<i class="fa fa-asterisk"
                     style="font-size: .6em;color:red;" 
                     aria-hidden="true"></i>';

    foreach ($this->column_rules as $key => $value) {
        $is_required = substr($this->column_rules[$key]['rules'],0,8 );
        $field  = $this->column_rules[$key]['field'];
        $fld_data[$field] = [
            'label' => $this->column_rules[$key]['label'],
            'required' => $is_required == 'required' ? $is_req_output : '',
            'icon' => $this->column_rules[$key]['icon'],
            'input_type' => $this->column_rules[$key]['input_type']
        ];
    }
    return $fld_data;
}
/* ===============================================
   Below is Perfect Controller From David Connelly
   =============================================== */

function get($order_by, $table_name = null)
{
    $query = $this->model_name->get($order_by, $table_name);
    return $query;
}

function get_with_limit($limit, $offset, $order_by)
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $query = $this->model_name->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id, $table_name = null)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable! '.$id);
    }

    $query = $this->model_name->get_where($id, $table_name);
    return $query;
}

function get_where_custom($col, $value, $order_by = null)
{
    $query = $this->model_name->get_where_custom($col, $value, $order_by);
    return $query;
}


function _insert($data, $table_name = null)
{
    $this->model_name->_insert($data, $table_name);
    return $this->model_name->_get_insert_id(); // added 07-22-17 Evelio   
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $rows_updated = $this->model_name->_update($id, $data);
    return $rows_updated;
}

function _delete($id, $table_name = null)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $rows_deleted = $this->model_name->_delete($id, $table_name);
    return $rows_deleted;
}

function count_where($column, $value)
{
    $count = $this->model_name->count_where($column, $value);
    return $count;
}

function get_max()
{
    $max_id = $this->model_name->get_max();
    return $max_id;
}

function _custom_query($mysql_query)
{
    $query = $this->model_name->_custom_query($mysql_query);
    return $query;
}




}
