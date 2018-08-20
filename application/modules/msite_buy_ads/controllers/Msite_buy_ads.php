<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Msite_buy_ads extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'Mdl_msite_buy_ads';
var $store_controller = 'msite_buy_ads';

var $column_rules = array(
    array('field' => 'company_name', 'label' => 'Company Name', 'rules' => 'required'),
    array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
    array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
    array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),    
    array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
    array('field' => 'confirmEmail', 'label' => 'Confirm E-Mail Address', 'rules' => 'required'),
    array('field' => 'agree_terms', 'label' => 'You have to accept the terms and policies', 'rules' => 'required'),

);

function __construct() {
    parent::__construct();

}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function process_payment() {
 
    /* process changes */
    $this->load->library('form_validation');
    $this->form_validation->set_rules( $this->column_rules );

    if($this->form_validation->run() == TRUE) {
        /*   process paypal payment here   */
        $this->load->module('pay_pal');
        $paypal_trans_id = $this->pay_pal->proceed_with_pp();

$pay_pal_ok=true;

        if( $pay_pal_ok ){
            /* success from pay pal */
            $ad_id = $this->ads_purchased($paypal_trans_id);
            redirect( $this->store_controller.'/ad_form_completed/'.$ad_id );  
        } else {
            redirect( $this->store_controller.'/ad_form_failed');            
        }

    }

    $data = $this->input->post(NULL, TRUE);
    /* get ad levels from post  */
    $item_url = url_title( $data['itemname'] ); 
    $this->ad_form( $item_url );

}

function ad_form( $url_data = null ) {
    $item_url = $this->input->post('sel_level', TRUE);
    $item_url = isset($item_url) === true? $item_url : $url_data;

    /* get available ad levels */
    list($item_details, $item_title, $item_counts, $ad_plans) = $this->_ad_plan_details($item_url);

    $data_ad_info['item_details']  = $item_details;
    $data_ad_info['item_title']    = isset($item_title) ? $item_title : 'Advertise With Us';
    $data['data_ad_info']   = $data_ad_info;

    $data['ad_plans']   = $ad_plans;
    $data['item_counts']= $item_counts;
    $data['page_title'] = isset($item_title) ? $item_title : ' ';

    $data['custom_jscript'] = ['sb-admin/js/bootstrapValidator.min',
                               'public/js/ad_form_app',
                               'public/js/format_flds'
                              ];    
    $data['page_url']   = 'ad_form';
    $data['view_nav']   = 'ad_form_nav';
    $data['menu_level'] = 1;
    $data['left_side_nav'] =  false;

    $data['redeeme_Coupon'] = '';
    //$data['image_repro']    = ''; // set to empty to avoid erro in template processing

    $this->load->module('templates');
    $this->templates->public_main($data);

}

function _ad_plan_details($item_url) {
    $mysql_query = 'SELECT DISTINCT(item_title) AS ad_plan FROM msite_ads';
    $ad_plans = $this->_custom_query($mysql_query)->result();

    $sql_items = 'SELECT * FROM msite_ads
    WHERE `item_url` = "'.$item_url.'" order by page_order';
    $item_results = $this->_custom_query($sql_items)->result();
    $item_counts  = count($item_results);

    foreach ($item_results as $line=>$ad) {
        $item_title = $ad->item_title;

        $item_price = $ad->item_price;
        if( strlen($item_price)>3 ) {
            $len = strlen($item_price);
            $item_price = substr($item_price, -$len,$len-3).','.substr($item_price, -3, 3);
        }

        $ad_id = $ad->ad_id;
        $item_details[$ad_id][] =array(
        'page_ad'    => $ad->ad_id,
        'page_order' => $ad->page_order,
        'chkBox'     => 'chk_ad'.$ad->page_order,
        'item_price' => $ad->item_price,
        'display'    => ' ( $'.$item_price.' ) ',
        'ad_prem'    =>$ad->item_description
        );
    }
    return  array( $item_details, $item_title, $item_counts, $ad_plans );

}

