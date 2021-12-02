<?php
class Mod_noticia extends CI_Model
{
	var $tb = 'frontend.frontend_noticia';	
	function __construct()
	{
		parent::__construct();
	}
	function get_noticias($criterio = array(),$items_pagina = NULL,$inicio = NULL)
	{		
		$this->db->where(' (fecha_publicar <= \''.app_now().'\' )',NULL,false);
		$this->db->where(' (fecha_publicar_fin >= \''.app_now().'\' OR fecha_publicar_fin IS NULL) ',NULL,false);
		$this->db->order_by($this->tb.'.fecha_publicar','DESC');
		return $this->db->get_where($this->tb,$criterio,$items_pagina,$inicio)->result_array();
	}
	function get_total_noticias($criterio)
	{
		$this->db->select('count(*) as total');
		$this->db->where(' fecha_publicar <= \''.app_now().'\' ',NULL,false);
		$this->db->where(' fecha_publicar_fin >= \''.app_now().'\' OR fecha_publicar_fin IS NULL ',NULL,false);
		return $this->db->get_where($this->tb,$criterio)->row()->total;
	}
	function get_noticia($criterio)
	{
		return $this->db->get_where($this->tb,$criterio)->row_array();
	}
}
?>