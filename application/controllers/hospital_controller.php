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

    public function add_hospital() {
        
    }

    public function update_hospital() {
        
    }

    public function delete_hospital() {
        
    }
    
    // For Ajax use
    public function response_by_city(){
        $this->load->model('hospital_model');
        $city = $this->input->post('city');
        $condition_array = array(
            0=>array(
                'column' => 'city',
                'value' => $city,
            )
        );
        $response = $this->hospital_model->hospital_in_city($condition_array);
        echo json_encode($response);
    }
    
    public function response_by_hospital(){
        $this->load->model('hospital_model');
        $hospital = $this->input->post('hospital');
        $condition_array = array(
            0=>array(
                'column' => 'hospital',
                'value' => $hospital,
            )
        );
        $response = $this->hospital_model->department_in_hospital($condition_array);
        echo json_encode($response);
    }

}
