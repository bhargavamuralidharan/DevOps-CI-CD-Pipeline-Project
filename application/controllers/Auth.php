<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		// load user model
		$this->load->model('user_model');
	}

	public function index()
	{
		//redirect the user from this page if they're logged in
		if($this->session->logged_in == TRUE)
			redirect('/');

		$data['title'] = "Login";

		$this->load->template('auth/login', $data);
	}

	public function login(){
		//set validation requirements
		$this->form_validation->set_rules('username', 'Username/Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="danger-alert"><i class="fas fa-exclamation-triangle"></i> ', '</div>');

		//run validation
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Login";
			$this->load->template('auth/login', $data); //failed validations
		} else {
			$result = $this->user_model->get_account($this->input->post('username'));

			if($result)
			{
				//check if passwords match
				if(password_verify($this->input->post('password'), $result[0]['password']))
				{
					//set session variables
					$this->session->set_userdata('logged_in', TRUE);
					$this->session->set_userdata('user_id', $result[0]['id']);
					$this->session->set_userdata('username', $result[0]['username']);
					$this->session->set_userdata('email', $result[0]['email']);
					$this->session->set_userdata('password', $result[0]['password']);

					if($result[0]['verified'] == false) {
						$this->session->set_userdata('unverified', true);
					}

					redirect('dashboard');
				} else {
					//login credentials invalid
					$data['title'] = "Login";
					$data['error_message'] = '<i class="fas fa-exclamation-triangle"></i> Sorry, login credentials invalid.';
					$this->load->template('auth/login', $data);
				}
			} else {
				//server error, data was not passed to model
				$data['title'] = "Login";
				$data['error'] = '<i class="fas fa-exclamation-triangle"></i> Sorry, there was an issue while logging in. (Er: 2)';
				$this->load->template('auth/login', $data);
			}
		}
	}

	public function register_action(){
		//set validation requirements
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('lname', 'Last name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]|valid_email', array('is_unique' => 'That %s is already in use. Please pick another.'));
		$this->form_validation->set_rules('phone', 'Telephone', 'trim|required|min_length[10]|numeric', array('numeric' => 'Please only include numbers in this field (no spaces or hyphens).'));
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('zip', 'Zipcode', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', array('is_unique' => 'That %s is already in use. Please pick another.'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm-password', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="danger-alert"><i class="fas fa-exclamation-triangle"></i> ', '</div>');

		//run validation
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Create New Account";
			$data['load_extra_js_header'] = array(base_url("resources/js/countries.js"));
			$this->load->template('auth/register', $data); //failed registration
		} else {
			//registration successful
			$data['title'] = "Login";
			$data['reg_success'] = "Registration successful. Please check your email (" . $this->input->post('email') . ")";
			$this->user_model->register_account(
				$this->input->post('title'),
				$this->input->post('fname'),
				$this->input->post('lname'),
				$this->input->post('email'),
				$this->input->post('phone'),
				$this->input->post('company'),
				$this->input->post('address'),
				$this->input->post('country'),
				$this->input->post('state'),
				$this->input->post('city'),
				$this->input->post('zip'),
				$this->input->post('username'),
				$this->input->post('password')
			);
			
			$hash = random_str(12);

			$data['load_extra_js_header'] = array(base_url("resources/js/countries.js"));
			$this->session->set_flashdata('account_created', 'Your account has been created. Please check your email for confirmation.');
			$this->load->template('auth/login', $data);

			$this->email->from('no-reply@app.com', 'AppName');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Verify Your Account');
			$this->email->message(default_email_template(
				'Thank you for signing up for Kebanas. Please click the button below to verify your account.<br><br>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td bgcolor="#EB7035" style="padding: 12px 18px 12px 18px; border-radius:3px" align="center">
								<a href="'.base_url('verify/account/'.$hash).'" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; display: inline-block;">Verify Account &rarr;</a></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				
				<br><br>

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									If the link above doesn\'t work, please copy the following link into your browser\'s address bar:
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
								'.base_url('verify/account/'.$hash).'
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				<br><br>

			'));

			$this->email->set_mailtype('html');

			$this->email->send();
		}
	}

	// Account registration
	public function register(){
		//redirect the user from this page if they're logged in
		if($this->session->logged_in == TRUE)
			redirect('/');

		$data['title'] = "Create New Account";
		$this->load->template('auth/register', $data);
	}

	// Account recovery 
	public function account_recovery($test = null){
		//redirect the user from this page if they're logged in
		if($this->session->logged_in == TRUE)
			redirect('/');

		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$data['title'] = "Recover Your Account";
			$data['navbar_transparent'] = true;
			$this->load->template('auth/account_recovery', $data);
		} else if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_error_delimiters('<div class="danger-alert"><i class="fas fa-exclamation-triangle"></i> ', '</div>');

			//run validation
			if ($this->form_validation->run() == FALSE) {
				$data['title'] = "Account Recovery";
				$data['navbar_transparent'] = true;
				$this->load->template('auth/account_recovery', $data); //failed registration
			} else {
				
				$check_email = $this->user_model->check_email($this->input->post('email'));

				if($check_email > 0) {

					$check_recoveries = $this->user_model->check_recoveries($this->input->post('email'));

					if($check_recoveries == 0) {
						$slug = random_str(20);
						$this->user_model->add_recovery_request($this->input->post('email'), $slug);
					}
				}

				$data['title'] = "Recover Your Account";
				$data['navbar_transparent'] = true;
				$data['response'] = "If your email address exists in our system you will get an email shortly with instructions on how to recover your account.";
				$this->load->template('auth/account_recovery', $data);
			}
		}
		
	}

	public function logout()
	{
		//destroy all session data
		$this->session->sess_destroy();
		$_SESSION = array();

		redirect('/auth');
	}

}
