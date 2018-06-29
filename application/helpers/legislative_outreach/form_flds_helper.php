<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* site_user.php */


if ( ! function_exists('get_fields'))
{
   function get_fields( $result_set = array() )
    {

      $site_user_rules = array(
            array(
              'field' => 'first_name',
              'label' => 'First Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
            ),
            array(
              'field' => 'last_name',
              'label' => 'Last Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
            ),
            array(
              'field' => 'middle_name',
              'label' => 'Middle Name',
              'rules' =>'',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
            ),
            array(
              'field' => 'address1',
              'label' => 'Address1',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
             'field' => 'address2',
             'label' => 'Address2',
             'rules' => 'max_length[100]',
             'icon'  => 'envelope',
             'placeholder'=>'',
             'input_type' =>'text',
             'input_options'=>'0',
            ),
            array(
              'field' => 'city',
              'label' => 'City',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
              'field' => 'state',
              'label' => 'State',
              'rules' => 'required',          
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_type' =>'text',
              'input_options' => '0',
            ),
            array(
              'field' => 'zip',
              'label' => 'Zip',
              'rules' => 'required|is_natural|exact_length[5]',                    
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
              'input_options'=>'0',
            ),
      // );

      // $site_user_rules2 = array(

            array(
              'field' => 'occupation',
              'label' => 'Occupation',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' =>'text',
              'input_options' => '0',          
            ),
            array(
              'field' => 'phone',
              'label' => 'Phone',
              'rules' =>'required',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
              'field' => 'cell_phone',
              'label' => 'Cell Phone',
              'rules' =>'',
              'icon'  => 'phone',
              'placeholder'=>'(201) 999-9999',
              'input_type' =>'text',
              'input_options' => '0',          
            ),
            array(
              'field' => 'dob',
              'label' => 'Date of Birth',
              'rules' =>'required',              
              'icon'  => 'user',
              'placeholder'=>'MM/DD/YYYY',
              'input_type' =>'text',
              'input_options' => '0'
            ),
            array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => 'required|valid_email|max_length[200]', 
              'icon'  => 'envelope',
              'placeholder'=>'email@email.com',
              'input_type' =>'text',
              'input_options' => '0',          
            ),

      );

 	  return $site_user_rules;

  }// get_fields

 
} // endif