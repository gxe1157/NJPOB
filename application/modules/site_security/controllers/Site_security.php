<?php
class Site_security extends MX_Controller 
{

function __construct() {
parent::__construct();

}

function _get_user_id()
{
    //attempt to get the ID of the user
    //start by checking for a session variable
    $user_id = $this->session->userdata('user_id');

    if (!is_numeric($user_id)) {
        //check for a valid cookie
        $this->load->module('site_cookies');
        $user_id = $this->site_cookies->_attempt_get_user_id();
    }
    return $user_id;
}

function is_logged_in()
{
    $user_id = $this->_get_user_id();
    return (!is_numeric($user_id)) ? true : false;
}

function _make_sure_logged_in()
{
    //make sure the customer (member) is logged
    $user_id = $this->_get_user_id();
    if (!is_numeric($user_id)) {
        quit('userid not found : site_security '.$redirect_to);
        redirect('youraccount/login');
    }
    return $user_id;    
}


function _make_sure_is_admin() 
{
    $is_admin = $this->session->userdata('is_admin');
    if ($is_admin==1) {
        return TRUE;
    } else {
       redirect('site_security/not_allowed');
    }
}

function not_allowed() 
{
    echo "You are not allowed to be here.";
}

function generate_random_string($length) {
    $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function _hash_string($str)
{
    $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
        'cost' => 11
    ));
    return $hashed_string;
}

function _verify_hash($plain_text_str, $hashed_string)
{
    $result = password_verify($plain_text_str, $hashed_string);
    return $result; //TRUE or FALSE
}

function _encrypt_string($str)
{
    $this->load->library('encryption');
    $encrypted_string = $this->encryption->encrypt($str);
    return $encrypted_string;
}

function _decrypt_string($str)
{
    $this->load->library('encryption');
    $decrypted_string = $this->encryption->decrypt($str);
    return $decrypted_string;
}

function _decode_ss($str)
{
    $last4_social=null;
    if($str){
       $this->load->library('encryption');
        $decrypted_string = $this->encryption->decrypt($str);
        $last4_social = 'xxx-xx-'.substr($decrypted_string,5,4);
    }
    return $last4_social;
}

function _mask_driver_lic($str)
{
    $driver_lic=null;
    if($str){
       $this->load->library('encryption');
       $decrypted_string = $this->encryption->decrypt($str);
       // $last4_social = 'xxx-xx-'.substr($decrypted_string,5,4);
    }
    return $str;
}

function create_key()
{
    $this->load->library('encryption');    
    $key = bin2hex($this->encryption->create_key(16));

    $base64_encode =  base64_encode($key);
    $base64_decode =  base64_decode($base64_encode);    

    quit($key,1);
    quit($base64_encode,1);    
    quit($base64_decode,0);        
}

}