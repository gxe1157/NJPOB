<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('login_init'))
{
	function login_init( ) {
	    $ci =& get_instance();
	    $ci->load->module('site_security');  

	    $userid = $ci->site_security->_get_user_id();	    
	    $userid = is_numeric( $userid ) ? $userid : 0; // Will return userid not a true or false
	    $login_data = $ci->model_name->get_login_byid($userid)->result();

	    $default['status']= $userid > 0 ? 1 : 0;
		$default['admin_id'] = $userid;	    /* tis user is logged */
	    $default['admin_name']= $userid>0 ? !empty($login_data[0]->username) ? $login_data[0]->username: $login_data[0]->first_name : '';
	    $default['avatar_admin']= $userid>0 ? $login_data[0]->avatar_name : '';
 	    $default['is_admin']= $userid>0 ? $login_data[0]->is_admin : '';
 	    $default['is_deleted']= $userid>0 ? $login_data[0]->is_deleted : '';
		$default['is_logged_in'] = $ci->session->is_logged_in; 	    
	    $default['page_title'] = "";

	    return $default;
	}
}

if ( ! function_exists('get_login_info'))
{
	function get_login_info($update_id)
	{
		if( empty($update_id) )
			return [ null, null, null, null,null];

	    $ci =& get_instance();

	    $results_set = $ci->model_name->get_login_byid($update_id)->result();
	    $avatar_name = $results_set[0]->avatar_name;
	    $status = $results_set[0]->status;
	    $member_id = $results_set[0]->id;
	    $avatar_name = $avatar_name !='' ? $avatar_name : 'annon_user.png';
	    $fullname = $results_set[0]->first_name.' '.$results_set[0]->last_name;
  	    $member_level = $results_set[0]->membership_level;

	    return [$status, $avatar_name, $member_id, $fullname, $member_level];
	}
}


if ( ! function_exists('dd'))
{
	function dd( $array = array(), $exit = null){
	    echo "<pre>";
	    print_r($array);
	    echo "</pre>";
	    if( empty($exit) ) exit();
	}
}

if ( ! function_exists('ddf'))
{
	function ddf( $fld = null, $exit = null){
	    echo "<h4>fld| ".$fld." |</h4>";
	    if( empty($exit) ) exit();  
	}
}

if ( ! function_exists('quit'))
{
	function quit($output = null, $exit = null){
	    echo('<h3>Debug: '.$output.'</h3>');
	    if( empty($exit) ) exit();  
	}
}

                        
if ( ! function_exists('fatal_error'))
{
	function fatal_error( $code ) {
	   die("<h3>We seem to be having techincal difficulties. Contact web developer and provide this error code: ".$code."</h3");
	}
}

if ( ! function_exists('base_dir'))
{
	function base_dir(){
    	$base_dir = explode('application', APPPATH);
    	return $base_dir[0];
	}
}


if ( ! function_exists('SQLformat_date'))
{
	function SQLformat_date($date){
	    $temp=$date[6].$date[7].$date[8].$date[9].'-'.$date[0].$date[1].'-'.$date[3].$date[4];
	    return $temp;
	}
}

if ( ! function_exists('format_date'))
{
	function format_date($date){
	    if(empty($date)) $date ="0000/00/00";
	    $temp=$date[5].$date[6].'/'.$date[8].$date[9].'/'.$date[0].$date[1].$date[2].$date[3];
	    return ($temp == '00/00/0000' || $temp == '//') ? null : $temp;
	}
}


if ( ! function_exists('convert_timestamp'))
{
	function convert_timestamp($timestamp, $format)	{ 
     
	     switch ($format) {
	         case 'info':
	         //INFO // 08 March 2018 10:15 AM 
	         $the_date = date('j F Y h:i A', $timestamp);
	         break;          

	         case 'full':
	         //FULL // Friday 18th of February 2011 at 10:00:00 AM       
	         $the_date = date('l jS \of F Y \a\t h:i:s A', $timestamp);
	         break;          
	         case 'cool':
	         //COOL // Friday 18th of February 2011          
	         $the_date = date('l jS \of F Y', $timestamp);
	         break;                  
	         case 'datepicker_us':
	         //DATEPICKER  // 2/18/11         
	         $the_date = date('m\/d\/Y', $timestamp); 
	         break;  
	     }
	     return $the_date;
	}
}


if ( ! function_exists('last_referer'))
{
	function last_referer() {
	   $current_file = explode('/', $_SERVER['HTTP_REFERER']);
	   $array_count = count($current_file);
	   $new_array = $current_file[ $array_count-2 ]."/".$current_file[ $array_count -1];
	   return $new_array;
	}
}


if ( ! function_exists('required_fields'))
{
	function required_fields($column_rules){
        $field_name = '';		
	    foreach ($column_rules as $key => $value) {
            $column_rule = $column_rules[$key]['rules'];
	        if( strpos($column_rule, 'required') !== false ){     
	            $field_name = $column_rules[$key]['field'];
	            $req_flds[$field_name] = '<span style="color: red; font-size: 1.4em"> * </span>';
	        }
	    }
	    return $req_flds;
	}
}


/* ===============================================
	Custom for this site
  =============================================== */


if ( ! function_exists('image_pagination'))
{
	function image_pagination( $imgDir ){
	    $bm_pages = array();
	    if (is_dir(FCPATH.$imgDir)){
	        if ($dirHandle = opendir(FCPATH.$imgDir)){
	            while($file = readdir($dirHandle)){
	                if ( $file != 'Thumbs.db' && $file != "." && $file != ".." ) {
	                    $bm_pages[] = base_url().$imgDir.'/'.$file;
	                 }
	            }
	            closedir($dirHandle);
	        }
	    }
	    
	    if( count($bm_pages) == 0 ){
	         $bm_pages[] = base_url().'public/images/404-error-page.jpg';
	    }

	    return $bm_pages;
	}

}

if ( ! function_exists('create_links'))
{
	function create_links( $bm_pages ) {
	    $x = 0;
	    $get_link = 'Page: ';
	    foreach( $bm_pages as $key => $value) {   
	        $x++;
	        $get_link .= '<a id="img'.$x.'" href="javascript:nextPage('.$x.')" >&nbsp;&nbsp;'.$x.' </a> ';
	    }
	    return $get_link;
	}
}


