<?php
class Restaurent extends MY_Controller {
	
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
  $rest= array('contentId'=>8);
  $data['rest']	=	$this->Admin_model->fetch_one_row('content',$rest);
  $data['Rest_data']	=	$this->Admin_model->fetch_all_order('restaurent','res_id','desc');
		$this->load->view('restaurant',$data);

	}
	
	// change profile
	
		
}
