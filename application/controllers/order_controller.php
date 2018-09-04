<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order_controller
 *
 * @author Administrator
 */
class order_controller extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $doctor_id = $this->session->userdata('id');
        $this->load->model('order_model');
        $data['records'] = $this->order_model->read($doctor_id);
        $this->load->view('order_view', $data);
    }
    
}
