<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//get the data for a specific account
	public function get_account($username){

		return $this->db->where('username', $username)->get('user')->result_array();

	}

	public function register_account($title, $fname, $lname, $email, $phone, $company, $address, $country, $state, $city, $zip, $username, $password){

		$user = array(
			'title' => $title,
			'first_name' => $fname,
			'last_name' => $lname,
			'phone' => $phone,
			'company' => $company,
			'username' => $username, 
			'email' => $email, 
			'password' => password_hash($password, PASSWORD_DEFAULT));
		$this->db->insert('user', $user);
		$insert_id = $this->db->insert_id();

		$address = array(
			'user_id' => $insert_id,
			'deliver_to' => $fname . ' ' . $lname,
			'address' => $address,
			'city' => $city,
			'province' => $state,
			'zip_code' => $zip,
			'country' => $country);
		$this->db->insert('address', $address);

		return true;
	}

	// Get the data of all users
	public function get_all_users() {

		return $this->db->get('user')->result_array();
	
	}

	// Get the data of all staff
	public function get_all_staff() {

		return $this->db->where('access >', 0)->get('user')->result_array();
	
	}

	// Get the data of all staff
	public function get_all_users_reg() {

		return $this->db->where('access', 0)->get('user')->result_array();
	
	}

	// Get the address of a user based on the ID passed to the function
	public function get_user_address_by_id($user_id) {

		return $this->db->where('user_id', $user_id)->get('address')->result_array();
	
	}

	// Update user password
	public function update_password($new_password, $user_id) {
		$this->db->set('password', password_hash($new_password, PASSWORD_DEFAULT));
		$this->db->where('id', $user_id);
		return $this->db->update('user'); 
	}

	// Update a user's address
	public function update_address($user_id, $deliver_to, $address, $city, $province, $zip_code, $country) {
		
		$this->db->set(array('deliver_to' => $deliver_to, 'address' => $address, 'city' => $city, 'province' => $province, 'zip_code' => $zip_code, 'country' => $country));
		$this->db->where('user_id', $user_id);
		return $this->db->update('address'); 
	}

	// Add a package
	public function add_package($deliver_to, $tracking_id, $delivery_title, $delivery_details, $weight) {

		$data = array(
			'user_id' => $deliver_to,
			'tracking_id' => $tracking_id,
			'title' => $delivery_title,
			'details' => $delivery_details,
			'weight' => $weight
		);

		// Insert data to delivery table
		$this->db->insert('delivery', $data);

		// Insert data to delivery_status table
		$this->db->insert('delivery_status', array('tracking_id' => $tracking_id));

	}

}