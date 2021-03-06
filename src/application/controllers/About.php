<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "About";
		//$data['load_extra_js'] = array(base_url("test.js"));

		$this->load->template('about', $data);

	}

}