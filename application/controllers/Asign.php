 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asign extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->helper("url");
		$this->load->library('form_validation');
		$this->load->model('asign_model');
		$this->load->model('utilerias_model');
	}
	public function index()
	{
		
	}
	public function insertData()
	{
		$ticket			= $this->input->post('ticket');
		$nota			= $this->input->post('nota');
		$estado			= $this->input->post('estado');
		$tecnico		= $this->input->post('asignar');

		$data = 
		array(
			'nota' 			=> $nota,
			'ticket_id' 	=> $ticket,
			'usuario_id' 	=> $this->session->userdata('usuario'),
			'asignado_id'	=> $tecnico,
			'estado_id' 	=> $estado
		);

		$ok = $this->asign_model->addData($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"La contestación al ticket '.$ticket.' se ha agregado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}

	public function insertNote()
	{
		$ticket			= $this->input->post('ticket');
		$nota			= $this->input->post('nota');

		$data = 
		array(
			'nota' 			=> $nota,
			'ticket_id' 	=> $ticket,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->asign_model->addDataNote($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"Se agrego una nota como contestación al ticket '.$ticket.' correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}

	public function updateSQL()
	{
		$ticket			= $this->input->post('ticket');
		$sql			= $this->input->post('sql');

		$data = 
		array(
			'sql' 			=> $sql,
			'ticket_id' 	=> $ticket,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->asign_model->updateDataSQL($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"El SQL del ticket '.$ticket.' se ha actualizado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}

	public function updateRevision()
	{
		$ticket			= $this->input->post('ticket');
		$revision		= $this->input->post('revision');

		$data = 
		array(
			'revision' 		=> $revision,
			'ticket_id' 	=> $ticket,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->asign_model->updateDataRevision($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"La revisión al ticket '.$ticket.' se ha actualizado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}

	public function updateStatus()
	{
		$ticket			= $this->input->post('ticket');
		$estado			= $this->input->post('estado');

		$data = 
		array(
			'ticket_id' 	=> $ticket,
			'estado_id' 	=> $estado,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->asign_model->updateDataStatus($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"El estado del ticket '.$ticket.' se ha actualizado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}

	public function updateAsing()
	{
		$ticket			= $this->input->post('ticket');
		$asignar		= $this->input->post('asignar');

		$data = 
		array(
			'asignado_id' 	=> $asignar,
			'ticket_id' 	=> $ticket,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->asign_model->addDataAsign($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"La asignación del ticket '.$ticket.' se ha actualizado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}

	}

	public function updateData()
	{
		

		$ok = $this->asign_model->updateData($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"El usuario '.$usuario.' se ha actualizado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}
	}

	public function uploadFile()
	{
		$next 		= '';
		$ticket		= $this->input->post('ticket');
		$usuario 	= $this->session->userdata('usuario');
		$fileInput 	= 'userfile';
		$nombre 	= base64_encode($ticket.$usuario.date("U"));
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
			echo '{"status":"fail", "msg":"'.print_r($error).'"}';
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
				echo '{"status":"success", "msg":"El archivo se ha guardado satisfactoriamente"}';
			}else{
				echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
			}
		}	
	}

	public function showPreviewFile()
	{
		$archivo	= $this->input->post('archivo');
		$data 		= array(
						"archivo_ticket_id"	=> $archivo
					);
		$ok 		= $this->asign_model->getPreviewFile($data);
		$file 		= $ok->result();
		$preview 	= $file[0]->archivo;
		$type 		= $file[0]->content_type;
		echo '<img src="data:'.$type.';base64,'.base64_encode( $preview ).'"/>';
	}

	public function updateSolventacion()
	{
		$ticket			= $this->input->post('id');
		$solventacion	= $this->input->post('solventacion');
		$revision		= $this->input->post('revision');

		$data = 
		array(
			'solventacion' 	=> $solventacion,
			'ticket_id' 	=> $ticket,
			'usuario_id' 	=> $this->session->userdata('usuario')
		);

		$ok = $this->asign_model->updateDataSolventacion($data);

		if($ok == 1){
			$data = 
			array(
				'nota' 			=> $revision,
				'ticket_id' 	=> $ticket,
				'usuario_id' 	=> $this->session->userdata('usuario')
			);

			$ok = $this->asign_model->addDataNote($data);
		}

		if( $ok == 1){
			echo '{"status":"success", "msg":"La solventación del ticket '.$ticket.' se ha actualizado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}
	}

	public function updateAmbiente()
	{
		$ticket			= $this->input->post('ticket');
		$ambiente		= $this->input->post('ambiente');

		$data = 
		array(
			'ambiente_id' 	=> $ambiente,
			'ticket_id' 	=> $ticket
		);

		$ok = $this->asign_model->updateDataAmbiente($data);

		if( $ok == 1){
			echo '{"status":"success", "msg":"La contestación al ticket '.$ticket.' se ha agregado correctamente"}';
		}else{
			echo '{"status":"fail", "msg":"Al parecer hay un problema en la BD espere un momento y vuelvalo a intentar"}';	
		}
	}

	public function deleteData()
	{
		
	}
}