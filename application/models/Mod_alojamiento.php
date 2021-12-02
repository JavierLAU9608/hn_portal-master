<?php
class Mod_alojamiento extends CI_Model
{
	private $cupos_dias = array();
	private $paros = false;

    private $precio_por_oferta = false;
    private $info_oferta = [];
    private $precio_original = 0;

    function __construct()
	{
		parent::__construct();
	}
	function get_hotel($criterio = array())
	{
		if(!isset($criterio['id']))
			$criterio['id'] = $this->id_hotel_current;
		$hotel = $this->db->get_where('hotel.hotel_hotel',$criterio)->row_array();	
		if($hotel)
		{
			$hotel['habitaciones'] = $this->get_alojamientos(NULL,NULL,'f');			
			$hotel['plan_alojamiento'] = $this->get_planes_alojamiento($hotel['id']);
			$hotel['paros_venta'] = $this->get_paros_venta($hotel['id']);
			$hotel['paquetes_luna_miel'] = $this->get_paquetes_luna_miel();
			$hotel['fecha_maxima'] = $this->_get_fecha_maxima_contrato();
			$hotel['fecha_minima'] = $this->_get_fecha_minima($hotel);
			$hotel['habitaciones_reserva'] = $this->_get_habitaciones_para_reserva($hotel);
			return $hotel;
		}
		return false;
	}
	function get_planes_alojamiento($id_hotel = NULL)
	{
		if($id_hotel == NULL)
			$id_hotel = $this->id_hotel_current;
		$this->db->join('hotel.hotel_plan_de_alimentacion_hotel',' hotel.hotel_plan_de_alimentacion.id = hotel.hotel_plan_de_alimentacion_hotel.plan_fk');
		return $this->db->get_where('hotel.hotel_plan_de_alimentacion',array("hotel_fk"=>$id_hotel))->result_array();
	}
	public function get_paros_venta($id = NULL)
	{
		if (false === $this->paros) {
			if($id == NULL)
				$id = $this->id_hotel_current;
			$fecha_actual=date("Y/m/d",strtotime('now'));
			$this->db->select('*');
			$this->db->from('hotel.hotel_paro');
			$this->db->where('hotel.hotel_paro.hotel_fk', $id);
			$this->db->where('hotel.hotel_paro.fecha_fin >=',$fecha_actual);

			$this->paros = $this->db->get()->result_array();
		}

		return $this->paros;
	}
	public function get_paquetes_luna_miel()
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('hotel.hotel_pack_luna.id, hotel.hotel_pack_luna.nombre,' .
			'hotel.hotel_pack_luna.descripcion,hotel.hotel_pack_luna.precio, hotel.hotel_pack_luna.disponible, ' .
			'hpi.nombre as nombre_trad, hpi.descripcion as descripcion_trad');

		$this->db->join('hotel.hotel_pack_idioma hpi', 'hotel.hotel_pack_luna.id = hpi.pack_fk AND hpi.idioma_fk = '.$idioma_id, 'LEFT OUTER');

		$paquetes = $this->db->get_where('hotel.hotel_pack_luna',array("disponible"=>'t'))->result_array();

		foreach ($paquetes as &$paquete) {
			if (isset($paquete['nombre_trad'])) {
				$paquete['nombre'] =  $paquete['nombre_trad'];
				unset ($paquete['nombre_trad']);
			}
			if (isset($paquete['descripcion_trad'])) {
				$paquete['descripcion'] =  $paquete['descripcion_trad'];
				unset ($paquete['descripcion_trad']);
			}
		}

