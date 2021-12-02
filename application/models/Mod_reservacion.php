<?php

/**
  Modelo para la gestión de la reservación de un hotel
  Desarrollado Alexis José Turruella <alexturruella@gmail.com>
  2012
 */
class Mod_reservacion extends CI_Model {

    var $tb = 'frontend.frontend_reserva';

    function __construct()
    {
        parent::__construct();
    }

    function get_formas_pago()
    {
        return $this->db->get_where('frontend.frontend_forma_pago', array('activo' => 't'))->result_array();
    }

    function get_forma_pago_defecto()
    {
        return $this->db->get_where('frontend.frontend_forma_pago', array('activo' => 't', 'predeterminado' => 't'))->result_array();
    }

    /*
      Permite comprobar si el id del usuario es el propietario de la reserva
      para ser propietario el usuario debe ser le titular de la tarjeta
     */

    function valida_cliente_reserva($id_usuario, $id_reserva)
    {
        $this->db->select('frontend.frontend_reserva.id');
        $this->db->from('frontend.frontend_reserva');
        $this->db->where('frontend.frontend_reserva.id', $id_reserva);
        $this->db->where('frontend.frontend_reserva.titular_tarjeta_fk', $id_usuario);
        if ($this->db->get()->num_rows() > 0)
        {
            return true;
        }
        return false;
    }

    function actualizar_reserva($id_reserva, $reserva)
    {
        if ($this->db->update($this->tb, $reserva, array('id' => $id_reserva)))
        {
            return true;
        }
        return false;
    }

    function actualizar_reserva_editada($id_reserva, $reserva)
    {
        if ($this->db->update($this->tb, $reserva, array('id' => $id_reserva)))
        {
            return true;
        }
        return false;
    }

    function get_no_consecutivo_reserva()
    {
        $cantidad = $this->db->count_all($this->tb);
        return $cantidad + 1;
    }

    function get_no_consecutivo_reserva_editada($id_reserva, $opcion = NULL)
    {
        $reserva = $this->db->get_where($this->tb, array('id' => $id_reserva))->row();
        $no_reserva = $reserva->no_reserva;
        $fragmantado = explode('-', $no_reserva);
        $no_reserva_editada = '';
        if (sizeof($fragmantado) == 3)
        {
            $fragmantado[2] = $fragmantado[2] + 1;
            $no_reserva_editada = implode('-', $fragmantado);
        } else
        {
            $no_reserva_editada = $no_reserva . '-' . '1';
        }
        if ($opcion == true)
        {
            return array('no_reserva' => $no_reserva_editada, 'no_reserva_anterior' => $no_reserva);
        } else
        {
            return $no_reserva_editada;
        }
    }

    function actualizar_reservas_por_edicion($no_reserva_anterior, $no_reserva)
    {
        if ($this->db->update('frontend.frontend_reserva', array('no_reserva' => $no_reserva), 
array('no_reserva' => $no_reserva_anterior, 'estado_fk' => 4)))
        {
            return true;
        }
        return false;
    }

    function insert_productos_a_pagar_en_pasarela($info)
    {
        $this->db->insert('frontend.frontend_reserva_productos_pasarela', $info);
        return $this->db->insert_id();
    }

    function update_productos_a_pagar_en_pasarela($info, $condicion)
    {
        if ($this->db->update('frontend.frontend_reserva_productos_pasarela', $info, $condicion))
        {
            return true;
        }
        return false;
    }

    function get_reserva_pasarela($transaccion, $checkStatus = false)
    {
        $this->db->select('*');
        $this->db->from('frontend.frontend_reserva_productos_pasarela');
        $this->db->where('frontend.frontend_reserva_productos_pasarela.id', $transaccion);
        if ($checkStatus) {
            $this->db->where('frontend.frontend_reserva_productos_pasarela.estado', 0);
        }
        return $this->db->get()->row();
    }

    function get_reserva_pasarela_confirmada($transaccion)
    {
        $this->db->select('*');
        $this->db->from('frontend.frontend_reserva_productos_pasarela');
        $this->db->where('frontend.frontend_reserva_productos_pasarela.id', $transaccion);
        $this->db->where('frontend.frontend_reserva_productos_pasarela.estado', 2);
        return $this->db->get()->row();
    }

    function get_datos_reserva($id_reserva)
    {
        return $this->db->get_where($this->tb, array('id' => $id_reserva))->row_array();
    }

    function get_reserva_producto_pasarela($info)
    {
        return $this->db->get_where('frontend.frontend_reserva_productos_pasarela', $info)->row_array();
    }

    function get_operacion_reserva($info)
    {
        return $this->db->get_where('frontend.frontend_operacion_reserva', $info)->row_array();
    }

    function get_reservas_con_calendario($id_usuario)
    {
        $this->db->select('DISTINCT(' . $this->tb . '.id)');
        $this->db->from($this->tb);
        $this->db->join('frontend.frontend_canlendario_pago', $this->tb . '.id = frontend.frontend_canlendario_pago.reserva_fk');
        $this->db->where($this->tb . '.titular_tarjeta_fk', $id_usuario);
        $this->db->where($this->tb . '.estado_fk', 10);
        return $this->db->get()->result_array();
    }

    function get_calendario_pagos($id_reserva)
    {
        return $this->db->get_where('frontend.frontend_canlendario_pago', array('reserva_fk' => $id_reserva))->result_array();
    }

    function get_pago_del_calendario($id)
    {
        return $this->db->get_where('frontend.frontend_canlendario_pago', array('id' => $id))->row_array();
    }

    function update_pago_del_calendario($info, $condicion)
    {
        if ($this->db->update('frontend.frontend_canlendario_pago', $info, $condicion))
        {
            return true;
        }

        return false;
    }

    function get_politica_cancelar($modulo, $dias)
    {
        $this->db->select('*');
        $this->db->from('frontend.frontend_politica_cancelar');
        $this->db->where('frontend.frontend_politica_cancelar.dias >= ', $dias, false);
        $this->db->where('frontend.frontend_politica_cancelar.modulo_fk', $modulo);
        $this->db->order_by('frontend.frontend_politica_cancelar.dias DESC');
        $cancelaciones = $this->db->get()->result_array();
        return end($cancelaciones);
    }

    public function insert_operacion_reserva($info)
    {
        $this->db->insert('frontend.frontend_operacion_reserva', $info);
        return $this->db->insert_id();
    }

    public function cancelar_reserva($info, $id)
    {
        return $this->db->update($this->tb, $info, array('id' => $id));
    }
	
	public function get_numero_reserva($id_reserva)
    {
        $this->db->select('numero_transferencia');
        $this->db->from('frontend.frontend_operacion_reserva');
        $this->db->where('frontend.frontend_operacion_reserva.reserva_fk', $id_reserva);

        $result = $this->db->get()->row();

        return $result->numero_transferencia;
    }

}

?>