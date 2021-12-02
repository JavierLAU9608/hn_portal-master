<?php
class Mod_restaurante extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
	function get_restaurantes($items_pagina = NULL,$inicio = NULL)
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('t.id, t.nombre, t.descripcion, t.cantidad_persona, t.imagen, t.slug, t.description,
		 t.disponible, t.tipo_fk, t.release, t.confirmacion_online, t.keywords,t.tipo_comida, ti.nombre as nombre_trad, ti.descripcion as descripcion_trad, ti.tipo_comida as tipo_comida_trad');
		$this->db->from('restaurante.restaurante_restaurante t');
		$this->db->where('t.disponible', 't');
		$this->db->join('restaurante.restaurante_idioma_rest ti', 't.id = ti.restaurante_fk AND ti.idioma_fk = '.$idioma_id,'LEFT OUTER');
		$this->db->limit($items_pagina, $inicio);
		$this->db->order_by('t.nombre','ASC');

		$data = $this->db->get()->result_array();

		return $data;
	}
	function get_tipo_restaurante($id_restaurante)
	{			
		$this->db->join('restaurante.restaurante_tipo','restaurante.restaurante_tipo.id = restaurante.restaurante_restaurante.tipo_fk');
		return $this->db->get_where('restaurante.restaurante_restaurante',array("restaurante.restaurante_restaurante.id"=>$id_restaurante))->row_array();		
	}	
	function get_imagenes_restaurante($id_restaurante)
	{			
		$this->db->join('hotel.hotel_imagenes','hotel.hotel_imagenes.id = restaurante.restaurante_imagen.imagen_fk');
		return $this->db->get_where('restaurante.restaurante_imagen',array("restaurante.restaurante_imagen.restaurante_fk"=>$id_restaurante))->result_array();
	}	
	function get_total_restaurantes()
	{
		return $this->db->count_all('restaurante.restaurante_restaurante');
	}
	function get_restaurante($criterio)
	{
		$restaurante = $this->db->get_where('restaurante.restaurante_restaurante',$criterio)->row_array();
		if($restaurante)
		{
			$restaurante['tipo'] = $this->get_tipo_restaurante($restaurante['id']);
			$restaurante['horarios'] = $this->_get_horarios($restaurante['id']);
			return $restaurante;
		}
		return false;
	}
	private function _get_horarios($id_restaurante)
	{
		$this->db->order_by('restaurante.restaurante_horario.hora_inicio','ASC');	
		return $this->db->get_where('restaurante.restaurante_horario',array('restaurante_fk'=>$id_restaurante))->result_array();
	}
	public function get_horario($id_horario)
	{	
		return $this->db->get_where('restaurante.restaurante_horario',array('id'=>$id_horario))->row_array();
	}
	function get_menu($id_restaurante)
	{
		//$this->db->order_by('restaurante.restaurante_menu.recomendado','DESC');
		$this->db->order_by('restaurante.restaurante_menu.id','ASC');
		$menus = $this->db->get_where('restaurante.restaurante_menu',array('restaurante.restaurante_menu.restaurante_fk'=>$id_restaurante))->result_array();
		foreach($menus as &$m)
		{
			$m['platos'] = $this->_renderizar_platos_menu($this->get_menu_platos($m['id']));
		}
		return $menus;
	}
	function get_el_menu($id_restaurante,$id_menu)
	{
		return $this->db->get_where('restaurante.restaurante_menu',array('restaurante_fk'=>$id_restaurante,'id'=>$id_menu))->row_array();
	}
	private function _renderizar_platos_menu($platos)
	{
		$platos_sin_clasificacion = array();
		$platos_calsificados = array();
		foreach($platos as $p)
		{
			if($p['id_tipo_plato'] == NULL)
			{
				$plato_traduccion = app_traduccion('restaurante','restaurante_plato_idioma','nombre','plato_fk',$p['id_plato'],$p['nombre_plato']);
				$platos_sin_clasificacion[]=($p['cantidad']>1?$p['cantidad'].' ':'').$plato_traduccion;
			}
			else
			{
				if(!isset($platos_calsificados[$p['id_tipo_plato']]))
					$platos_calsificados[$p['id_tipo_plato']][] = $p;
				else
					array_push($platos_calsificados[$p['id_tipo_plato']],$p);
			}
		}
		return array_merge($platos_sin_clasificacion,$platos_calsificados);
	}
	function get_menu_platos($id_menu)
	{
		 $this->db->select('
           	restaurante.restaurante_tipo_plato.id as id_tipo_plato,   
		    restaurante.restaurante_tipo_plato.nombre as nombre_tipo_plato,        
			restaurante.restaurante_tipo_plato.orden as orden_tipo_plato,
			restaurante.restaurante_plato.id as id_plato,   
		    restaurante.restaurante_plato.nombre as nombre_plato,        
			restaurante.restaurante_plato.tipo_comida_fk as id_tipo_comida,
			restaurante.restaurante_tipo_comida.nombre as nombre_tipo_comida,
			restaurante.restaurante_menu_plato.cantidad
        ');
		
		$this->db->join('restaurante.restaurante_tipo_plato','restaurante.restaurante_tipo_plato.id = restaurante.restaurante_menu_plato.tipo_plato_fk','LEFT');
		$this->db->join('restaurante.restaurante_plato','restaurante.restaurante_plato.id = restaurante.restaurante_menu_plato.plato_fk');
		$this->db->join('restaurante.restaurante_tipo_comida','restaurante.restaurante_tipo_comida.id = restaurante.restaurante_plato.tipo_comida_fk');
		
		$this->db->order_by('orden_tipo_plato','ASC');		
		
		return $this->db->get_where('restaurante.restaurante_menu_plato',array('restaurante.restaurante_menu_plato.menu_fk'=>$id_menu))->result_array();				
	}
	public function voucher($producto)
	{
		$datos_restaurante = $this->get_restaurante(array('id'=>$producto['options']['id_restaurante']));
		$nombre_restaurante = $datos_restaurante['nombre'];
		$horario = $this->get_horario($producto['options']['horario']);
		$horario_nombre = app_traduccion('restaurante','restaurante_horario_idioma','nombre','horario_fk',$horario['id'],$horario['nombre']);
		$lineas = array();
			$lineas[] = $nombre_restaurante;
			$lineas[] = trans('rt_dia_reservacion').': '.$producto['options']['fecha'].' | '.$horario_nombre;
			if(sizeof($producto['options']['menus'])>0)
			 {
				 $lineas[] = trans('rt_menus_reservados').': ';
				 foreach($producto['options']['menus'] as $m)
				 {
					 $menu_reservado = $this->get_el_menu($datos_restaurante['id'],$m['id_menu']);
					 $nombre_menu = app_traduccion('restaurante','restaurante_menu_idioma','nombre','menu_fk',$menu_reservado['id'],$menu_reservado['nombre']);
					 $lineas[]= '  '.$nombre_menu.' | '.trans('rt_cantidad').' '.$m['cantidad'];
				 } 
				 
			 }
		return $lineas;
	}	
}
?>