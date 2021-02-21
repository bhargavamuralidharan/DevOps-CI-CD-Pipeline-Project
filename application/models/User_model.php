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

	public function add_password($category = null, $title, $username = null, $password = null, $url = null, $note = null){

		$data = array('category_id' => $category, 'user_id' =>$this->session->user_id, 'title' => $title, 'username' => $username, 'password' => $password, 'url' => $url, 'notes' => $note);
		return $this->db->insert('passwords', $data);

	}

	public function get_passwords($user_id){

		return $this->db->where('user_id', $this->session->user_id)->get('passwords')->result_array();

	}

	public function get_password($user_id, $password_id){

		return $this->db->where(array('user_id' => $this->session->user_id, 'id' => $password_id))->get('passwords')->result_array();

	}

	public function get_password_categories(){

		return $this->db->get('password_categories')->result_array();

	}

	public function delete_password($password_id){

		return $this->db->where(array('user_id' => $this->session->user_id, 'id' => $password_id))->delete('passwords');

	}

}