<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_Base extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
    }

    protected function _get_output($response)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
