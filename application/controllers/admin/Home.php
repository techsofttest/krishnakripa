<?php
class Home extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');		
		$this->load->model("Admin_model");
		$this->load->model("BookingModel");
		//$this->pr_details=get_profile_details();
		if(!$this->session->userdata('adminId'))
		{
			redirect(base_url().'admin/login');	
		}
	}
	
	//index	   
	function index()
	{   
	   
		$data['bookings']	=	$this->BookingModel->ViewBookingsToday();	
		$data['rooms'] = $this->Admin_model->fetch_all('room');
		$this->load->view('admin/home',$data);
		
	}


	public function ToggleMenu($type)
	{

	if($type=="Booking")
	{

	$this->session->unset_userdata('manage');

	redirect(base_url().'admin/home');

	}
	else
	{

	$this->session->set_userdata('manage','website');

	redirect(base_url().'admin/home');

	}

	

	}
	
	// change profile
	
		
}
