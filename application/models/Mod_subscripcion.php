<?php
class Mod_subscripcion extends CI_Model
{	
	var $tb = 'frontend.frontend_boletin';
	function __construct()
	{
		parent::__construct();
	}
	function get_subscriptores($criterio)
	{
		return $this->db->get_where($this->tb,$criterio)->result_array();
	}
	function get_subscriptor($criterio)
	{
		return $this->db->get_where($this->tb,$criterio)->row_array();
	}
	function delete_subscriptor($condicion)
	{
		return $this->db->delete($this->tb,$condicion);
	}
	function add_subscriptor($subscriptor)
	{
		return $this->db->insert($this->tb,$subscriptor);
	}
}
?>