<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->model('users_model');
		$this->load->model('utilerias_model');
	}
	public function index()
	{
		
	}
	public function insertData()
	{
		$usuario	= $this->input->post('usuario');
		$pass		= $this->encrypt->encode($this->input->post('pass'));
		$mail		= $this->input->post('mail');
		$perfil		= $this->input->post('perfil');

		$data = 
		array(
			'usuario' 		=> $usuario,
			'contrasena' 	=> $pass,
			'email' 		=> $mail,
			'perfil_id' 	=> $perfil
		);

		$ok = $this->users_model->addData($data);

		switch ($perfil) {
			case '1':
				$perfilName = 'Administrador';
				break;
			case '2':
				$perfilName = 'Usuario';
				break;
			case '3':
				$perfilName = 'Técnico';
				break;
		}

		if( $ok != 0){
			echo '{"status":"success", "msg":"El usuario '.$usuario.' se ha agregado correctamente", "usuario" : "'.$usuario.'", "email" : "'.$mail.'", "perfil" : "'.$perfilName.'", "id_usuario" : "'.$ok.'"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}
	public function updateData()
	{
		$id			= $this->input->post('id');
		$usuario	= $this->input->post('usuario');
		$pass		= $this->input->post('pass');
		$mail		= $this->input->post('mail');
		$perfil		= $this->input->post('perfil');
		$perfilName = '';

		if($pass){
			$pass	= $this->encrypt->encode($pass);
		}
		else{
			$pass 	= "";
		}

		$data = 
		array(
			'id' 			=> $id,
			'usuario' 		=> $usuario,
			'contrasena' 	=> $pass,
			'email' 		=> $mail,
			'perfil_id' 	=> $perfil
		);

		$ok = $this->users_model->updateData($data);

		switch ($perfil) {
			case '1':
				$perfilName = 'Administrador';
				break;
			case '2':
				$perfilName = 'Usuario';
				break;
			case '3':
				$perfilName = 'Técnico';
				break;
		}

		if( $ok == 1){
			echo '{"status":"success", "msg":"El usuario '.$usuario.' se ha actualizado correctamente", "usuario" : "'.$usuario.'", "email" : "'.$mail.'", "perfil" : "'.$perfilName.'"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}
	}
	public function updateSingleData()
	{

		$id			= $this->input->post('id');
		$usuario	= $this->input->post('usuario');
		$pass		= $this->input->post('pass');
		$mail		= $this->input->post('mail');
		$perfil		= $this->input->post('perfil');
		$perfilName = '';

		if($id == $this->session->userdata('usuario')){

			if($pass){
				$pass	= $this->encrypt->encode($pass);
			}
			else{
				$pass 	= "";
			}

			$data = 
			array(
				'id' 			=> $id,
				'usuario' 		=> $usuario,
				'contrasena' 	=> $pass,
				'email' 		=> $mail
			);

			$ok = $this->users_model->updateSingleData($data);

			switch ($perfil) {
				case '1':
					$perfilName = 'Administrador';
					break;
				case '2':
					$perfilName = 'Usuario';
					break;
				case '3':
					$perfilName = 'Técnico';
					break;
			}

			if( $ok == 1){
				$this->session->unset_userdata('info');
				$data = json_encode(array('id' => $id, 'usuario' => $usuario, 'email' => $mail, 'perfil' => $perfil));
				$this->session->set_userdata('info', $data);
				echo '{"status":"success", "msg":"El usuario '.$usuario.' se ha actualizado correctamente", "usuario" : "'.$usuario.'", "email" : "'.$mail.'", "perfil" : "'.$perfilName.'"}';
			}else{
				echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
			}
		}else{
			echo '{"status":"fail", "msg":"Está acción no está permitida"}';	
		}
	}
	public function deleteData()
	{
		$usuario = $this->input->post('usuario');
		$data = 
		array(
			'usuario' 		=> $usuario
		);

		$ok = $this->users_model->removeData($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"El usuario '.$usuario.' se ha eliminado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}
	}
	public function checkUser()
	{
		$usuario	= $this->input->post('user');
		$ok = $this->users_model->getDataValidation($usuario);
		echo $ok;
	}
}