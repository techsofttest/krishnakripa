<?php
class Hotel extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');			
	}
	
	//index	   
	function index()
	{ 
  $cond=array('seoid' => 5);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
  $res= array('contentId'=>9);
  $data['res']	=	$this->Admin_model->fetch_one_row('content',$res);
  $fields = array('hotel'=>0);
  $data['res_data']	=	$this->Admin_model->fetch_data_cond('room',$fields,'roomid','desc');
		$this->load->view('hotel-category',$data);		
	}

	function Executive()
	{
  $cond=array('seoid' => 5);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
  $exe= array('contentId'=>7);
  $data['res']	=	$this->Admin_model->fetch_one_row('content',$exe);
  $fields = array('hotel'=>1);
  $data['res_data']	=	$this->Admin_model->fetch_data_cond('room',$fields,'roomid','desc');
		$this->load->view('hotel-category',$data);		
	}
		
		
}
