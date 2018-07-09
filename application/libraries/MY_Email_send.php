<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email_send  extends MX_Controller
{
	public function __construct()
	{

	}

	function contact_form()
	{
	    if( ENV != 'live')  return false;
	    		
        $to        = $this->input->post('email_to', TRUE);
        $from      = $this->input->post('email', TRUE);
		$bcc_email = 'webmaster@411mysite.com, jpkinsley@gmail.com';

        $subject   = $this->input->post('subject', TRUE);
        $message   = "Time Stamp : ".convert_timestamp( time(), 'full');
        $message  .= "\n\n";
        $message  .= "Message    : ".$this->input->post('message', TRUE);
        $message  .= "\n\n";

		$this->process_email($from, $to, $bcc_email, $subject, $message );

	    /* send to confimation page */
	    redirect(base_url()."contactus-confirmation");
	}

	function email_report($mess_ecode)
	{
	    if( ENV != 'live')  return false;

	    $to        = 'webmaster@411mysite.com';
	    $from      = 'web server';
		$bcc_email = null;	    
	    $subject   = 'Problem at : '.base_url();
	    $message   = $mess_ecode;

		$this->process_email($from, $to, $bcc_email, $subject, $message );
	}

	function send_admin_email($email_to, $type, $mess_ecode = null)
	{
	    if( ENV != 'live')  return false;

	    $email_result = $this->model_name->get_view_data_custom('type', $type, 'site_admin_emails', null)->row();

	    $to        = $email_to;	    
	    $from      = $email_result->from;
		$bcc_email = $email_result->admin_email;
	    $subject   = $email_result->subject;
	    $message   = $email_result->body;

        if( $mess_ecode ){
	        // sprintf(format,arg1,arg2,arg++);
		    $mess_ecode_string = join(', ',$mess_ecode);
        	$message = sprintf($message, $mess_ecode_string);
        }

		$this->process_email($from, $to, $bcc_email, $subject, $message );
	}

	private function process_email($from, $to, $bcc_email=null, $subject, $message )
	{

        $this->load->library('email');

        $this->email->from( $from);
        $this->email->to($email);
        if(isset($bcc_email)) $this->email->bcc($bcc_email);        
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();

	    // if ( ! $this->email->send() ) {
	    //         // Generate log error
	    // }
	}

}