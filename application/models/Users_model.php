<?php
class Users_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->helper('date');
        }

        public function addData($data){
            $ok = 0;
            $dataDB = 
            array(
                'usuario'       => $data['usuario'],
                'contrasena'    => $data['contrasena'],
                'email'         => $data['email'],
                'perfil_id'     => $data['perfil_id']
            );
            $ok = $this->db->insert('usuarios',$dataDB);
            if($ok == 1){
                $ok = $this->db->insert_id();
            }else{
                $ok = 0;
            }
            return $ok;
        }
        public function updateData($data){
            $ok = 0;
            $id = $data['id'];
            if($data['contrasena']){
                $dataDB = 
                array(
                    'usuario'       => $data['usuario'],
                    'contrasena'    => $data['contrasena'],
                    'email'         => $data['email'],
                    'perfil_id'     => $data['perfil_id']
                );
            }else{
                $dataDB = 
                    array(
                        'usuario'       => $data['usuario'],
                        'email'         => $data['email'],
                        'perfil_id'     => $data['perfil_id']
                    );   
            }
            $this->db->where('usuario_id', $id);
            $ok = $this->db->update('usuarios',$dataDB);
            return $ok;
        }
        public function updateSingleData($data){
            $ok = 0;
            $id = $data['id'];
            if($data['contrasena']){
                $dataDB = 
                array(
                    'usuario'       => $data['usuario'],
                    'contrasena'    => $data['contrasena'],
                    'email'         => $data['email']
                );
            }else{
                $dataDB = 
                    array(
                        'usuario'       => $data['usuario'],
                        'email'         => $data['email']
                    );   
            }
            $this->db->where('usuario_id', $id);
            $ok = $this->db->update('usuarios',$dataDB);
            return $ok;
        }
        public function removeData($data){
            $usuario = $data['usuario'];
            $this->db->where('usuario_id', $usuario);
            $this->db->delete('usuarios');
            return 1;
        }
        public function getData(){
            $this->db->select('usuario_id, contrasena, email, usuario, u.perfil_id, perfil');
            $this->db->from('usuarios u');
            $this->db->join('perfil_usuario pu', 'u.perfil_id = pu.perfil_id', 'left');
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        // Validar usuario no repetido
        function getDataValidation($id){ //READ VALIDATION
            $this->db->select('*');
            $this->db->from('usuarios u'); 
            $this->db->where('usuario', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return 'false';
            else return 'true';
        }

}
?>