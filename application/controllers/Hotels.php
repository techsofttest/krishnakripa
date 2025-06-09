<?php
class Hotels extends MY_Controller {
	
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
  $exe= array('contentId'=>7);
  $data['exe']	=	$this->Admin_model->fetch_one_row('content',$exe);
		$this->load->view('hotels',$data);		
	}
	
	// change profile
	
		
}
