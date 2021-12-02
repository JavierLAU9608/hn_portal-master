<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_libro extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->url_base.=trans('ruta_libro');
		$this->str_producto = '';
		//$this->load->model('mod_libro', 'libro');
	}
	public function index($idioma = NULL)
	{	
		if($idioma!==NULL && sizeof($this->sitio->st_get_idioma(array('codigo' => $idioma)))>0)
		{
			
		}
		else
		{
			$idioma = app_idioma_codigo();
		}
		$datos = array('idioma'=>$idioma);
		$this->load->view('libro/libro',$datos);
	}
	public function generar($idioma = NULL)
	{
		$this->load->helper('file');
		if($idioma!==NULL)
		{
			$this->cargar_idiomas($idioma);
			$idioma_sel = $this->sitio->st_get_idioma(array('codigo' => $idioma));
		}
		else
			$idioma = app_idioma_codigo();		
			
		$paginas = $this->_bd_paginas();
		$xml = '';
		$paginas_xml = array();
		$fichero_lang = '';
		$numero_pagina = 1;
		foreach($paginas as $pagina)
		{
			if(isset($idioma_sel['id']))
			{
				$traduccion = $this->_bd_traduccion($pagina['id'],$idioma_sel['id']);
				if($traduccion)
				{
					$pagina['titulo'] = $traduccion['titulo'];
					$pagina['texto'] = $traduccion['texto'];
				}
			}			
			$datos = array('pagina'=>$pagina,'ruta'=>'images/libro/'.$idioma.'/pages','num'=>$numero_pagina++);
			$this->load->view('libro/plantillas/'.$pagina['plantilla'],$datos,false);
			$paginas_xml[] = '<page src="pages/'.$pagina['id'].'.jpg"/>';
		}
		$xml.='<content width="550" height="500" bgcolor="cccccc" loadercolor="ffffff" panelcolor="5d5d61" buttoncolor="5d5d61" textcolor="ffffff">';
		foreach($paginas_xml as $item)
		{
			$xml.=$item;
		}
		$xml.='</content>';
		$fichero_xml = 'images/libro/'.$idioma.'/xml/Pages.xml';
		write_file($fichero_xml,$xml);
		print json_encode(array('success'=>true,'msg'=>'Libro generado'));
	}
	public function vista_previa($id)
	{
		if($pagina = $this->_bd_pagina($id))
		{
			$idioma = app_idioma_codigo();
			$datos = array('pagina'=>$pagina,'ruta'=>'images/libro/'.$idioma.'/pages','num'=>1,'vista_previa'=>true);
			$this->load->view('libro/plantillas/'.$pagina['plantilla'],$datos,false);
		}
	}
	private function _bd_paginas()
	{
		$this->db->order_by('orden','ASC');
		return $this->db->get_where('hotel.hotel_libro',array('hotel_fk'=>$this->id_hotel_current,'disponible'=>'t'))->result_array();
	}
	private function _bd_pagina($id)
	{
		return $this->db->get_where('hotel.hotel_libro',array('id'=>$id))->row_array();
	}
	private function _bd_traduccion($pagina,$idioma)
	{
		return $this->db->get_where('hotel.hotel_libro_idioma',array('libro_fk'=>$pagina,'idioma_fk'=>$idioma))->row_array();
	}
}