<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* site_user.php */



if ( ! function_exists('get_tables_names'))
{
   function get_table_data()
    {
      $user_address = array('address1', 'address2', 'city', 'state', 'zip', 'county');
      $user_mail_to = array('mail_add1', 'mail_add2','mail_city', 'mail_state', 'mail_zip');
      $users    = array('membership_level', 'first_name','last_name','middle_name','phone','cell_phone', 'email');

      $user_info    = array('registered_voter', 'legislative_dist', 'gender', 'dob',
                              'driver_lic', 'height', 'weight','social_sec', 'hair_color',
                              'eye_color', 'marital_status' );

      $user_family  = array('spouse_fname', 'spouse_lname',
                              'spouse_dob', 'spouse_gender', 'spouse_email');

      $user_employment_le = array('le_agency', 'le_dept', 'le_add1', 'le_add2', 'le_city',
                                    'le_state', 'le_zip', 'le_rank', 'le_email', 'le_phone',
                                    'le_dt_hired', 'le_dt_retired', 'le_yos');
     
      $user_employment_prv_sector = array('prv_sector', 'prv_sector_employer', 'prv_sector_dept',
                                   'prv_sector_add1', 'prv_sector_add2', 'prv_sector_city',
                                   'prv_sector_state', 'prv_sector_zip', 'prv_sector_position',
                                   'prv_sector_email', 'prv_sector_phone', 'prv_sector_dt_hired');

      $user_children = array('child_fname', 'child_lname', 'child_dob', 'child_gender');


      return array( $users,
                    $user_address,
                    $user_mail_to,
                    $user_info,
                    $user_family,
                    $user_employment_le,
                    $user_employment_prv_sector,
                    $user_children );
    } 

}


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
         
      // $ci =& get_instance();
      // $ci->load->module('lib');     

      $Select_option = array(
          array(''=>'Please Select...','Yes'=>'Yes','No'=>'No'),
          array(''=>'Please Select...','Male'=>'Male', 'Female'=>'Female', 'Other'=>'Other'),
          array(''=>'Please Select...','Single'=>'Single', 'Married'=>'Married', 'Divorced'=>'Divorced','Widowed'=>'Widowed'),
      );

      $site_user_rules = array(
            array(
              'field' => 'first_name',
              'label' => 'First Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
              'fld_group' =>'1'
            ),
            array(
              'field' => 'last_name',
              'label' => 'Last Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
              'fld_group' =>'1'
            ),
            array(
              'field' => 'middle_name',
              'label' => 'Middle Name',
              'rules' =>'',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              'input_options' => '0',
              'fld_group' =>'1'
            ),
            array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => '', 
              'icon'  => 'envelope',
              'placeholder'=>'email@email.com',
              'input_value' => $display_value ? $results->email : '',              
              'input_type' =>'text',
              'input_options' => '0',          
              'fld_group' =>'1'
            ),
            array(
              'field' => 'phone',
              'label' => 'Phone',
              'rules' =>'',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              'input_value' => $display_value ? $results->phone : '',              
              'input_type' =>'text',
              'input_options'=>'0',
              'fld_group' =>'1'          
            ),
            array(
              'field' => 'cell_phone',
              'label' => 'Cell Phone',
              'rules' =>'',
              'icon'  => 'phone',
              'placeholder'=>'(201) 999-9999',
              'input_value' => $display_value ? $results->cell_phone : '',
              'input_type' =>'text',
              'input_options' => '0',          
              'fld_group' =>'1'          
            ),
            array(
              'field' => 'membership_level',
              'label' => 'Membership Level',
              'rules' => '',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->membership_level : '',
              'input_type' =>'text',
              'input_options' => '0',          
              'fld_group' =>'1'          
            ),
            array(
              'field' => 'address1',
              'label' => 'Address1',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->address1 : '',              
              'input_type' =>'text',
              'input_options'=>'0',
              'fld_group' =>'1'          
            ),
            array(
             'field' => 'address2',
             'label' => 'Address2',
             'rules' => 'max_length[100]',
             'icon'  => 'envelope',
             'placeholder'=>'',
             'input_value' => $display_value ? $results->address2 : '',             
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
              'input_value' => $display_value ? $results->city : '',                           
              'input_type' =>'text',
              'input_options'=>'0',
              'fld_group' =>'1'          
            ),
            array(
              'field' => 'state',
              'label' => 'State',
              'rules' => 'required',          
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_value' => $display_value ? $results->state : '',            
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'1'          
            ),
            array(
              'field' => 'zip',
              'label' => 'Zip',
              'rules' => 'required|is_natural|exact_length[5]',                    
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->zip : '',          
              'input_type' =>'text',
              'input_options'=>'0',
              'fld_group' =>'1'
            ),
            array(
              'field' => 'county',
              'label' => 'County',
              'rules' => 'required|alpha|max_length[100]',                    
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->county : '',             
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ),
            array(
              'field' => 'registered_voter',
              'label' => 'Voter Status',
              'rules' => 'required',                    
              'icon'  => 'user',
              'placeholder'=>'Are you a registered voter?',
              'input_value' => $display_value ? $results->registered_voter : '',             
              'input_type' => 'drop_down_sel',
              'input_options' => '0',
              'fld_group' =>'2'          
            ), 
            array(
              'field' => 'legislative_dist',
              'label' => 'Legist Dist',
              'rules' => '',                    
              'icon'  => 'user',
              'placeholder'=>'Enter your legistlative district if known...',
              'input_value' => $display_value ? $results->legislative_dist : '',              
              'input_type' => 'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ), 
            array(
              'field' => 'mail_to',
              'label' => 'Mail To',
              'rules' => 'required',
              'icon'  => 'envelope',
              'placeholder'=> 'Is mailing address same?',
              'input_value' => $display_value ? $results->mail_to : '',         
              'input_type' => 'drop_down_sel',
              'input_options' => '0',
              'fld_group' =>'2'          
            ), 
            array(
              'field' => 'mail_add1',
              'label' => 'Mail Add1',
              'rules' => 'required|min_length[3]|max_length[100]',          
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->mail_add1 : '',             
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ),
            array(
              'field' => 'mail_add2',
              'label' => 'Mail Add2',
              'rules' => 'max_length[100]',          
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->mail_add2 : '',              
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ),
            array(
              'field' => 'mail_city',
              'label' => 'Mail City',
              'rules' => 'required|min_length[3]|max_length[100]',          
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->mail_city : '',              
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ),
            array(
              'field' => 'mail_state',
              'label' => 'Mail State',
              'rules' => 'required',       
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_value' => $display_value ? $results->mail_state : '',             
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ),
            array(
              'field' => 'mail_zip',
              'label' => 'Mail Zip',
              'rules' => 'required|is_natural|exact_length[5]',                              
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->mail_zip : '',           
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'2'          
            ),
            array(
              'field' => 'driver_lic',
              'label' => 'Driver&#39;s License',
              'rules' => 'required|alpha_numeric',                              
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->driver_lic : '',              
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' =>'3'          
            ),
            array(
              'field' => 'social_sec',
              'label' => 'Social Security',
              'rules' => 'required|numeric|max_length[9]',                                       
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->social_sec : '',              
              'input_type' => 'password',
              'input_options' => '0',
              'fld_group' =>'3'          
            ),
            array(
              'field' => 'ss_confirm',
              'label' => 'Confirm Social Security',
              'rules' => 'matches[social_sec]',                                        
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->social_sec : '',             
              'input_type' =>'password',
              'input_options' => '0',
              'fld_group' =>'3'          
            ),
            array(
              'field' => 'marital_status',
              'label' => 'Marital Status',
              'rules' => 'required',                              
              'icon'  => 'user',
              'placeholder'=>'Please select ',
              'input_value' => $display_value ? $results->marital_status : '',             
              'input_type' =>'drop_down_sel',
              'input_options' => '2',
              'fld_group' =>'3'
            ), 
            array(
              'field' => 'le_agency',
              'label' => 'Agency',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'Law Enforcement Agency',
              'input_value' => $display_value ? $results->le_agency : '',      
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_dept',
              'label' => 'Department',
              'rules' => 'required|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->le_dept : '',         
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_rank',
              'label' => 'Rank / Title',
              'rules' => 'required|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->le_rank : '',            
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_add1',
              'label' => 'Address1',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->le_add1 : '',        
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
              ),
            array(
              'field' => 'le_add2',
              'label' => 'Address2',
              'rules' => '',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->le_add2 : '',             
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_city',
              'label' => 'City',
              'icon'  => 'envelope',
              'rules' => 'required|min_length[3]|max_length[100]',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->le_city : '',            
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_state',
              'label' => 'State',
              'rules' => 'required',
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_value' => $display_value ? $results->le_state : '',             
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_zip',
              'label' => 'Zip',
              'rules' => 'required|is_natural|exact_length[5]', 
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->le_zip : '',             
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_email',
              'label' => 'Work Email',
              'rules' => 'required|valid_email|max_length[200]',
              'icon'  => 'envelope',
              'placeholder'=>'email@email.com',
              'input_value' => $display_value ? $results->le_email : '',         
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),
            array(
              'field' => 'le_phone',
              'label' => 'Work Phone',
              'rules' => 'required',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              'input_value' => $display_value ? $results->le_phone : '',          
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_'
            ),          
            array(
              'field' => 'le_dt_hired',
              'label' => 'Date Hired',
              'icon'  => 'user',
              'placeholder'=>' MM/DD/YYYY',
              'input_value' => $display_value ? format_date($results->le_dt_hired) : '',              
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_',
            ),
            array(
              'field' => 'le_dt_retired',
              'label' => 'Date Retired',
              'icon'  => 'user',
              'placeholder'=>' MM/DD/YYYY',
              'input_value' => $display_value ? format_date($results->le_dt_retired) : '',              
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_',
            ),
            array(
              'field' => 'le_yos',
              'label' => 'Years of Service',
              'icon'  => 'user',
              'placeholder'=>'99',
              'input_value' => $display_value ? $results->le_yos : '',          
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'le_',
            ),
            array(
              'field' => 'prv_sector',
              'label' => '<span style="color: #2F93CC">Are you currently employed by the private sector?</span>',
              'rules' => 'required',                              
              'icon'  => '',
              'placeholder'=>'Please select ',
              'input_value' => $display_value ? $results->prv_sector : '',             
              'input_type' =>'drop_down_sel',
              'input_options' => '0',
              'fld_group' =>'le_'
            ), 
            array(
              'field' => 'prv_sector_employer',
              'label' => 'Employer',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'Agency/Company Name',
              'input_value' => $display_value ? $results->prv_sector_employer : '',              
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_dept',
              'label' => 'Department',
              'rules' => 'required|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->prv_sector_dept : '',          
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_position',
              'label' => 'Title',
              'rules' => 'required|max_length[100]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->prv_sector_position : '',         
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_add1',
              'label' => 'Address1',
              'rules' => 'required|min_length[3]|max_length[100]',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->prv_sector_add1 : '',        
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
              ),
            array(
              'field' => 'prv_sector_add2',
              'label' => 'Address2',
              'rules' => '',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->prv_sector_add2 : '',        
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_city',
              'label' => 'City',
              'icon'  => 'envelope',
              'rules' => 'required|min_length[3]|max_length[100]',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->prv_sector_city : '', 
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_state',
              'label' => 'State',
              'rules' => 'required',
              'icon'  => 'envelope',
              'placeholder'=>'Example: NJ, Ct, CA ...',
              'input_value' => $display_value ? $results->prv_sector_state : '',        
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_zip',
              'label' => 'Zip',
              'rules' => 'required|is_natural|exact_length[5]', 
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->prv_sector_zip : '', 
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_email',
              'label' => 'Work Email',
              'rules' => 'required|valid_email|max_length[200]',
              'icon'  => 'envelope',
              'placeholder'=>'email@email.com',
              'input_value' => $display_value ? $results->prv_sector_email : '',      
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),
            array(
              'field' => 'prv_sector_phone',
              'label' => 'Work Phone',
              'rules' => 'required',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              'input_value' => $display_value ? $results->prv_sector_phone : '',       
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'
            ),          
            array(
              'field' => 'prv_sector_dt_hired',
              'label' => 'Date Hired',
              'icon'  => 'user',
              'rules' => 'required',              
              'placeholder'=>' MM/DD/YYYY',
              'input_value' => $display_value ? format_date($results->prv_sector_dt_hired) : '',
              'input_type' =>'text',
              'input_options' => '0',
              'fld_group' => 'prv_'              
            ),          
            array( //0
              'field' => 'dob',
              'label' => 'Date of Birth',
              'icon'  => '',
              'placeholder'=>'MM/DD/YYYY',
              'input_value' => $display_value ? format_date($results->dob) : '',
              'input_type' =>'text',
              'input_options' => '0'
            ),
            array( //1
              'field' => 'gender',
              'label' => 'Gender',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->gender : '',
              'input_type' =>'drop_down_sel',
              'input_options' => '1'
            ),   

            array( //2
              'field' => 'height',
              'label' => 'Height',
              'rules' => 'required',
              'icon'  => '',
              'placeholder'=>'ft - in',
              'input_value' => $display_value ? $results->height : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //3
              'field' => 'weight',
              'label' => 'Weight',
              'rules' => 'required',
              'icon'  => '',
              'placeholder'=>'lbs',
              'input_value' => $display_value ? $results->weight : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //4
              'field' => 'hair_color',
              'label' => 'Hair Color',
              'rules' => 'required',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->hair_color : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //5
              'field' => 'eye_color',
              'label' => 'Eye Color',
              'rules' => 'required',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->eye_color : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //6
              'field' => 'spouse_fname',
              'label' => 'Spouse First Name',
              'rules' => 'required',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->spouse_fname : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //7
              'field' => 'spouse_lname',
              'label' => 'Spouse Last Name',
              'rules' => '',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->spouse_lname : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          

            array( //8
              'field' => 'spouse_dob',
              'label' => 'Spouse Date of Birth',
              'rules' => '',
              'icon'  => '',
              'placeholder'=>'MM/DD/YYYY',
              'input_value' => $display_value ? format_date($results->spouse_dob) : '',
              'input_type' =>'text',
              'input_options' => '0'
            ),
            array( //9
              'field' => 'spouse_gender',
              'label' => 'Spouse Gender',
              'rules' => '',              
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->spouse_gender : '',
              'input_type' =>'drop_down_sel',
              'input_options' => '1'
            ),
            array( //9
              'field' => 'spouse_email',
              'label' => 'Spouse Email',
              'rules' => '',              
              'icon'  => 'enveople',
              'placeholder'=>'email@email.com',
              'input_value' => $display_value ? $results->spouse_email : '',
              'input_type' =>'text',
              'input_options' => '0'
            ),   
            array( //0
              'field' => 'child_fname',
              'label' => 'First Name',
              'rules' => '',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->child_fname : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //1
              'field' => 'child_lname',
              'label' => 'Last Name',
              'rules' => '',
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->child_lname : '',       
              'input_type' =>'text',
              'input_options' => '0'
            ),          
            array( //2
              'field' => 'child_dob',
              'label' => 'Date of Birth',
              'rules' => '',
              'icon'  => '',
              'placeholder'=>'MM/DD/YYYY',
              'input_value' => $display_value ? format_date($results->child_dob) : '',
              'input_type' =>'text',
              'input_options' => '0'
            ),
            array( //3
              'field' => 'child_gender',
              'label' => 'Gender',
              'rules' => '',              
              'icon'  => '',
              'placeholder'=>'',
              'input_value' => $display_value ? $results->child_gender : '',
              'input_type' =>'drop_down_sel',
              'input_options' => '1'
            ),   
      );

 	  return array( $Select_option, $site_user_rules );

  }// get_fields

 
} // endif