function ads_purchased( $paypal_trans_id=null ) {
    /* Step 1 - payments */
    $site_payments['transactionid'] = $paypal_trans_id;
    $site_payments['trans_type'] = $this->input->post( 'trans_type', TRUE);
    $site_payments['pay_method'] = $this->input->post( 'pay_method', TRUE);
    $site_payments['amount']     = $this->input->post( 'itemprice', TRUE);
    $site_payments['username']   = $this->input->post( 'email', TRUE);
    $site_payments['create_date']= time();  // timestamp for database
    // echo $this->lib->checkArray($site_payments,0);


    /* Step 2 - insert new record */
    $msite_account_fields = array(
            'company_name', 'first_name', 'last_name', 'email', 'phone', 'comment'
    );

    foreach ($msite_account_fields as $key => $value) {
      $key_value = $value == 'username' ?  'email' :  $value ;
      $msite_accounts[ $value] = $this->input->post( $key_value, TRUE);
    }
    $msite_accounts['create_date'] = time();  // timestamp for database
    // echo $this->lib->checkArray($msite_accounts,1);

    /* Step 3 - buy_ads */
    $msite_buy_ads['buyer_id']      = '';
    $msite_buy_ads['transactionid'] = $paypal_trans_id;
    $msite_buy_ads['payment_id']    = '';
    $msite_buy_ads['product_id']    = $this->input->post( 'itemnumber', TRUE);
    $msite_buy_ads['prod_descrip']  = $this->input->post( 'itemname', TRUE );
    $msite_buy_ads['quantity']       = $this->input->post( 'itemQty', TRUE);
    $msite_buy_ads['amount']        = $this->input->post( 'itemprice', TRUE);
    $msite_buy_ads['create_date'] = time();  // timestamp for database

    /* Insert into mysql here */
    $this->load->model('mdl_msite_buy_ads');
    $ad_id = $this->mdl_msite_buy_ads->insert_ad_purchase( $site_payments, $msite_buy_ads, $msite_accounts );

    return $ad_id;
}

function ad_form_failed() {
    $data['page_title'] = 'Payment Processing: Failed ';
    $data['view_module']= 'msite_buy_ads';
    $data['page_url']   = 'ad_form_failed';     
    $data['view_nav']   = '';
    $data['nav_option'] = '';  // name of mysql to use. leave empty if none
    $data['image_repro']= '';
    $data['left_side_nav'] =  false;    
    $this->load->module('templates');
    $this->templates->public_main($data);    

}

function ad_form_completed($ad_id) {
    $mysql_query ="
    SELECT
    msite_accounts.company_name,
    msite_accounts.first_name,
    msite_accounts.last_name,
    msite_accounts.email,
    msite_accounts.phone,
    msite_accounts.comment,

    site_payments.transactionid as stran,
    site_payments.trans_type,
    site_payments.pay_method,

    msite_buy_ads.buyer_id,
    msite_buy_ads.transactionid as btran,
    msite_buy_ads.payment_id,
    msite_buy_ads.product_id,
    msite_buy_ads.prod_descrip,
    msite_buy_ads.quantity,
    msite_buy_ads.amount,
    msite_buy_ads.create_date

    FROM
    msite_accounts,
    msite_buy_ads,
    site_payments

    where 
    msite_buy_ads.id = 1
    and msite_buy_ads.buyer_id = msite_accounts.id
    and msite_buy_ads.payment_id = site_payments.id";

    $result_set = $this->_custom_query($mysql_query)->result();

    $data['result_set'] = $result_set[0];
    $data['page_title'] = 'Payment Processing: Success ';
    $data['view_module']= 'msite_buy_ads';
    $data['page_url']   = 'ad_form_completed';     
    $data['view_nav']   = '';
    $data['nav_option'] = '';  // name of mysql to use. leave empty if none
    $data['image_repro']= '';
    $data['left_side_nav'] =  false;
     
    $this->load->module('templates');
    $this->templates->public_main($data);    
}



/* ===============================================
    Call backs go here...
  =============================================== */




/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
