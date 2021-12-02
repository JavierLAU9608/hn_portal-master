<?php
/*
nombre = plantilla 2
medias = 2
archivos = array(1=>array('nombre'=>'1','w'=>360,'h'=>260),2=>array('nombre'=>'2','w'=>100,'h'=>150))
*/
$img = imagecreatefromjpeg('images/libro/fondo.jpg');
$largo_fondo = imagesx($img);
$ancho_fondo = imagesy($img);
$img_1 = imagecreatefromjpeg(app_dir_admin().'/admin/libro/'.$pagina['imagen_1']);
$largo_1 = imagesx($img_1);
$ancho_1 = imagesy($img_1);
imagecopymerge($img,$img_1,($largo_fondo - $largo_1)/2,60,0,0,$largo_1,$ancho_1,100);

$y = $ancho_1 + 60 + 40;

$img_2 = imagecreatefromjpeg(app_dir_admin().'/admin/libro/'.$pagina['imagen_2']);
$largo_2 = imagesx($img_2);
$ancho_2 = imagesy($img_2);
imagecopymerge($img,$img_2,370,$y,0,0,$largo_2,$ancho_2,100);

$linea_inicial = $y;
if($pagina['titulo']!=='' &&  $pagina['titulo']!==NULL)
{
	imagestring($img,3,50,$linea_inicial,utf8_decode($pagina['titulo']),0xFFBA00);
	$linea_inicial+=20;
}
$lineas = app_word_wrap(utf8_decode($pagina['texto']),5);
foreach($lineas as $linea)
{
	imagestring($img,2,50,$linea_inicial,$linea,0xFFFFFF);
	$linea_inicial+=12;
}
imagestring($img,3,50,($ancho_fondo - 20),trans('hotel_nacional_cuba'),0xFFBA00);
imagestring($img,3,($largo_fondo - 20),($ancho_fondo - 20),$num,0xFFBA00);
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