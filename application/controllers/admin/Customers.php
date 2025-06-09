<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends MY_Controller {
		// construct
        public function __construct()
		{
		parent::__construct();
		$this->load->database();
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'text'));
        $this->load->model("Admin_model");	
		$this->load->model("BookingModel");			
		$this->load->library('session');		
		if(!$this->session->userdata('adminId'))
		{
			redirect(base_url().'admin/login');	
		}	
			
        }
		
		
		public function index()
		
		{ 

    	$data['customers']	=	$this->Admin_model->fetch_all_order('customers','cus_id','desc');	

    	$data['seo_title'] = "View Customers | ".$this->data['admin_title'].""; 

		$this->load->view('admin/view_customers',$data);     

  		}
		

		
		
	
	
}