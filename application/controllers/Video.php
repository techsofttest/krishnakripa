<?php
class Video extends MY_Controller {
	
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
	    
	     $cond=array('seoid' => 1);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
  $data['video']	=	$this->Admin_model->fetch_all('video'); 
		$this->load->view('video',$data);
		
	}
	
	// change profile
	
		
}
