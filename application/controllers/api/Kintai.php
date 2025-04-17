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

    public function exists_clock_in($id)
    {
        if (!empty($id)) {
            $result = $this->kintai_access->exists_clock_in($id);

            return $this->_get_output($result);
        }
    }

    public function exists_clock_out($id)
    {
        if (!empty($id)) {
            $result = $this->kintai_access->exists_clock_out($id);

            return $this->_get_output($result);
        }
    }

    public function record_clock_in($id)
    {
        if (!empty($id)) {
            return $this->kintai_access->record_clock_in($id);
        }
    }

    public function record_clock_out($id)
    {
        if (!empty($id)) {
            return $this->kintai_access->record_clock_out($id);
        }
    }

    public function schedule_register($id, $date, $in, $out)
    {
        if ($date < date('Y-m-d')) {
            return FALSE;
        }

        if (!empty($id) and !empty($date) and !empty($in) and !empty($out)) {
            return $this->kintai_access->schedule_clock_in($id, $date, $in) and $this->kintai_access->schedule_clock_out($id, $date, $out);
        }
    }

    public function schedule_clock_out($id, $date, $time)
    {
        if (!empty($id) and !empty($date) and !empty($time)) {
            return $this->kintai_access->schedule_clock_out($id, $date, $time);
        }
    }

    public function schedule_remove($id, $date)
    {
        if (!empty($id) and !empty($date)) {
            return $this->kintai_access->schedule_remove($id, $date);
        }
    }

    public function record_remove($id)
    {
        if (!empty($id)) {
            return $this->kintai_access->record_remove($id);
        }
    }
}
