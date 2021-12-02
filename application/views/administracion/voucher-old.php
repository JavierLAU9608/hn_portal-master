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
$this->ezpdf->selectFont("application/libraries/pdf/fonts/Helvetica-Bold.afm");

$this->ezpdf->setStrokeColor(0.7,0.7,0.8);//color GRIS
if (defined('ENVIRONMENT') && ENVIRONMENT == 'production') {
	$this->ezpdf->addJpegFromFile("images/logo_HotelNaional.jpg",35 , 765 ,80,50);
	$this->ezpdf->addJpegFromFile("images/logo_GranCaribe.jpg",490,765,70,50);
}

$this->ezpdf->setStrokeColor(0.7,0.7,0.8);//color GRIS
$this->ezpdf->setLineStyle(2);

$this->ezpdf->line(140,815,140,765);
$this->ezpdf->line(470,815,470,765);
$this->ezpdf->line(140,815,470,815);
$this->ezpdf->line(140,765,470,765);
$this->ezpdf->setColor(0.2,0.2,0.2);
$this->ezpdf->addText(165,795,14,trans('voucher'),0,0);
$this->ezpdf->setColor(0,0,0);
$this->ezpdf->addText(165,780,$tamano_letra,utf8_decode(trans('vch_numero')).' '.app_relleno($datos_reserva['options']['id_reserva'],4),0,0);

$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText(350,795,$tamano_letra,utf8_decode(trans('vch_num_reserva')),0,0);
$this->ezpdf->setColor(0,0,0);
$this->ezpdf->addText(350,780,$tamano_letra,($datos_reserva['options']['no_reserva']),0,0);

$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText($columna_1,750,$tamano_letra ,utf8_decode(trans('vch_fecha_emision')),0,0);
$this->ezpdf->addText($columna_2 -80,750,$tamano_letra ,utf8_decode(trans('vch_confirmacion')),0,0);
$this->ezpdf->addText($columna_3 -150,750,$tamano_letra ,utf8_decode(trans('pagado_a')),0,0);
$this->ezpdf->addText($columna_3,750,$tamano_letra ,utf8_decode(trans('no_transaccion')),0,0);

$this->ezpdf->setColor(0,0,0);
$this->ezpdf->addText($columna_1,740,$tamano_letra ,date('d/m/Y',strtotime($datos_reserva['options']['fecha_modificada']==NULL?$datos_reserva['options']['fecha_creada']:$datos_reserva['options']['fecha_modificada'])),0,0);
$this->ezpdf->addText($columna_2 -80,740,$tamano_letra ,$datos_reserva['options']['numero_confirmacion'],0,0);
$this->ezpdf->addText($columna_3 -150,740,$tamano_letra ,$pagado_a,0,0);
$this->ezpdf->addText($columna_3,740,$tamano_letra ,$codigo,0,0);

$this->ezpdf->line($columna_1,730,560,730);

$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText($columna_1,715,$tamano_letra ,utf8_decode(trans('vch_servicio')),0,0);
$this->ezpdf->addText($columna_2,715,$tamano_letra ,utf8_decode(trans('vch_cliente')),0,0);
$this->ezpdf->addText($columna_3,715,$tamano_letra ,utf8_decode(trans('vch_nacionalidad')),0,0);

$this->ezpdf->setColor(0,0,0);
$this->ezpdf->addText($columna_1,700,$tamano_letra ,utf8_decode(trans($servicio)),0,0);
$this->ezpdf->addText($columna_2,700,$tamano_letra ,utf8_decode($nombre_cliente),0,0);
$this->ezpdf->addText($columna_3,700,$tamano_letra ,utf8_decode($pais['nombre']),0,0);

$this->ezpdf->setLineStyle(4);
$this->ezpdf->line($columna_1,695,560,695);

$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText($columna_1,680,$tamano_letra ,utf8_decode(trans('vch_servicios')),0,0);

