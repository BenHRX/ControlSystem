<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of city_model
 *
 * @author Administrator
 */
class city_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function read() {
        $result_set = $this->db->get('city');
        return $result_set->result();
    }
    
    public function read_by($data){
        $this->db->from('city');
        foreach($data as $record){
            $this->db->where($record['column'],$record['value']);
        }    
        return $this->db->get()->result();
    }
    
    public function update_by($data, $condition){
        $this->db->set($data);
        foreach($condition as $c){
            $this->db->where($c['column'], $c['value']);
        }
        $this->db->update('city', $data);
    }
    
    public function add_by($data){
        if($this->db->insert('city', $data)){
            return true;
        }else{
            return false;
        }
    }
    
    public function delete_by($condition){
        $this->db->from('city');
        foreach($condition as $c){
            $this->db->where($c['column'], $c['value']);
        }
//        $string_a = $this->db->get_compiled_delete(); 
//        var_dump($string_a);
        if($this->db->delete()){
            return true;
        }else{
            return false;
        }
    }

}
