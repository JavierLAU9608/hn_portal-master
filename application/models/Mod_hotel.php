<?php
class Mod_hotel extends CI_Model
{
	var $tb = 'hotel.hotel_hotel';
	function __construct()
	{
		$this->id_hotel_current = 78;
		parent::__construct();
	}
	function set_id_hotel($id)
	{
		$this->id_hotel_current = $id;
	}
	function get_hotel($id = NULL)
	{
		$id = $id?$id:$this->id_hotel_current;
	}
	function get_tipos_imagen()
	{
		$this->db->order_by('orden','ASC');
		return $this->db->get('hotel.hotel_imagen_tipo')->result_array();
	}
	function get_tipos_imagen_idioma()
	{
		return $this->db->get('hotel.hotel_imagen_tipo_idioma')->result_array();
	}
	function get_tipo_imagen($criterio)
	{
		return $this->db->get_where('hotel.hotel_imagen_tipo',$criterio)->row_array();
	}
	function get_galeria_imagenes($criterio = array(),$items_pagina = NULL,$inicio = NULL)
	{
		$criterio['hotel_fk'] = $this->id_hotel_current;
		$this->db->order_by('principal','ASC');
		return $this->db->get_where('hotel.hotel_imagenes',$criterio,$items_pagina,$inicio)->result_array();
	}
	function get_total_imagenes($criterio = array())
	{
		$criterio['hotel_fk'] = $this->id_hotel_current;
		return $this->db->count_all('hotel.hotel_imagenes',$criterio);
	}
	function get_imagen($id)
	{
		return $this->db->get_where('hotel.hotel_imagenes',array('id'=>$id))->row_array();
	}
    function get_catalogo($id, $idIdioma)
	{
        $this->db->select('documento_pdf');
		$this->db->where(' idioma_fk = '.$idIdioma,NULL,false);
		$this->db->where(' hotel_fk = '.$id,NULL,false);
                
		$pdf = $this->db->get_where('hotel.hotel_idioma_hotel', array())->row_array();
                
        return (count($pdf)>0) ? $pdf : $this->db->get_where('hotel.hotel_hotel',array('id'=>$id))->row_array();		
	}        
}
?>