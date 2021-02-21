<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    //loads the header, view and footer for the template   
	public function template($page, $data = array())
    {
        $this->view('templates/v1/header', $data);
        $this->view($page, $data);
        $this->view('templates/v1/footer', $data);
    }

    //loads the header, view and footer for the template
    public function admin_template($page, $data = array())
    {
        $this->view('templates/admin/header', $data);
        $this->view('templates/admin/sidebar', $data);
        $this->view('admin/' . $page, $data);
        $this->view('templates/admin/footer', $data);
    }

}