		return $paquetes;
	}
	public function get_paquete_luna_miel($id)
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('hotel.hotel_pack_luna.id, hotel.hotel_pack_luna.nombre,' .
			'hotel.hotel_pack_luna.descripcion,hotel.hotel_pack_luna.precio, hotel.hotel_pack_luna.disponible, ' .
			'hpi.nombre as nombre_trad, hpi.descripcion as descripcion_trad');

		$this->db->join('hotel.hotel_pack_idioma hpi', 'hotel.hotel_pack_luna.id = hpi.pack_fk AND hpi.idioma_fk = '.$idioma_id, 'LEFT OUTER');

		$paquete = $this->db->get_where('hotel.hotel_pack_luna',array("hotel.hotel_pack_luna.id"=>$id))->row_array();

		if (isset($paquete['nombre_trad'])) {
			$paquete['nombre'] =  $paquete['nombre_trad'];
			unset ($paquete['nombre_trad']);
		}
		if (isset($paquete['descripcion_trad'])) {
			$paquete['descripcion'] =  $paquete['descripcion_trad'];
			unset ($paquete['descripcion_trad']);
		}

		return $paquete;
	}
		/*
	Conocer la fehca máxima del contrato del hotel
	@param $id_hot -> id del hotel
	return date(fecha_fin_contrato)
	*/
	private function _get_fecha_maxima_contrato($id_hotel=NULL)
	{
		if($id_hotel == NULL)
			$id_hotel = $this->id_hotel_current;
		$this->db->select('max(hotel.hotel_temporada.fecha_fin) as fecha_maxima');
        $this->db->from('hotel.hotel_politica');
		$this->db->join('hotel.hotel_temporada', 'hotel.hotel_politica.temporada_fk=hotel.hotel_temporada.id', 'INNER');
	    $this->db->where('hotel.hotel_politica.hotel_fk',$id_hotel);
	    $resultado=$this->db->get()->row();
	    return $resultado->fecha_maxima;
	}
	private function _get_fecha_minima($hotel)
	{
		$fecha_inicio_reserva=app_dateadd(app_now(),$hotel['release']);			
		//si esta en un paro de venta incrementar un dia y comprobar
		while($this->_existe_paro_venta($fecha_inicio_reserva,$hotel['id'])==true)
		{
			$fecha_inicio_reserva=app_dateadd($fecha_inicio_reserva,1);
		}
		return $fecha_inicio_reserva;
	}
	private function _get_habitaciones_para_reserva($hotel)
	{
		$this->db->select('hotel.hotel_tipo_de_habitacion.id, hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk,hotel.hotel_tipo_de_habitacion.nombre_habitacion,hotel.hotel_ocupacion_habitacion_hotel.disponible,hotel.hotel_ocupacion_habitacion_hotel.cantidad_adulto,hotel.hotel_temporada.fecha_inicio,hotel_ocupacion_habitacion_hotel.cantidad_pax,hotel_ocupacion_habitacion_hotel.ninno_adicional ',false);
                
        $this->db->from('hotel.hotel_politica');
		$this->db->join('hotel.hotel_temporada', 'hotel.hotel_politica.temporada_fk=hotel.hotel_temporada.id', 'INNER');
		$this->db->join('hotel.hotel_tipo_de_habitacion', 'hotel.hotel_politica.tipo_habitacion_fk=hotel.hotel_tipo_de_habitacion.id', 'INNER');
		$this->db->join('hotel.hotel_ocupacion_habitacion_hotel', 'hotel.hotel_politica.tipo_habitacion_fk=hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk', 'INNER');
		$this->db->join('hotel.hotel_hotel', 'hotel.hotel_ocupacion_habitacion_hotel.hotel_fk=hotel.hotel_hotel.id AND hotel.hotel_politica.hotel_fk=hotel.hotel_hotel.id', 'INNER');
		
		$this->db->where('hotel.hotel_hotel.id = '.$hotel['id'].' AND hotel.hotel_politica.precio_adulto <> 0 AND \''.$hotel['fecha_minima'].'\' BETWEEN \''.$hotel['fecha_minima'].'\' AND hotel.hotel_temporada.fecha_fin AND hotel_ocupacion_habitacion_hotel.disponible=\'t\'', NULL, FALSE);
		
		$this->db->order_by('hotel.hotel_temporada.fecha_inicio ASC');
		$this->db->order_by('hotel.hotel_politica.precio_adulto ASC');		
              
		$resultado = $this->db->get()->result_array();
		$existentes=array();
		$resultado_correcto=array();
		
		foreach($resultado as $r)
		{
			if(array_key_exists($r['id'],$existentes)==false)
			{				
				$resultado_correcto[]=$r;
				$existentes[$r['id']]=$r['id'];
			}
		}
		return $resultado_correcto;
	}
	public function get_precio_habitacion($tipo_habitacion,$fecha,$noches,$plan,$paxs,$ninno_adicional,$paquete_luna_miel)
	{
		$tmp_f = explode('-', $fecha);
		$fechaInicio = mktime(0,0,0, $tmp_f[1], $tmp_f[2], $tmp_f[0]);
		 
		$fechaFin = mktime(0,0,0, $tmp_f[1], $tmp_f[2], $tmp_f[0]) + ($noches==0?1:$noches) * 24 * 60 * 60; 

		$data = array();
		$suplementos_todos=array();
		$detalles_precio=array('ok'=>'f','precio'=>0,'suplementos'=>array());

		$precio_dia1 = 0;

		//aqui se pone menor igual si se cuenta la cantidad de dias, pero debe ser la noche
		for($i = $fechaInicio; $i < $fechaFin; $i += 86400)
		{
			//PRECIO POR DIA Y RETORNAR ERROR SI HAY PARO VENTA, NO POLITICA
			$dia = date( 'Y-m-d',mktime(0, 0, 0, date("m", $i), date("d", $i), date("Y", $i)));			
			if($this->_existe_paro_venta($dia) == false)
			{
				if($precio = $this->_get_precio_habitacion_dia($tipo_habitacion,$dia,$plan,$paxs,$ninno_adicional))
				{
					$detalles_precio['precio'] += $precio;
					if ($precio_dia1 == 0) {
						$precio_dia1 = $precio;
					}
				}
				else
				{
					return array('ok'=>'f','msg'=>'al_error_no_politica');
				}
			}
			else
				return array('ok'=>'f','msg'=>'al_error_paro_venta');
			//SUPLEMENTO DIARIO POR PAX	
			if($suplementos = $this->_get_suplementos($dia,$plan))
			{
				$paxs += $ninno_adicional?1:0;
				foreach($suplementos as $s)
				{
					$detalles_precio['precio'] += $s['precio']*$paxs;
					$detalles_precio['suplementos'][$s['id']] = $s;
				}
			}					
		}
		if($detalles_precio['precio'] > 0)
		{
            $detalles_precio['precio_original'] = $this->precio_original != 0 ? ($this->precio_original * $noches):  $detalles_precio['precio'];

			//$detalles_precio['precio_original'] = $detalles_precio['precio'];

            $detalles_precio['precio'] = $this->aplicar_nueva_oferta($detalles_precio['precio'], $tipo_habitacion, $fecha, $noches, $precio_dia1);

			//LUNA MIEL
			if($paquete_luna_miel>0)
			{
				if($paquete = $this->get_paquete_luna_miel($paquete_luna_miel))
				{
					$detalles_precio['precio'] += $paquete['precio'];
				}
			}
			//DESCUENTo CLIENTE
			$descuento_cliente = app_descuento_tipo_cliente('alojamiento');
			if($descuento_cliente)
				$detalles_precio['precio'] = app_aplicar_descuento($detalles_precio['precio'],$descuento_cliente);


			// B2B
			list($descuento_producto, $pre, $post) = app_descuento_tipo_producto('Hotel', $tipo_habitacion, $plan, $fecha);
			if ($descuento_producto) {
				$temp = explode('-', $paxs);
				$adultos = $temp[0];
				$ninnos = isset($temp[1]) ? $temp[1]: 0;

				$detalles_precio['precio'] -= ((int) $adultos * $pre) - ((int) $ninnos * $pre/2) ;
				$detalles_precio['precio'] = app_aplicar_descuento($detalles_precio['precio'], $descuento_producto);
				$detalles_precio['precio'] += ((int) $adultos * $post) + ((int) $ninnos * $post/2) ;
			}

			$detalles_precio['ok'] = 't';

            $detalles_precio['desglose_oferta'] = $this->info_oferta;

			return $detalles_precio;
		}
		else
			return array('ok'=>'f','msg'=>'al_error_no_politica');		
		
	}

    private function aplicar_nueva_oferta($precio, $tipo_habitacion, $fecha, $noches, $precio_dia1)
    {
        $id_hotel = $this->id_hotel_current;

        $today = date("Y-m-d", strtotime("now"));
        $this->db->select('*');
        $this->db->from('hotel.hotel_oferta_habitacion');

        $wh = " (hotel.hotel_oferta_habitacion.hotel_fk = '" . $id_hotel . "')";
        $wh .= " AND (hotel.hotel_oferta_habitacion.tipo_habitacion_fk = '" . $tipo_habitacion . "')";
        $wh .= " AND ('" . $today . "' BETWEEN  hotel.hotel_oferta_habitacion.fecha_inicio_comercial AND hotel.hotel_oferta_habitacion.fecha_fin_comercial)";
        $wh .= " AND ('" . $fecha . "' BETWEEN hotel.hotel_oferta_habitacion.fecha_aplicacion AND hotel.hotel_oferta_habitacion.fecha_fin_aplicacion)";

        $wh .= "AND (hotel.hotel_oferta_habitacion.oferta_dias_descuento = true)";
        $wh .= "AND (hotel.hotel_oferta_habitacion.dias_desde <=" . $noches . ")";

        $this->db->where($wh, null, false);

        if ($oferta = $this->db->get()->row_array()) {
            if ($oferta['descontar_cantidad_dias'] == 't') {
                $cant_descuentos =  floor($noches / $oferta['dias_desde']);

                $precio = $precio - ($precio_dia1*$cant_descuentos);
            } else {
                $precio = $precio - ($precio_dia1*$oferta['dias_descuento']);
            }

        }

        return $precio;
    }


    private function _get_precio_habitacion_dia($tipo_habitacion,$fecha,$plan,$paxs,$ninno_adicional)
	{
        $politica = $this->_get_politica_habitacion($tipo_habitacion, $plan, $fecha, null, $paxs);

        if ($politica) {
            $this->precio_original = $politica['precio_adulto'];
        }

		//preguntar si hay oferta y calcular el precio para oferta
		if($oferta = $this->_get_oferta_habitacion($tipo_habitacion,$fecha))
		{
            $this->info_oferta[] = ['fecha' => $fecha, 'tipo_habitacion' => $tipo_habitacion, 'oferta_id' => $oferta['id'], 'desc' => $oferta['descripcion'], 'titulo' => $oferta['titulo'], 'precio' => $oferta['precio']];
            $this->precio_por_oferta = true;
			$precio = $oferta['precio'];
			if($ninno_adicional)
				$precio += $oferta['precio_ninno_adicional'];

            if ($oferta['precio_porciento'] === 't') {
                if ($politica) {
                    $nuevo_precio = $politica['precio_adulto'];
                    if ($ninno_adicional) {
                        $nuevo_precio += $politica['precio_nino'];
                    }

                    // precio con descuento en %
                    $nuevo_precio = $nuevo_precio -($nuevo_precio * $precio / 100);

                    return $nuevo_precio;
                }
            }

			return $precio;
		} elseif ($politica) {
			//si no hay oferta preguntar si hay temporada y calcular el precio para la temporada
			$precio = $politica['precio_adulto'];
			if($ninno_adicional)
				$precio += $politica['precio_nino'];
			return $precio;
		}
		return false;
	}
	/*
	Conocer si para una fecha especifica el hotel esta en paro de venta
	@param $id_hot -> Id del hotel
	@param $fecha  -> Fecha que se desa concoer si existe para de venta en el hotel
	*/
	private function _existe_paro_venta($fecha,$id_hotel = NULL)
	{
		if($id_hotel == NULL)
			$id_hotel = $this->id_hotel_current;
		$this->db->select('*');
		$this->db->from('hotel.hotel_paro');
		$this->db->where('hotel.hotel_paro.hotel_fk', $id_hotel);
		$wh=" ('".$fecha."' BETWEEN hotel.hotel_paro.fecha_inicio AND hotel.hotel_paro.fecha_fin)";
		$this->db->where($wh,null,false);
        if($this->db->get()->num_rows()>0)
		 return true;
		return false;
	}
	/*
	Obener la politica de una habitacion de un hotel
	@param $id_hotel -> Id del hotel
	@param $id_hab   -> Id de la habitacion
	@param $id_plan  -> Id del plan de alimentación
	@param $id_tem   -> Id de la temporada
	@param $fecha    -> Fecha
	return array
	*/
	private function _get_politica_habitacion($tipo_habitacion,$plan,$fecha,$id_hotel = NULL, $paxs = null)
	{
		$query = '';
		if ($paxs != null) {
			//1-1
			$temp    = explode('-', $paxs);
			$adultos = $temp[0];
			$ninos   = isset($temp[1]) ? $temp[1] : 0;
			$query   = ' AND (hotel.hotel_politica.cantidad_maxima_ninos = ' . $ninos . ') AND (hotel.hotel_politica.cantidad_maxima_adulto = ' . $adultos . ')';
		}

		if ($id_hotel == null) {
			$id_hotel = $this->id_hotel_current;
		}
		$sel = 'hotel.hotel_politica.id,
				  hotel.hotel_politica.precio_adulto,
				  hotel.hotel_politica.precio_nino,
				  hotel.hotel_politica.plan_fk,
				  hotel.hotel_politica.temporada_fk,
				  hotel.hotel_politica.hotel_fk,
				  hotel.hotel_politica.tipo_habitacion_fk
			  ';

		$this->db->select($sel);
		$this->db->from('hotel.hotel_politica');
		$this->db->join('hotel.hotel_temporada', 'hotel.hotel_politica.temporada_fk=hotel.hotel_temporada.id', 'INNER');
		$this->db->join('hotel.hotel_ocupacion_habitacion_hotel',
			'hotel.hotel_politica.tipo_habitacion_fk=hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk AND hotel.hotel_ocupacion_habitacion_hotel.hotel_fk=hotel.hotel_politica.hotel_fk',
			'INNER'
		);

		$wh = '(hotel.hotel_politica.tipo_habitacion_fk = ' . $tipo_habitacion . ') AND
			  (hotel.hotel_politica.hotel_fk = ' . $id_hotel . ') AND ';

		if ($plan) {
		    $wh .='(hotel.hotel_politica.plan_fk = ' . $plan . ') AND ';
        }

        $wh .= '(\'' . $fecha . '\' BETWEEN hotel.hotel_temporada.fecha_inicio AND hotel.hotel_temporada.fecha_fin)' . $query;

		$this->db->where($wh, null, false);

		return $this->db->get()->row_array();
	}
	public function _get_oferta_habitacion($tipo_habitacion,$fecha,$id_hotel = NULL)
	{
		if($id_hotel == NULL)
			$id_hotel = $this->id_hotel_current;
		$today=date("Y-m-d",strtotime("now"));
		$this->db->select('*');
		$this->db->from('hotel.hotel_oferta_habitacion');

		$wh = " (hotel.hotel_oferta_habitacion.hotel_fk = '".$id_hotel."')";
		$wh.= " AND (hotel.hotel_oferta_habitacion.tipo_habitacion_fk = '".$tipo_habitacion."')";
		$wh.= " AND ('".$today."' BETWEEN  hotel.hotel_oferta_habitacion.fecha_inicio_comercial AND hotel.hotel_oferta_habitacion.fecha_fin_comercial)";		
		$wh.= " AND ('".$fecha."' BETWEEN hotel.hotel_oferta_habitacion.fecha_aplicacion AND hotel.hotel_oferta_habitacion.fecha_fin_aplicacion)";
		 
		$this->db->where($wh, null, false);
        $ofertas = $this->db->get()->result_array();

		return  $this->getOfertaMenorPrecio($ofertas);
	}

	private function getOfertaMenorPrecio($ofertas)
    {
        if ($ofertas == null) {
            return null;
        }

        $ofertaMin = $ofertas[0];
        foreach ($ofertas as $oferta) {
            if ($oferta['precio'] < $ofertaMin['precio']) {
                $ofertaMin = $oferta;
            }
        }

        return $ofertaMin;
    }
		/*
	Obtener los suplementos de un hotel en una fecha determinada
	Retornara un arreglo con los suplementos que contienen la fecha pasada por parametro
	@param $id_hot -> id del hotel
	@param $fecha  -> Fecha en la que se quiere conocer los suplemtos que tiene el hotel
	@param $id_plan-> Id del plan de alimentacion
	*/
	private function _get_suplementos($fecha,$plan,$id_hotel = NULL)
	{
		if($id_hotel == NULL)
			$id_hotel = $this->id_hotel_current;
		$this->db->select('*');
		$this->db->from('hotel.hotel_suplemento');

		$wh = " (hotel.hotel_suplemento.hotel_fk = '".$id_hotel."')";
		$wh.= " AND (hotel.hotel_suplemento.plan_fk = ".$plan.")";
		$wh.= " AND ('".$fecha."' BETWEEN hotel.hotel_suplemento.fecha_inicio AND hotel.hotel_suplemento.fecha_fin)";
		$this->db->where($wh, null, false);

		return $this->db->get()->result_array();
	}
	function get_alojamientos($items_pagina = NULL,$inicio = NULL,$ejecutivo = null)
	{		
		$this->db->select('*,hotel.hotel_ocupacion_habitacion_hotel.id as id_ocupacion');
		$this->db->order_by('hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk','ASC');			
		$this->db->join('hotel.hotel_ocupacion_habitacion_hotel',' hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk = hotel.hotel_tipo_de_habitacion.id ');
		$where = array("hotel.hotel_ocupacion_habitacion_hotel.disponible"=>'t');

		if ($ejecutivo) {
			$where["hotel.hotel_tipo_de_habitacion.tipo_ejecutivo"]=$ejecutivo;
		}

		return $this->db->get_where('hotel.hotel_tipo_de_habitacion',$where,$items_pagina,$inicio)->result_array();
	}
	function get_total_habitaciones($criterio = array())
	{
		$this->db->select('count(*) as total');
		$this->db->from('hotel.hotel_ocupacion_habitacion_hotel');
		$this->db->join('hotel.hotel_tipo_de_habitacion',' hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk = hotel.hotel_tipo_de_habitacion.id');
		$this->db->where('tipo_ejecutivo',$criterio['tipo_ejecutivo']);
		$this->db->where('hotel_fk',$criterio['hotel_fk']);
		return $this->db->get()->row()->total;
	}
	function get_tipo_alojamiento($id_hab)
	{			
		$this->db->join('hotel.hotel_tipo_de_habitacion','hotel.hotel_tipo_de_habitacion.id = hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk');
		return $this->db->get_where('hotel.hotel_ocupacion_habitacion_hotel',array("hotel.hotel_ocupacion_habitacion_hotel.id"=>$id_hab))->row_array();		
	}	
	function get_imagenes_alojamiento($id_tipo)
	{	
		$this->db->join('hotel.hotel_imagenes','hotel.hotel_imagenes.id = hotel.hotel_imagen_habitacion.imagen_fk');
		return $this->db->get_where('hotel.hotel_imagen_habitacion',array("hotel.hotel_imagen_habitacion.tipol_habitacionl_fk"=>$id_tipo))->result_array();
	}
	function get_facilidades_alojamiento($id_tipo,$id_hotel)
	{
        $idioma = app_idioma();

        $this->db->select('hotel.hotel_facilidad_habitacion.nombre, hotel.hotel_facilidad_h_idioma.nombre as nombre_trad');
        $this->db->join('hotel.hotel_facilidad_habitacion','hotel.hotel_facilidad_habitacion.id = hotel.hotel_facilidad_hotel_habitacion.facilidad_habitacion_fk');
        $this->db->join('hotel.hotel_facilidad_h_idioma','hotel_facilidad_h_idioma.facilidad_hab_fk = hotel.hotel_facilidad_habitacion.id AND hotel_facilidad_h_idioma.idioma_fk = '.$idioma['id'], 'LEFT OUTER');

		return $this->db->get_where('hotel.hotel_facilidad_hotel_habitacion',array("hotel.hotel_facilidad_hotel_habitacion.tipo_habitacion_fk"=>$id_tipo,"hotel.hotel_facilidad_hotel_habitacion.hotel_fk"=>$id_hotel))->result_array();
	}
	function get_precio_alojamiento($id_tipo)
	{
		$this->db->order_by('hotel.hotel_politica.precio_adulto','ASC');				
		$this->db->join('hotel.hotel_politica','hotel.hotel_temporada.id = hotel.hotel_politica.temporada_fk');		
		$this->db->where("'".date("Y-m-d")."' BETWEEN hotel.hotel_temporada.fecha_inicio AND hotel.hotel_temporada.fecha_fin",NULL, FALSE);
		return $this->db->get_where('hotel.hotel_temporada',array("hotel.hotel_politica.tipo_habitacion_fk"=>$id_tipo))->row_array();		
	}			
	function get_total_alojamientos()
	{
		return $this->db->count_all('hotel.hotel_ocupacion_habitacion_hotel');
	}
	function get_historicas()
	{			
		$habitaciones = $this->db->get_where('public.public_hab_personalidad',array())->result_array();
		foreach($habitaciones as &$h)
		{
			$this->db->join('public.public_hab_per','public.public_hab_per.personalidad_fk = frontend.frontend_personalidad.id');
			$h['personalidades_asociadas'] = $this->db->get_where('frontend.frontend_personalidad',array('habitacion_fk'=>$h['id']))->result_array();
		}
		return $habitaciones;		
	}
	public function _get_tipo_habitacion($id)
	{
		return $this->db->get_where('hotel.hotel_tipo_de_habitacion',array("id"=>$id))->row_array();
	}
	public function _get_plan_alimentacion($id)
	{
		return $this->db->get_where('hotel.hotel_plan_de_alimentacion',array("id"=>$id))->row_array();
	}
	public function voucher($producto, $show_oferts = false)
	{
		$lineas = array();
		$lineas[] = trans('al_habitaciones').': ';
		$offertas_mostradas = [];
		foreach($producto['options']['habitaciones'] as $h)
		{
			$datos_habitacion = $this->_get_tipo_habitacion($h['tipo_habitacion']);
			$nombre_habitacion = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$datos_habitacion['id'],$datos_habitacion['nombre_habitacion']);
			$plan_alimentacion = $this->_get_plan_alimentacion($h['plan']);	
			$nombre_plan = app_traduccion('hotel','hotel_plan_idioma','nombre','plan_fk',$plan_alimentacion['id'],$plan_alimentacion['nombre_plan']);
			$lineas[] = $nombre_habitacion;

			$nuevo_pax = $h['nuevo_paxs'];
			if ($nuevo_pax) { // este es nuevo en la BD
				$temp = explode('-', $nuevo_pax);
				$a = $temp[0];
				$ad = ($a > 1) ? $a . ' ' . trans('al_adultos') : $a . ' ' . trans('al_adulto');

				$ni = ' ';
				if (isset($temp[1]) && $temp[1] != 0) {
					$n = $temp[1];
					$ni .= ($n > 1) ? $n . ' ' . trans('al_ninos') : $n . ' ' . trans('al_nino');
				}
				$personas = $ad.$ni;
			} else {
				$personas = $h['paxs'];
			}

			$lineas[] = '  '.trans('al_fecha_entrada').' '.$h['fecha'].' | '.trans('al_hora_entrada').' '.$h['hora'].' | '.trans('al_noches').' '.$h['noches'].' | '.
				trans('al_pax').' '.$personas.' | '.trans('al_plan_alojamiento').' '.$nombre_plan;

			if ($h['responsable_nombre'])
            {
                $lineas[] = '  '. trans('responsable_hab_nombre'). ": " . $h['responsable_nombre']. '       '.
                    trans('responsable_hab_pasaporte').' :'.$h['responsable_pasaporte'];
            }
			if($h['paquete_luna_miel']>0)
			{
				$p_l = $this->get_paquete_luna_miel($h['paquete_luna_miel']);// ya viene traducido
				//$nombre_paquete = app_traduccion('hotel','hotel_pack_idioma','nombre','pack_fk',$p_l['id'],$p_l['nombre']);
				$lineas[] = '  '.trans('al_paquete_luna_miel').': '.$p_l['nombre'];
			}

			if (!$nuevo_pax) {
				if($h['ninno_adicional']!=='f' && $h['ninno_adicional'])
				{
					$lineas[] = '  '.trans('al_ninno_adicional');
				}
			}

		}

		if ($show_oferts) {
            foreach($producto['options']['habitaciones'] as $h)
            {
                $desglose = isset($h['detalles_reservacion']['desglose_oferta']) ? $h['detalles_reservacion']['desglose_oferta']: [];
                $lineas[] = '';
                if (count($desglose) > 0) {
                    $lineas[] = 'Ofertas aplicadas';//strtoupper(trans('al_ofertas'));

                    $pos = count($lineas) -1;
                    $flag = true;
                    foreach ($desglose as $item) {
                        $off = $item['fecha'] . '-'. $item['oferta_id'];

                        if (!in_array($off, $offertas_mostradas)) {
                            $lineas[] = '     '. $item['fecha'] . '   ' . $item['titulo'] . '   '.$item['desc'];
                            $offertas_mostradas[] = $off;
                            $flag = false;
                        }
                    }

                    if ($flag) {
                        $lineas[$pos] = '';
                    }
                }
            }
        }


		return $lineas;
	}

	  ///////////////////////////////////////////////////////////////
     /////////// MODIFICACIONES de RESERVA desde AQUI //////////////
	///////////////////////////////////////////////////////////////

	// agragr a los paros de venta los dias que no hay disponibilidad la
	// disponibilidad depende de los cupos y las reservaciones en estado_fk=4
	public function modifica_paros(&$datos, $tipo_habitacion, $fecha = null, $plan = null)
	{
		$fecha_ini = $datos['hotel']['fecha_minima'];
		$fecha_fin = $datos['hotel']['fecha_maxima'];

		// solo el mes en cuestión
		if ($fecha) {

			$obj_fecha = new DateTime($fecha, new DateTimeZone('America/Havana'));
			$first_day = $obj_fecha->format('Y-m-01');//primer día del mes
			$last_day = $obj_fecha->format('Y-m-t');//último día del mes

//			if ($last_day < $fecha_fin) {
//				$datos['hotel']['fecha_maxima'] = $last_day;
//				$fecha_fin = $last_day;
//			}
//
//			if ($fecha_ini < $first_day) {
//				// fecha minima es el primer dia del mes
//				$fecha_ini = $first_day;
//				$datos['hotel']['fecha_minima'] = $first_day;
//			}

			$fecha_fin = $last_day;
			$fecha_ini = $first_day;
		}

		$f_ini = $this->date_to_ts($fecha_ini);
		$f_fin = $this->date_to_ts($fecha_fin)+86399;

		$minimo_noches = $datos['hotel']['minimo_de_noches'];

		$f_current = $f_ini;
		$paros     = $datos['hotel']['paros_venta'];

		// determinar disponibilidad B2B en caso de no existir agregar a los paros de venta
		$user_registrado = $this->session->userdata('usuario_registrado');
		if($user_registrado)
		{
			$id_tipo_cliente = $user_registrado['id_tipo_cliente'];

			$this->db->select('*');
			$this->db->from('frontend.frontend_cliente_producto');
			$this->db->where('frontend.frontend_cliente_producto.descuento_fk', $id_tipo_cliente);
			$this->db->where('frontend.frontend_cliente_producto.tipo_habitacion_fk', $tipo_habitacion);
			if ($plan) {
				$this->db->where('frontend.frontend_cliente_producto.plan_fk', $plan);
			}

			$limites = $this->db->get()->result_array();
			foreach ($limites as $l) {
				$cupos = $l['cupos'];
				$fecha_ini = $l['fecha_cupo_inicio'];
				$fecha_fin = $l['fecha_cupo_fin'];

				if ($l['cupos_dias'] == 't') {
					//obtener cantidad de reservas de cada día
					$fecha_obj_temp = new DateTime($fecha_ini, new DateTimeZone('America/Havana'));
					$f_ini_temp = $fecha_obj_temp->format('Y-m-d');
					while ($f_ini_temp <= $fecha_fin) {
						$pagadas = $this->get_reservas_confirmadas($user_registrado['id'], $f_ini_temp);
						if ($pagadas >= $cupos) {
							$paros[] = array('fecha_inicio' => $f_ini_temp, 'fecha_fin' => $f_ini_temp, 'hotel_fk' => 78, 'tipo_paro' => 'falta de cupo B2B');
						}
						$fecha_obj_temp->add(new DateInterval('P1D'));
						$f_ini_temp = $fecha_obj_temp->format('Y-m-d');
					}
					// si >= agregar a los paros
				} else {
					$pagadas = $this->get_reservas_confirmadas($user_registrado['id'], $fecha_ini, $fecha_fin);

					if ($pagadas >= $cupos) {
						// agregar rango de fecha a los paros
						$paros[] = array('fecha_inicio' => $fecha_ini, 'fecha_fin' => $fecha_fin, 'hotel_fk' => 78, 'tipo_paro' => 'falta de cupo B2B');
					}
				}
			}
		}

		while ($f_current <= $f_fin) {

			$f = $this->ts_to_date($f_current);
			$f_current += 86400; // next day

			if (! $this->_existe_disponibilidad($tipo_habitacion, $f, $paros)) {
				// agregar al paro de venta
				if (! $this->ya_esta_en_paro($paros, $f)) {
					$paros[] = array(
						'fecha_fin'    => $f,
						'fecha_inicio' => $f,
						'hotel_fk'     => 78,
						'tipo_paro'    => 'por solapamiento'
					);
				}

				// evitar solapamiento en reservas hacia atras deshabilitando los dias que no cumplen con el
				// mínimo de noches (si el mínimo es 1 se deja como está)
				for ($i = 2; $i <= $minimo_noches; $i++) {
					$curr   = $f_current - (86400 * $i);
					$f_temp = $this->ts_to_date($curr);
					if (! $this->ya_esta_en_paro($paros, $f_temp)) {
						$paros[] = array(
							'fecha_fin'    => $f_temp,
							'fecha_inicio' => $f_temp,
							'hotel_fk'     => 78,
							'tipo_paro'    => 'por disponibilidad'
						);
					}
				}
			} else {
			    // ver si hay precio
                $politica = $this->_get_politica_habitacion($tipo_habitacion, $plan, $f);
                if (! $politica) {
                    $paros[] = array(
                        'fecha_fin'    => $f,
                        'fecha_inicio' => $f,
                        'hotel_fk'     => 78,
                        'tipo_paro'    => 'por falta de precio'
                    );
                }
            }
		}

		$paros  = $this->ordena_paros($paros);
		$datos['hotel']['paros_venta'] = $paros;

		if ($temp = $this->get_min_day($datos)) {
			$datos['hotel']['fecha_minima'] = $temp;
		}
		$datos['hotel']['min_active_day']  = $temp;

		return true;
	}

	public function get_reservas_confirmadas($id_usuario, $f1, $f2 = null)
	{
//        $wh = "frontend.frontend_reserva.estado_fk = 4";
//        $sql_reserva = "select * from frontend.frontend_reserva where " . $wh . " AND frontend.frontend_reserva.persona_reserva_fk=$id_usuario";
//        $query = $this->db->query($sql_reserva);

		$this->db->select('frontend.frontend_reserva.id as reserva_id, frontend.frontend_habitacion_reserva.id as hab_reserva_id, frontend.frontend_habitacion_reserva.fecha_entrada');
		$this->db->from('frontend.frontend_reserva');
		$this->db->where('frontend.frontend_reserva.estado_fk', 4);
		$this->db->where('frontend.frontend_reserva.persona_reserva_fk', $id_usuario);

		$where = "\"frontend.frontend_reserva.id = frontend\".\"frontend_habitacion_reserva\".\"reserva_fk\" ";

		if ($f2) {
			$where .= " AND (\"frontend\".\"frontend_habitacion_reserva\".\"fecha_entrada\" BETWEEN '".$f1."' AND '".$f2."')";
		} else {
			$where .= " AND \"frontend\".\"frontend_habitacion_reserva\".\"fecha_entrada\" = '".$f1."'";
		}
		$this->db->join('frontend.frontend_habitacion_reserva', $where);


		$r = $this->db->get()->result_array();

		return count($r);
	}

	private function ya_esta_en_paro($paros, $fecha)
	{
		$min_ts = $this->date_to_ts($fecha);

		foreach ($paros as $key => $paro) {
			$ini_par_ts = $this->date_to_ts($paro['fecha_inicio']);
			$fin_par_ts = $this->date_to_ts($paro['fecha_fin']);

			if ($min_ts >= $ini_par_ts && $min_ts <= $fin_par_ts) {
				return true;
			}
		}

		return false;
	}

	private function get_min_day($datos)
	{
		$paros = $datos['hotel']['paros_venta'];
		$min   = $datos['hotel']['fecha_minima'];

		$min_ts = $this->date_to_ts($min);
		$paros  = $this->ordena_paros($paros);

		foreach ($paros as $key => $paro) {
			$ini_par_ts = $this->date_to_ts($paro['fecha_inicio']);
			$fin_par_ts = $this->date_to_ts($paro['fecha_fin']);

			if ($min_ts >= $ini_par_ts && $min_ts <= $fin_par_ts) {
				$min_ts = $this->move_day($fin_par_ts, 1);
			}
		}

		$fecha = $this->ts_to_date($min_ts);

		$obj_fecha1 = new DateTime($fecha, new DateTimeZone('America/Havana'));
		$obj_fecha2 = new DateTime($min, new DateTimeZone('America/Havana'));

		// minimo dia del mismo mes
		if ($obj_fecha1->format('m') === $obj_fecha2->format('m')) {
			return $fecha;
		}

		return null;
	}

	private function ordena_paros($paros)
	{
		$cant = count($paros);
		for ($i = 0; $i < $cant; $i++) {
			for ($k = $i + 1; $k < $cant; $k++) {
				$p1 = $paros[$i];
				$p2 = $paros[$k];

				if ($this->date_to_ts($p1['fecha_inicio']) > $this->date_to_ts($p2['fecha_inicio'])) {
					$temp = $p2;
					$p2   = $p1;
					$p1   = $temp;

					$paros[$i] = $p1;
					$paros[$k] = $p2;
				}
			}
		}

		return $paros;
	}

	private function ts_to_date($ts)
	{
		return date('Y-m-d', mktime(0, 0, 0, date("m", $ts), date("d", $ts), date("Y", $ts)));
	}

	public function date_to_ts($fecha, $sep = '-')
	{
		$tmp_f = explode($sep, $fecha);

		return mktime(0, 0, 0, $tmp_f[1], $tmp_f[2], $tmp_f[0]);
	}

	private function move_day($ts, $days)
	{
		return $ts + ($days * 86400);
	}

	public function _existe_disponibilidad($tipo_habitacion, $fecha, $paros = null)
	{
		$f_current = $this->date_to_ts($fecha);

		if ($paros != null) {
			foreach ($paros as $key => $_paro) {
				$f_paro1    = $_paro['fecha_inicio'];
				$f_ini_paro = $this->date_to_ts($f_paro1);

				$f_paro2    = $_paro['fecha_fin'];
				$f_fin_paro = $this->date_to_ts($f_paro2);

				if ($f_current >= $f_ini_paro && $f_current <= $f_fin_paro) {
					return false;
				}
			}
		}

		return ($this->get_cant_hab_disp($tipo_habitacion, $fecha) > 0);
	}

	public function get_cant_hab_disp($tipo_habitacion, $fecha)
	{
		$paros = $this->get_paros_venta();

		if ($this->ya_esta_en_paro($paros, $fecha)) {
			return 0;
		}

		//$cant_reservadas = $this->get_reservadas($tipo_habitacion, $fecha);
		$capacidad       = $this->get_capacidad($tipo_habitacion, $fecha);

		//return ($capacidad - $cant_reservadas);
		return $capacidad;
	}

	// Obtener la capacidad de un tipo de habitacion para una fecha
	// a partir de los cupos, si no estan definidos cupos devuelve
	// la cantidad de habit. del hotel de ese tipo
	public function get_capacidad($tipo_habitacion, $fecha)
	{
		$cupos = $this->cupos_dias;

		if (isset($cupos[$tipo_habitacion])) {
			$resp = $cupos[$tipo_habitacion];
		} else {
			// buscar los cupos
			$this->db->select('hotel.hotel_cupo_dia.cupo, hotel.hotel_cupo_dia.fecha_inicio, hotel.hotel_cupo_dia.fecha_fin');
			$this->db->from('hotel.hotel_cupo_dia, hotel.hotel_ocupacion_habitacion_hotel');
			$this->db->where('"hotel_ocupacion_habitacion_hotel"."id" = "hotel"."hotel_cupo_dia"."habitacion_fk"'
				. ' AND "hotel_ocupacion_habitacion_hotel"."tipo_habitacion_fk" =' . $tipo_habitacion
			//. ' AND \'' . $fecha . '\' BETWEEN "hotel"."hotel_cupo_dia"."fecha_inicio" AND "hotel"."hotel_cupo_dia"."fecha_fin"'
			);

			//$resp = $this->db->get()->row();

			$resp = $this->db->get()->result_array();
			$cupos[$tipo_habitacion] = $resp;
			$this->cupos_dias = $cupos;
		}

		foreach ($resp as $key => $rango) {
			$ini = $rango['fecha_inicio'];
			$fin = $rango['fecha_fin'];

			// asegurar el formato yyyy-mm-dd
			if ($fecha >= $ini && $fecha <= $fin) {
				return $rango['cupo'];
			}
		}

//		// si no hay cupos definidos buscar la cantidad
//		$this->db->select('hotel_ocupacion_habitacion_hotel.cantidad');
//		$this->db->from('hotel.hotel_ocupacion_habitacion_hotel');
//		$this->db->where('hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk =', $tipo_habitacion);

		return 0;
	}

	public function get_pax_habitacion($tipo_habitacion, $plan, $fecha)
	{
		$id_hotel = $this->id_hotel_current;
		$sel      = 'hotel.hotel_politica.cantidad_maxima_adulto as adultos, hotel.hotel_politica.cantidad_maxima_ninos as ninos';

		$this->db->select($sel);
		$this->db->from('hotel.hotel_politica');
		$this->db->join('hotel.hotel_temporada', 'hotel.hotel_politica.temporada_fk=hotel.hotel_temporada.id', 'INNER');
		$this->db->join('hotel.hotel_ocupacion_habitacion_hotel',
			'hotel.hotel_politica.tipo_habitacion_fk=hotel.hotel_ocupacion_habitacion_hotel.tipo_habitacion_fk AND hotel.hotel_ocupacion_habitacion_hotel.hotel_fk=hotel.hotel_politica.hotel_fk',
			'INNER'
		);

		$wh = '(hotel.hotel_politica.tipo_habitacion_fk = ' . $tipo_habitacion . ') AND
			  (hotel.hotel_politica.hotel_fk = ' . $id_hotel . ') AND
			  (hotel.hotel_politica.plan_fk = ' . $plan . ') AND
			  (\'' . $fecha . '\' BETWEEN hotel.hotel_temporada.fecha_inicio AND hotel.hotel_temporada.fecha_fin)';

		$this->db->where($wh, null, false);

		return $this->db->get()->result_array();
	}

	/**
	 * Calcula la cantidad maxima de noches que se puede reservar
	 * en una habitacion, a partir de una fecha, se usa para evitar
	 * que se reserve 5 noches y un dia caiga en un paro o no haya
	 * disponibilidad
	 */

	public function get_max_cant_max_noches($fecha, $tipo_habitacion)
	{
		$cant_max    = 0;
		$maximo      = 30; // 30 dias maximo en una reserva
		$fechaInicio = $this->date_to_ts($fecha);

		$fechaFin = $this->move_day($fechaInicio, $maximo);

		for ($i = $fechaInicio; $i < $fechaFin; $i += 86400) {
			$dia = $this->ts_to_date($i);
			if ($this->_existe_paro_venta($dia) == false
                && $this->_existe_disponibilidad($tipo_habitacion, $dia)
                && $this->_get_politica_habitacion($tipo_habitacion, null, $dia)) // si tiene precio para ese día
			{
				$cant_max++;
			} else {
				break;
			}
		}

		return $cant_max;
	}

	public function get_reserva_info($date)
	{
		// check si la fecha es una fecha válida
		$d = DateTime::createFromFormat('Y-m-d', $date);
		if (!$d || $d->format('Y-m-d') !== $date) {
			return null;
		}

		$this->db->select('*');
		$this->db->from('frontend.frontend_reserva_info');
		$this->db->where('\''.$date . '\' BETWEEN "frontend"."frontend_reserva_info"."fecha_ini" AND "frontend"."frontend_reserva_info"."fecha_fin"', null, false);
		$this->db->limit(1);

		$info = $this->db->get()->row();

		if ($info) {
			$idioma_current = app_existe_idioma_seleccionado();
			if (!$idioma_current) {
				$idioma_current = app_idioma_defecto();
			}

			$this->db->select('*');
			$this->db->from('frontend.frontend_reserva_info_idioma');
			$this->db->where('frontend.frontend_reserva_info_idioma.idioma_fk', $idioma_current['id']);
			$this->db->where('frontend.frontend_reserva_info_idioma.info_fk', $info->id);
			$this->db->limit(1);

			$trad = $this->db->get()->row();

			if (is_object($trad)) {
				return $trad->info;
			}
		} else {
			return null;
		}

		return $info->info;
	}

	function get_hotel_reducido($criterio = array())
	{
		if (! isset($criterio['id'])) {
			$criterio['id'] = $this->id_hotel_current;
		}

		$hotel = $this->db->get_where('hotel.hotel_hotel', $criterio)->row_array();
		if ($hotel) {
			$paros  = $this->get_paros_venta($hotel['id']);
			$hotel['fecha_maxima'] = $this->_get_fecha_maxima_contrato();
			$hotel['fecha_minima'] = $this->_get_fecha_minima($hotel);

			$_min = app_dateadd($hotel['fecha_minima'], -1);
			$paros[] = array(
				'fecha_inicio' => '2016-06-01',
				'fecha_fin' => $_min,
				'hotel_fk' => 78,
				'tipo_paro' => 'release',
			);

			$hotel['paros_venta'] = $paros;

			return $hotel;
		}

		return false;
	}

	public function get_reserva_hab($reserva_fk)
    {
        $this->db->select('h.*, ht.nombre_habitacion, r.no_reserva');
        $this->db->from('frontend.frontend_habitacion_reserva h');
        $this->db->where('h.reserva_fk', $reserva_fk);

        $this->db->join('hotel.hotel_tipo_de_habitacion ht', 'ht.id = h.tipo_habitacion_fk');
        $this->db->join('frontend.frontend_reserva r', 'r.id = h.reserva_fk');

        return $this->db->get()->result_array();
    }

    public function update_reserva_resp($data, $id)
    {
        return $this->db->update('frontend.frontend_habitacion_reserva', $data, array('id' => $id));
    }
}
?>