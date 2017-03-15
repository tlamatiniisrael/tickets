<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('utilerias_model');
		$this->load->model('users_model');
		$this->load->model('tickets_model');
	}

	public function index()
	{
		if($this->session->userdata('usuario')){
			redirect(base_url('index.php/welcome/home'), 'location');
		}
		$data['tab'] = '{"tab":"login"}';
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/content',$data);
		$this->load->view('template/footer');
		$this->load->view('template/foot');
	}
	public function home()
	{
		if(!$this->session->userdata('usuario')){
			redirect(base_url(), 'location');
		}
		$data['tab'] 		= '{"tab":"home"}';
		$usuario 	= $this->session->userdata('usuario');
		$rol 		= $this->session->userdata('rol');
		$data['tickets'] 		= $this->tickets_model->getData($usuario, $rol);
		$data['estados'] 		= $this->utilerias_model->getEstados();
		$data['tecnicos'] 		= $this->utilerias_model->getTecnicos();
		$data['solventacion'] 	= $this->utilerias_model->getSolventacion();
		
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/tab',$data);
		$this->load->view('modals/modal_edit',$data);
		$this->load->view('template/content',$data);
		$this->load->view('template/footer');
		$this->load->view('template/foot');
	}
	public function ticket()
	{
		if(!$this->session->userdata('usuario')){
			redirect(base_url(), 'location');
		}
		$data['tab'] 		= '{"tab":"ticket"}';
		$data['prioridad'] 	= $this->utilerias_model->getPrioridad();
		$data['categorias'] = $this->utilerias_model->getCategorias();
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/tab',$data);
		$this->load->view('template/content',$data);
		$this->load->view('template/footer');
		$this->load->view('template/foot');
	}
	public function addUser()
	{
		if(!$this->session->userdata('usuario')){
			redirect(base_url(), 'location');
		}
		$data['tab'] 		= '{"tab":"addUser"}';
		$data['usuarios'] 	= $this->users_model->getData();
		$data['perfil'] 	= $this->utilerias_model->getPerfilUsuario();
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/tab',$data);
		$this->load->view('modals/modal_menu');
		$this->load->view('modals/modal_edit',$data);
		$this->load->view('modals/modal_delete',$data);
		$this->load->view('template/content',$data);
		$this->load->view('template/footer');
		$this->load->view('template/foot');
	}
	public function about()
	{
		if(!$this->session->userdata('usuario')){
			redirect(base_url(), 'location');
		}
		$data['tab'] 		= '{"tab":"about"}';
		$this->load->view('template/head');
		$this->load->view('template/header',$data);
		$this->load->view('template/tab',$data);
		$this->load->view('modals/modal_menu');
		$this->load->view('modals/modal_edit',$data);
		$this->load->view('modals/modal_delete',$data);
		$this->load->view('template/content',$data);
		$this->load->view('template/footer');
		$this->load->view('template/foot');
	}
}