<?php
class About extends MY_Controller {
	
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
  $cond=array('seoid' => 2);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
  $about= array('contentId'=>1);
  $data['about']	=	$this->Admin_model->fetch_one_row('content',$about);
  $res= array('contentId'=>9);
  $data['res']	=	$this->Admin_model->fetch_one_row('content',$res);
  $exe= array('contentId'=>7);
  $data['exe']	=	$this->Admin_model->fetch_one_row('content',$exe);
  $rest= array('contentId'=>8);
  $data['rest']	=	$this->Admin_model->fetch_one_row('content',$rest);  
  $dir= array('contentId'=>10);
  $data['dir']	=	$this->Admin_model->fetch_one_row('content',$dir);
  $vis= array('contentId'=>11);
  $data['vis']	=	$this->Admin_model->fetch_one_row('content',$vis);
  $mis= array('contentId'=>12);
  $data['mis']	=	$this->Admin_model->fetch_one_row('content',$mis);
  
		$this->load->view('about',$data);
		
	}
	
	// change profile
	
		
}
