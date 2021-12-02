<?php

class Mod_manage_reserva extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function insert_reserva_manual($info_reserva)
    {
        $this->db->trans_begin();
        $this->db->insert('frontend.frontend_reserva', $info_reserva);
        $id_reserva = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            throw new Exception('no se pudo guardar la reserva en: frontend_reserva');
        } else {
            $this->db->trans_commit();
        }

        return $id_reserva;
    }

    public function insert_habitacion_reserva_manual($info_reserva)
    {
        $this->db->trans_begin();
        $this->db->insert('frontend.frontend_habitacion_reserva', $info_reserva);
        $id_reserva = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
        }

        return $id_reserva;
    }

    public function insert_operacion_reserva_manual($info_reserva)
    {
        $this->db->trans_begin();
        $this->db->insert('frontend.frontend_operacion_reserva', $info_reserva);
        $id_reserva = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            throw new Exception('no se pudo guardar la reserva en: frontend_operacion_reserva');
        } else {
            $this->db->trans_commit();
        }

        return $id_reserva;
    }

    // el id es el q aparece en el panel
    public function delete_reserva($id_reserva)
    {
        $this->db->trans_begin();

        $sql_eliminar_hab_reserva = "DELETE FROM frontend.frontend_habitacion_reserva where frontend.frontend_habitacion_reserva.reserva_fk=" . $id_reserva;
        $this->db->query($sql_eliminar_hab_reserva);
        $this->db->trans_commit();
        if ($this->db->trans_status() === FALSE) {
            $debug = true;
        }

        $sql_eliminar_op_reserva = "DELETE FROM frontend.frontend_operacion_reserva where frontend.frontend_operacion_reserva.reserva_fk=" . $id_reserva;
        $this->db->query($sql_eliminar_op_reserva);
        $this->db->trans_commit();

        $sql_eliminar_op_reserva = "DELETE FROM frontend.frontend_reserva where frontend.frontend_reserva.id=" . $id_reserva;
        $this->db->query($sql_eliminar_op_reserva);
        $this->db->trans_commit();
    }

    public function actualiza_manual($id, $estado, $transaccion)
    {
        $data = array('estado' => $estado, 'codigo' => $transaccion);
        $this->db->update('frontend.frontend_reserva_productos_pasarela', $data, array('id' => $id));
    }

    function get_reserva_pasarela($id, $valide_estatus = true)
    {
        $this->db->select('*');
        $this->db->from('frontend.frontend_reserva_productos_pasarela');
        $this->db->where('frontend.frontend_reserva_productos_pasarela.id', $id);

        if ($valide_estatus) {
            $this->db->where('frontend.frontend_reserva_productos_pasarela.estado', 0);
        }

        return $this->db->get()->row();
    }
	
	public function getCorreos($email, $email2 = null) {
        $this->db->select('id, para, asunto, error, fecha_enviado');
        $this->db->from('seguridad.seguridad_email_logs');
        
        if (null == $email2) {
            $this->db->where('seguridad.seguridad_email_logs.para', $email);
        } else {
            $wh = '"seguridad"."seguridad_email_logs"."para"=\''.$email.'\' OR '.
                  '"seguridad"."seguridad_email_logs"."para"=\''.$email2.'\'';

            $this->db->where($wh, null, false);
        }
        
        return $this->db->get()->result_array();
    }

    public function getCorreosByFecha($fecha)
    {
        $this->db->select('id, para, asunto, error, fecha_enviado');
        $this->db->from('seguridad.seguridad_email_logs');

        $this->db->where(' (fecha_enviado >= \''.$fecha.' 00:00:00 \') and (fecha_enviado <= \''.$fecha.' 23:59:59 \')',NULL,false);

        $correos = $this->db->get()->result_array();

        return $correos;
    }


	
	public function getCorreoTexto($id) {
		
        $this->db->select('id, texto');
        $this->db->from('seguridad.seguridad_email_logs');
		$this->db->where('seguridad.seguridad_email_logs.id', $id);
        
        
        return $this->db->get()->result_array();
    }
}
