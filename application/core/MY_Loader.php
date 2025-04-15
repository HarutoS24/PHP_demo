<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class MY_Loader extends CI_Loader {
    public $uri;
    public $benchmark;
    public $hooks;
    public $config;
    public $log;
    public $utf8;
    public $router;
    public $output;
    public $security;
    public $input;
    public $lang;
    public $load;
    public $db;
}