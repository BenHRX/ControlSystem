<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order_model
 *
 * @author Administrator
 */
class order_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function read($doctor_id) {
        // select * from orders join doctor on orders.doctor_id = doctor.user_id join customer on orders.user_id = customer.user_id;
        $this->db->select("order_id, orders.user_id, doctor_id, customer.name AS customer_name, customer.phone AS contact_phone, doctor.name AS doctor_name, date, time_slot, order_status");
        $this->db->from("orders");
        $this->db->join("doctor", "orders.doctor_id = doctor.user_id");
        $this->db->join("customer", "orders.user_id = customer.user_id");
        $this->db->where("doctor_id", $doctor_id);
        $result_set = $this->db->get();
        return $result_set->result();
    }

    public function add_order() {
        
    }

    public function delete_order() {
        // 订单不应该由系统这端删除, 可以开放给客户操作?
    }

    public function update_order() {
        
    }

}
