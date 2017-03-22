<?php
class Asign_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->helper('date');
        }

        public function addDataNote($data){
            $ok = 0;
            $dataDB = 
            array(
                'nota'          => $data['nota'],
                'ticket_id'     => $data['ticket_id'],
                'usuario_id'    => $data['usuario_id']
            );

            $ok = $this->db->insert('nota_ticket',$dataDB);

            if($ok == 1){
                $ok = 0;
                $dataDB = 
                array(
                    'movimiento'    => "Nota Enviada",
                    'ticket_id'     => $data['ticket_id'],
                    'usuario_id'    => $data['usuario_id']
                );
                $ok = $this->db->insert('historial_tickets',$dataDB);
            }

            return $ok;
        }

        public function addDataSQL($data){
            $ok = 0;
            $dataDB = 
            array(
                'sql'           => $data['sql'],
                'ticket_id'     => $data['ticket_id'],
                'usuario_id'    => $data['usuario_id']
            );

            $ok = $this->db->insert('sql_ticket',$dataDB);

            if($ok == 1){
                $ok = 0;
                $dataDB = 
                array(
                    'movimiento'    => "SQL Enviado",
                    'ticket_id'     => $data['ticket_id'],
                    'usuario_id'    => $data['usuario_id']
                );
                $ok = $this->db->insert('historial_tickets',$dataDB);
            }

            return $ok;
        }

        public function addDataRevision($data){
            $ok = 0;
            $dataDB = 
            array(
                'revision'      => $data['revision'],
                'ticket_id'     => $data['ticket_id'],
                'usuario_id'    => $data['usuario_id']
            );

            $ok = $this->db->insert('revision_ticket',$dataDB);

            if($ok == 1){
                $ok = 0;
                $dataDB = 
                array(
                    'movimiento'    => "Revisión Enviada",
                    'ticket_id'     => $data['ticket_id'],
                    'usuario_id'    => $data['usuario_id']
                );
                $ok = $this->db->insert('historial_tickets',$dataDB);
            }

            return $ok;
        }

        public function addDataAsign($data){
            $this->db->trans_start();
            if($data['asignado_id']){
                $dataDB = 
                array(
                    'asignado_id'   => $data['asignado_id'],
                );
                $this->db->where('ticket_id', $data['ticket_id']);
                $this->db->update('tickets',$dataDB);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE)
            {
                $ok = 0;
                $dataDB = 
                    array(
                        'movimiento'    => "Ticket Asignado",
                        'ticket_id'     => $data['ticket_id'],
                        'usuario_id'    => $data['usuario_id']
                    );
                $ok = $this->db->insert('historial_tickets',$dataDB);
                return $ok;
            }
        }

        public function updateDataAmbiente($data){
            $this->db->trans_start();
                if($data['ambiente_id']){
                    $dataDB = 
                    array(
                        'ambiente_id'   => $data['ambiente_id'],
                    );
                    $this->db->where('ticket_id', $data['ticket_id']);
                    $this->db->update('tickets',$dataDB);
                }
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE)
                return 1;
            else
                return 0;
        }

        public function updateDataStatus($data){
            $this->db->trans_start();
            if($data['estado_id']){
                $dataDB = 
                array(
                    'estado_id' => $data['estado_id']
                );
                $this->db->where('ticket_id', $data['ticket_id']);
                $this->db->update('tickets',$dataDB);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE)
            {
                $ok = 0;
                $dataDB = 
                    array(
                        'movimiento'    => "Estado Asignado",
                        'ticket_id'     => $data['ticket_id'],
                        'usuario_id'    => $data['usuario_id']
                    );
                $ok = $this->db->insert('historial_tickets',$dataDB);
                return $ok;
            }
        }

        public function updateData($data){
           
            $this->db->where('usuario_id', $id);
            $ok = $this->db->update('usuarios',$dataDB);
            return $ok;
        }

        public function updateDataSolventacion($data){
            $ok     = 0;
            $ticket = $data['ticket_id'];
            $dataDB = 
            array(
                'solventacion_id'  => $data['solventacion']
            );

            $this->db->where('ticket_id', $ticket);
            $ok = $this->db->update('tickets',$dataDB);

            if($ok == 1){
                $ok = 0;
                $dataDB = 
                array(
                    'movimiento'    => "Solventación Enviada",
                    'ticket_id'     => $data['ticket_id'],
                    'usuario_id'    => $data['usuario_id']
                );
                $ok = $this->db->insert('historial_tickets',$dataDB);
            }

            return $ok;
        }

        public function uploadFileData($data){
            $ok = 0;
            $dataDB = 
                array(
                    "content_type"      => $data['content_type'],
                    "nombre"            => $data['nombre'],
                    "nombre_original"   => $data['nombre_original'],
                    "ticket_id"         => $data['ticket_id'],
                    "usuario_id"        => $data['usuario_id']
                );
            $ok = $this->db->insert('archivo_ticket',$dataDB);
            return $ok;
        }

        public function getPreviewFile($data){
            $archivo = $data['archivo_ticket_id'];
            $this->db->select('archivo, content_type');
            $this->db->from('archivo_ticket ar');
            $this->db->where('archivo_ticket_id', $archivo);
            $query = $this->db->get();
            if($query->num_rows() > 0) return $query;
            else return false;
        }

}
?>