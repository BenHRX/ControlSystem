<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of city_control
 *
 * @author Administrator
 */
class city_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("city_model");
        $data['cities'] = $this->city_model->read();
        $this->load->view("city_view", $data);
    }

    public function add_city_view() {
        $this->load->helper('form');
        $this->load->view('city_add_view');
    }

    public function add_city() {
        $add_array = array(
            'name' => $this->input->post('city_name'),
        );
        $this->load->model('city_model');
        $this->city_model->add_by($add_array);
        $this->index();
    }

    public function update_city_view() {
        $city_name = urldecode($this->uri->segment('2'));
        $this->load->model("city_model");
        $data_array = array(
            0 => array('column' => 'name',
                'value' => $city_name)
        );
        $data['cities'] = $this->city_model->read_by($data_array);
//        var_dump($data);
        $this->load->helper('form');
        $this->load->view('city_update_view', $data);
    }

    public function update_city() {
        $this->load->model("city_model");
        $update_array = [
            'name' => $this->input->post('city_name'),
        ];
        $condition = [
            0 => ['column' => 'name',
                'value' => $this->input->post('old_city_name'),
            ],
        ];
        $this->city_model->update_by($update_array, $condition);
        $this->index();
    }

    public function delete_city_view() {
        $city_name = urldecode($this->uri->segment('2'));
        $this->load->model("city_model");
        $data_array = array(
            0 => array('column' => 'name',
                'value' => $city_name)
        );
        $data['cities'] = $this->city_model->read_by($data_array);
//        var_dump($data);
        $this->load->helper('form');
        $this->load->view('city_delete_view', $data);
    }

    public function delete_city() {
        if (null !== $this->input->post('delete')) {
            $this->load->model('city_model');
            $condition = array(
                0 => array(
                    'column' => 'name',
                    'value' => $this->input->post('city_name'),
                )
            );
            $this->city_model->delete_by($condition);
        }
        $this->index();
    }

    // For Ajax or Wechat request using data
    public function response_city_list() {
        $this->load->model('city_model');
        $response = $this->city_model->read();
        echo json_encode($response);
    }

}
