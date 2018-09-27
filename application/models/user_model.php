<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author Administrator
 */
class user_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function match($data) {
        $this->db->select('user_id, user_name, user_access, name, hospital, department');
        $this->db->where('user_name', $data['user_name']);
        $this->db->where('user_pwd', $data['user_pwd']);
        $result_set = $this->db->get('doctor');
        if ($result_set->num_rows() == 1) {
            // session update
            $row = $result_set->row_array();
            $session_array = array(
                "id" => $row['user_id'],
                "user" => $row['user_name'],
                "real_name" => $row['name'],
                "access_right" => $row['user_access'],
                "user_hospital" => $row['hospital'],
                "user_department" => $row['department'],
            );
            $this->session->set_userdata($session_array);
            return true;
        } else {
            return false;
        }
    }

    public function list_user($data) {
        $this->db->select('user_id, user_name, user_access, name, hospital, department, major, description');
        $this->db->where('user_name', $data['user_name']);
        $this->db->where('user_pwd', $data['user_pwd']);
        $result_set = $this->db->get('doctor');
        $row = $result_set->row_array();

        if ($row['user_access'] == 9) {
            $this->db->select('user_id, user_name, user_access, name, hospital, department, major, description');
            $result_set = $this->db->get('doctor');
        }
        return $result_set->result();
    }

    public function refresh_data($data) {
        $this->db->select('user_id, user_name, user_access, name, hospital, department, major, description');
        $this->db->where('user_name', $data['user_name']);
        $result_set = $this->db->get('doctor');
        $row = $result_set->row_array();

        if ($row['user_access'] == 9) {
            $this->db->select('user_id, user_name, user_access, name, hospital, department, major, description');
            $result_set = $this->db->get('doctor');
        }
        return $result_set->result();
    }

    public function read_by($condition) {
        $this->db->select('user_id, user_name, user_access, name, hospital, department, major, description');
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        $result_set = $this->db->get('doctor');
        return $result_set->result();
    }

    public function delete_by($condition) {
        $this->db->from('doctor');
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        return($this->db->delete());
    }

    public function add_by($data) {
        return($this->db->insert('doctor', $data));
    }

    public function update_by($data, $condition) {
        $this->db->set($data);
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
        return($this->db->update('doctor'));
    }

    public function get_user_by_condition($condition) {
        $this->db->from('doctor');
        $this->db->join('duty', 'doctor.user_id = duty.doctor_id');
        $this->db->select('doctor.user_id AS userId, name, hospital, department, major, photo_path, description, duty.date AS duty_date, duty.status AS status, duty.time_slot_1 AS period1, duty.time_slot_2 AS period2, duty.time_slot_3 AS period3, duty.time_slot_4 AS period4, duty.time_slot_5 AS period5, duty.time_slot_6 AS period6');
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
        return($this->db->get()->result_array());
    }

    public function get_city_user_info($condition) {
        $this->db->from('doctor');
        $this->db->join('hospital', 'doctor.hospital = hospital.name');
        $this->db->select('doctor.user_id AS userId, doctor.name AS real_name, hospital, department, major, photo_path, doctor.description AS doctor_summary, hospital.city AS city');
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
        return($this->db->get()->result_array());
    }

    public function get_user_period_duty($condition, $no_date_condition) {
        $this->db->from('doctor');
        $this->db->join('duty', 'doctor.user_id = duty.doctor_id', 'left');
        $this->db->select('doctor.user_id AS userId, name, hospital, department, major, photo_path, description, duty.date AS duty_date, duty.status AS status, duty.time_slot_1 AS period1, duty.time_slot_2 AS period2, duty.time_slot_3 AS period3, duty.time_slot_4 AS period4, duty.time_slot_5 AS period5, duty.time_slot_6 AS period6');
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
        $result_set = $this->db->get()->result_array();
        if (count($result_set) !== 0) {
            return $result_set;
        } else {
            $this->db->from('doctor');
            $this->db->join('duty', 'doctor.user_id = duty.doctor_id', 'left');
            $this->db->select('doctor.user_id AS userId, name, hospital, department, major, photo_path, description, duty.date AS duty_date, duty.status AS status, duty.time_slot_1 AS period1, duty.time_slot_2 AS period2, duty.time_slot_3 AS period3, duty.time_slot_4 AS period4, duty.time_slot_5 AS period5, duty.time_slot_6 AS period6');
            foreach ($no_date_condition as $key => $value) {
                $this->db->where($key, $value);
            }
            return $this->db->get()->result_array();
        }
    }

}
