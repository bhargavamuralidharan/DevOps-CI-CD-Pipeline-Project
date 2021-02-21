<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Default_controller extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Home";
		//$data['load_extra_js'] = array(base_url("test.js"));

		$this->load->template('home', $data);


	}

}
