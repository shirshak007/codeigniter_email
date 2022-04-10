<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class CodeigniterEmailSending extends BaseController {
	public function __construct() {
		parent::__construct();
	}
    
	public function index() {}

	/**
	* MAIL SENDING FUNCTION
	* To generate app password, login to google account -> Manage Google Account -> Security -> enable 2-step verification
	* App Passwords field will appear, click then choose other and give some name
	* The password will be provided
	*/    
	public function sendMyEmail() {
	    //prepare config array
	    $config['protocol'] = "smtp";
	    $config['smtp_host'] = "smtp.gmail.com";
	    $config['smtp_user'] = "youremail@gmail.com";
	    $config['smtp_pass'] = "your_app_password";
	    $config['smtp_port'] = "587";
	    $config['smtp_crypto'] = 'tls';
	    $config['smtp_keepalive'] = TRUE; // to enable persistant smtp connection
	    $config['mailtype'] = 'html';
	    $config['send_multipart'] = FALSE;
	    $config['charset'] = 'utf-8';
	    $config['wordwrap'] = TRUE;
	    
	    $this->email->initialize($config);
	    log_message('debug', 'Email preferences initialized successfully!');
	    
	    $this->email->set_newline("\r\n");
	    
	    $this->email->from("sender@gmail.com", "sender_name");
	    $this->email->to("receiver@gmail.com");
	    
	    //$this->CI->email->cc($ccArr);
	    //$this->CI->email->bcc($bccArr);
	    //$this->CI->email->reply_to($reply_to);
	    //email subject
	    $this->email->subject("Test Email 2");
	    
	    //email body
	    $this->email->message("This is a test email"); //you can send html email too
	    
	    if($this->email->send()) {
	        log_message('debug',"Mail Sent successfully!");
	    } else {
	        log_message('debug','Print Debugger with body: '.$this->email->print_debugger(array('body')));
	    }
	}
}
?>
