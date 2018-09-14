<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of duty_model
 *
 * @author Administrator
 */
class duty_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function read($user_id) {
        $this->db->where('doctor_id', $user_id);
        $result_set = $this->db->get('duty');
        return $result_set->result();
    }

    public function read_by($condition) {
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
//        var_dump($this->db->get_compiled_select('duty'));
        return($this->db->get('duty')->result());
    }

    public function duty_add($data) {
        return($this->db->insert('duty', $data));
    }

    public function duty_delete($condition) {
        $this->db->from("duty");
        foreach ($condition as $key => $value) {
            $this->db->where($key, $value);
        }
//        var_dump($this->db->get_compiled_delete());
        return($this->db->delete());
    }

    public function duty_update() {
        
    }

}
