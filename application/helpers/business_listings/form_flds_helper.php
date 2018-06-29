<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Business Listings */


if ( ! function_exists('get_fields'))
{
  
  function get_fields( )
  {
      $site_user_rules = array(
            array(
              'field' => 'business',
              'label' => 'Business Name',
              'rules' =>'required|min_length[3]|max_length[100]',
              'icon'  => 'briefcase',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
            ),
            array(
              'field' => 'address1',
              'label' => 'Address1',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
            ),
            array(
             'field' => 'address2',
             'label' => 'Address2',
             'rules' => 'max_length[100]',
             'icon'  => 'envelope',
             'placeholder'=>'',
             'input_type' =>'text',
            ),
            array(
              'field' => 'city',
              'label' => 'City',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
            ),
            array(
              'field' => 'state',
              'label' => 'State',
              'rules' => 'required',          
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_type' =>'text',
            ),
            array(
              'field' => 'zip',
              'label' => 'Zip',
              'rules' => 'required|is_natural|exact_length[5]',                    
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
            ),
            array(
              'field' => 'phone',
              'label' => 'Phone',
              'rules' =>'required',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              'input_type' =>'text',
            ),
            array(
              'field' => 'cell_phone',
              'label' => 'Cell Phone',
              'rules' =>'',
              'icon'  => 'phone',
              'placeholder'=>'(201) 999-9999',
              'input_type' =>'text',
            ),
            array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => 'required|valid_email', 
              'icon'  => 'envelope',
              'placeholder'=>'email@email.com',
              'input_type' =>'text',
            ),
            array(
              'field' => 'website',
              'label' => 'Web Site',
              'rules' => 'required', 
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text',
            ),
            array(
              'field' => 'bus_category',
              'label' => 'Business Category',
              'rules' => 'required',  
              'icon'  => 'briefcase',
              'placeholder'=>'',
              'input_type' =>'select',
            ),
            array(
              'field' => 'specialization',
              'label' => 'Specialization',
              'rules' => 'required',  
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text',
            ),
            array(
              'field' => 'pay_option',
              'label' => 'Payment Options',
              'rules' => 'required',  
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text',
            ),
            array(
              'field' => 'details',
              'label' => 'Description',
              'rules' => 'required',  
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'textarea',
            ),
            array(
              'field' => 'photo',
              'label' => 'Business Photo',
              'rules' => '',  
              'icon'  => 'picture',
              'placeholder'=>'',
              'input_type' =>'upload_image',
            )
      );

    return $site_user_rules;

  }// get_fields


} // endif