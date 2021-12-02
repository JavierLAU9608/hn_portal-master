<?php
include_once 'DBProfiler.php';
include_once 'LangProfiler.php';
include_once 'MailProfiler.php';

/**
 * Un profiler personal mientras cambiamos la versión de CI a una que tenga un profiler decente
 *
 * @versión 0.2.1
 * @author Luis L. Rodríguez Oro <roll3lg@gmail.com>
 */
class MyProfilerLib
{
    private $version = '0.2.1';

    /**
     * Mantener todas las query que se han realizado (incluye las que se hacen por ajax)
     *
     * Nota: Al mantener el registro de todas las consultas SQL el json crece exponencialmente
     * manténgalo en desactivado a menos que sea necesario
     *
     * @var bool
     */
    private $keep_query = false;

    /**
     * Nombre del controlador que hace la petición
     *
     * @var string
     */
    private $controller;

    /**
     * Nombre del método que hace la acción
     *
     * @var string
     */
    private $method;

    /**
     * Micro time inicial
     *
     * @var int
     */
    private $time_start;

    /**
     * Ruta completa hacia el archivo profiler.json
     *
     * @var string
     */
    private $file_name;

    /**
     * Resumen de totales (db, lang, email)
     *
     * @var array
     */
    private $resumen;

    public function __construct()
    {
//        // en config/database.php
//        $db['sqlite'] = array (
//            'dsn' => 'sqlite:'.APPPATH.'cache/myprofiler.sqlite',
//            'hostname' => '',
//            'username' => '',
//            'password' => '',
//            'dbdriver' => 'pdo',
//            'dbprefix' => '',
//            'pconnect' => FALSE,
//            'db_debug' => TRUE,
//            'cache_on' => FALSE,
//            'cachedir' => '',
//            'char_set' => 'utf8',
//            'dbcollat' => 'utf8_general_ci',
//            'swap_pre' => '',
//            'autoinit' => TRUE,
//            'stricton' => FALSE,
//            'failover' => array()
//        );
//
//        $profiler_db = $this->load->database('sqlite', TRUE);
//        $profiler_db->select('*');
//        $profiler_db->from('profiler');
//        $profiler_db->where('id', 1);
//
//        $d = $profiler_db->get()->result();

        if (!is_dir($this->getProfileDir())) {
            mkdir($this->getProfileDir());
        }

        $c = & get_instance();

        $this->controller = $c->router->class;
        $this->method = $c->router->method;

        $this->time_start = $c->benchmark->marker['total_execution_time_start'];

        $this->file_name = $this->getFileName();
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->getProfileDir() . 'profiler.json';
    }

    /**
     * @return string
     */
    public function getProfileDir()
    {
        return FCPATH . 'application/cache/profiler/';
    }

    /**
     * @return array
     */
    public function getResumen()
    {
        $this->getData();

        return $this->resumen;
    }

    public function setPreference($opt, $val)
    {
        $data = $this->getData();

        $data['preference'][$opt] = $val;

        $this->setData($data);
    }

    /**
     * @return array
     */
    public function getQueries()
    {
        $data = $this->getData();

        return $data['db'];
    }

    public function run()
    {
        $con = & get_instance();

        // poner las queries
        $this->addQueries($con->db->queries, $con->db->query_times);
    }

