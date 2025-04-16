<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kintai extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['kintai_access']);
    }

    public function record_clock_in($id)
    {
        return $this->kintai_access->record_clock_in($id);
    }

    public function record_clock_out($id)
    {
        return $this->kintai_access->record_clock_out($id);
    }

    public function schedule_clock_in($id, $date, $time)
    {
        return $this->kintai_access->schedule_clock_in($id, $date, $time);
    }

    public function schedule_clock_out($id, $date, $time)
    {
        return $this->kintai_access->schedule_clock_out($id, $date, $time);
    }
}
