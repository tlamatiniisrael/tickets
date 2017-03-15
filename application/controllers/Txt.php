<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Txt extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->model('utilerias_model');
	}
	public function index()
	{
		
	}
	public function generateSQL()
	{
		$txt 		= 'No hay contenido disponible';
		$ticket		= $this->input->post('ticket');
		$sql 		= $this->utilerias_model->getSQL($ticket);
		if($sql){
			$txt 		= "--Consultas a ejecutar\r\n\r\n";
			$txt 		.= "--".date("d/m/Y  H:i:s")."\r\n\r\n";
			$conteo 	= count($sql);
			for ($i=0; $i < $conteo; $i++) {
				$txt 	.= "   ".$sql[$i]->sql."\r\n";
			}
		}
		echo $txt;
		
	}
	public function generateRevision()
	{
		$txt 		= 'No hay contenido disponible';
		$ticket		= $this->input->post('ticket');
		$sql 		= $this->utilerias_model->getRevision($ticket);
		if($sql){
			$txt 		= "--Historial de revisiones\r\n\r\n";
			$txt 		.= "--".date("d/m/Y  H:i:s")."\r\n\r\n";
			$conteo 	= count($sql);
			for ($i=0; $i < $conteo; $i++) {
				$txt 	.= "   ".$sql[$i]->revision."\r\n";
			}
		}
		echo $txt;
	}
	public function download()
	{
		if(empty($_POST['filename']) || empty($_POST['content'])){
			exit;
		}

		$filename = preg_replace('/[^a-z0-9\-\_\.]/i','',$_POST['filename']);

		header("Cache-Control: ");
		header("Content-type: text/plain");
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		echo $_POST['content'];
	}
}