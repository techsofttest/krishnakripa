<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  

  public function __construct()
  
    {
		
        parent::__construct();
		
		$this->load->model("Admin_model");
		
		$this->load->helper('text_cut');
		
		$this->data = array(
            'admin_title' => 'Krishnakripa Residency ',
			
        );
		
		$cond = array('id' => 1);			
		$data['con_data'] 	= 	$this->Admin_model->fetch_one_row('contact',$cond);
		$data['seo_data']	=	$this->Admin_model->fetch_all('seopage');
		$this->load->vars($data);
		
    }
	
	
	
	
	
	
}