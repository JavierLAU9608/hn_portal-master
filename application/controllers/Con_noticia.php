<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Con_noticia extends APP_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mod_noticia', 'noticia');
    }

    public function noticia($id)
    {
        $datos = array();
        if ($datos['noticia'] = $this->noticia->get_noticia(array('id' => $id))) {
            $this->display('noticia', $datos);
        }
    }
}