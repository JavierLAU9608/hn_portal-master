<?php

class Pasarela extends APP_Controller
{
    public function index()
    {
        $data['firma'] = $this->input->post('firma');
        $data['comercio'] = $this->input->post('comercio');
        $data['transaccion'] = $this->input->post('transaccion');
        $data['importe'] = $this->input->post('importe');
        $data['moneda'] = $this->input->post('moneda');
        $data['operacion'] = $this->input->post('operacion');
        $data['amex'] = $this->input->post('amex');

        $this->getPasarelaConfig($data);

        list($fecha, $code) = $this->getFechaCode();
        $this->getFirmas($data, $code, $fecha);

        $this->display('@pasarela/index', $data);
    }

    private function getFechaCode()
    {
        $hoy = new DateTime('now', new DateTimeZone('America/Havana'));
        $fecha = $hoy->format('Y-m-d');

        // código de la transacción en la pasarela 12 caracteres
        $code = $hoy->format('ymdHis');

        return array($fecha, $code);
    }

    private function getFirmas(&$data, $code, $fecha)
    {
        // si desea usar el módulo pasarela de una app diferente, fijar la palabra clave
        $pass = $this->getPass();

        $firma_p = md5($data['comercio'] . $data['transaccion'] . $data['importe'] . $data['moneda'] . 'P' . $pass);
        $firma_a = md5($data['comercio'] . $data['transaccion'] . $data['importe'] . $data['moneda'] . 'A' . $code . $fecha . $pass);
        $firma_d = md5($data['comercio'] . $data['transaccion'] . $data['importe'] . $data['moneda'] . 'D' . $code . $fecha . $pass);

        $data['firma_a'] = $firma_a;
        $data['firma_d'] = $firma_d;
        $data['fecha'] = $fecha;
        $data['codigo'] = $code;

        $data['error'] = '';
        if ($data['firma'] != $firma_p) {
            // la firma que se envía desde la app no coincide con la esperada
            $data['error'] = 'la firma que se envía desde la app no coincide con la esperada';
        }
        $data['importe2'] = $data['importe'] / 100;
    }

    private function getPasarelaConfig(&$data)
    {
        $data['comerse'] = $this->app_config('pasarela_comerse_name');
        $data['tarjetas_url'] = $this->app_config('pasarela_tarjetas_url');
        $data['monedas'] = $this->app_config('pasarela_monedas');
        $data['pasarela_curl'] = $this->app_config('pasarela_route_curl');
        $data['pasarela_redirect'] = $this->app_config('pasarela_route_redirect');
    }

    private function getPass()
    {
        return $this->sitio->st_get_informacion_simple_directa('palabra_secreta');
    }
}