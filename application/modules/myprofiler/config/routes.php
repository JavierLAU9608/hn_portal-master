<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route = [];
if (ENVIRONMENT == 'development') {
    $route['profiler'] = "myprofiler/index";
    $route['profiler/lang'] = "myprofiler/lang";
    $route['profiler/clearAll'] = "myprofiler/clearAll";
    $route['profiler/config'] = "myprofiler/config";
    $route['profiler/email'] = "myprofiler/email";
    $route['profiler/mailshow'] = "myprofiler/mailshow";
    $route['profiler/clearqueries'] = "myprofiler/clearqueries";
    $route['profiler/clearmails'] = "myprofiler/clearmails";
    $route['profiler/clearlangs'] = "myprofiler/clearlangs";
    $route['profiler/preference'] = "myprofiler/preference";
    $route['profiler/resumen'] = "myprofiler/resumen";
}
