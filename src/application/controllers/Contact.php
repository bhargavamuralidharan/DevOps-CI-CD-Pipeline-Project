<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index() {

		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
			$data['title'] = "Send Us A Message";
			$data['load_extra_js'] = array(base_url('resources/js/contact.js'));
			$this->load->template('contact', $data);

		} else if($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[20]');

			//run validation
			if ($this->form_validation->run() == FALSE) {
				//failed validations
				echo json_encode(array("response" => "failed_validations", "message" => '<div class="alert alert-danger">' . validation_errors() . '</div>' ));
			} else {

				$content = 
					'<b>Name: </b>'. $this->input->post('name') . '<br><br>' .
					'<b>Email: </b>'. $this->input->post('email') . '<br><br>' .
					'<b>Subject: </b>'. $this->input->post('subject') . '<br><br>' .
					'<b>Message: </b>'. strip_tags(html_entity_decode($this->input->post('message'))). '<br><br>';

				$this->email->from('no-reply@kebanas.com', 'Kebanas Contact Form');
				$this->email->to('contact@kebanas.com');
				$this->email->reply_to($this->input->post('email'));
				$this->email->subject('Contact Form Message: ' . $this->input->post('subject'));
				$this->email->message($content);
				$this->email->set_mailtype('html');
				$this->email->send();

				echo json_encode(array("response" => "ok", "message" => '<div class="alert alert-success">Thank you, your message has been sent. We\'ll get back to you as soon as possble.</div>'));
			}
		}

	}

	public function submit() {
		
	}

}