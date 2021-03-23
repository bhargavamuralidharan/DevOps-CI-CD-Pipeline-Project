<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('delivery_model');
	}

    public function index() {
        
        $data['title'] = "Track your order";
        $data['load_extra_js'] = array(base_url('resources/js/t-page.js'));

        $this->load->template('tracking/tracking', $data);

    }

    public function track() {

        $tracking_id = $this->input->post('tracking_id');
        
        if($tracking_id != null) {

            $package = $this->delivery_model->get_package_by_id($tracking_id);

			if($package) {
                $current_status = $this->delivery_model->get_current_status($tracking_id);
                $delivery_status = $this->delivery_model->get_delivery_status_by_tracking_id($tracking_id);
                $delivery_status_titles = $this->delivery_model->get_delivery_status_titles();
                
                $count = 1;
                $out = '';
                
                foreach($delivery_status as $ds) { 
                    $out .= '
                    <div class="flex">
                        <div class="p-4">
                    ';    
                        if($count == 1 && $current_status[0]['status'] != 4){ 
                            $count++;
                            $out .='
                            <h3><i class="fas fa-circle-notch"></i></h3>
                            ';
                        } else { 
                            $count++;
                            $out .='
                            <h3><i class="fas fa-check text-success"></i></h3>
                            ';
                        }
                        $out .='
                        </div>
                        <div class="box full-width">
                            <div class="flex align-items-center">
                                <div class="flex-1"><h4>'. $delivery_status_titles[$ds['status'] - 1]['title'] .'</h4></div>
                                <div class="flex-1">'. date('F j, Y | h:m a', strtotime($ds['d_date'])) .'</div>
                            </div>
                        </div>
                    </div>
                    ';
                }

                echo json_encode(array("response" => "success", "out" => $out ));

            } else {
                echo json_encode(array("response" => "package_not_found", "message" => '
                    <div class="text-center">
                        <div class="alert alert-dismissable fade show alert-warning mw-500 margin-0-auto">
                            We\'re sorry, we couldn\'t find the package that you searched for.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <small><a href="'.site_url('contact').'" target="_blank">Send us a message</a> if you require assistance.</small>
                    </div>'
                ));
            }

        }
    }

}