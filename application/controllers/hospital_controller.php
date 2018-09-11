<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hospital_controller
 *
 * @author Administrator
 */
class hospital_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // The hospital need to join the department database
        $this->load->model('hospital_model');
        $data['records'] = $this->hospital_model->hospital_read();  // This is to group the hospital and the department view
        $this->load->view('hospital_view', $data);
    }

    public function add_hospital_view() {
        $this->load->helper('form');
        $this->load->model('city_model');
        $data['cities'] = $this->city_model->read();
        $data['selected_city'] = $data['cities'][0];
        $this->load->view('hospital_add_view', $data);
    }

    public function add_hospital() {
        $this->load->model('hospital_model');
        if ($this->input->post('add') !== null) {
            $data_array = array(
                "name" => $this->input->post('hospital_name'),
                "city" => $this->input->post('city_choose'),
                "address" => $this->input->post('address'),
                "description" => $this->input->post('description'),
                "longtitude" => $this->input->post('longtitude'),
                "latitude" => $this->input->post('latitude'),
            );
//            var_dump($data_array);
            $this->hospital_model->hospital_add($data_array);
        }
        $this->index();
    }

    public function add_department_view() {
        $this->load->helper('form');
        $this->load->model('city_model');
        $data['cities'] = $this->city_model->read();
        $data['selected_city'] = $data['cities'][0];
        $this->load->model('hospital_model');
        $condition = array(
            0 => array("column" => 'city',
                "value" => $data['cities'][0]->name,
            ),
        );
        $data['hospitals'] = $this->hospital_model->hospital_in_city($condition);
        $data['selected_hospital'] = $data['hospitals'][0];
        $this->load->view('department_add_view', $data);
    }

    public function add_department() {
        $this->load->model('hospital_model');
        if ($this->input->post('add') !== null) {
            $data_array = array(
                "department" => $this->input->post('department_name'),
                "hospital" => $this->input->post('hospital_name'),
                "description" => $this->input->post('description'),
            );
            $this->hospital_model->department_add($data_array);
        }
        $this->index();
    }

    public function update_hospital_view() {
        
    }

    public function update_hospital() {
        
    }

    public function update_department_view() {
        
    }

    public function update_department() {
        
    }

    public function delete_hospital_view() {
        $hospital_name = urldecode($this->uri->segment('2'));
        $this->load->helper('form');
        $this->load->model('hospital_model');
        $condition_array = array(
            0 => array(
                'column' => 'name',
                'value' => $hospital_name,
            ),
        );
        $data['records'] = $this->hospital_model->hospital_read_by_condition($condition_array);
        $this->load->view('hospital_delete_view', $data);
    }

    public function delete_hospital() {
        // Need to cascade delete the department, user, booking
        if (null !== $this->input->post('accept')) {
            $this->load->model('hospital_model');
            $this->hospital_model->hospital_delete($this->input->post('hospital_name'));
        }
        $this->index();
    }

    public function delete_department_view() {
        $hospital_name = urldecode($this->uri->segment('2'));
        $department_name = urldecode($this->uri->segment('3'));
        $this->load->helper('form');
        $this->load->model('hospital_model');
        $condition_array = array(
            0 => array(
                'column' => 'department.department',
                'value' => $department_name,
            ),
            1 => array(
                'column' => 'name',
                'value' => $hospital_name,
            ),
        );
        // This should limit to one record
        $data['record'] = $this->hospital_model->hospital_read_by_condition($condition_array);
        $this->load->view('department_delete_view', $data);
    }

    public function delete_department() {
        if (null !== $this->input->post("accept")) {
            $this->load->model('hospital_model');
            $condition_array = array(
                0 => array(
                    'column' => 'department',
                    'value' => $this->input->post("department_name"),
                ),
                1 => array(
                    'column' => 'hospital',
                    'value' => $this->input->post("hospital_name"),
                ),
            );
            $this->hospital_model->department_delete_by_condition($condition_array);
        }
        $this->index();
    }

    // For Ajax use
    public function response_by_city() {
        $this->load->model('hospital_model');
        $city = $this->input->post('city');
        $condition_array = array(
            0 => array(
                'column' => 'city',
                'value' => $city,
            )
        );
        $response = $this->hospital_model->hospital_in_city($condition_array);
        echo json_encode($response);
    }

    public function response_by_hospital() {
        $this->load->model('hospital_model');
        $hospital = $this->input->post('hospital');
        $condition_array = array(
            0 => array(
                'column' => 'hospital',
                'value' => $hospital,
            )
        );
        $response = $this->hospital_model->department_in_hospital($condition_array);
        echo json_encode($response);
    }

}
