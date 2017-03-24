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
		$this->load->model('asign_model');
	}
	public function index()
	{
		
	}
	public function insertData()
	{
		$codigo			= $this->input->post('codigo');
		$categoria		= $this->input->post('categoria');
		$proridad		= $this->input->post('proridad');
		$sumario		= $this->input->post('sumario');
		$descripcion	= $this->input->post('descripcion');
		$archivoTC		= $this->input->post('archivo');
		$bdTC			= $this->input->post('base-datos');
		$aplicativoTC	= $this->input->post('aplicativo');
		// Tipo cambio
		if(!$archivoTC)
		$archivoTC 		= 0;
		if(!$bdTC)
		$bdTC 			= 0;
		if(!$aplicativoTC)
		$aplicativoTC 	= 0;

		$cambio = $archivoTC + $bdTC + $aplicativoTC;
		//File
		$next 		= '';
		$fileInput 	= 'userfile';
		$nombre 	= base64_encode(date("U"));
		$errormsg 	= '';

		$data = 
		array(
			'codigo' 		 => $codigo,
			'tipo_cambio_id' => $cambio,
			'categoria_id' 	 => $categoria,
			'prioridad_id' 	 => $proridad,
			'sumario' 		 => $sumario,
			'descripcion' 	 => $descripcion,
			'usuario_id' 	 => $this->session->userdata('usuario')
		);

		$ticket = $this->tickets_model->addData($data);

		//File input
		
		$config 	= 
		array(
			'upload_path' => "./assets/adjuntos/",
			'allowed_types' => "*",
			'overwrite' => TRUE,
			'file_name' => $nombre,
			'max_size' => "10240000", // Can be set to particular file size , here it is 10 MB(10240 Kb)
			'max_height' => "0",
			'max_height' => "0",
			'max_width' => "0"
		);
		$this->load->library('upload', $config);

		if($this->upload->do_upload($fileInput)){
			$data = array('upload_data' => $this->upload->data());
			$dataFile = $data['upload_data'];
			$next = '1';
		}else{
			$error = array('error' => $this->upload->display_errors());
			$next = '2';
		}
		if($next == '1'){
			$data 		= array(
						"ticket_id"			=> $ticket,
						"nombre"			=> $dataFile['orig_name'],
						"nombre_original"	=> $dataFile['client_name'],
						"content_type"		=> $dataFile['file_type'],
						'usuario_id' 		=> $this->session->userdata('usuario')
					);
			$ok = $this->asign_model->uploadFileData($data);
			if( $ok == 1){
				echo '{"status":"success", "msg":"El ticket se ha guardado satisfactoriamente"}';
			}else{
				echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
			}
		}else{
			echo '{"status":"success", "msg":"El ticket se ha guardado satisfactoriamente"}';
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