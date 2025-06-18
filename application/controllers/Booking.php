<?php
class Booking extends MY_Controller {
	
	function __construct()
	{
		        parent::__construct();
				$this->load->database();
    			$this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
    			$this->load->model("Admin_model");
	 			$this->load->model("BookingModel");
				$this->load->library('session');	
				
				//$this->session->set_userdata('b_id',18);
				if(empty($this->session->userdata('b_id')))
				{
				redirect(base_url());
				}
				
				
			}
			
	
			
			public function Summary()
			{
			
			$id = $this->session->userdata('b_id');

			$data['booking'] = $this->BookingModel->ViewBookingById($id);

			$this->load->view('summary',$data);

			}


}
