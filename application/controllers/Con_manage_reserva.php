<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

const VALIDATE_TRANSACTION = 1;
const VALIDATE_TOKEN = 2;
const VALIDATE_ID = 3;
const NO_VALIDATE = 0;

class Con_manage_reserva extends APP_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('mod_reservacion', 'prod_pasarela');
        $this->load->model('mod_manage_reserva', 'mod_reservacion');
        $this->load->library('request');

        error_reporting(0);
    }

    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('','<br/>');

        /** @var CI_Form_validation $validation */
        $validation = $this->form_validation;

        $fecha = strtolower($this->input->post("fecha"));
        $tipo_habitacion = $this->input->post("tipo_habitacion");
        $cantidad_habitaciones = $this->input->post("cantidad_habitaciones");
        $noches = $this->input->post("noches");

        if ($validation->run('form_home_hotel') == TRUE)
        {
            echo 'ok';
        }

        $_fecha = array('name' => 'fecha', 'value' => $fecha);

        $_tipo_habitacion = array(1 => 'suit', 2 => 'junior');
        $_cantidad_habitaciones = array(1 => 1, 2 => 2);
        $_noches = array(1 => 1, 2 => 2, 3 => 3, 4 => 4);

        $e = validation_errors();

        echo form_open('con_manage_reserva');
        echo form_input($_fecha);
        echo form_dropdown('tipo_habitacion', $_tipo_habitacion);
        echo form_dropdown('cantidad_habitaciones', $_cantidad_habitaciones);
        echo form_dropdown('noches', $_noches);
        echo form_submit('send', 'ok');
        echo form_close();
        echo $e;

        $all = $this->sitio->st_get_all_informacion();

    }

    public function decode()
    {
        try {
            $id = $this->request->_get('id'); //id en la pasarela
            $this->request->_get('transaccion', null, VALIDATE_TRANSACTION);
            $reserva = $this->validate_reserva($id, false);
            //$this->request->_get('token', null, VALIDATE_TOKEN);
        } catch (Exception $exc) {
            return $this->response(array('success' => false, 'msg' => $exc->getMessage()));
        }

        $datos_titular_tarjeta = unserialize(trim($reserva->datos_titular_tarjeta));
        $datos_titular_reserva = unserialize(trim($reserva->datos_titular_reserva));

        echo '<pre>';

        echo '<br>Titular de la reserva:<br>';
        print_r($datos_titular_reserva);

        if ($datos_titular_reserva != $datos_titular_tarjeta) {
            echo '<br>Titular de la tarjeta:<br>';
            print_r($datos_titular_tarjeta);
        }

        echo '<br>Datos para reserva:<br>';
        print_r($this->get_data_reserva($reserva));

        echo '<br>Datos para habitacion_reserva:<br>';
        print_r($this->get_data_habit_res($reserva, null));

        echo '<br>Datos para operacion_reserva:<br>';
        print_r($this->get_data_op_reserva($reserva, NULL, NULL));

        echo '</pre>';
    }

    public function manual_insert()
    {
        try {
            $id = $this->request->_get('id', null, VALIDATE_ID); //id en la pasarela
            $transaccion = $this->request->_get('transaccion', null, VALIDATE_TRANSACTION);
            //$this->request->_get('token', null, VALIDATE_TOKEN);

            $reserva = $this->validate_reserva($id);
        } catch (Exception $exc) {
            return $this->response(array('success' => false, 'msg' => $exc->getMessage()));
        }

        try {
            // reserva
            $id_reserva = $this->mod_reservacion->insert_reserva_manual($this->get_data_reserva($reserva));

            // habitacion_reserva
            $this->insert_hab_res($reserva, $id_reserva);

            $this->mod_reservacion->insert_operacion_reserva_manual($this->get_data_op_reserva($reserva, $id_reserva, $transaccion));

            // actualizar reserva_productos_pasarela
            $this->mod_reservacion->actualiza_manual($id, 2, $transaccion);
        } catch (Exception $e)
        {
            if (isset($id_reserva)) {
                $this->mod_reservacion->delete_reserva($id_reserva); // eliminar los elementos insertados
            }

            return $this->response(array('success' => false, 'msg' => $e->getMessage()));
        }

        // notifica
        $this->notifica_al_correo($reserva);
        return $this->response(array("success" => true));

    }

    public function get_token()
    {
        // solo en modo de desarrollo
        if (defined('ENVIRONMENT')) {
            if (ENVIRONMENT == 'development') {
                $id = $this->request->_get('id', null, VALIDATE_ID, true); //id en la pasarela
                echo md5($id . 'elPa3380rdD3l4h0s14');
            }
        }
    }

    public function notifica()
    {
        try {
            $id = $this->request->_get('id', null, VALIDATE_ID); //id en la pasarela
            $this->request->_get('token', null, VALIDATE_TOKEN);
            $reserva = $this->validate_reserva($id);

            $this->notifica_al_correo($reserva);
        } catch (Exception $exc) {
            return $this->response(array('success' => false, 'msg' => $exc->getMessage()));
        }
        
        return $this->response(array("success" => true));
    }

    private function notifica_al_correo($reserva)
    {
        $producto_a_pagar = unserialize(trim($reserva->productos_a_pagar));
        $reserva_base = unserialize(trim($reserva->reserva_base));
        $keys = array_keys($producto_a_pagar);
        $importe = $producto_a_pagar[$keys[0]]['subtotal'];

        $datos_titular_tarjeta = unserialize(trim($reserva->datos_titular_tarjeta));
        $datos_titular_reserva = unserialize(trim($reserva->datos_titular_reserva));

        $datos_email_reserva = array(
            'nombre' => $datos_titular_tarjeta['nombre'],
            'email' => $datos_titular_tarjeta['email'],
            'titualar_tarjeta' => $datos_titular_tarjeta['nombre'],
            'titular_reserva' => $datos_titular_reserva['nombre'],
            'pasaporte' => $datos_titular_reserva['pasaporte'],
            'no_reserva' => $reserva_base['no_reserva'],
            'importe_pagar_carro' => app_rate_cambio($importe, 'ltr'),
            'key_car' => $reserva_base['key_car']
        );


        $this->load->library('notificacion_email');
        $this->notificacion_email->notificacion_pago_pasarela($datos_email_reserva, $producto_a_pagar);
    }

    private function get_data_op_reserva($reserva, $id_reserva, $transaccion)
    {
        $producto_a_pagar = unserialize(trim($reserva->productos_a_pagar));
        $keys = array_keys($producto_a_pagar);

        $fecha = $producto_a_pagar[$keys[0]]['options']['fecha'];
        $importe = $producto_a_pagar[$keys[0]]['subtotal'];

        // operacion_reserva
        $data = array(
            'fecha' => $fecha,
            'numero_transferencia' => $transaccion,
            'precio_total' => $importe,
            'tipo_operacion_fk' => 1,
            'reserva_fk' => $id_reserva
        );

        return $data;
    }

    private function get_data_habit_res($reserva, $id_reserva)
    {
        // habitacion_reserva
        $producto_a_pagar = unserialize(trim($reserva->productos_a_pagar));
        $keys = array_keys($producto_a_pagar);
        $habitaciones = $producto_a_pagar[$keys[0]]['options']['habitaciones'];
        $data = array();

        foreach ($habitaciones as $habitacion) {
            $data[] = array(
                'hotel_fk' => 78,
                'tipo_habitacion_fk' => $habitacion['tipo_habitacion'],
                'fecha_entrada' => $habitacion['fecha'],
                'hora_entrada' => '12:00',
                'plan_fk' => $habitacion['plan'],
                'cantidad_noches' => $habitacion['noches'],
                'precio' => $habitacion['precio'],
                'reserva_fk' => $id_reserva,
                'detalles_reservacion' => serialize($habitacion['detalles_reservacion']),
                'precio_convertido' => $habitacion['detalles_reservacion']['precio_convertido'],
                'cantidad_paxs' => $habitacion['paxs'],
                'ninno_adicional' => 'f',
            );
        }

        return $data;
    }

    private function get_data_reserva(&$reserva)
    {
        $producto_a_pagar = unserialize(trim($reserva->productos_a_pagar));
        $fecha_reserva = $reserva->fecha;

        $keys = array_keys($producto_a_pagar);
        $reserva_base = unserialize(trim($reserva->reserva_base));

        // esto se genera por si ya exite el de la prereserva
        $no_reserva = $this->_generar_no_reserva();

        // reserva
        $data = array(
            'titular_tarjeta_fk' => $reserva_base['titular_tarjeta_fk'],
            'persona_reserva_fk' => $reserva_base['persona_reserva_fk'],
            'forma_pago_fk' => $reserva_base['forma_pago_fk'],
            'estado_fk' => 4,
            'fecha_creada' => $fecha_reserva,
            'key_car' => $reserva_base['key_car'],
            'pk_idioma' => $reserva_base['pk_idioma'],
            'pk_moneda' => $reserva_base['pk_moneda'],
            'no_reserva' => $no_reserva,
            'estado_prestatario_fk' => 3,
            'nota' => $producto_a_pagar[$keys[0]]['options']['detalles'],
        );

        // reasignar el valor
        $reserva_base['no_reserva'] = $no_reserva;
        $reserva->reserva_base = serialize($reserva_base);

        return $data;
    }

    private function insert_hab_res($reserva, $id_reserva)
    {
        $habitaciones = $this->get_data_habit_res($reserva, $id_reserva);

        foreach ($habitaciones as $habitacion) {
            $id_habit_reserva = $this->mod_reservacion->insert_habitacion_reserva_manual($habitacion);
            if (!$id_habit_reserva) {
                throw new Exception('no se pudo guardar la reserva en: frontend_habitacion_reserva');
            }
        }

        return true;
    }

    private function _generar_no_reserva($pais = null, $cantidad_productos = 1)
    {
        $pais = app_relleno($pais, 3);
        $cantidad_productos = app_relleno($cantidad_productos, 2);
        $idioma = $this->idioma_current['id'];
        $tipo_cliente = app_relleno('C', 3, '0', 'r');

        $consecutivo = app_relleno($this->prod_pasarela->get_no_consecutivo_reserva(), 5);

        $no_reserva = 'STG-';
        $no_reserva.=$pais . '' . $idioma . '' . $tipo_cliente . '' . $cantidad_productos . '' . $consecutivo;
        return $no_reserva;
    }

    private function response($data)
    {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    private function validate_reserva($id, $valide_estatus = true)
    {
        $reserva = $this->mod_reservacion->get_reserva_pasarela($id, $valide_estatus);
        if (sizeof($reserva) !== 1) {
            throw new Exception('La reserva no se encuentra o ya fue activada');
        }

        return $reserva;
    }
	
	/**
     * Este metodo lo utiliza el panel para mostrar los correos que se le envian
     * a un cliente
     */
    public function getCorreosEnviados() {
        $email1 = isset($_POST['email1']) ? $_POST['email1'] : null;
        $email2 = isset($_POST['email2']) ? $_POST['email2'] : null;
         
        //$email1 = 'michael.jefford@petermac.org';
        
        if ($email1 == $email2) {
            $email2 = null;
        }
        $result = array();
        
        if (null != $email1) {
            $correos = $this->mod_reservacion->getCorreos($email1, $email2);
            
            $result['total'] = count($correos);
            $result['table'] = $correos;
        }
                
        return $this->response($result);
    }
	
	public function getCorreosEnviadoTexto($id) {
        //$id = isset($_GET['id']) ? $_GET['id'] : null;         
        
        $result = array();
        $result['table']['texto'] = "";		
        //return $id;
		$correos = $this->mod_reservacion->getCorreoTexto($id);
		//$result['table']['texto'] = $correos[0]['texto'];
        
		$this->load->view('view_email',array( 'texto'=>$correos[0]['texto']) );
        //print $correos[0]['texto'] ;       
        //return $this->response($result);
    }

    public function getEmailByDate()
    {
        //$date = new DateTime();

        $correos = $this->mod_reservacion->getCorreosByFecha('2017-05-11');
        var_dump($correos);
    }

    public function prueba_x() {
        $this->load->model('mod_alojamiento_debug', 'mod_debug');

        $fecha = '2016-07-21';
        $tipo_habitacion = 193;

        $datos['hotel'] = $this->mod_debug->get_hotel_reducido();
        $this->mod_debug->modifica_paros($datos, $tipo_habitacion, $fecha);
        echo 1;

        $paros = $datos['hotel']['paros_venta'];
        $fecha_min = $datos['hotel']['fecha_minima'];
        $min_noches = $datos['hotel']['minimo_de_noches'];

        $fecha = $fecha_min;

        $_p = array();
        foreach ($paros as $key => $paro)
        {
            $_p[] = array(date("Y/m/d",strtotime($paro['fecha_inicio'])), date("Y/m/d",strtotime($paro['fecha_fin'])));
        }

        $cant_max_noches   = $this->mod_debug->get_max_cant_max_noches($fecha, $tipo_habitacion);
        $cant_habitaciones = $this->mod_debug->get_cant_hab_disp($tipo_habitacion, $fecha);

        // nueva funcionalidad
        $info = $this->mod_debug->get_reserva_info($fecha);

        print json_encode(array('ok' => 't', 'fecha' => $fecha,
                                'habitaciones' => $cant_habitaciones, 'noches_min' => $min_noches,
                                'min_active_day' => $datos['hotel']['min_active_day'],
                                'noches_max' => $cant_max_noches, 'paros' => $_p,
                                'info' => $info
                          ));
        exit();

    }
}
