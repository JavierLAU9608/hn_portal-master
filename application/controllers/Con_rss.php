<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_rss extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_rss', 'rss');
	}
	public function index($idioma)
	{
		if($idioma_sel = $this->sitio->st_get_idioma(array('codigo'=>$idioma)))
		{		
			$this->cargar_idiomas($idioma);
			$data = array();
			$rss = $this->getRssInfo(NULL);				
			$ofertas_rss = array();
			$noticias_rss = array();			
			foreach ($rss as $item)
			{ 
			   $ofertas_rss[] = $this->rss->select_rss_oferta($item['id'])->result_array();
			   $noticias_rss[] = $this->rss->select_rss_noticia($item['id'])->result_array();
			}			
			$data['ofertas'] = $ofertas_rss[0];
			$data['noticias'] = $noticias_rss[0];			
			$this->load->view('rss', $data );
		}
		else
			$this->_error(trans('error_inesperado'));
	}
	
	private function getRssInfo($key=null)
	{
		$this->load->model('mod_rss', 'rss');
		return $this->rss->select($key)->result_array();
	}
}