<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();

		//redirect the user from this page if they're logged in
        require_auth();

	}

	public function index()
	{
		$data['title'] = "Dashboard";
        $this->load->template('dashboard/index', $data);
    }

}