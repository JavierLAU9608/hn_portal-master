<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class profiler
 *
 * Un profiler personalizado
 */
class Myprofiler extends CI_Controller
{
    public function index()
    {
        $data = array('total_query' => 0);
        if (ENVIRONMENT == 'development') {
            $data = $this->myprofilerlib->getQueries();
            $data['resumen'] = $this->myprofilerlib->getResumen();
        }

        $this->load->view('myprofiler/infoquery', $data);
    }

    public function clearAll()
    {
        if (ENVIRONMENT == 'development') {
            $this->myprofilerlib->clearAll();

            redirect(base_url('profiler'));
        }
    }

    public function lang()
    {
        if (ENVIRONMENT == 'development') {
            $data = $this->myprofilerlib->getLang();
            $data['resumen'] = $this->myprofilerlib->getResumen();

            $this->load->view('myprofiler/infolang', $data);
        }
    }

    public function email()
    {
        if (ENVIRONMENT == 'development') {
            $data = $this->myprofilerlib->getEmail();
            $data['resumen'] = $this->myprofilerlib->getResumen();

            $this->load->view('myprofiler/infoemail', $data);
        }
    }

    public function config()
    {
        if (ENVIRONMENT == 'development') {
            $config = $this->config->config;
            $data['resumen'] = $this->myprofilerlib->getResumen();
            $data['config'] = $config;

            $this->load->view('myprofiler/config', $data);
        }
    }

    public function mailshow()
    {
        $dir = $this->myprofilerlib->getProfileDir();
        $file = $dir . 'email/' . $this->input->get_post('file');

        if (file_exists($file) && is_file($file)) {
            $content = file_get_contents($file);
        } else {
            $content = 'No se pudo encontrar el archivo: ' . $file;
        }

        $this->load->view('myprofiler/partial/_email', array('email' => $content));
    }

    public function clearqueries()
    {
        $this->myprofilerlib->clearQueries();
        redirect(base_url('profiler'));
    }

    public function clearmails()
    {
        $this->myprofilerlib->clearMails();
        redirect(base_url('profiler/email'));
    }

    public function clearlangs()
    {
        $this->myprofilerlib->clearLang();
        redirect(base_url('profiler/lang'));
    }

    public function preference()
    {
        $this->myprofilerlib->setPreference($this->input->get('option'), $this->input->get('value'));

        echo json_encode(['success' => true]);
    }

    public function resumen()
    {
        $resumen = $this->myprofilerlib->getResumen();

        echo json_encode(array('db' => $resumen['db'], 'lang' => $resumen['lang'], 'email' => $resumen['email']));
        exit();
    }
}