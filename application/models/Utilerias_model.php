<?php
class Utilerias_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }
        //Selects
        public function getPerfilUsuario(){
            $query = $this->db->get('perfil_usuario');
			$data=array();
			$data[""] = 'Selecciona un perfil'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->perfil_id] = $row->perfil;
		    }
		    return ($data);
        }
        public function getCategorias(){
            $query = $this->db->get('categorias');
			$data=array();
			$data[""] = 'Selecciona una categoria'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->categoria_id] = $row->categoria;
		    }
		    return ($data);
        }
        public function getPrioridad(){
            $query = $this->db->get('prioridad');
			$data=array();
			$data[""] = 'Selecciona una prioridad'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->prioridad_id] = $row->prioridad;
		    }
		    return ($data);
        }
        public function getEstados(){
            $query = $this->db->get('estado_ticket');
			$data=array();
			$data[""] = 'Selecciona un estado'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->estado_id] = $row->estado;
		    }
		    return ($data);
        }
        public function getAmbiente(){
            $query = $this->db->get('ambiente_ticket');
			$data=array();
			$data[""] = 'Selecciona el ambiente de desarrollo'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->ambiente_id] = $row->ambiente;
		    }
		    return ($data);
        }
        public function getTecnicos(){
        	$this->db->where('perfil_id', '3');
            $query = $this->db->get('usuarios');
			$data=array();
			$data[""] = 'Selecciona un técnico'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->usuario_id] = $row->usuario;
		    }
		    return ($data);
        }

        public function getTecnicosDetail(){
        	$this->db->where('perfil_id', '3');
            $query = $this->db->get('usuarios');
			if($query->num_rows() > 0) return $query->result();
            else return false;
        }

        public function getSolventacion(){
            $query = $this->db->get('solventacion_ticket');
			$data=array();
			$data[""] = 'Selecciona una opción'; 
			foreach ($query->result() as $row)
		    {
		        $data[$row->solventacion_id] = $row->solventacion;
		    }
		    return ($data);
        }
        // Consultas completas
        public function getSQL($id){
            $this->db->select('fecha_sql, sq.sql ');
            $this->db->from('sql_ticket sq');
            $this->db->where('ticket_id', $id);
			$query = $this->db->get();
            if($query->num_rows() > 0) return $query->result();
            else return false;
        }
        public function getRevision($id){
            $this->db->select('fecha_revision, revision');
            $this->db->from('revision_ticket');
            $this->db->where('ticket_id', $id);
			$query = $this->db->get();
            if($query->num_rows() > 0) return $query->result();
            else return false;
        }
}
?>