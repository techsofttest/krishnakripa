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

		$data['customers'] = 5;

		//$data['rooms'] = $this->Admin_model->fetch_all('room');

		$data['rooms'] = $this->BookingModel->get_available_room_count_by_date(date('Y-m-d'));

		$data['summary'] = $this->BookingModel->get_daily_booking_summary(date('Y-m-d'));

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

	public function RoomAvailableByDate()
	{

	$date = date('Y-m-d',strtotime($this->input->post('date')));
	
	$data['rooms'] = $this->BookingModel->get_available_room_count_by_date($date);

	$data['summary'] = $this->BookingModel->get_daily_booking_summary($date);

	echo json_encode($data);

	}
	
		
}
