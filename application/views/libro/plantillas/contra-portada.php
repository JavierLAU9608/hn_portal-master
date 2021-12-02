<?php
/*
nombre = contra portada
medias = 1
archivos = array(1=>array('nombre'=>'1','w'=>360,'h'=>260))
*/
$img = imagecreatefromjpeg('images/libro/fondo.jpg');
$largo_fondo = imagesx($img);
$img_1 = imagecreatefromjpeg(app_dir_admin().'/admin/libro/'.$pagina['imagen_1']);
$largo_1 = imagesx($img_1);
$ancho_1 = imagesy($img_1);
imagecopymerge($img,$img_1,($largo_fondo - $largo_1)/2,70,0,0,$largo_1,$ancho_1,100);

$x1 = ($largo_fondo - $largo_1)/2 - 20;
$x2 = $x1 + $largo_1 + 20 + 20;
$y1 = 70 - 20;
$y3 = $y1 + $ancho_1 + 20 + 20;

imageline($img,$x1,$y1,$x2,$y1,0xFFBA00);
imageline($img,$x1,$y3,$x2,$y3,0xFFBA00);
imageline($img,$x1,$y1,$x1,$y3,0xFFBA00);
imageline($img,$x2,$y1,$x2,$y3,0xFFBA00);
//---------------------------------------------------------------------------------------------
$img_gran_caribe = imagecreatefromjpeg('images/libro/logo_gran_caribe.jpg');
$largo_gc = imagesx($img_gran_caribe);
$ancho_gc = imagesy($img_gran_caribe);
imagecopymerge($img,$img_gran_caribe,100,370,0,0,$largo_gc,$ancho_gc,100);
imageline($img,30,370 + $ancho_gc + 5,400,370 + $ancho_gc + 5,0xFFBA00);
imageline($img,100 + $largo_gc + 5,380,100 + $largo_gc + 5,380 + $ancho_gc + 30 ,0xFFBA00);

$controlador =& get_instance();
$direccion = $controlador->sitio->st_get_informacion_simple_directa('direccion');
$texto_direccion = utf8_decode(trans('direccion').': '.$direccion);

$lineas = app_word_wrap($texto_direccion,5);
$linea_inicial = 380;
$x = 100 + $largo_gc + 10;
foreach($lineas as $linea)
{
	imagestring($img,2,$x,$linea_inicial,$linea,0xFFBA00);
	$linea_inicial+=12;
}
$telefonos = $controlador->sitio->st_get_informacion_multiple('telefono');
$aux_tel = array();
foreach($telefonos as $t)
{
	$aux_tel[] = $t['value'];
}
$texto_telefono = utf8_decode(trans('telefono').': '.implode(', ',$aux_tel));
imagestring($img,2,$x,$linea_inicial,$texto_telefono,0xFFBA00);

$correo_reserva = $controlador->sitio->st_get_informacion_simple_directa('correoreserva1');
imagestring($img,2,30,370 + $ancho_gc + 10,$correo_reserva,0xFFBA00);
imagestring($img,2,30,370 + $ancho_gc + 25,base_url(),0xFFBA00);

//-------------------------------------------------------------------------------------
if(isset($vista_previa) && $vista_previa == true)
{
	header('Content-Type: image/jpeg');
    imagejpeg($img);
}
else
{
	imagejpeg($img,$ruta.'/'.$pagina['id'].'.jpg');
}
//-------------------------------------------------------------------------------------
imagedestroy($img);
?>