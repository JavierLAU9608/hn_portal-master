<?php

class LangProfiler
{

    private $controller;
    private $data;

    public function __construct($data, $c, $ignore = array('con_tools'))
    {
        $this->data       = $data;
        $this->controller = $c;
    }

    public function addLang($key, $value)
    {
        $data = $this->data;

        $url     = $_SERVER['REQUEST_URI'];
        $missing = $data['missing'];

        if (! $this->existLang($missing, $key)) { // si no se reportó
            $missing[] = array('key' => $key, 'url' => $url, 'controller' => $this->controller);

            $data['total_missing'] = $data['total_missing'] + 1;
            $data['missing']       = $missing;
        }


        return $data;
    }

    private function existLang($data, $key)
    {
        foreach ($data as $item) {
            if ($item['key'] == $key) {
                return true;
            }
        }

        return false;
    }
}