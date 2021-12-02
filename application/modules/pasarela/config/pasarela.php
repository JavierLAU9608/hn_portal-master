<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [];
if (ENVIRONMENT == 'development') {
    // nombre de las rutas a las que se envía la resp y se redirecciona
    $config['pasarela_route_curl'] = "con_reservacion/pasarela";
    $config['pasarela_route_redirect'] = "con_reservacion/pasarela";

    // comercio que sale en el extracto de pago del cliente
    $config['pasarela_comerse_name'] = "Agencia de viajes Havanatur";

    $config['pasarela_tarjetas_url'] = "http://localhost/H-Nacional/portal/web/img/tarjetas/";

    $config['pasarela_monedas'] = array(
        840 => array('US Dollar', '$'),
        978 => array('Euro', '€'),
        826 => array('Libra', '₤')
    );
}
