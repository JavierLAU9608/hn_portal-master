<?php
class Mod_rss extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}	
	
	public function select($key=null)
	{
		$this->db->select('frontend.frontend_rss_type.id');
		$this->db->from('frontend.frontend_rss_type');
		if($key!=null){
			$this->db->where('frontend.frontend_rss_type.key', $key);
		}
		return $this->db->get();
	}
	
	public function select_rss_oferta($id=null )
	{
		$this->db->select('frontend.frontend_rss_oferta.id, oferta.oferta_producto.nombre, oferta.oferta_producto.descripcion, oferta.oferta_producto.id as idoferta ');                
		$this->db->from('frontend.frontend_rss_oferta');
                $this->db->join('oferta.oferta_producto', 'frontend.frontend_rss_oferta.idoferta_fk=oferta.oferta_producto.id');
				
		if($id!=null){
			$this->db->where('frontend.frontend_rss_oferta.type_fk', $id);
		}
		
		return $this->db->get();
	}
	
	public function select_rss_noticia($id=null )
	{
		$this->db->select('frontend.frontend_rss_noticia.id, frontend.frontend_noticia.titulo, frontend.frontend_noticia.texto, frontend.frontend_noticia.id as idnoticia ');                
		$this->db->from('frontend.frontend_rss_noticia');
                $this->db->join('frontend.frontend_noticia', 'frontend.frontend_rss_noticia.noticia_fk=frontend.frontend_noticia.id');
				
		if($id!=null){
			$this->db->where('frontend.frontend_rss_noticia.type_fk', $id);
		}
		
		return $this->db->get();
	}
}
?>