    /**
     * @return array
     */
    private function getData()
    {
        $ci = & get_instance();
        $config = $ci->config->config;

        if (file_exists($this->file_name)) {
            $data = json_decode(file_get_contents($this->file_name), true);

            if (isset($data['db']['total_query']) && isset($data['lang']['total_missing']) && isset($data['email']['total_mail'])) {
                $this->resumen = array(
                    'db' => $data['db']['total_query'] + $data['db']['total_query_ajax'],
                    'lang' => $data['lang']['total_missing'],
                    'email' => $data['email']['total_mail'],
                    'controller' => $this->controller,
                    'method' => $this->method,
                    'time_start' => $this->time_start,
                    'version' => $this->version,
                    'memory' => round(memory_get_usage() / (1024*1024), 1),
                    'preference' => array(
                        'visible_bar' => isset($data['preference']['visible_bar']) ? $data['preference']['visible_bar'] : $config['profiler_visible_bar'],
                        'userguide_url' => $config['profiler_userguide_url'],
                        'panel_url' => $config['profiler_panel_url'],
                    )
                );

                return $data;
            }
        }

        $this->resumen = array(
            'db' => 0,
            'lang' => 0,
            'email' => 0,
            'controller' => '',
            'method' => '',
            'time_start' => microtime(true),
            'version' => $this->version,
            'memory' => memory_get_usage(),
            'preference' => [
                'visible_bar' => $config['profiler_visible_bar'],
                'userguide_url' => $config['profiler_userguide_url'],
                'panel_url' => $config['profiler_panel_url'],
            ]
        );

        return array(
            'db' => $this->getEmptyQuery(),
            'lang' => array(
                'total_missing' => 0,
                'missing' => array(),
            ),
            'email' => array(
                'total_mail' => 0,
                'mails' => array(),
            )
        );
    }

    /**
     * Valores en 0 de las query
     *
     * @return array
     */
    private function getEmptyQuery()
    {
        return array(
            'total_query' => 0,
            'total_query_ajax' => 0,
            'total_time' => 0,
            'queries' => array(),
            'queries_ajax' => array(),
        );
    }

    /**
     * @return array
     */
    public function getLang()
    {
        $data = $this->getData();

        return $data['lang'];
    }

    /**
     * @return array
     */
    public function getEmail()
    {
        $data = $this->getData();

        return $data['email'];
    }

    /**
     * Agrega las queries al profiler
     *
     * @param $all_queries
     * @param $all_times
     */
    public function addQueries($all_queries, $all_times)
    {
        $c = & get_instance();
        $ajax = $c->input->is_ajax_request();

        $data = $this->getData();
        if (!$this->keep_query) {
            if (false === $ajax) {
                $data['db'] = $this->getEmptyQuery();
            }
        }

        $object = new DBProfiler($data['db'], $this->controller);
        $resp = $object->addQueries($all_queries, $all_times, $ajax);

        if ($resp) {
            $data['db'] = $resp;
            $this->setData($data);
        }
    }

    /**
     * Guardar el contenido del profiler
     *
     * @param $data array
     */
    private function setData($data)
    {
        try {
            file_put_contents($this->file_name, json_encode($data), LOCK_EX);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Agregar una nueva traducción faltante, se ejecuta en lang()
     *
     * @param $key
     * @param $val
     */
    public function addLang($key, $val)
    {
        $data = $this->getData();
        $object = new LangProfiler($data['lang'], $this->controller.'/'. $this->method);

        $resp = $object->addLang($key, $val);
        $data['lang'] = $resp;

        $this->setData($data);
    }

    /**
     * Agregar un nuevo correo al profiler, se ejecuta en send_mail
     *
     * @param $to
     * @param $subject
     * @param $message
     */
    public function addMail($to, $subject, $message)
    {
        $data = $this->getData();
        $object = new MailProfiler($data['email']);

        $resp = $object->addMail($to, $subject, $message);
        $data['email'] = $resp;

        $this->setData($data);
    }

    /**
     * Poner el profiler en 0
     */
    public function clearAll()
    {
        $this->clearLang();
        $this->clearQueries();
        $this->clearMails();
    }

    /**
     * Poner las traducciones en 0
     */
    public function clearLang()
    {
        $data = $this->getData();

        $data['lang'] = array(
            'total_missing' => 0,
            'missing' => array(),
        );

        $this->setData($data);
    }

    /**
     * Poner las query en 0
     */
    public function clearQueries()
    {
        $data = $this->getData();

        $data['db'] = $this->getEmptyQuery();

        $this->setData($data);
    }

    /**
     * Poner los correos en 0
     */
    public function clearMails()
    {
        // eliminar los archivos html de los correos
        try {
            $mask = $this->getProfileDir() . "email/*.html";
            array_map("unlink", glob($mask));
        } catch (Exception $e) {
        }

        $data = $this->getData();

        $data['email'] = array(
            'total_mail' => 0,
            'mails' => array(),
        );

        $this->setData($data);
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }
}