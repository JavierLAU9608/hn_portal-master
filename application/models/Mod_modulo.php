<?php
class Mod_modulo extends CI_Model
{
	var $tb = 'frontend.frontend_modulo_publicidad';	
	function __construct()
	{
		parent::__construct();
	}
	function get_reconocimiento($opciones = array())
	{		
		$this->db->order_by('orden','ASC');
		return $this->db->get_where($this->tb,array('publicar'=>'t','posicion'=>1),2,0)->result_array();
	}
	function get_top_left($opciones = array())
	{		
		$this->db->order_by('orden','ASC');
		return $this->db->get_where($this->tb,array('publicar'=>'t','posicion'=>2))->result_array();
	}
	function get_modulos($key_modulo,$opciones = array())
	{		
		$this->db->order_by('orden','ASC');
		$cantidad = isset($opciones['cantidad'])?$opciones['cantidad']:NULL;
		$iniciar = isset($opciones['iniciar'])?$opciones['iniciar']:NULL;
		$this->db->join('frontend.frontend_modulo_pagina',' frontend.frontend_modulo_pagina.modulo_fk = '.$this->tb.'.id');
		$modulos = $this->db->get_where($this->tb,array('publicar'=>'t','posicion'=>$key_modulo,'menu_principal_fk'=>$opciones['menu_principal_fk']),$cantidad,$iniciar)->result_array();
		foreach($modulos as &$m)
		{
			$m['links'] = $this->_get_links_modulo($m['id']);
		}
		return $modulos;
	}
	function _get_links_modulo($id_modulo)
	{
		$this->db->order_by('orden','ASC');
		return $this->db->get_where('frontend.frontend_modulo_items',array('modulo_fk'=>$id_modulo))->result_array();
	}
}
?>