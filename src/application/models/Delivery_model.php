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

	public function set_delivered($tracking_id) {

        $this->db->set(array('delivery_status' => 4));
		$this->db->where('tracking_id', $tracking_id);
		$this->db->update('delivery'); 

		$user = array(
			'tracking_id' => $tracking_id,
			'status' => 4);
		return $this->db->insert('delivery_status', $user);

        
    }

	public function set_dispatched($tracking_id) {

        $this->db->set(array('delivery_status' => 2));
		$this->db->where('tracking_id', $tracking_id);
		$this->db->update('delivery'); 

		$user = array(
			'tracking_id' => $tracking_id,
			'status' => 2);
		return $this->db->insert('delivery_status', $user);

    }

	public function set_in_transit($tracking_id) {

        $this->db->set(array('delivery_status' => 3));
		$this->db->where('tracking_id', $tracking_id);
		$this->db->update('delivery'); 

		$user = array(
			'tracking_id' => $tracking_id,
			'status' => 3);
		return $this->db->insert('delivery_status', $user);
   
    }

	// Get packages in transit for a particular user
	public function get_packages_in_transit($user_id) {
	
		//return $this->db->join('delivery_status', 'delivery_status.tracking_id = delivery.tracking_id')->where('delivery.user_id', $user_id)->get('delivery')->result_array();
		return $this->db->where(array('user_id' => $user_id, 'delivery_status !=' => 4))->get('delivery')->result_array();
	
	}

	// Get delivered packages for a particular user
	public function get_delivered_packages($user_id, $limit = null) {

		if($limit != null)
			return $this->db->where(array('user_id' => $user_id, 'delivery_status' => 4))->limit($limit)->get('delivery')->result_array();
		
		return $this->db->where(array('user_id' => $user_id, 'delivery_status' => 4))->get('delivery')->result_array();
	
	}
}