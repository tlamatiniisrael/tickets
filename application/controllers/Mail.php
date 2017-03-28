 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function send()
	{
		$destino		= $this->input->post('to');
		$msg			= $this->input->post('msg');
        $config = array(
			'protocol' 		=> 'smtp',
		 	'smtp_host' 	=> 'smtp.googlemail.com',
		 	'smtp_user' 	=> 'helpdesk.sma@gmail.com', //correo de gmail
		 	'smtp_pass' 	=> '%h3lpd3sk%', // password de gmail
		 	'smtp_port' 	=> '587',
		 	'smtp_crypto' 	=> 'tls',
		 	'mailtype' 		=> 'html',
		 	'wordwrap' 		=> TRUE,
		 	'charset'		=> 'utf-8'
		 );

		 $this->load->library('email', $config);
		 $this->email->set_newline("\r\n");
		 $this->email->from('helpdesk.sma@gmail.com');
		 $this->email->subject('Cambios en el ticket');
		 $this->email->message($msg);
		 $this->email->to($destino);
		 $this->email->send();
	}
	
}