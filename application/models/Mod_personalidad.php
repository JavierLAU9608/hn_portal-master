<?php
class Mod_personalidad extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
	function get_personalidades($criterio,$items_pagina = NULL,$inicio = NULL)
	{
		if(!isset($criterio['publicar'])){$criterio['publicar']='t';}


		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('i.id, i.nombre, i.descripcion, i.imagen, i.tipo_personalidad_fk, ' .
			'i.publicar, i.slug, i.fecha_visita, ii.descripcion as descripcion_trad,');
		$this->db->from('frontend.frontend_personalidad i');
		$this->db->join('frontend.frontend_personalidad_idioma ii', 'i.id = ii.personalidad_fk AND ii.idioma_fk = '.$idioma_id, 'LEFT OUTER');
		$this->db->where($criterio);

		$this->db->order_by('i.fecha_visita','DESC');
		$this->db->order_by('i.nombre','ASC');

		return $this->db->get_where(null,$criterio,$items_pagina,$inicio)->result_array();
	}
	function get_total_personalidades($criterio = array('publicar'=>'t'))
	{
		if(!isset($criterio['publicar'])){$criterio['publicar']='t';}
		return $this->db->count_all('frontend.frontend_personalidad',$criterio);
	}
	function get_personalidad($criterio)
	{
		$idioma = app_idioma();
		$idioma_id = $idioma['id'];

		$this->db->select('i.id, i.nombre, i.descripcion, i.imagen, i.tipo_personalidad_fk, ' .
			'i.publicar, i.slug, i.fecha_visita, i.description, i.keywords, ii.descripcion as descripcion_trad,' .
			'ii.description as description_trad, ii.keywords as keywords_trad');
		$this->db->from('frontend.frontend_personalidad i');
		$this->db->join('frontend.frontend_personalidad_idioma ii', 'i.id = ii.personalidad_fk AND ii.idioma_fk = '.$idioma_id, 'LEFT OUTER');
		$this->db->where($criterio);

		$personalidad = $this->db->get()->row_array();

		//$personalidad = $this->db->get_where('frontend.frontend_personalidad',$criterio)->row_array();
		if($personalidad)
		{
			// usar traducción de keywords o description
			$personalidad['descripcion'] = $personalidad['descripcion_trad'] != null ? $personalidad['descripcion_trad'] : $personalidad['descripcion'];
			$personalidad['keywords'] = $personalidad['keywords_trad'] != null ? $personalidad['keywords_trad']: $personalidad['keywords'];
			$personalidad['description'] = $personalidad['description_trad'] != null ? $personalidad['description_trad']: $personalidad['description'];

			// usar nombre como keywords o description
			$personalidad['keywords'] = $personalidad['keywords'] != null ? $personalidad['keywords']: $personalidad['nombre'];
			$personalidad['description'] = $personalidad['description'] != null ? $personalidad['description']: $personalidad['nombre'];

			$personalidad['tipo_personalidad'] = $this->get_tipo_personalidad($personalidad['tipo_personalidad_fk']);
			return $personalidad;
		}
		return false;
	}
	function get_tipo_personalidad($id)
	{
		return $this->db->get_where('frontend.frontend_tipo_personalidad',array('id'=>$id))->row_array();
	}
}
?>