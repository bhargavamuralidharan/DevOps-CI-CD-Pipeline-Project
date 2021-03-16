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
        $this->load->model('delivery_model');

        echo '
            <style>
                @import url("https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;600;700;800&display=swap");
                body{
                    font-family: "Fira Sans", "Helvetica", "Arial", sans-serif; 
                    font-size: 19px;
                }
            </style>
        <div style="margin:-8px;text-align:center;padding:10px;background-color:#efefef;margin-bottom:30px;"><h1>Unit Test Cases</h1></div>';

        $this->unit->set_test_items(array('test_name', 'test_datatype', 'res_datatype', 'result'));
    }

    private function division($a, $b) {
        return $a / $b;
    }

    private function multiplication($a, $b) {
        return $a * $b;
    }

    private function run_test($array) {
        // Syntax: $this->unit->run(Test Case, Expected Result, Test Name);

        echo '<div style="max-width: 750px;margin:0 auto;padding:0px 10px;">';
        //echo $array[0];
        echo $this->unit->run($array[1], $array[2], $array[0]) .'<br><br>';
        echo '</div>';
    }

    public function index() {

        // Test arithmetic (division)
        $this->run_test(array("Basic Test - division", $this->division(6,3), 2));

        // Test arithmetic (multiplication)
        $this->run_test(array("Basic Test - multiplication", $this->multiplication(10,10), 100));

        /* 
         * 
         *  Test user model
         * 
        */

        // get_account method
        $this->run_test(array("User Model - get user account by username:<br> Method: <b>\$this->user_model->get_account('aennis')</b>", $this->user_model->get_account('aennis'), 'is_array'));
        $this->run_test(array("User Model - get user account by username - invalid user:<br> Method: <b>\$this->user_model->get_account('this_user_doesnt_exist')</b>", $this->user_model->get_account('this_user_doesnt_exist'), 'is_array'));

        // get_user_address_by_id method
        $this->run_test(array("User Model - get user address by id:<br> Method: <b>\$this->user_model->get_user_address_by_id(1)</b>", $this->user_model->get_user_address_by_id(1), 'is_array'));

        //update_password method
        $this->run_test(array("User Model - update user password:<br> Method: <b>\$this->user_model->update_password('old', 'new')</b>", $this->user_model->update_password('old', 'new'), 'is_bool'));


        /* 
         * 
         *  Test delivery model
         * 
        */
        // Get current status of a package
        $this->run_test(array("Delivery Model - Get current status of a package:<br> Method: <b>\$this->delivery_model->get_current_status('i2s73mw8rp')</b>", $this->delivery_model->get_current_status('i2s73mw8rp'), 'is_array'));
        
        // Get a list of status titles
        $this->run_test(array("Delivery Model - Get a list of status titles:<br> Method: <b>\$this->delivery_model->get_delivery_status_titles()</b>", $this->delivery_model->get_delivery_status_titles(), 'is_array'));

        // Get the details of a package based on tracking ID
        $this->run_test(array("Delivery Model - Get the details of a package based on tracking ID:<br> Method: <b>\$this->delivery_model->get_package_by_id()</b>", $this->delivery_model->get_package_by_id('i2s73mw8rp'), 'is_array'));

        // Get a list of all packages
        $this->run_test(array("Delivery Model - Get a list of all packages:<br> Method: <b>\$this->delivery_model->get_all_packages(\$limit = null)</b>", $this->delivery_model->get_all_packages($limit = null), 'is_array'));

        // Get a list of all in transit
        $this->run_test(array("Delivery Model - Get a list of all packages in transit for a particular user:<br> Method: <b>\$this->delivery_model->get_packages_in_transit(\$user_id)</b>", $this->delivery_model->get_packages_in_transit(120), 'is_array'));
    
        // Get delivered packages for a particular user
        $this->run_test(array("Delivery Model - Get a list of all delivered packages for a particular user:<br> Method: <b>\$this->delivery_model->get_delivered_packages(\$user_id, \$limit = null)</b>", $this->delivery_model->get_delivered_packages(120, 10), 'is_array'));
    
    }

}