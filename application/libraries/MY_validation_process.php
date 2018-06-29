<?php
 
class Form_validation extends CI_Controller{
 
    //class constructor to load all required files
    function __construct(){
        parent::__construct();
 
        //libraries and helpers required for form validation
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
    }
 
 
    //index() function to load the form(view file)
    public function index(){
 
        $this->load->view('form_validation');
    }
 
 
    //after submiting the form validate() functin will be called
    public function validate(){
     
        //set all the rules in $validation_rules array
        $validation_rules = array(
               array(
                     'field'   => 'name',
                     'label'   => 'name',
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'trim|required|valid_email'
                  ),   
               array(
                     'field'   => 'password',
                     'label'   => 'password',
                     'rules'   => 'trim|required|matches[confirm_password]'
                  ),
                 array(
                     'field'   => 'confirm_password',
                     'label'   => 'confirm password',
                     'rules'   => 'trim|required'
                  ),
                  array(
                     'field'   => 'gender',
                     'label'   => 'Gender',
                     'rules'   => 'required'
                  )
        );
 
        //just pass your rules array to validation_errors_to_array() function it will give validation errors in array
        //$errors_array array contain validation errors in array form
        //$errors_array['field_name'] will give error of the field,, for eg---$errors_array['name'],$errors_array['password']
        $errors_array = $this->validation_errors_to_array($validation_rules);
 
        //if validation contains errors $errors_array is not empty, so $errors_array will be true
        //if validation has no errors $errors_array is false, and goes to else block
        //In the if else block you can write code whatever you want ,for validation success and validation fail
        if($errors_array){
            echo "We have validation errors";
            echo "<pre>";
            print_r($errors_array);
        }
        else
            echo "We dont have validation errors";
 
     
    }
 
 
    //this function can be used for any form with any number of fields
    //this function is for converting validation errors to array
    //$validation_rules contains all rules set in above fuunction
    public function validation_errors_to_array($validation_rules){
 
        $this->form_validation->set_rules($validation_rules); //through this statement rules are set
 
        $errors_array = array();//array is initialized
         
        //if form validation is false means their are errors
        if($this->form_validation->run() == false){
 
            //$row as each individual field array 
            foreach($validation_rules as $row){
 
                $field = $row['field'];          //getting field name
                $error = form_error($field);    //getting error for field name
                                                //form_error() is inbuilt function
 
                //if error is their for field then only add in $errors_array array
                if($error)
                $errors_array[$field] = $error;
             
            }
 
            return $errors_array;
 
        }
        else
            return false;//if no validation error then return false
 
 
    }
 
 
}
 
?>