<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of duty_controller
 *
 * @author Administrator
 */
class duty_controller extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->model('duty_model');
        $data['records'] = $this->duty_model->read($this->session->userdata('id'));
        $this->load->view('duty_view', $data);
    }
}
