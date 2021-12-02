<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload = [];
if (ENVIRONMENT == 'development') {
    $autoload['config'] = array('pasarela');
}