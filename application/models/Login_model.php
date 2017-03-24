<?php
class Login_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getStartSession($user){
            $this->db->select('usuario_id, usuario, perfil_id, contrasena');
            $this->db->from('usuarios u');
            $this->db->where('usuario', $user);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query->result();
            else return false;
    }
}?>