$this->ezpdf->setColor(0,0,0);
$this->ezpdf->y=670;
$datos_adicionales = 45;
foreach($items as $item)
{
	$this->ezpdf->addText($datos_adicionales,$this->ezpdf->y,8,utf8_decode($item),0,0);
	$this->ezpdf->y-=10;
	if($datos_adicionales == 45)
		$datos_adicionales = 55;
}
$this->ezpdf->y-=20;
$this->ezpdf->line($columna_1,($this->ezpdf->y),560,($this->ezpdf->y));

$this->ezpdf->y-=15;
$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText($columna_3,$this->ezpdf->y,$tamano_letra ,utf8_decode(trans('vch_importe')),0,0);
$this->ezpdf->setColor(0,0,0);
$this->ezpdf->addText($columna_3 + 50,$this->ezpdf->y,$tamano_letra ,app_rate_cambio($reserva['price'],'ltr'),0,0);

$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText($columna_1,$this->ezpdf->y,$tamano_letra ,utf8_decode(trans('vch_observaciones')),0,0);
$this->ezpdf->y-=10;
$this->ezpdf->setColor(0,0,0);

if(isset($datos_reserva['options']['detalles']))
{
	$nota_reserva=utf8_decode($datos_reserva['options']['detalles']);
	while($nota_reserva!='')
	{
		$nota_reserva=$this->ezpdf->addTextWrap($columna_1,$this->ezpdf->y,300,7,$nota_reserva);
		$this->ezpdf->y-=10;
	}
}

$this->ezpdf->y-=50;
$this->ezpdf->setStrokeColor(0.7,0.7,0.8);//color GRIS
$this->ezpdf->setLineStyle(2);
$this->ezpdf->line($columna_1,$this->ezpdf->y,560,$this->ezpdf->y);

$this->ezpdf->y-=10;
$this->ezpdf->setColor(0.2,0.3,0.6);
$this->ezpdf->addText($columna_1,$this->ezpdf->y,$tamano_letra_footer,utf8_decode(trans('vch_url_records')),0,0);

$this->ezpdf->y-=10;
$this->ezpdf->setColor(0,0,0);
$this->ezpdf->addText($columna_1,$this->ezpdf->y,$tamano_letra_footer,utf8_decode(base_url('login-page').'/cuenta/historial'),0,0);


$this->ezpdf->y-=20;
$this->ezpdf->setStrokeColor(0.7,0.7,0.8);//color GRIS
$this->ezpdf->setLineStyle(3);

$this->ezpdf->line($columna_1,$this->ezpdf->y,560,$this->ezpdf->y);
$this->ezpdf->setColor(0.2,0.3,0.6);

$y_aux=$this->ezpdf->y;
$y_aux-=10;
$this->ezpdf->setColor(0.7,0.7,0.8);
$this->ezpdf->addText($columna_1,$y_aux,$tamano_letra_footer,utf8_decode(trans('vch_direccion')),0,0);
$this->ezpdf->addText($columna_2,$y_aux,$tamano_letra_footer,utf8_decode(trans('vch_telefonos')),0,0);
$this->ezpdf->addText($columna_3,$y_aux,$tamano_letra_footer,utf8_decode(trans('vch_email')),0,0);

$y_aux-=10;
$y_aux1=$y_aux;
$this->ezpdf->setColor(0.2,0.3,0.6);
$direccion_empresa=utf8_decode($direccion_empresa);
while($direccion_empresa!='')
{
	$direccion_empresa=$this->ezpdf->addTextWrap($columna_1,$y_aux,150,$tamano_letra_footer,$direccion_empresa);
	$y_aux-=8;
}

$this->ezpdf->addText($columna_3,$y_aux1,$tamano_letra_footer,$email,0,0);

foreach($telefonos_empresa as $telefono)
{
	$this->ezpdf->addText($columna_2,$y_aux1,$tamano_letra_footer,$telefono['value'],0,0);
	$y_aux1-=8;
}
force_download('voucher('.$datos_reserva['options']['no_reserva'].').pdf', $this->ezpdf->ezOutput());
?>