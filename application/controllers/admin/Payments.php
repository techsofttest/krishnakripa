<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MY_Controller {
		// construct
        public function __construct()
		{
		parent::__construct();
		$this->load->database();
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'text','number'));
        $this->load->model("Admin_model");	
		$this->load->model("BookingModel");			
		$this->load->library('session');		
		if(!$this->session->userdata('adminId'))
		{
			redirect(base_url().'admin/login');	
		}	
			
        }
		
		
		public function Paid()
		
		{ 

		$date_from = "";
		$date_to = "";
		$customer = "";
	

		if(!empty($this->input->get('date_from')))
		{
			$date_from = $this->input->get('date_from');
		}

		if(!empty($this->input->get('date_to')))
		{
			$date_to = $this->input->get('date_to');
		}

		if(!empty($this->input->get('customer')))
		{
			$customer = $this->input->get('customer');
		}


		$data['customers'] = $this->Admin_model->fetch_where_order('customers',array(),'first_name','asc');

    	$data['payments']  =  $this->BookingModel->ViewPayments($date_from,$date_to,$customer);	

    	$data['seo_title'] = "View Payments | ".$this->data['admin_title'].""; 

		$this->load->view('admin/view_payments',$data);     

  		}
		

		public function Pending()
		
		{ 

    	$data['bookings']	=	$this->BookingModel->ViewBookings();	

    	$data['seo_title'] = "View Payments | ".$this->data['admin_title'].""; 

		$this->load->view('admin/view_payments',$data);     

  		}


		
		
	
	
}