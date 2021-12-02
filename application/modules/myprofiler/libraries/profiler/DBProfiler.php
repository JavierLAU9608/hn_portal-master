<?php

/**
 * @author: Luis L. Rdquez Oro <roll3lg@gmail.com>
 * @version: 0.2
 *
 * */
class DBProfiler
{

    private $controller;
    private $infoQ;

    private $ignore_controller;

    public function __construct($infoQ, $c, $ignore = array('con_profiler'))
    {
        $this->infoQ = $infoQ;
        $this->controller = $c;
        $this->ignore_controller = $ignore;
    }

    /**
     * @return array
     */
    public function getQueries()
    {
        return $this->infoQ;
    }

    public function addQueries($all_queries, $all_times, $ajax = false)
    {
        if (in_array($this->controller, $this->ignore_controller)) {
            return null;
        }

        $url = $_SERVER['REQUEST_URI'];
        $_q  = $all_queries;
        $_qt = $all_times;
        $con = $this->controller;

        $db = $this->getQueries();
        if ($ajax) {
            $db['total_query_ajax'] += count($_q);

            for ($i = 0; $i < count($_q); $i++) {
                $token = md5($_q[$i].'//ajax');
                $db['total_time'] += $_qt[$i];

                if (! $this->existsQuery($db, $token, $url)) {
                    $db['queries_ajax'][$con][$url][] = array(
                        'sql'        => $_q[$i],
                        'time'       => $_qt[$i],
                        'token'      => $token,
                        'total_used' => 1,
                    );
                }
            }

            return $db;
        } else {
            $db['total_query_ajax'] = 0;
            $db['queries_ajax'] = array();
        }

        if (! $this->existsUrl($url)) { // solo una vez por url

            $db['total_query'] += count($_q);

            for ($i = 0; $i < count($_q); $i++) {
                $token = md5($_q[$i]);
                $db['total_time'] += $_qt[$i];

                if (! $this->existsQuery($db, $token, $url)) {
                    $db['queries'][$con][$url][] = array(
                        'sql'        => $_q[$i],
                        'time'       => $_qt[$i],
                        'token'      => $token,
                        'total_used' => 1,
                    );
                }
            }

            return $db;
        }

        return null;
    }

    private function existsQuery(&$queries, $token, $url)
    {
        $con = $this->controller;

        if (isset($queries['queries_ajax'][$con][$url])) {
            foreach ($queries['queries_ajax'][$con][$url] as &$q) {
                if ($q['token'] == $token) {
                    $q['total_used'] += 1;

                    return true;
                }
            }
        }

        if (isset($queries['queries'][$con][$url])) {
            foreach ($queries['queries'][$con][$url] as &$q) {
                if ($q['token'] == $token) {
                    $q['total_used'] += 1;

                    return true;
                }
            }
        }

        return false;
    }

    private function existsUrl($url)
    {
        $con = $this->controller;
        $queries = $this->getQueries();

        if (isset($queries['queries'][$con])){
            foreach ($queries['queries'][$con] as $k => $q) {
                if ($k == $url) {
                    return true;
                }
            }
        }

        return false;
    }
}