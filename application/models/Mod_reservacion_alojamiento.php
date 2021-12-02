<?php

/**
  Modelo para la gestión de la reservación de un hotel
  Desarrollado Alexis José Turruella <alexturruella@gmail.com>
  2012
 */
class Mod_reservacion_alojamiento extends CI_Model {

    var $tb = 'frontend.frontend_habitacion_reserva';

    function __construct() {
        parent::__construct();
    }

    public function procesar_insert_reserva($reserva_general, $reserva) {
        //Esta es la estructura de la base de datos $contenedor_detalles
        $contenedor_detalles = array();
        $habitaciones = $reserva['options']['habitaciones'];
        $detalle = array();
        foreach ($habitaciones as $h) {
            // este es un parche porque el pax viene como una combinación de adultos
            // niños (2-1)
            $pax =  $h['paxs'];
            $temp = explode('-', $pax);
            $nin_add = $h['ninno_adicional'] ? 't' : 'f';
            if (count($temp) > 0) {
                $pax = $temp[0] + (isset($temp[1]) ? $temp[1] : 0);// sumas adultos y niños para obtener el pax
                $nin_add = (isset($temp[1]) && $temp[1] != 0) ? 't' : 'f';
            }

            $detalle['hotel_fk'] = $reserva['options']['id_hotel'];
            $detalle['tipo_habitacion_fk'] = $h['tipo_habitacion'];
            $detalle['fecha_entrada'] = $h['fecha'];
            $detalle['responsable_nombre'] = isset($h['responsable_nombre']) ? $h['responsable_nombre'] : '';
            $detalle['responsable_pasaporte'] = isset($h['responsable_pasaporte']) ? $h['responsable_pasaporte'] : '';
            $detalle['hora_entrada'] = $h['hora'];
            $detalle['plan_fk'] = $h['plan'];
            $detalle['cantidad_noches'] = $h['noches'];
            $detalle['cantidad_paxs'] = $pax;
            $detalle['nuevo_paxs'] = $h['paxs'];
            $detalle['paquete_luna_miel_fk'] = $h['paquete_luna_miel'];
            $detalle['ninno_adicional'] = $nin_add;;
            //$precio_convertido = app_rate_cambio($h['precio']);
            $detalle['precio_convertido'] = $h['detalles_reservacion']['precio_convertido'];
            $detalle['precio'] = $h['precio'];
            $detalle['detalles_reservacion'] = serialize($h['detalles_reservacion']);
            $contenedor_detalles[] = $detalle;
        }

        $datos_reserva = array('reserva', 'detalles');
        $datos_reserva['reserva'] = $reserva_general;
        $datos_reserva['detalles'] = $contenedor_detalles;

        return $this->insert_reserva($datos_reserva);
    }

    public function insert_reserva($datos_reserva) {
        $info_reserva = $datos_reserva['reserva'];
        $this->db->trans_begin();
        $this->db->insert('frontend.frontend_reserva', $info_reserva);
        $id_reserva = $this->db->insert_id();

        $detalles_reserva = $datos_reserva['detalles'];
        foreach ($detalles_reserva as $detalle) {
            $detalle['reserva_fk'] = $id_reserva;
            $this->db->insert($this->tb, $detalle);
            $this->db->insert_id();
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $id_reserva;
        }
    }

    public function get_reservas_confirmadas($id_usuario, $estado = 7) {
        $wh = (is_array($estado)) ? ("(frontend.frontend_reserva.estado_fk=" . $estado[0] . " OR frontend.frontend_reserva.estado_fk=" . $estado[1] . ")") : ("frontend.frontend_reserva.estado_fk=" . $estado);
        $sql_reserva = "select * from frontend.frontend_reserva where " . $wh . " AND frontend.frontend_reserva.titular_tarjeta_fk=$id_usuario";
        $query = $this->db->query($sql_reserva);
        if ($query->num_rows() > 0) {
            $reservas_confirmadas = array();
            foreach ($query->result_array() as $row) {
                $reserva_confirmada = $this->get_reserva($row['id']);
                if ($reserva_confirmada != false) {
                    $reserva_confirmada['options']['aconfirmar'] = 2;
                    $reservas_confirmadas[] = $reserva_confirmada;
                }
            }
            return $reservas_confirmadas;
        }
        return false;
    }

