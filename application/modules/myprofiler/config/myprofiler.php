<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [];
if (ENVIRONMENT == 'development') {
    $config['profiler_visible_bar'] = "none"; // block, none
    $config['profiler_userguide_url'] = "http://localhost/user_guide3/";
    $config['profiler_panel_url'] = "http://localhost:81/H-Nacional/panel/web/";
}
