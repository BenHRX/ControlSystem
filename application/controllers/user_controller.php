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
//            var_dump($queue_data);
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

    public function update_user_view($id = null) {
        if ($id == null) {
            $user_id = $this->uri->segment('2');
        } else {
            $user_id = $id;
        }

        $this->load->model("user_model");
        $this->load->helper('form');

        $data_array = array(
            0 => array('column' => 'user_id',
                'value' => $user_id),
        );
        $data['records'] = $this->user_model->read_by($data_array);

        $this->load->model("hospital_model");
        $data['hospitals'] = $this->hospital_model->hospital_in_city(null);
        $this->load->model("hospital_model");

        $condition = array(
            0 => array(
                'column' => 'hospital',
                'value' => $data['records'][0]->hospital,
            ),
        );
        $data['departments'] = $this->hospital_model->department_in_hospital($condition);

        $this->load->view('user_update_view', $data);
    }

    public function update_user() {
        if (null === $this->input->post("update")) {
            $this->index();
            return;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm_pwd', "Confirm password", "required", array('required' => 'You must provide a %s'));
        if ($this->form_validation->run() == FALSE) {
            $this->update_user_view($this->input->post('user_id'));
        } else {
            $this->load->model('user_model');
            // validate current user, refresh session??
            $data = array(
                "user_name" => $this->session->userdata("user"),
                "user_pwd" => $this->input->post("confirm_pwd"),
            );
            if ($this->user_model->match($data)) {
                // Set update data
                $data_set = array(
                    "name" => $this->input->post("new_real_name"),
                    "hospital" => $this->input->post("hospital_list"),
                    "department" => $this->input->post("department_list"),
                    "major" => $this->input->post("new_major"),
                    "description" => $this->input->post("new_description"),
                );
                $condition = array(
                    "user_id" => $this->input->post("user_id"),
                );
                $this->user_model->update_by($data_set, $condition);
            }
        }
        $this->index();
    }

    public function add_user_view() {
        // This is for testing
        $this->load->helper('form');
        $this->load->model('city_model');
        $data['cities'] = $this->city_model->read();
        $this->load->view('user_add_view', $data);
    }

    public function add_user() {
//        print_r($_POST);
        if (null !== $this->input->post('confirm')) {
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

    // For wechat program
    public function get_user_info() {
        // This is to get the user info by many conditions
        $raw_date = $this->input->post('date');
        $year_index = strpos($raw_date, '年');
        $month_index = strpos($raw_date, '月');
        $day_index = strpos($raw_date, '日');
        $clean_date = substr($raw_date, 0, 4) . "-" .
                substr($raw_date, $month_index - 2, 2) . "-" .
                substr($raw_date, $day_index - 2, 2);
        if (null === $this->input->post('hospital') && null === $this->input->post('department')) {
            $condition_array = array(
                'duty.date' => $clean_date,
            );
        } else {
            $condition_array = array(
                'hospital' => $this->input->post('hospital'),
                'department' => $this->input->post('department'),
                'duty.date' => $clean_date,
            );
        }
        $this->load->model('user_model');
        $data_array = $this->user_model->get_user_by_condition($condition_array);
        echo json_encode($data_array);
    }

    /* This function is get the list by city position only */
    /* Expect the doctor list in this city */
    public function get_user_by_city() {
        $condition_array = array(
            'hospital.city' => $this->input->post('city_name'),
            'user_access !=' => 9,
        );
        $this->load->model('user_model');
        $data_array = $this->user_model->get_city_user_info($condition_array);
        echo json_encode($data_array);
    }
    
    public function get_user_duty_by_period(){
        $condition_array = array(
            'name' => $this->input->post('doctor_name'),
            'doctor.user_id' => $this->input->post('doctor_id'),
            'duty.date >=' => $this->input->post('start_date'),
            'duty.date <=' => $this->input->post('end_date'),
        );
        $another_array = array(
            'name' => $this->input->post('doctor_name'),
            'doctor.user_id' => $this->input->post('doctor_id'),            
        );
        $this->load->model('user_model');
        $data_array = $this->user_model->get_user_period_duty($condition_array, $another_array);
        echo json_encode($data_array);
    }

}
