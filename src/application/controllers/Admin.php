<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');

		require_auth_admin();
	}

	public function index()
	{

		$data['title'] = "Admin";
		$this->load->template('admin/index', $data);

	}

    public function add_package()
	{
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
			$data['title'] = "Add Package";
			$data['users'] = $this->user_model->get_all_users();
			$this->load->template('admin/add_package.php', $data);
		
		} else if($_SERVER['REQUEST_METHOD'] == "POST") {

			$this->form_validation->set_rules('deliver_to', 'Deliver To', 'trim|required');
			$this->form_validation->set_rules('tracking_id', 'Tracking ID', 'trim|required');
			$this->form_validation->set_rules('delivery_title', 'Delivery Title', 'trim|required');
			$this->form_validation->set_rules('delivery_details', 'Delivery Details', 'trim|required');
			$this->form_validation->set_rules('weight', 'Weight', 'trim|required|numeric');

			//run validation
			if ($this->form_validation->run() == FALSE) {
				//failed validations
				echo json_encode(array("response" => "failed_validations", "message" => '<div class="alert alert-danger">' . validation_errors() . '</div>' ));
			} else {

				$this->user_model->add_package(
					$this->input->post('deliver_to'), 
					$this->input->post('tracking_id'), 
					$this->input->post('delivery_title'), 
					$this->input->post('delivery_details'),
					$this->input->post('weight')
				);

				$this->session->set_userdata('package_added', 'Package has been added to the database.');

				$data['title'] = "Add Package";
				$data['users'] = $this->user_model->get_all_users();
				$this->load->template('admin/add_package.php', $data);

			}

		}

	}

}