    public function get_reserva($id_reserva) {
        $reservas = array();
        $sql_reserva = "select * from frontend.frontend_reserva where frontend.frontend_reserva.id=$id_reserva";
        $query = $this->db->query($sql_reserva);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $sql_reserva_detalles = "SELECT * FROM " . $this->tb . " WHERE " . $this->tb . ".reserva_fk=" . $row->id;
            $query_detalles = $this->db->query($sql_reserva_detalles);
            if ($query_detalles->num_rows() > 0) {
                $row_detalle = $query_detalles->result_array();
                $habitaciones = array();
                $precio_total = 0;
                $fecha_menor = '9999';
                foreach ($row_detalle as $h) {
                    if ($h['fecha_entrada'] < $fecha_menor)
                        $fecha_menor = $h['fecha_entrada'];
                    $precio_total += $h['precio'];
                    $habitaciones[] = array('id_hotel' => $h['hotel_fk'],
                        'tipo_habitacion' => $h['tipo_habitacion_fk'],
                        'fecha' => $h['fecha_entrada'],
                        'hora' => $h['hora_entrada'],
                        'plan' => $h['plan_fk'],
                        'noches' => $h['cantidad_noches'],
                        'paxs' => $h['cantidad_paxs'],
                        'nuevo_paxs' => $h['nuevo_paxs'],
                        'ninno_adicional' => $h['ninno_adicional'],
                        'paquete_luna_miel' => $h['paquete_luna_miel_fk'],
                        'responsable_nombre' => $h['responsable_nombre'],
                        'responsable_pasaporte' => $h['responsable_pasaporte'],
                        'precio' => $h['precio'],
                        'precio_convertido' => $h['precio_convertido'],
                        'detalles_reservacion' => unserialize($h['detalles_reservacion'])
                    );
                }
                $informacion_options = array(
                    'id_hotel' => $h['hotel_fk'],
                    'fecha' => $fecha_menor,
                    'habitaciones' => $habitaciones,
                    'detalles' => $row->nota,
                    'id_reserva' => $row->id,
                    'no_reserva' => $row->no_reserva,
                    'titular_tarjeta_fk' => $row->titular_tarjeta_fk,
                    'persona_reserva_fk' => $row->persona_reserva_fk,
                    'pk_idioma' => $row->pk_idioma,
                    'aconfirmar' => NULL,
                    'id_reserva_padre' => $row->reserva_padre_fk,
                    'fecha_creada' => $row->fecha_creada,
                    'fecha_modificada' => $row->fecha_modificada,
                    'numero_confirmacion' => $row->numero_confirmacion,
                    'estado' => $row->estado_fk
                );

                if ($row->estado_fk == 7)
                    $informacion_options['id_reserva_confirmada'] = $row->id;

                $reserva['qty'] = 1;
                $reserva['price'] = $precio_total;
                $reserva['name'] = $h['hotel_fk'];
                $reserva['options'] = $informacion_options;
                return $reserva;
            }
            return false;
        }
        return false;
    }

    public function eliminar_reserva_confirmada($id_reserva) {
        $this->db->trans_begin();
        $sql_eliminar_reserva_detalles = "DELETE FROM " . $this->tb . " where " . $this->tb . ".reserva_fk=" . $id_reserva;
        $this->db->query($sql_eliminar_reserva_detalles);

        $sql_eliminar_reserva = "DELETE FROM frontend.frontend_reserva where frontend.frontend_reserva.id=" . $id_reserva;
        $this->db->query($sql_eliminar_reserva);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}

?>