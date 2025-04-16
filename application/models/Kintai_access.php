<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kintai_access extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('kintai_db');
    }

    private function get_data()
    {
        $query = $this->db->from('employee');
        return $query->get()->result();
    }

    /**
     * 出勤をデータベースに対して記録する。すでに同日中に出勤を押している場合は処理を行わない。
     * @param int $id 従業員id
     * @return bool   操作の成否
     */
    public function record_clock_in($id)
    {
        $query = $this->db->from('attendance_records')->where(
            ['employee_id' => $id, 'record_date' => date('Y/m/d')]
        )->get();
        //すでに同日中に出勤が押されている場合処理を受け付けない
        if ($query->num_rows() > 0) {
            return FALSE;
        }

        $this->db
            ->insert(
                'attendance_records',
                [
                    'employee_id' => $id,
                    'record_date' => date('Y/m/d'),
                    'record_start' => date('g:i')
                ]
            );

        //三項演算子か。。。
        return TRUE;
    }

    /**
     * 退勤をデータベースに対して記録する。すでに同日中に退勤を押している場合は処理を受け付けない。
     * @param int $id 従業員id
     * @return bool   操作の成否
     */
    public function record_clock_out($id)
    {
        $query = $this->db->from('attendance_records')->where([
            'employee_id' => $id,
            'record_date' => date('Y/m/d')
        ]);
        //すでに同日中に退勤が押されている場合処理を受け付けない
        $row = $query->get()->row();
        if (! empty($row->record_end)) {
            return FALSE;
        }

        return $this->db->where('employee_id', $id)->set('record_end', date('g:i'))->update('attendance_records');
    }

    /**
     * 出勤予定をデータベースに対して記録する。
     * @param int    $id 従業員id
     * @param string $date 出勤予定日
     * @param string $time 出勤予定時間 
     * @return bool        操作の成否
     */
    public function schedule_clock_in($id, $date, $time)
    {
        $query = $this->db
            ->from('attendance_schedule')
            ->where([
                'employee_id' => $id,
                'schedule_date' => $date
            ]);
        //すでに指定日について出勤時間の登録がある場合update処理を行う
        if ($query->get()->num_rows() > 0) {
            $query->set('schedule_start', $time)->update('attendance_schedule');
            return TRUE;
        } else {
            $this->db->insert('attendance_schedule', ['employee_id' => $id, 'schedule_date' => $date, 'schedule_start' => $time]);
        }

        return $this->db;
    }

    /**
     * 退勤予定をデータベースに対して記録する。
     * @param int    $id 従業員id
     * @param string $date 退勤予定日
     * @param string $time 退勤予定時間 
     * @return bool        操作の成否
     */
    public function schedule_clock_out($id, $date, $time)
    {
        $query = $this->db
            ->from('attendance_schedule')
            ->where([
                'employee_id' => $id,
                'schedule_date' => $date
            ]);
        //すでに指定日について退勤時間の登録がある場合update処理を行う
        if ($query->get()->num_rows() > 0) {
            $query->set('schedule_end', $time)->update('attendance_schedule');
        } else {
            $this->db->insert('attendance_schedule', ['employee_id' => $id, 'schedule_date' => $date, 'schedule_end' => $time]);
        }

        return $this->db;
    }
}
