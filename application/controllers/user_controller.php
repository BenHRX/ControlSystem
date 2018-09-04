<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_controller
 *
 * @author Administrator
 */
class user_controller extends CI_Controller {

    // This class data need to store into the session
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $session_user = $this->session->userdata('user');
        if (isset($session_user)) {
            $data = array(
                "user_name" => $this->session->userdata("user"),
            );
            $this->load->model('user_model');
            $queue_data['records'] = $this->user_model->refresh_data($data);
            $this->load->view('user_info_view', $queue_data);
        } else {
            $this->user_login();
        }
    }

    public function user_login() {
        $this->load->helper('form');
        $this->load->view('user_login_view');
    }

    public function user_login_check() {
        $this->load->model('user_model');
        $data = array(
            "user_name" => $this->input->post("user_name"),
            "user_pwd" => $this->input->post("user_pwd"),
        );
        if ($this->user_model->match($data)) {        // match
            $queue_data['records'] = $this->user_model->list_user($data);
            var_dump($queue_data);
            $this->load->view('user_info_view', $queue_data);
        } else {
            $queue_data['error'] = 'Access Denied';
            $this->load->helper('form');        // Use CI defined form then need this
            $this->load->view('user_login_view', $queue_data);
        }
    }

    public function delete_user_view() {
        $user_id = $this->uri->segment('2');

        $this->load->model("user_model");
        $data_array = array(
            0 => array('column' => 'user_id',
                'value' => $user_id),
        );
        $data['records'] = $this->user_model->read_by($data_array);
        $this->load->helper('form');
        $this->load->view('user_delete_view', $data);
    }

    public function delete_user() {
        if (null !== $this->input->post('delete')) {
            $user_id = $this->input->post('user_id');
            $this->load->model("user_model");
            $data_array = array(
                0 => array('column' => 'user_id',
                    'value' => $user_id),
            );
            $this->user_model->delete_by($data_array);
        }
        $this->index();
    }
    
    public function add_user_view(){
        // This is for testing
        $this->load->helper('form');
        $this->load->model('city_model');
        $data['cities'] = $this->city_model->read();
        $this->load->view('user_add_view', $data);
    }
    
    public function add_user(){
        print_r($_POST);
        if(null !== $this->input->post('confirm')){
            $data_input = array(
                'user_name' => $this->input->post('user_name'),
                'user_pwd' => $this->input->post('user_password'),
                'user_access' => $this->input->post('user_access'),
                'name' => $this->input->post('name'),
                'department' => $this->input->post('department'),
                'hospital' => $this->input->post('hospital'),
                'major' => $this->input->post('major'),
                'description' => $this->input->post('description'),
            );
            $this->load->model('user_model');
            $this->user_model->add_by($data_input);
        }
        $this->index();
    }

}
