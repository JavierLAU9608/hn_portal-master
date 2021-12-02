<?php
/*
Desarrollado por <alexturruella@gmail.com> Alexis José Turruella Sánchez
Sistema: HOTEL NACIONAL DE CUBA
*/
$tamano_letra = 10;
$tamano_letra_footer = 8;
$columna_1 = 35;
$columna_2 = 230;
$columna_3 = 430;

$anchoParrafo = 560;

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");

$this->ezpdf->setStrokeColor(0.7, 0.7, 0.8);//color GRIS

$this->ezpdf->addJpegFromFile("web/img/logo_HotelNaional.jpg", 35, 765, 80, 50);
$this->ezpdf->addJpegFromFile("web/img/logo_GranCaribe.jpg", 490, 765, 70, 50);

$this->ezpdf->setStrokeColor(0.7, 0.7, 0.8);//color GRIS

$fila = 770;
$this->ezpdf->setColor(0.2, 0.2, 0.2);
$this->ezpdf->addText(165, 775, 40, trans('voucher'), 0, 0);
$this->ezpdf->setColor(0, 0, 0);
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_numero')) . ' ' . app_relleno($datos_reserva['options']['id_reserva'], 4), 0, 0);

$fila -= 30;
$this->ezpdf->addText(370, $fila, $tamano_letra, utf8_decode(trans('vch_num_reserva')) . ' ' . $datos_reserva['options']['no_reserva'], 0, 0);

$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_fecha_emision')) . ' '.
    date('d/m/Y', strtotime($datos_reserva['options']['fecha_modificada'] == NULL ? $datos_reserva['options']['fecha_creada'] : $datos_reserva['options']['fecha_modificada'])), 0, 0);


$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_estimado'). $nombre_cliente), 0, 0);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$fila -= 20;
$text = utf8_decode(trans('vch_bienvenido'));
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, 8, $text);
    $fila -= 10;
}

$this->ezpdf->line($columna_1, $fila, 560, $fila);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_datos_cliente')), 0, 0);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_nombre').' ' . $nombre_cliente), 0, 0);
$fila -= 10;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_nacionalidad').' ' . $pais['nombre']), 0, 0);
$fila -= 10;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_telefono').' ' . $telefono), 0, 0);
$fila -= 10;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_email').' ' . $correo), 0, 0);

$fila -= 20;
$this->ezpdf->line($columna_1, $fila, 560, $fila);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_datos_reserva')), 0, 0);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$fila -= 20;
$datos_adicionales = 45;
foreach ($items as $item) {
    $this->ezpdf->addText($datos_adicionales, $fila, 8, utf8_decode($item), 0, 0);
    $fila -= 10;
    if ($datos_adicionales == 45)
        $datos_adicionales = 55;
}

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 15;
$this->ezpdf->addText($columna_3, $fila, $tamano_letra, utf8_decode(trans('vch_importe') . ' ' . app_rate_cambio($reserva['price'], 'ltr')), 0, 0);

$fila -= 10;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_observaciones')), 0, 0);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$fila -= 10;
if (isset($datos_reserva['options']['detalles'])) {
    $nota_reserva = utf8_decode($datos_reserva['options']['detalles']);
    while ($nota_reserva != '') {
        $nota_reserva = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, 7, $nota_reserva);
        $fila -= 10;
    }
}

$fila -= 15;
$this->ezpdf->line($columna_1, $fila, 560, $fila);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_datos_pago')), 0, 0);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$fila -= 20;
$text = utf8_decode(trans('vch_pagado_mediante'));
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_modalidad')).' ' . $text, 0, 0);
$fila -= 10;

/*$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_num_trans').' '  . $codigo), 0, 0);
$fila -= 10;*/

$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_num_op').' '  . $reserva['options']['id_reserva']), 0, 0);
$fila -= 10;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_ref_banco').' '  . $codigo), 0, 0);


if ($datos_reserva['options']['estado'] == 6){
    $fila -= 10;
    $this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_estado')), 0, 0);

    $this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
    $this->ezpdf->addText(112, $fila, $tamano_letra, utf8_decode(trans('vch_cancelado')), 0, 0);
    $this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
}

/*$fila -= 20;
$text = utf8_decode(trans('vch_info1').' ' . $pagado_a);
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}*/

$fila -= 20;
$text = utf8_decode(trans('vch_info2'));
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}

$fila -= 10;
$text = utf8_decode(trans('vch_info3'). ' '. $pagado_a);
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}


$fila -= 15;
$this->ezpdf->line($columna_1, $fila, 560, $fila);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_nota')), 0, 0);

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$fila -= 20;
$text = utf8_decode(trans('vch_info4'));
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}


$fila -= 15;
$this->ezpdf->line($columna_1, $fila, 560, $fila);
$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_politica_title')), 0, 0);

$fila -= 20;
$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$text = utf8_decode(trans('vch_politica_text'));
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_politica_ninnos_title')), 0, 0);

$fila -= 20;
$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$text = utf8_decode(trans('vch_politica_ninnos_text'));
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}

$this->ezpdf->line($columna_1, $fila, 560, $fila);
$this->ezpdf->newPage();

$fila = 770;

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");
$fila -= 20;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode('Hotel Nacional de Cuba'), 0, 0);
$fila -= 20;

$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica.afm");
$text = utf8_decode($direccion_empresa);
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_direccion').' ' . $text), 0, 0);
$fila -= 10;
$text = '';
foreach ($telefonos_empresa as $telefono) {
   $text .= $telefono['value'];
}
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_telefonos') .' ' . $text), 0, 0);
$fila -= 10;
$text = $email;
$this->ezpdf->addText($columna_1, $fila, $tamano_letra, utf8_decode(trans('vch_email') .' ' . $text), 0, 0);

$fila -= 50;
$text = utf8_decode(trans('vch_aviso_legal'));
while ($text != '') {
    $text = $this->ezpdf->addTextWrap($columna_1, $fila, $anchoParrafo, $tamano_letra, $text);
    $fila -= 10;
}

force_download('voucher(' . $datos_reserva['options']['no_reserva'] . ').pdf', $this->ezpdf->ezOutput());
?>