<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_hotel extends APP_Controller {
	var $tipos_imagen = array();
	function __construct()
	{
		parent::__construct();
		$this->tipos_imagen = $this->mod_hotel->get_tipos_imagen();
	}
	public function index()
	{

	}
	public function galeria_imagenes($slug = '',$pagina = 0)
	{
		$this->load->library('pagination');
		
		$tipo_imagen = array();
		$criterio = array();
		$tipo_imagen_id = '';
		$tipo_imagen_existe = false;
		$config['base_url']=base_url(trans('ruta_galeria_imagenes'));
		if($slug !== '')
		{
			foreach($this->tipos_imagen as $ti)
			{
				if($slug == url_title($ti['nombre']))
				{
					$tipo_imagen_existe = true;
					$tipo_imagen = $ti;
					break;
				}
			}
			if($tipo_imagen_existe == false)
			{
				$tipos_imagen_traducido = $this->mod_hotel->get_tipos_imagen_idioma();
				foreach($tipos_imagen_traducido as $tit)
				{
					if($slug == url_title($tit['nombre']))
					{
						$tipo_imagen = $tit;
						break;
					}
				}
			}
			$tipo_imagen_id = $tipo_imagen['id'];
			$criterio['tipo_imagen_fk'] = $tipo_imagen_id;
			$config['base_url']=base_url(trans('ruta_galeria_imagenes_tipo',array('slug'=>$slug)));
			$datos['tipo_imagen'] = app_traduccion('hotel','hotel_imagen_tipo_idioma',NULL,'imagen_tipo_fk',$tipo_imagen['id'],$tipo_imagen);		
		}
				
		$items_pagina = $this->sitio->st_get_informacion_simple_directa('paginadogalerias');
		$config['page_query_string']=false;
		
		$config['total_rows'] = $this->mod_hotel->get_total_imagenes($criterio);	
		$config['cur_page'] = $pagina;	
		$config['per_page']	= $items_pagina;
		$this->pagination->initialize($config);	
		$datos['paginacion'] = $this->pagination->create_links();
		$datos['pagina'] = $pagina;
		
		$datos['items'] = $this->_menu_vertical();
		$datos['item_activo'] = $tipo_imagen_id;
		
		$datos['lista_imagenes'] = $this->mod_hotel->get_galeria_imagenes($criterio,$items_pagina,$pagina);
		$this->load->view('galeria_imagenes',$datos);
	}
	public function descargar_imagen($id)
	{
		if($imagen = $this->mod_hotel->get_imagen($id))
		{
			$this->load->helper('download');
			$ruta_imagen = app_dir_admin().'/hoteles/'.$this->id_hotel_current.'/images/zoom-'.$imagen['url'];
			$data = file_get_contents($ruta_imagen);		
			force_download($imagen['archivo_origen'], $data); 
		}
		else
		redirect(base_url(trans('ruta_galeria_imagenes')));
	}
	public function descargar_coleccion($id_tipo_imagen)
	{
		$imagenes = $this->mod_hotel->get_galeria_imagenes(array('tipo_imagen_fk'=>$id_tipo_imagen));
		$tipo_imagen = $this->mod_hotel->get_tipo_imagen(array('id'=>$id_tipo_imagen));
		$tipo_imagen = app_traduccion('hotel','hotel_imagen_tipo_idioma',NULL,'imagen_tipo_fk',$tipo_imagen['id'],$tipo_imagen);
		$this->load->library('zip');
		if($tipo_imagen['descripcion'] && $tipo_imagen['descripcion']!=='')
		{
			$this->zip->add_data($tipo_imagen['nombre'].'.txt',$tipo_imagen['descripcion']);
		}
		$i = 1;
		foreach($imagenes as $imagen)
		{
			$ruta_imagen = app_dir_admin().'/hoteles/'.$this->id_hotel_current.'/images/zoom-'.$imagen['url'];
			$data = file_get_contents($ruta_imagen);			
			$extension = explode('.',$imagen['archivo_origen']);
			$name = $tipo_imagen['nombre'].'-'.$i.'.'.end($extension);
			$this->zip->add_data($name,$data);
			$i++;
		}
		$this->zip->download($tipo_imagen['nombre'].'.zip'); 
	}
    public function descargar_catalogo()
	{
        $catalogo = $this->mod_hotel->get_catalogo($this->id_hotel_current, $this->idioma_current['id']);                
		if($catalogo)
		{
			$this->load->helper('download');
			$ruta_cat = app_dir_admin().'/hoteles/pdf/'.$catalogo['documento_pdf'];
			$data = file_get_contents($ruta_cat);		
			force_download(trans("hotel_nacional_cuba").".pdf", $data);
		}		
	}
	private function _menu_vertical()
	{		
		$menu_tipo_imagen = array();
		foreach($this->tipos_imagen as $ti)
		{
			$nombre = app_traduccion('hotel','hotel_imagen_tipo_idioma','nombre','imagen_tipo_fk',$ti['id'],$ti['nombre']);
			$menu_tipo_imagen[$ti['id']] = array('url'=>trans('ruta_galeria_imagenes_tipo',array('slug'=>url_title($nombre))),
										  'titulo'=>$nombre
										  );
		}
		return $menu_tipo_imagen;
	}
}