<?php
class Json_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getJsonUser($id){
            $this->db->select('usuario_id, contrasena, email, usuario, u.perfil_id, perfil');
            $this->db->from('usuarios u');
            $this->db->join('perfil_usuario pu', 'u.perfil_id = pu.perfil_id', 'left');
            $this->db->where('usuario_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        public function getJsonTickets($id){
            $this->db->select('ticket_id, descripcion, fecha_registro, cat.categoria_id, categoria, tkt.solventacion_id, st.solventacion, tkt.usuario_id, us.usuario, tkt.asignado_id, asig.usuario as asignado, pri.prioridad_id, prioridad, etkt.estado_id, estado, sumario, descripcion');
            $this->db->from('tickets tkt');
            $this->db->join('categorias cat', 'tkt.categoria_id = cat.categoria_id', 'left');
            $this->db->join('estado_ticket etkt', 'tkt.estado_id = etkt.estado_id', 'left');
            $this->db->join('prioridad pri', 'tkt.prioridad_id = pri.prioridad_id', 'left');
            $this->db->join('usuarios us', 'tkt.usuario_id = us.usuario_id', 'left');
            $this->db->join('usuarios asig', 'tkt.asignado_id = asig.usuario_id', 'left');
            $this->db->join('ambiente_ticket amb', 'tkt.ambiente_id = amb.ambiente_id', 'left');
            $this->db->join('tipo_cambio tc', 'tkt.tipo_cambio_id = tc.tipo_cambio', 'left');
            $this->db->join('solventacion_ticket st', 'tkt.solventacion_id = st.solventacion_id', 'left');
            $this->db->where('ticket_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        public function getJsonAsign($id){
            $this->db->select('nota_id, fecha_nota, nt.usuario_id, usuario, nota');
            $this->db->from('nota_ticket nt');
            $this->db->join('tickets t', 'nt.ticket_id = t.ticket_id');
            $this->db->join('usuarios u', 'nt.usuario_id = u.usuario_id');
            $this->db->where('nt.ticket_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        public function getJsonPetition($id){
            $this->db->select('ticket_id, nota_id, fecha_nota, nota, u.usuario_id, usuario');
            $this->db->from('nota_ticket nt');
            $this->db->join('usuarios u', 'nt.usuario_id = u.usuario_id');
            $this->db->where('ticket_id', $id);
            $this->db->order_by("nota_id", "asc");
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        public function getJsonNotes($id){
            $this->db->select('nota_id, fecha_nota, usuario, nota');
            $this->db->from('nota_ticket nt');
            $this->db->join('usuarios u', 'nt.usuario_id = u.usuario_id');
            $this->db->where('ticket_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        public function getJsonAttached($id){
            $this->db->select('archivo_ticket_id, fecha_archivo, ar.usuario_id, u.usuario, ar.nombre, ar.nombre_original');
            $this->db->from('archivo_ticket ar');
            $this->db->join('usuarios u', 'u.usuario_id = ar.usuario_id');
            $this->db->where('ticket_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

        public function getJsonHistory($id){
            $this->db->select('historial_id, fecha_movimiento, usuario, movimiento');
            $this->db->from('historial_tickets ht');
            $this->db->join('usuarios u', 'ht.usuario_id = u.usuario_id');
            $this->db->where('ticket_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

}
?>