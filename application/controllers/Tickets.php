<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->library('form_validation');
		$this->load->model('tickets_model');
		$this->load->model('utilerias_model');
	}
	public function index()
	{
		
	}
	public function insertData()
	{
		$categoria		= $this->input->post('categoria');
		$proridad		= $this->input->post('proridad');
		$sumario		= $this->input->post('sumario');
		$descripcion	= $this->input->post('descripcion');

		$data = 
		array(
			'categoria_id' 	=> $categoria,
			'prioridad_id' 	=> $proridad,
			'sumario' 		=> $sumario,
			'descripcion' 	=> $descripcion,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->tickets_model->addData($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"El ticket se ha agregado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}
	public function updateData()
	{
		
	}
	public function deleteData()
	{
		
	}
	public function checkUser()
	{
		$usuario	= $this->input->post('user');
		$ok = $this->users_model->getDataValidation($usuario);
		echo $ok;
	}
}