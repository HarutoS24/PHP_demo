<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('Api_Base.php');
class Kintai extends Api_Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['kintai_access']);
    }

    public function get_kintai_calendar()
    {
        $result = $this->kintai_access->get_kintai_calendar();

        return $this->_get_output($result);
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
