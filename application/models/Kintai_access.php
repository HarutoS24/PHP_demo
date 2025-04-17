<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kintai_access extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('kintai_db');
    }

    public function get_kintai_calendar()
    {
        $query = $this->db
            ->from('employee')
            ->join('attendance_schedule', 'employee.id=attendance_schedule.employee_id', 'left')
            ->join('attendance_records', 'employee.id=attendance_records.employee_id AND schedule_date=record_date', 'left');
        $result = $query->get()->result();

        $time_dic = [
            'schedule_start',
            'schedule_end',
            'record_start',
            'record_end',
        ];

        foreach ($result as $row) {
            foreach ($time_dic as $name) {
                if (! empty($row->$name)) {
                    $row->$name = substr($row->$name, 0, 5);
                }
            }
        }

        return $result;
    }

    public function exists_clock_in($id)
    {
        $query = $this->db->from('attendance_records')->where(
            ['employee_id' => $id, 'record_date' => date('Y-m-d'), 'record_start!=' => NULL]
        )->get();

        return $query->num_rows() > 0;
    }

    public function exists_clock_out($id)
    {
        $query = $this->db->from('attendance_records')->where([
            'employee_id' => $id,
            'record_date' => date('Y-m-d')
        ]);

        $row = $query->get()->row();
        return ! empty($row->record_end);
    }

    /**
     * 出勤をデータベースに対して記録する。すでに同日中に出勤を押している場合は処理を行わない。
     * @param int $id 従業員id
     * @return bool   操作の成否
     */
    public function record_clock_in($id)
    {
        $query = $this->db->from('attendance_records')->where(
            ['employee_id' => $id, 'record_date' => date('Y-m-d'), 'record_start!=' => NULL]
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
                    'record_date' => date('Y-m-d'),
                    'record_start' => date('g:i')
                ]
            );

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
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
            'record_date' => date('Y-m-d')
        ]);
        //すでに同日中に退勤が押されている場合処理を受け付けない
        $row = $query->get()->row();
        if (! empty($row->record_end)) {
            return FALSE;
        }

        $this->db->where('employee_id', $id)->set('record_end', date('g:i'))->update('attendance_records');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
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
        $data = [
            'employee_id' => $id,
            'schedule_date' => $date
        ];
        $query = $this->db
            ->from('attendance_schedule')
            ->where([
                'employee_id' => $id,
                'schedule_date' => $date
            ]);
        //すでに指定日について出勤時間の登録がある場合update処理を行う
        if ($query->get()->row()) {
            $this->db
                ->from('attendance_schedule')
                ->where($data)->set('schedule_start', $time)->update('attendance_schedule');

            return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        } else {
            $this->db->insert('attendance_schedule', ['employee_id' => $id, 'schedule_date' => $date, 'schedule_start' => $time]);

            return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        }
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
        $data = [
            'employee_id' => $id,
            'schedule_date' => $date
        ];
        $query = $this->db
            ->from('attendance_schedule')
            ->where($data);
        //すでに指定日について退勤時間の登録がある場合update処理を行う
        if ($query->get()->num_rows() > 0) {
            $this->db
                ->from('attendance_schedule')
                ->where($data)->set('schedule_end', $time)->update('attendance_schedule');

            return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        } else {
            $this->db->insert('attendance_schedule', ['employee_id' => $id, 'schedule_date' => $date, 'schedule_end' => $time]);

            return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        }

        return $this->db;
    }

    /**
     * データベースからシフトを削除する。
     * 今日を含めてそれ以前の日付については編集できない。
     * @param int    $id 従業員id
     * @param string $date 退勤予定日
     * @return bool        操作の成否
     */
    public function schedule_remove($id, $date)
    {
        $query = $this->db
            ->from('attendance_schedule')
            ->where([
                'employee_id' => $id,
                'schedule_date' => $date
            ])->delete();

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function record_remove($id)
    {
        $this->db->where([
            'record_date' => date('Y-m-d')
        ])->from('attendance_records')->delete();

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
