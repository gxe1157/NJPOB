<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Timedates extends MY_Controller 
{

/* model name goes here */
var $mdl_name   = '';

function __construct() {
    parent::__construct();
}

function get_nice_date($timestamp, $format)
{ 
     
     switch ($format) {
         case 'full':
         //FULL // Friday 18th of February 2011 at 10:00:00 AM       
         $the_date = date('l jS \of F Y \a\t h:i:s A', $timestamp);
         break;          
         case 'cool':
         //FULL // Friday 18th of February 2011          
         $the_date = date('l jS \of F Y', $timestamp);
         break;                  
         case 'shorter':
         //SHORTER // 18th of February 2011          
         $the_date = date('jS \of F Y', $timestamp);
         break;          
         case 'mini':
         //MINI  // 18th Feb 2011
         $the_date = date('jS M Y', $timestamp);
         break;          
         case 'oldschool':
         //OLDSCHOOL  // 18/2/11         
         $the_date = date('j\/n\/y', $timestamp); 
         break;
         case 'datepicker':
         //DATEPICKER  // 18/2/11         
         $the_date = date('d\-m\-Y', $timestamp); 
         break;  
         case 'datepicker_us':
         //DATEPICKER  // 2/18/11         
         $the_date = date('m\/d\/Y', $timestamp); 
         break;  

         case 'monyear':
         //MINI  // 18th Feb 2011
         $the_date = date('F Y', $timestamp);
         break; 
     }
     return $the_date;
}

function make_timestamp_from_datepicker($datepicker)
{
    $hour  =7;
    $minute=0;
    $second=0;
    
    $day   = substr($datepicker, 0, 2);
    $month = substr($datepicker, 3,2);
    $year  = substr($datepicker, 6,4);
    
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    return $timestamp;
}

function make_timestamp_from_datepicker_us($datepicker)
{
    $hour=7;
    $minute=0;
    $second=0;
    
    $month = substr($datepicker, 0, 2);
    $day   = substr($datepicker, 3,2);
    $year  = substr($datepicker, 6,4);
    
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    return $timestamp;
}

function make_timestamp($day, $month, $year)
{
    $hour=7;
    $minute=0;
    $second=0;
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    return $timestamp;
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */



  

/* ===============================================
    Call backs go here...
  =============================================== */




/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
