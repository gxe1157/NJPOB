<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Car Shield */


if ( ! function_exists('get_fields'))
{
  
  function get_fields( )
  {
      $site_user_rules = array(
            // array(
            //   'field' => 'username',
            //   'label' => 'Username',
            //   'rules' => 'required|valid_email|max_length[100]', 
            //   'icon'  => 'user',
            //   'placeholder'=>'Enter Username or Email',
            //   'input_type' =>'text',
            //   // 'input_options' => '0',          
            // ),        
            array(
              'field' => 'make',
              'label' => 'Make',
              'rules' =>'required|min_length[3]|max_length[60]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),
            array(
              'field' => 'model',
              'label' => 'Model',
              'rules' =>'required|min_length[3]|max_length[60]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),
            array(
              'field' => 'color',
              'label' => 'Color',
              'rules' =>'required|min_length[3]|max_length[60]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),

            array(
              'field' => 'model_year',
              'label' => 'Model Year',
              'rules' =>'required|numeric|min_length[4]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),
            array(
              'field' => 'plate_no',
              'label' => 'Plate No',
              'rules' =>'required|min_length[3]|max_length[20]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),            
            array(
              'field' => 'vin_no',
              'label' => 'Vin No',
              'rules' =>'required|min_length[3]|max_length[30]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),            
            array(
              'field' => 'driver_lic',
              'label' => 'Driver Lic',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'pencil',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),            
            array(
              'field' => 'social_sec',
              'label' => 'Social Security',
              'rules' => 'required|numeric|max_length[9]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'password',
              // 'input_options' => '0',
            ),
            array(
              'field' => 'ss_confirm',
              'label' => 'Confirm Social Security',
              'rules' => 'required|matches[social_sec]',           
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' =>'password',
              // 'input_options' => '0',
            )            
      );
            
    return $site_user_rules;

  }// get_fields


} // endif