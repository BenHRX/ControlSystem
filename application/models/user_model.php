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
        $this->db->select('user_id, user_name, user_access, hospital, department');
        $this->db->where('user_name', $data['user_name']);
        $this->db->where('user_pwd', $data['user_pwd']);
        $result_set = $this->db->get('doctor');
        if ($result_set->num_rows() == 1) {
            // session update
            $row = $result_set->row_array();
            $session_array = array(
                "id" => $row['user_id'],
                "user" => $row['user_name'],
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
    
    public function refresh_data($data){
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
    
    public function read_by($condition){
        $this->db->select('user_id, user_name, user_access, name, hospital, department, major, description');
        foreach($condition as $c){
            $this->db->where($c['column'], $c['value']);
        }
        $result_set = $this->db->get('doctor');
        return $result_set->result();
    }
    
    public function delete_by($condition){
        $this->db->from('doctor');
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        return($this->db->delete());
    }
    
    public function add_by($data){
        return($this->db->insert('doctor', $data));
    }

}
