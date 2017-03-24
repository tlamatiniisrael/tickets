<?php
class Tickets_model extends CI_Model {

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
                'codigo'            => $data['codigo'],
                'descripcion'       => $data['descripcion'],
                'sumario'           => $data['sumario'],
                'categoria_id'      => $data['categoria_id'],
                'prioridad_id'      => $data['prioridad_id'],
                'usuario_id'        => $data['usuario_id'],
                'tipo_cambio_id'    => $data['tipo_cambio_id']
            );
            $this->db->insert('tickets',$dataDB);
            $ticketID = $this->db->insert_id();
            //Iniciar espacios SQL y Revision
            $dataDB = 
            array(
                'ticket_id'      => $ticketID,
                'usuario_id'     =>  $data['usuario_id'],
            );
            $this->db->insert('sql_ticket',$dataDB);
            $this->db->insert('revision_ticket',$dataDB);
            return $ticketID;
        }
         public function updateData($data){
            $ok = 0;
            $id = $data['id'];
                $dataDB = 
                array(
                    'usuario'       => $data['usuario'],
                    'contrasena'    => $data['contrasena'],
                    'email'         => $data['email'],
                    'perfil_id'     => $data['perfil_id']
                );
            $this->db->where('usuario_id', $id);
            $ok = $this->db->update('usuarios',$dataDB);
            return $ok;
        }
        public function getData($usuario, $rol){
            switch ($rol) {
                case '1':
                    $this->db->select('ticket_id, fecha_registro, t.usuario_id, u.usuario, e.estado_id, e.estado, sumario');
                    $this->db->from('tickets t');
                    $this->db->join('usuarios u', 't.usuario_id = u.usuario_id', 'left');
                    $this->db->join('estado_ticket e', 't.estado_id = e.estado_id', 'left');
                    break;
                case '2':
                    $this->db->select('ticket_id, fecha_registro, t.usuario_id, u.usuario, e.estado_id, e.estado, sumario');
                    $this->db->from('tickets t');
                    $this->db->join('usuarios u', 't.usuario_id = u.usuario_id', 'left');
                    $this->db->join('estado_ticket e', 't.estado_id = e.estado_id', 'left');
                    $this->db->where('t.usuario_id', $usuario);
                    break;
                case '3':
                    $this->db->select('ticket_id, fecha_registro, t.usuario_id, u.usuario, e.estado_id, e.estado, sumario');
                    $this->db->from('tickets t');
                    $this->db->join('usuarios u', 't.usuario_id = u.usuario_id', 'left');
                    $this->db->join('estado_ticket e', 't.estado_id = e.estado_id', 'left');
                    $this->db->where('t.asignado_id', $usuario);
                    break;
                default:
                    # code...
                    break;
            }
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }
}
?>