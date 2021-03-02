<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_delivery_status_titles() {

        return $this->db->get('delivery_status_title')->result_array();
        
    }

}