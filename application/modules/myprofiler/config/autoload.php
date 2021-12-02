<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload = [];
if (ENVIRONMENT == 'development') {
    $autoload['helper'] = array('profiler');
    $autoload['libraries'] = array('profiler/MyProfilerLib');
    $autoload['config'] = array('myprofiler');
}