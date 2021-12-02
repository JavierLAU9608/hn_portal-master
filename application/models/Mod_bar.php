<?php
class Mod_bar extends CI_Model
{	
	var $tb = 'bar.bar_bar';
	var $str_producto = 'bar';
	function __construct()
	{
		parent::__construct();
	}
	function get_bares($criterio,$items_pagina = NULL,$inicio = NULL,$opciones = array())
	{	
		if(!isset($criterio['disponible'])){$criterio['disponible']='t';}
		$this->db->order_by('nombre','ASC');
		$bares = $this->db->get_where($this->tb,$criterio,$items_pagina,$inicio)->result_array();
		
		if(isset($opciones['imagenes']) && $opciones['imagenes'] == true)
		{
			foreach($bares as &$b)
			{
				$b['imagenes'] = $this->get_imagenes_bar($b['id'],4);
			}
		}
		//Para obtener el menor precio para cada Bar
		foreach($bares as &$b)
		{
			$menor_precio = 99999;
			$menus = $this->get_tarifas_bar($b['id']);
			foreach($menus as $m)
			{
				$primera_tarifa = array_shift($m['tarifas']);
				if($menor_precio > $primera_tarifa['precio'])
					$menor_precio = $primera_tarifa['precio'];
			}
			if($menor_precio!==99999)
				$b['menor_precio'] = $menor_precio;				
			else
				$b['menor_precio'] = false;	
		}
		return $bares;
	}
	function get_total_bares($criterio = array())
	{
		if(!isset($criterio['disponible'])){$criterio['disponible']='t';}
		return $this->db->count_all($this->tb,$criterio);
	}
	function get_bar($criterio,$tarifas = FALSE,$imagenes = FALSE)
	{
		$bar = $this->db->get_where($this->tb,$criterio)->row_array();
		if($bar)
		{
			if($tarifas)
			{
				$bar['menus'] = $this->get_tarifas_bar($bar['id']);
			}
			if($imagenes)
			{
				$bar['imagenes'] = $this->get_imagenes_bar($bar['id']);
			}
			return $bar;
		}
		return false;
	}
	function get_tarifas_bar($id)
	{
		$tarifas = $this->db->get_where('bar.bar_menu',array('bar_fk'=>$id))->result_array();
		$tarifas_reales = array();
		foreach($tarifas as $t)
		{
			$this->db->order_by('precio','ASC');
			$tarifas_precios = $this->db->get_where('bar.bar_precio_menu',array('menu_bar_fk'=>$t['id']))->result_array();
			$descuento_cliente = app_descuento_tipo_cliente($this->str_producto);
			if($descuento_cliente)
			{
				foreach($tarifas_precios as &$tp)
				{
					$tp['precio'] = app_aplicar_descuento($tp['precio'],$descuento_cliente);
					$tp['precio_extra'] = app_aplicar_descuento($tp['precio_extra'],$descuento_cliente);
				}
			}
			$t['tarifas'] = $tarifas_precios;
			$tarifas_reales[$t['id']] = $t;
		}
		return $tarifas_reales;
	}
	function get_menu($id)
	{
		 return $this->db->get_where('bar.bar_menu',array('id'=>$id))->row_array();
	}
	function get_horario($id)
	{
		 return $this->db->get_where('bar.bar_precio_menu',array('id'=>$id))->row_array();
	}
	function get_imagenes_bar($id,$limite = NULL)
	{
		$this->db->join('hotel.hotel_imagenes','hotel.hotel_imagenes.id = imagen_fk');
		return $this->db->get_where('bar.bar_imagen',array('bar_fk'=>$id),$limite,0)->result_array();
	}
	public function voucher($producto)
	{
		$datos_bar = $this->get_bar(array('id'=>$producto['options']['id_bar']));
		$menu = $this->get_menu($producto['options']['id_menu']);
		$duracion = $this->get_horario($producto['options']['id_duracion']);
		$lineas = array();
			$lineas[] = $datos_bar['nombre'];
			$lineas[] = $menu['nombre'].' | '.trans('br_cantidad_personas').' '.$producto['options']['cantidad'].' | '.trans('br_duracion').' '.$duracion['duracion'].' | '.trans('br_precio_hora_extra').' '.$producto['options']['horas_extras'];

		return $lineas;
	}
}
?>