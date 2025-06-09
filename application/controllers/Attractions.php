<?php
class Attractions extends MY_Controller {
	
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
   $cond=array('seoid' => 4);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
  $data['attraction']	=	$this->Admin_model->fetch_all_by_desc('attractions','att_id');	
		$this->load->view('attractions',$data);
		
	}
	
	// change profile
	
		
}
