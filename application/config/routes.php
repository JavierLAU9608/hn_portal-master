<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "con_home";
$route['404_override'] = 'con_sitio/show_error_404';

$route['pasarela-curl'] = "con_reservacion/pasarela_curl";

// generales
$route['login'] = "con_seguridad";
$route['login-page/(:any)/(:any)'] = "con_seguridad/loginPage/$1/$2";
$route['salir'] = "con_seguridad/cerrar";
$route['registro'] = "con_seguridad/registro";
$route['recuperar-contrasenna'] = 'con_seguridad/recuperar_contrasenna';
$route['activar-cuenta/(:any)'] = "con_seguridad/activar_cuenta/$1";
$route['perfil'] = "con_micuenta";
$route['cuenta/perfil'] = "con_micuenta";
$route['cuenta/historial'] = "con_micuenta/historial";
$route['informacion/(:any)'] = "con_home/pagina_footer/$1";


// voucher
$route['cuenta/voucher/(:any)/(:num)'] = "con_reservacion/voucher/$1/$2";
$route['cuenta/voucheradmin/(:any)/(:num)'] = "con_reservacion/voucheradmin/$1/$2";

// reserva general
$route['cuenta/cancelar-reserva/(:any)/(:num)'] = "con_reservacion/cancelar_producto_pagado/$1/$2";
$route['datos-reserva'] = "con_reservacion/datos_reserva";
$route['carro-compra'] = "con_reservacion/carro_compra";
$route['carro-compra/cancelar/(:any)'] = "con_reservacion/cancelar_producto_car/$1";
$route['carro-compra/editar/(:any)'] = "con_reservacion/editar_reserva_car/$1";
$route['invitacion-pago/(:num)'] = 'con_reservacion/invitacion_pago/$1';
$route['invitacion-pago-denegado/(:num)'] = 'con_reservacion/invitacion_pago_denegado/$1';
$route['cuenta/calendario-pagos'] = "con_micuenta/calendario_pagos";
$route['cuenta/pagar/(:any)/(:num)'] = "con_reservacion/pagar_pago_calendario/$1/$2";


// oferta
$route['oferta/(:any)/(:num)'] = "con_oferta/oferta/$2";
$route['ofertas/(:num)'] = "con_oferta/index/NULL/$1";
$route['ofertas'] = "con_oferta";
$route['ofertas/(:any)/(:num)'] = "con_oferta/index/$1/$2";
$route['ofertas/(:any)'] = "con_oferta/index/$1/0";
$route['reserva-oferta/(:num)'] = "con_oferta/reservar/$1";


// alojamiento
$route['reserva-alojamiento'] = "con_alojamiento/reservar";
$route['reserva-alojamiento/(:any)/(:num)'] = "con_alojamiento/reservar/$2";


// noticias
$route['noticias/(:any)/(:num)'] = "con_noticia/noticia/$2"; // la noticia de la garantía de pago (datos_reserva.twig)

// boletin
$route['boletin'] = 'con_subscripcion/boletin';
$route['cancelar-boletin/(:any)/(:num)'] = 'con_subscripcion/cancelar/$1/$2';

// rss
$route['rss/(:any)'] = 'con_rss/index/$1';

// restaurante
$route['restaurante-menus/(:any)'] = "con_restaurante/restaurante/menu/$1";

// evento
$route['facilidad/(:any)'] = "con_evento/get_servicio/$1";

// ajax Terminos y politica
$route['popup-page/(:any)'] = "con_home/pagina_footer_ajax/$1";

// contacto
$route['contact-email'] = "con_sitio/contact_us";
/*

$route['alojamiento/(:num)'] = "con_alojamiento/index/$1";
$route['alojamiento'] = "con_alojamiento";
$route['catalogo'] = 'con_hotel/descargar_catalogo';
$route['descargar-imagen/(:num)'] = 'con_hotel/descargar_imagen/$1';
$route['descargar-imagenes/(:num)'] = 'con_hotel/descargar_coleccion/$1';
$route['libro'] = 'con_libro/index';
$route['libro/(:any)'] = 'con_libro/index/$1';
//LOS QUE TIENEN TRADUCCION

$route['historia'] = "con_home/historia";
$route['restaurantes'] = "con_restaurante";
$route['restaurantes/(:num)'] = "con_restaurante/index/$1";
$route['restaurante/(:any)'] = "con_restaurante/restaurante/open/$1";

$route['reserva-restaurante/(:any)'] = "con_restaurante/reservar/$1";
$route['personalidades/(:num)'] = "con_personalidad/index/$1";
$route['personalidades'] = "con_personalidad";
$route['personalidades/(:any)'] = "con_personalidad/personalidad/$1";
$route['noticias/(:num)'] = "con_noticia/index/$1";
$route['noticias'] = "con_noticia";
$route['noticias/(:any)/(:num)'] = "con_noticia/noticia/$2";
$route['galeria-imagenes'] = "con_hotel/galeria_imagenes";
$route['galeria-imagenes/(:num)'] = "con_hotel/galeria_imagenes//$1";
$route['galeria-imagenes/(:any)'] = "con_hotel/galeria_imagenes/$1";
$route['galeria-imagenes/(:any)/(:num)'] = "con_hotel/galeria_imagenes/$1/$2";
$route['mapa-sitio'] = "con_sitio/mapa";


$route['ejecutivo'] = "con_alojamiento/index/0/t";
$route['ejecutivo/(:num)'] = "con_alojamiento/index/$1/t";
$route['historicas'] = "con_alojamiento/historicas/";
$route['paquetes-luna-miel'] = "con_alojamiento/paquetes_luna_miel/";
$route['bares/(:num)'] = "con_bar/index/$1";
$route['bares'] = "con_bar";
$route['bares/(:any)/menus'] = "con_bar/bar_menus/$1";
$route['bares/(:any)'] = "con_bar/bar/$1";
$route['reserva-bar/(:any)'] = "con_bar/reservar/$1";
$route['eventos-convenciones'] = "con_evento";
$route['eventos-convenciones/(:num)'] = "con_evento/index/$1";
$route['reservar-evento'] = "con_evento/reservar";
$route['detalles-reserva-eventos'] = "con_evento/crear_reserva";
$route['cancelar-evento'] = "con_evento/cancelar_evento";


/* End of file routes.php */
/* Location: ./application/config/routes.php */