<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_fields'))
{

   function get_fields( $result_set = array() )
    {

      $results = array();
      $display_value = false;

      if( count($result_set) > 0 ){
         $results = $result_set[0];
         $display_value = true;
      }
         
      $ci =& get_instance();
      $ci->load->module('lib');     

      $Select_option = array(
          array(''=>'Please Select...','Yes'=>'Yes','No'=>'No'),
          array(''=>'Please Select...','Male'=>'Male', 'Female'=>'Female', 'Other'=>'Other'),
          array(''=>'Please Select...','Single'=>'Single', 'Married'=>'Married', 'Divorced'=>'Divorced','Widowed'=>'Widowed'),
      );

      $profile = array(
            array(
              'field' => 'first_name',
              'label' => 'First Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->first_name) ) ? $results->first_name : '',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
            ),
            array(
              'field' => 'last_name',
              'label' => 'Last Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->last_name) ) ? $results->last_name : '',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
            ),
            array(
              'field' => 'middle_name',
              'label' => 'Middle Name',
              'rules' =>'',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->middle_name) ) ? $results->middle_name : '',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
            ),
            array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => '', 
              'icon'  => 'envelope',
              'placeholder'=>'email@email.com',
              'input_value' => ($display_value && isset($results->email) ) ? $results->email : '',
              'input_type' =>'text',
              'input_options' => '0',          
            ),
            array(
              'field' => 'phone',
              'label' => 'Phone',
              'rules' =>'',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              'input_value' => ($display_value && isset($results->phone) ) ? $results->phone : '',
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
              'field' => 'cell_phone',
              'label' => 'Cell Phone',
              'rules' =>'',
              'icon'  => 'phone',
              'placeholder'=>'(201) 999-9999',
              'input_value' => ($display_value && isset($results->cell_phone) ) ? $results->cell_phone : '',
              'input_type' =>'text',
              'input_options' => '0',          
            )
      );

      $address = array(
            array(
              'field' => 'address1',
              'label' => 'Address1',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->address1) ) ? $results->address1 : '',
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
             'field' => 'address2',
             'label' => 'Address2',
             'rules' => 'max_length[100]',
             'icon'  => 'envelope',
             'placeholder'=>'',
             'input_value' => ($display_value && isset($results->address2) ) ? $results->address2 : '',
             'input_type' =>'text',
             'input_options'=>'0',
             'fld_group' =>'1'         
            ),
            array(
              'field' => 'city',
              'label' => 'City',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->city) ) ? $results->city : '',
              'input_type' =>'text',
              'input_options'=>'0',
         
            ),
            array(
              'field' => 'state',
              'label' => 'State',
              'rules' => 'required',          
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_value' => ($display_value && isset($results->state) ) ? $results->state : null,
              'input_type' =>'text',
              'input_options' => '0',
         
            ),
            array(
              'field' => 'zip',
              'label' => 'Zip',
              'rules' => 'required|is_natural|exact_length[5]',                    
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->zip) ) ? $results->zip : null,
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
              'field' => 'county',
              'label' => 'County',
              'rules' => 'required|alpha|max_length[100]',                    
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => ($display_value && isset($results->county) ) ? $results->county : null,
              'input_type' =>'text',
              'input_options' => '0',
            ),
      );
      $password = array(
            array(
              'field' => 'password',
              'label' => 'Old Password',
              'rules' => 'required',                    
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => '',
              'input_type' =>'password',
              'input_options' => '0',
            ),
            array(
              'field' => 'new_password',
              'label' => 'New Password',
              'rules' => 'required',                    
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => '',
              'input_type' =>'password',
              'input_options' => '0',
            ),        
            array(
              'field' => 'confirm_password',
              'label' => 'Confirm Password',
              'rules' => 'required',                    
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => '',
              'input_type' =>'password',
              'input_options' => '0',
            ),        

      );      


  	  return array( $Select_option, $profile, $address, $password);

  }// group1
 
} // endif