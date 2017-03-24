 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function send()
	{
        $config = array(
		 'protocol' => 'smtp',
		 'smtp_host' => 'smtp.googlemail.com',
		 'smtp_user' => 'helpdesk.sma@gmail.com', //Su Correo de Gmail Aqui
		 'smtp_pass' => '%h3lpd3sk%', // Su Password de Gmail aqui
		 'smtp_port' => '587',
		 'smtp_crypto' => 'tls',
		 'mailtype' => 'html',
		 'wordwrap' => TRUE,
		 'charset' => 'utf-8'
		 );
		 $this->load->library('email', $config);
		 $this->email->set_newline("\r\n");
		 $this->email->from('helpdesk.sma@gmail.com');
		 $this->email->subject('Cambios en el ticket');
		 $this->email->message('Este es el mensaje');
		 $this->email->to('becario.victor.gil@gmail.com');
		 $this->email->send();
	}
	
}