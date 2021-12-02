<?php
print "<?xml version='1.0' encoding='ISO-8859-1' ?>";

//print_r($ofertas);
//print_r($noticias);exit;
$length_textos_descriptivos = 380;
$final_textos = '...';


print '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">';

print '<channel>\n';
print '<title>'.trans('seo_title_rss').'</title>';
print '<link>'.base_url().'</link>';
print '<description>'.trans('seo_description_rss').'</description>';
print '<language>'.CODIGO_IDIOMA.'</language>';
print '<copyright>'.trans('hotel_nacional_cuba').'</copyright>\n';

//if (count($noticias)) {
//    foreach ($noticias as $n) {
//
//		$noticia_traducida = app_traduccion('frontend','frontend_noticia_idioma',NULL,'noticia_fk',$n['id'],$n);
//		$nombre_noticia = utf8_decode($noticia_traducida['titulo']);
//		print "<item>\n";
//		print "<title>";
//		print $nombre_noticia;
//		print "</title>\n";
//		print "<description>";
//		$descripcion = app_strip_etiquetas(utf8_decode($noticia_traducida['texto']));
//		print str_replace("<br>", "\n", $descripcion);
//		print "</description>\n";
//		print "<link>";
//			print base_url(trans('ruta_noticia',array('titulo'=>url_title($nombre_noticia),'id'=>$n['idnoticia'])));
//		print "</link>\n";
//
//		print "</item>\n";
//
//    }
//}
if (count($ofertas)) {
    foreach ($ofertas as $o) {      
		$oferta_traducido = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$o['id'],$o);
		$nombre_oferta = utf8_decode(trans('of_oferta_nombre',array('nombre'=>$oferta_traducido['nombre'])));
		print "<item>\n";
		print "<title>";
		print $nombre_oferta;
		print "</title>\n";
		print "<description>";
		$descripcion = word_limiter(app_strip_etiquetas(utf8_decode($oferta_traducido['descripcion'])),10);
		
		print str_replace("<br>", "\n", $descripcion);
		print "</description>\n";
		print "<link>";
			print base_url(trans('ruta_oferta',array('nombre'=>url_title($nombre_oferta),'id'=>$o['idoferta'])));
		print "</link>\n";

		print "</item>\n";
        
    }
}



print  '</channel>';
print '</rss>';
?>
