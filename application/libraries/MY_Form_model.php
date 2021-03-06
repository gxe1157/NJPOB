<?php
 
class MY_Form_model extends MY_Controller{
     public $mCi;

    //class constructor to load all required files
    function __construct(){
        parent::__construct();
        $this->mCi =& get_instance();

    }

    function modal_fetch( $table_name=null )
    {
        $id = $this->input->post('rowId', TRUE);
        $query = $this->model_name->get_where($id, $table_name)->result();    

        $response['mysqlRows'] = $query[0];
        if( isset($response['mysqlRows']->dob) ){
            $response['mysqlRows']->dob =  format_date($response['mysqlRows']->dob );
        }

        $response['success'] =  '1';            
        $response['errors_array'] = '';
        return ($response);                
    }

    function modal_post($update_id, $user_id, $column_rules)
    {

        $this->form_validation->set_rules( $column_rules );
        if($this->form_validation->run() == TRUE) {
            /* get the variables */
            $data = $this->input->post(null, TRUE);

            $data['admin_id'] = $this->default['admin_id'];
            $data['user_id'] = $user_id;
            if(isset($data['dob']))
                $data['dob'] = SQLformat_date( $data['dob'] );

            /* remove some fields from data array */
            $this->remove_from_data($data);
            if(is_numeric($update_id)){
                //update details
                $data['modified_date'] = time();            
                $rows_updated = $this->_update($update_id, $data);

                $this->update_user_info($user_id);
                $response['success'] = $rows_updated > 0 ? 1: 2; // Update failed

            } else {
                //insert a new record    
                $data['create_date'] = time(); 
                $new_update_id = $this->_insert($data);

                $this->update_user_info($user_id);
                $response['success'] = $new_update_id > 0 ? 1: 2; // Insert failed

            }

            $response['data'] = $data;
            $response['flash_message']=$flash_message;
            $response['errors_array'] = '';

        } else {
            /*  $row as each individual field array  */
            foreach($column_rules as $row){
                $field = $row['field'];                     // getting field name
                $error = form_error($field);                // getting error for field name
                if($error) $errors_array[$field] = $error;  // Add errrors to $errors_array   
            }
            $validation_errors = implode( $errors_array);

            $response['flash_message'] = $validation_errors;
            $response['success'] = '0';                
            $response['errors_array'] = $errors_array;        
        }
        return $response;
    }
 
    function remove_from_data(&$data)
    {
        $user_ss = $this->input->post('social_sec', TRUE);   
        if( isset($user_ss) ) {
            unset($data['social_sec']);
            unset($data['ss_confirm']);
        }

        $user_dl = $this->input->post('driver_lic', TRUE);                  
        if( isset($user_dl) ) {
            unset( $data['driver_lic']);
        } 
    }            

    function update_user_info($user_id)
    {
       
        $table_data = [];
        $user_dl = $this->input->post('driver_lic', TRUE);                  
        if( isset($user_dl) )
            $table_data['driver_lic'] = $user_dl;

        $user_ss = $this->input->post('social_sec', TRUE);   
        if( isset($user_ss) )
            $table_data['social_sec'] = $this->site_security->_encrypt_string($user_ss);

        if( count($table_data) > 0 ) {
            $rows_updated = $this->model_name->update_data( 'user_info', $table_data, $user_id);
            if($rows_updated <1)
                quit( 'MY_Form_model | failed update');
            
        }

    }   


    function admin_member_portal_view($data)
    {
        $data['menu_level'] = 1;
        $data['left_side_nav'] = true;
        $data['nav_module']= 'youraccount/';
        $data['cancel_button_url'] = base_url()."youraccount/welcome";
        return $data;

    }



 
}
