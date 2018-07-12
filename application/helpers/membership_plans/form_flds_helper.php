<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Business Listings */


if ( ! function_exists('get_fields'))
{

  function get_fields( )
  {
      $site_user_rules = array(
            array(
              'field' => 'mem_plan_level',
              'label' => 'Plan Level',
              'rules' => 'required',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),
            array(
              'field' => 'form_header',
              'label' => 'Form Header',
              'rules' => 'required',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),            
            array(
              'field' => 'mem_category',
              'label' => 'Category',
              'rules' => 'required',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),            
            array(
              'field' => 'mem_dues1',
              'label' => 'Annual Dues',
              'rules' => 'required|decimal',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),
            array(
              'field' => 'mem_dues2',
              'label' => '3 Years Dues',
              'rules' => 'required|decimal',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),
            array(
              'field' => 'mem_initiation',
              'label' => 'Initiation Fee',
              'rules' => 'required|decimal',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),
            array(
              'field' => 'mem_life',
              'label' => 'Lifetime Fee',
              'rules' => 'required|decimal',    
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'text'),
            array(
              'field' => 'mem_plan_details',
              'label' => 'Description',
              'rules' => 'required',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'textarea'),
            array(
              'field' => 'mem_plan_benefits',
              'label' => 'Benefits',
              'rules' => '',
              'icon'  => 'list-alt',
              'placeholder'=>'',
              'input_type' =>'textarea')

      );

    return $site_user_rules;

  }// get_fields


} // endif