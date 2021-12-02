<?php
class Mod_evento extends CI_Model
{       
        //LEO - Eliminar esta variable para cargar por el campo mostrar_inicio
	//var $id_tipo_servicio_sala;	
	function __construct()
	{
		parent::__construct();
		//$this->id_tipo_servicio_sala = 2;
	}
	function get_tipo_servicios()
	{
        //$idioma = app_idioma();
        //$this->db->join('evento.evento_tipos_idioma', 'evento.evento_tipos_idioma.tipo_servicio_fk = evento.evento_tipo_servicio.id AND evento.evento_tipos_idioma.idioma_fk = ' . $idioma['id'], 'RIGTH OUTER');
        $this->db->order_by('evento.evento_tipo_servicio.orden','ASC');
        //print_r($this->db->get_where('evento.evento_tipo_servicio',array())->result_array());exit;
        return $this->db->get_where('evento.evento_tipo_servicio',array())->result_array();
	}
	function get_tipo_menu()
	{			
		$this->db->order_by('evento.evento_tipo_menu.nombre','ASC');	
		return $this->db->get_where('evento.evento_tipo_menu',array())->result_array();		
	}	
	function get_name_tipo_menu($id_tipo_menu)
	{			
		$result = $this->db->get_where('evento.evento_tipo_menu',array('evento.evento_tipo_menu.id'=>$id_tipo_menu))->row_array();
		if($result)	
			return $result['nombre'];
		return false;
	}	
	
	function get_salas_eventos()
	{	
                //LEO - Eliminar esta variable para cargar por el campo mostrar_inicio
		//$this->db->join('evento.evento_servicio','evento.evento_servicio.tipo_servicio_fk = evento.evento_tipo_servicio.id');							
		return $this->db->get_where('evento.evento_servicio',array("evento.evento_servicio.mostrar_inicio"=>"T"))->result_array();
	}	
	function get_imagenes_salas_eventos($id_servicio_sala = NULL)
	{	
		$this->db->select('DISTINCT(hotel.hotel_imagenes.id),hotel.hotel_imagenes.url,hotel.hotel_imagenes.descripcion');
		$this->db->join('evento.evento_servicio','evento.evento_servicio.id = evento.evento_servicio_imagen.servicio_fk');
		$this->db->join('hotel.hotel_imagenes','hotel.hotel_imagenes.id = evento.evento_servicio_imagen.imagen_fk');
		//LEO - Eliminar esta variable para cargar por el campo mostrar_inicio
                //$where = array("evento.evento_servicio.tipo_servicio_fk"=>$this->id_tipo_servicio_sala);
		$where = array("evento.evento_servicio.mostrar_inicio"=>"T");
		if($id_servicio_sala != NULL)
		{
			$where['evento.evento_servicio_imagen.servicio_fk'] = $id_servicio_sala;
		}		
		return $this->db->get_where('evento.evento_servicio_imagen',$where)->result_array();
	}
	function get_servicios($id_tipo_servicio,$id_tipo_menu = NULL)
	{	
		$this->db->select('evento.evento_servicio.id,evento.evento_servicio.nombre,evento.evento_servicio.descripcion,evento.evento_servicio.precio,evento.evento_servicio.precio_cantidad_unica,evento.evento_servicio.cantidad_minima,evento.evento_servicio.cantidad_maxima');
		$where["evento.evento_servicio.tipo_servicio_fk"] = $id_tipo_servicio;
		
		if($id_tipo_menu != NULL)
		{
		$this->db->join('evento.evento_servicio_menu','evento.evento_servicio_menu.servicio_fk = evento.evento_servicio.id');	
			$where["evento.evento_servicio_menu.tipo_menu_fk"] = $id_tipo_menu;
		}
		$this->db->order_by('evento.evento_servicio.orden','ASC');
		$this->db->order_by('evento.evento_servicio.precio','ASC');	
		return $this->db->get_where('evento.evento_servicio',$where)->result_array();	
	}
	function get_tipo_servicio($id_tipo_servicio)
	{			
		return $this->db->get_where('evento.evento_tipo_servicio',array('evento.evento_tipo_servicio.id'=>$id_tipo_servicio))->row_array();	
	}	
	function get_servicio($id_servicio)
	{			
		return $this->db->get_where('evento.evento_servicio',array('evento.evento_servicio.id'=>$id_servicio))->row_array();	
	}
	function get_imagenes_servicio($id)
	{
		$this->db->join('hotel.hotel_imagenes','hotel.hotel_imagenes.id = imagen_fk');
		return $this->db->get_where('evento.evento_servicio_imagen',array('servicio_fk'=>$id))->result_array();
	}
	public function voucher($producto)
	{
		$lineas = array();
		$lineas[] = $producto['options']['nombre'].' | '.trans('ev_no_participantes').' '.$producto['options']['no_participantes'];
		$lineas[] = trans('ev_inicio').' '.$producto['options']['fecha'].' | '.trans('ev_fin').' '.$producto['options']['fecha_fin'];
		 if(sizeof($producto['options']['dias_ev'])>0)
		 {
			 foreach($producto['options']['dias_ev'] as $keyday=>$d)
			 {
				 $lineas[] = trans('ev_dia_numero',array('numero'=>$keyday));
				 foreach($d as $id_tipo_servicio=>$tipo_servicio)
				 {
					 $datos_tipo_servicio = $this->get_tipo_servicio($id_tipo_servicio);
					 $tipo_servicio_nombre = app_traduccion('evento','evento_tipos_idioma','nombre','tipo_servicio_fk',$id_tipo_servicio,$datos_tipo_servicio['nombre']);
					 foreach($tipo_servicio as $id_servicio=>$servicio)
					 {
						 $servicio_incluido = $this->get_servicio($id_servicio);
						 $servicio_incluido_nombre = app_traduccion('evento','evento_servicio_idioma','nombre','servicio_fk',$id_servicio,$servicio_incluido['nombre']);
						 $lineas[] = '  '.$tipo_servicio_nombre.': '.$servicio_incluido_nombre;
					 }				 		
				 }
			 }
		 }
		return $lineas;
	}

	public function get_imagenes_evento($criteria = array(), $limit = null, $offset = null)
	{
		$this->db->select('t.url, t.descripcion, t.principal');
		$this->db->from('evento.evento_imagen t');

		$this->db->limit($limit, $offset);

		return $this->db->get()->result_array();
	}

	public function get_all_img_servicios($limit)
	{
		$this->db->select('*');
		$this->db->from('evento.evento_servicio_imagen');
		$this->db->join('hotel.hotel_imagenes','hotel.hotel_imagenes.id = evento.evento_servicio_imagen.imagen_fk');
		$this->db->order_by('evento.evento_servicio_imagen.principal', 'DESC');
		$this->db->limit($limit);

		return $this->db->get()->result_array();
	}
}
?>