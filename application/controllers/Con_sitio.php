<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Con_sitio extends APP_Controller
{

    public function index()
    {

    }

    function cambiar_idioma($id)
    {
        $idioma_sel = $this->sitio->st_get_idioma(array('id' => $id));
        if (sizeof($idioma_sel) > 0) {
            $this->session->set_userdata(array('language' => $idioma_sel));
            print 1;
        } else
            print 0;
    }

    function cambiar_moneda($id)
    {
        $moneda_sel = $this->sitio->st_get_moneda(array('id' => $id));
        if (sizeof($moneda_sel) > 0) {
            $this->session->set_userdata(array('money' => $moneda_sel));
            print 1;
        } else
            print 0;
    }

    function show_error_404()
    {
        $data = array('url' => trans('error_404', array('url' => base_url(uri_string()))));
        $this->display('error_404', $data);
    }

    public function contact_us()
    {
        $resp = trans('texto_contacto_denegado');

        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('','<br/>');

        if ($this->form_validation->run('contacto') == TRUE) {
            $resp = trans('texto_contacto_aceptado');

            $p = app_get_pais($this->input->post('pais_fk'));

            $informacion = [
                'correo' => $this->input->post('correo'),
                'nombre' => $this->input->post('nombre'),
                'msg' => $this->input->post('msg'),
                'pais' => isset($p['nombre'])? $p['nombre']: '',
            ];

            $this->load->library('notificacion_email');
            $this->notificacion_email->nuevo_contacto($informacion);
        }

        $this->display('informativas/contacto', ['info' => $resp]);
    }

}