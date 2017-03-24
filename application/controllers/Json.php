<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->model('json_model');
	}
	public function index()
	{
		
	}
	public function jsonUser(){
		$usuario	= $this->input->post('user');
		$ok = $this->json_model->getJsonUser($usuario);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonUser"}';
	}
	public function jsonTickets(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonTickets($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonTickets"}';
	}
	public function jsonAsign(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonAsign($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonAsign"}';
	}
	public function jsonNotes(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonNotes($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonAsign"}';
	}
	public function jsonAttached(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonAttached($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonAsign"}';
	}
	public function jsonHistory(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonHistory($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonAsign"}';
	}
	public function jsonTabCount(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonTabCount($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonTabCount"}';
	}
	public function jsonSQL(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonSQL($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonSQL"}';
	}
	public function jsonRev(){
		$ticket	= $this->input->post('ticket');
		$ok = $this->json_model->getJsonRev($ticket);
		if($ok != false)
			echo json_encode($ok->result());
		else
			echo '{"status":"fail","function":"Json.php -> jsonRev"}';
	}
}