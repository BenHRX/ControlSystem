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
class duty_controller extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('duty_model');
        $data['records'] = $this->duty_model->read($this->session->userdata('id'));
        $this->load->view('duty_view', $data);
    }

    public function add_duty_view() {
        // Can only control self duty
        $user_id = $this->session->userdata('id');
        $user_name = $this->session->userdata('real_name');
        $this->load->helper('form');
        $data = array(
            'user_id' => $user_id,
            'user_name' => $user_name,
        );
        $this->load->view('duty_add_view', $data);
    }

    public function add_duty() {
        if (null !== $this->input->post('add')) {
            $user_id = $this->session->userdata('id');
            $user_name = $this->session->userdata('real_name');
            $current_status = $this->input->post('status_group');
            if ($current_status !== '1') {
                $time_available = array_fill(0, 6, '0');
            } else {
                $time_available = $this->input->post('available');
            }
            $this->load->model('duty_model');
            $insert_array = array(
                'doctor_id' => $user_id,
                'doctor_name' => $user_name,
                'date' => $this->input->post('date_picker'),
                'status' => $current_status,
                'time_slot_1' => $time_available[0],
                'time_slot_2' => $time_available[1],
                'time_slot_3' => $time_available[2],
                'time_slot_4' => $time_available[3],
                'time_slot_5' => $time_available[4],
                'time_slot_6' => $time_available[5],
            );
            $this->duty_model->duty_add($insert_array);
//            $this->load->view('void');
        }
        $this->index();
    }

    public function delete_duty_view() {
        $user_id = $this->session->userdata('id');
        $user_name = $this->session->userdata('real_name');
        $this->load->helper('form');
        $this->load->model('duty_model');
        $condition = array(
            'doctor_id' => $user_id,
            'doctor_name' => $user_name,
            'date' => $this->uri->segment('2'),
        );
        $data['records'] = $this->duty_model->read_by($condition);
        $data['user_name'] = $user_name;
//        $this->load->view('void');
        $this->load->view('duty_delete_view', $data);
    }

    public function delete_duty() {
        if (null !== $this->input->post("confirm")) {
            $user_id = $this->session->userdata('id');
            $user_name = $this->session->userdata('real_name');
            $this->load->model('duty_model');
            $condition = array(
                'doctor_id' => $user_id,
                'doctor_name' => $user_name,
                'date' => $this->input->post("date"),
            );
            $this->duty_model->duty_delete($condition);
        }
        $this->index();
    }

    public function update_duty_view() {
        
    }

    public function update_duty() {
        
    }

}
