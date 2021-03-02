<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testunit extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		// load unit text library and user model
		$this->load->library('unit_test');
        $this->load->model('user_model');
	}

    private function division($a, $b) {
        return $a / $b;
    }

    private function multiplication($a, $b) {
        return $a * $b;
    }

    private function run_test($array) {
        // Syntax: $this->unit->run(Test Case, Expected Result, Test Name);

        echo $array[0];
        echo $this->unit->run($array[1], $array[2], $array[0]) .'<br><br>';
    }

    public function index() {

        // Test arithmetic (division)
        $this->run_test(array("Basic Test (division)", $this->division(6,3), 2));

        // Test arithmetic (multiplication)
        $this->run_test(array("Basic Test (multiplication)", $this->multiplication(10,10), 100));

        // Test user model
        // get_account method
        $this->run_test(array("User Model (get user account by username)", $this->user_model->get_account('aennis'), 'is_array'));
        $this->run_test(array("User Model (get user account by username - invalid user)", $this->user_model->get_account('this_user_doesnt_exist'), 'is_array'));

        // get_user_address_by_id method
        $this->run_test(array("User Model (get user address by id)", $this->user_model->get_user_address_by_id(1), 'is_array'));

        //update_password method
        $this->run_test(array("User Model (update user password)", $this->user_model->update_password('old', 'new'), 'is_bool'));
    }

}