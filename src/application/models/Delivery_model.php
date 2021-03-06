<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_current_status($tracking_id) {
		return $this->db->where('tracking_id', $tracking_id)->order_by('d_date', 'DESC')->limit(1)->get('delivery_status')->result_array();
	}

    public function get_delivery_status_titles() {

        return $this->db->get('delivery_status_title')->result_array();
        
    }

	public function get_delivery_status_by_tracking_id($tracking_id) {

        return $this->db->where('tracking_id', $tracking_id)->order_by('d_date', 'DESC')->get('delivery_status')->result_array();
        
    }

	public function get_package_by_id($tracking_id) {

		return $this->db->join('delivery_status', 'delivery_status.tracking_id = delivery.tracking_id')
				->where('delivery.tracking_id', $tracking_id)
				->get('delivery')
				->result_array();

	}

	public function get_all_packages($limit = null) {

		if($limit != null)
			return $this->db->join('user', 'user.id = delivery.user_id')
				->limit($limit, 0)
				->get('delivery')
				->result_array();

		return $this->db->join('user', 'user.id = delivery.user_id')
			->get('delivery')
			->result_array();
	}

}