<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hospital_model
 *
 * @author Administrator
 */
class hospital_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function hospital_read() {
        $this->db->select('name, department.department AS depart, city, address, hospital.description AS hospital_summary, department.description AS department_summary');
        $this->db->from('hospital');
        $this->db->join('department', 'department.hospital = hospital.name');
//        $this->db->join('department', 'department.hospital = hospital.name', 'left'); // left-join
        $result_set = $this->db->get();
        return $result_set->result();
    }

    public function hospital_update() {
        
    }

    public function hospital_add() {
        
    }

    public function hospital_delete() {
        
    }
    
    public function hospital_in_city($condition){
        $this->db->select("name");
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        return $this->db->get('hospital')->result_array();  // return array
    }

    public function department_in_hospital($condition){
        $this->db->select("department");
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        return $this->db->get('department')->result_array();  // return array
    }
}
