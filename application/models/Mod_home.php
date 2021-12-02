<?php
class Mod_home extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
	function get_pagina_footer($id)
	{
		return $this->db->get_where('frontend.frontend_menu_footer',array('id'=>$id))->row_array();
	}
}
?>