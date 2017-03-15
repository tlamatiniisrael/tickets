<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->helper('url');
            $this->load->library('encrypt');
            $this->load->model('login_model');
        }

	public function startSession(){
		$usuario	= $this->input->post('user');
		$pass		= $this->input->post('contrasena');
		$datos 		= $this->login_model->getStartSession($usuario);
		if($datos){
			$password 	= $datos[0]->contrasena;
			$password 	= $this->encrypt->decode($password);
		}
		if($pass == $password){
			$user 			= $datos[0]->usuario_id;
			$usuario 		= $datos[0]->usuario;
			$type 			= $datos[0]->perfil_id;
			$sessionData 	= 	array(
									'usuario' 	=> $user,
									'nombre' 	=> $usuario,
									'rol' 		=> $type,
									'activo' 	=> "1"
								);
			$this->session->set_userdata($sessionData);
			redirect(base_url('index.php/welcome/home'),'location');
		}else{
			redirect(base_url(),'location');
		}
	}

	public function checkSession(){
		$usuario	= $this->input->post('user');
		$pass		= $this->input->post('pass');
	}

	public function closeSession(){
		$this->session->sess_destroy();
		redirect(base_url(),'location');
	}


}
?>