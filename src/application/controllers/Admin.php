<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;

class Admin extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		require_auth_admin();
		
		$this->load->model('user_model');
		$this->load->model('delivery_model');

		$this->load->view('admin/admin_bar');
	}

	public function index()
	{

		$data['title'] = "Admin";
		$data['packages'] = $this->delivery_model->get_all_packages(10);
		$data['delivery_status_titles'] = $this->delivery_model->get_delivery_status_titles();

		$data['user_count'] = count($this->user_model->get_all_users_reg());
		$data['staff_count'] = count($this->user_model->get_all_staff());
		$data['packages_in_transit'] = count($this->delivery_model->get_all_packages_in_transit());
		$this->load->template('admin/index', $data);

	}

	public function server_info() {
		$this->load->view('admin/server_info.php');
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

				if(isset($send_to_sms)){
					// Twilio API
					$account_sid = 'AC4427e94dec1fa3d62e95c1ed7c3a30f9';
					$auth_token = 'b53a1481fcedb2d606c15615f7bda7f4';
					$twilio_number = "+14422410184";

					$client = new Client($account_sid, $auth_token);
					$client->messages->create(
						// Where to send a text message (your cell phone?)
						'+14372262440',
						array(
							'from' => $twilio_number,
							'body' => 'I sent this message in under 10 minutes!'
						)
					);
				}


				$data['title'] = "Add Package";
				$data['users'] = $this->user_model->get_all_users();
				$this->load->template('admin/add_package.php', $data);

			}

		}

	}

	public function manage_packages()
	{
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
			$data['title'] = "Manage Packages";
			$data['packages'] = $this->delivery_model->get_all_packages();
			$data['delivery_status_titles'] = $this->delivery_model->get_delivery_status_titles();

			$this->load->template('admin/manage_packages.php', $data);
		
		}
	}

	public function package($tracking_id)
	{
		if($tracking_id != null) {

			$package = $this->delivery_model->get_package_by_id($tracking_id);

			if($package) {
				$data['title'] = "Track your package";
				$data['user_address'] = $this->user_model->get_user_address_by_id($this->session->user_id);
				$data['package'] = $package;
				$data['delivery_address'] = $this->user_model->get_user_address_by_id($package[0]['user_id']);
				$data['current_status'] = $this->delivery_model->get_current_status($tracking_id);
				$data['delivery_status'] = $this->delivery_model->get_delivery_status_by_tracking_id($tracking_id);
				$data['delivery_status_titles'] = $this->delivery_model->get_delivery_status_titles();

				$data['load_extra_js'] = array(base_url('resources/js/admin_package.js'));

				$this->load->template('admin/package', $data);
			} else {
				redirect('admin');
			}
		} else {
			redirect('admin');
		}
	}

	public function update_tracking($endpoint = null)
	{

		$tracking_id = $this->input->post('tracking_id');

		if($endpoint != null) {

			$package = $this->delivery_model->get_package_by_id($tracking_id);

			if($package) {
				if($endpoint == 'delivered') {
					$this->delivery_model->set_delivered($tracking_id);
					echo json_encode(array("response" => "success"));
				} else if($endpoint == 'in_transit') {
					$this->delivery_model->set_in_transit($tracking_id);
					echo json_encode(array("response" => "success"));
				} else if($endpoint == 'dispatch') {
					$this->delivery_model->set_dispatched($tracking_id);
					echo json_encode(array("response" => "success"));
				}
			} else {
				echo json_encode(array("response" => "error", "message" => "An error occured. Please try again later." ));
			}
		} else {
			echo json_encode(array("response" => "error", "message" => "An error occured. Please try again later." ));
		}
	}

	public function users() {
		$data['title'] = "Manage Users";

		$data['staff'] = $this->user_model->get_all_staff();
		$data['users'] = $this->user_model->get_all_users_reg();
		$this->load->template('admin/users', $data);
	}

}