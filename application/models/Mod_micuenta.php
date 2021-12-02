<?php

class Mod_micuenta extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function upd_registro($usuario_data, $id)
    {
        return $this->db->update('frontend.frontend_registrarse', $usuario_data, array('frontend.frontend_registrarse.id' => $id));
    }

    function get_disponibilidad_tipo_registro($id_tipo_cliente)
    {
        $this->db->select('t1.id, t1.nombre');
        $this->db->from('frontend.frontend_tipo_registro t1');
        $this->db->where(['t1.id' => $id_tipo_cliente]);

        $tipos = $this->db->get()->result_array();

        $tipos['cupos'] = $this->get_cliente_producto($id_tipo_cliente);

        return $tipos;
    }

    function get_cliente_producto($id_tipo_cliente)
    {
        $this->db->select('t1.id,  t1.descuento_fk,  t1.descuento,  t1.cupos,  t1.cupos_dias,
         t1.fecha_cupo_inicio,  t1.fecha_cupo_fin, t1.producto_fk,  t1.producto_tipo, t1.tipo_habitacion_fk,
           t1.plan_fk, t3.nombre_habitacion, t4.nombre_plan');

        $this->db->from('frontend.frontend_cliente_producto t1');
        $this->db->join('frontend.frontend_tipo_cliente t2', "t1.descuento_fk = t2.id");
        $this->db->join('hotel.hotel_tipo_de_habitacion t3', 't3.id = t1.tipo_habitacion_fk', 'LEFT OUTER');
        $this->db->join('hotel.hotel_plan_de_alimentacion t4', 't4.id = t1.plan_fk', 'LEFT OUTER');
        $this->db->where(['t2.nombre' => $id_tipo_cliente]);

        $d = $this->db->get()->result_array();

        return $d;

    }
}

?>