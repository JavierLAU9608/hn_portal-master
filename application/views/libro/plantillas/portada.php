<?php
/*
nombre = portada
medias = 1
archivos = array(1=>array('nombre'=>'1','w'=>360,'h'=>260))
*/
$img = imagecreatefromjpeg('images/libro/fondo.jpg');
$largo_fondo = imagesx($img);
$img_logo = imagecreatefromjpeg('images/libro/logo.jpg');
$largo_l = imagesx($img_logo);
$ancho_l = imagesy($img_logo);
imagecopymerge($img,$img_logo,($largo_fondo - $largo_l)/2,10,0,0,$largo_l,$ancho_l,100);
$img_1 = imagecreatefromjpeg(app_dir_admin().'/admin/libro/'.$pagina['imagen_1']);
$largo_1 = imagesx($img_1);
$ancho_1 = imagesy($img_1);
imagecopymerge($img,$img_1,($largo_fondo - $largo_1)/2,130,0,0,$largo_1,$ancho_1,100);
imagestring($img, 4,190, $ancho_1 + 130 +20, utf8_decode($pagina['titulo']), 0xFFBA00);

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