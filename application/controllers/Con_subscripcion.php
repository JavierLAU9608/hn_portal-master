<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_subscripcion extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_subscripcion', 'subscripcion');
	}
	function subscribir()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('form_validation');
			$this->load->helper(array('form', 'url'));
			$this->form_validation->set_error_delimiters('','');
			if ($this->form_validation->run('subscripcion') == TRUE)
			{
				$exist = $this->subscripcion->get_subscriptor(array('email' => $this->input->post('subscripcion_email')));
				if ($exist) {
					echo trans('subscripcion_existente');
				} else {
					$subscriptor['email'] = $this->input->post('subscripcion_email');
					$subscriptor['idioma_fk'] = $this->idioma_current['id'];
					if($datos = $this->subscripcion->add_subscriptor($subscriptor))
					{
						print trans('subscripcion_guardada');
					}
					else
					{
						print trans('subscripcion_no_guardada');
					}
				}
			}
			else
			{
				print html_entity_decode(form_error('subscripcion_email'));				
			}
		}
	}
	function cancelar($codigo,$id)
	{
		$subscriptor = $this->subscripcion->get_subscriptor(array('id'=>$id));
		if($subscriptor)
		{
			if($codigo == md5($subscriptor['email']))
			{	
				$this->subscripcion->delete_subscriptor(array('id'=>$id));
				$this->display('informativas/cancelacion_boletin',array('email'=>$subscriptor['email']));
			}
			else
				$this->_error_no_existe(trans('subscripcion_no_existente'));
		}
		else
			$this->_error_no_existe(trans('subscripcion_no_existente'));
	}
	function boletin()
	{
		$this->load->library('notificacion_email');		
		$idiomas = $this->sitio->st_get_idiomas();

        //CARGAR LAS NOTICIAS
        $this->load->model('mod_noticia','noticia');
        $noticias = $this->noticia->get_noticias(['boletin' => true,'boletin_enviado' => false]);

		foreach($idiomas as $i)
		{
			$subscritores_idioma = $this->subscripcion->get_subscriptores(array('idioma_fk'=>$i['id']));
			if($subscritores_idioma)
			{
				$informacion_mail = array();
//				$subscritores = array();
				$this->cargar_idiomas($i['codigo']);
				$idioma_sel = $this->sitio->st_get_idioma(array('id'=>$i['id']));
				$this->session->set_userdata(array('language'=>$idioma_sel));

				//CARGAR LAS OFERTAS
				//$this->load->model('mod_oferta','ofertas');
//				$tipos_ofertas = $this->ofertas->get_tipos_ofertas();
				$ofertas = array();
//				foreach($tipos_ofertas as $tipo)
//				{
//					$mas_ofertas = $this->ofertas->get_ofertas(array('tipo_fk'=>$tipo['id']),5,0);
//
//					if($mas_ofertas && sizeof($mas_ofertas)>0)
//					{
//
//						$ofertas = array_merge($ofertas,$mas_ofertas);
//					}
//				}
				if(sizeof($noticias)>0)
				{
					$cuerpo_mail_boletin = $this->load->view('boletin',array('ofertas'=>$ofertas,'noticias'=>$noticias),true);
					$informacion_mail['cuerpo_boletin'] = $cuerpo_mail_boletin;
					foreach($subscritores_idioma as $s)
					{
						$subscriptor = array('email_notificacion'=>$s['email']);
						$informacion_mail['subscritor'] = $subscriptor;
						$informacion_mail['url_cancelar_subscripcion'] = base_url(trans('ruta_cancelar_boletin').'/'.md5($s['email']).'/'.$s['id']);
						$this->notificacion_email->boletin($informacion_mail);
					}
				}
			}
		}

        foreach ($noticias as $noticia) {
            $this->noticia->update(['boletin_enviado' => true], ['id' => $noticia['id']]);
        }
	}
}