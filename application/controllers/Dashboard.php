<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();

		//redirect the user from this page if they're not logged in
        require_auth();

		$this->load->model('user_model');

	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['user_address'] = $this->user_model->get_user_address_by_id($this->session->user_id);

        $this->load->template('dashboard/index', $data);
    }

	// Updates the user's password
	public function update_password() {

		require_auth_ajax();

		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
		$this->form_validation->set_error_delimiters('', '');

		//run validation
		if ($this->form_validation->run() == FALSE) {
			//failed validations
			echo json_encode(array("response" => "failed_validations", "message" => validation_errors() ));
		} else {
			// passed validations
			
			$result = $this->user_model->get_account($this->session->username);
			
			if($result)
			{
				//check if passwords match
				if(password_verify($this->input->post('old_password'), $result[0]['password']))
				{
					$this->user_model->update_password($this->input->post('new_password'));
					echo json_encode(array("response" => "success", "message" => "Your password has been changed." ));
				} else {
					echo json_encode(array("response" => "old_password_error", "message" => "The old password you entered is incorrect." ));
				}
			} else {
				echo json_encode(array("response" => "error", "message" => "An error occured." ));
			}
		}
	}

}