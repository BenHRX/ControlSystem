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
        $this->db->join('department', 'department.hospital = hospital.name');    // Whether need to use left join?
//        $this->db->join('department', 'department.hospital = hospital.name', 'left'); // left-join
        $result_set = $this->db->get();
        return $result_set->result();
    }

    public function hospital_read_by_condition($condition) {
        $this->db->select('name, department.department AS depart, city, address, hospital.description AS hospital_summary, department.description AS department_summary');
        $this->db->from('hospital');
        $this->db->join('department', 'department.hospital = hospital.name', 'left');
        foreach($condition as $c){
            $this->db->where($c['column'], $c['value']);
        }
        $result_set = $this->db->get();
        return $result_set->result();
    }

    public function hospital_update() {
        
    }

    public function hospital_add($data) {
        return($this->db->insert('hospital', $data));
    }

    public function department_add($data) {
        return($this->db->insert('department', $data));
    }

    public function hospital_delete($hospital_name) {
        // just one condition should be here - hospital name
        // Here should also delete the coresponding user / booking ??
        $delete_array = array(
           0=>array(
               'column' => 'hospital',
               'value' => $hospital_name,
           ),
        );
        if(!$this->department_delete_by_condition($delete_array)){
            return false;
        }
        $this->db->from('hospital');
        $this->db->where('name', $hospital_name);
//        var_dump($this->db->get_compiled_delete());
        return($this->db->delete());
    }
       
    public function department_delete_by_condition($condition){
        // Intent to use 1 condition only for deleting the whole hospital. if need to delete whole hospital department, use hospital name as condition
        $this->db->from('department');
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
//        var_dump($this->db->get_compiled_delete());
        return($this->db->delete());
    }

    public function hospital_in_city($condition) {
        $this->db->select("name");
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        return $this->db->get('hospital')->result_array();  // return array
    }

    public function department_in_hospital($condition) {
        $this->db->select("department");
        foreach ($condition as $c) {
            $this->db->where($c['column'], $c['value']);
        }
        return $this->db->get('department')->result_array();  // return array
    }

}
