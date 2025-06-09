<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends MY_Controller {
		
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url'));               
				$this->load->library('session');	
	            $this->load->model('Admin_model');
			
        }
		
	public function index($token)
	{

	
	if($token!="")
	{
		
		$cond = array('PASSOTP' => $token);
		
		$user = $this->Admin_model->fetch_one_row('admin',$cond);
		
			if(!empty($user))
			
			{
			
				$timestamp = date("Y-m-d H:i:s");
				
				$date_a = new DateTime($timestamp);
				 
				$date_b = new DateTime($user['PASSOTPTIME']);
		
				$interval = date_diff($date_a,$date_b);
			
				$generated_time_diff = $interval->format('%h');
				
					if($generated_time_diff>1)
					
					{
					
					$flashdata = array(

						'type' => "error",

						'msg' => "Link Expired",

					);

					$this->session->set_flashdata('linkexpired',$flashdata);
					
					redirect(base_url());
						
					}
					
					else
					{
					
					
					if($_POST)
					{
					
					$url = $_SERVER['HTTP_REFERER'];
				
					
					$password = $this->input->post('pass-word');
					
					$pass_confirm = $this->input->post('password_check');
					
						
						if($password == $pass_confirm)
							{
						
							$update_password = array(
							
							'adminPassword'=> md5($password),
							
							'PASSOTP' => '',
							
							'PASSOTPTIME' => NULL,
							
							);
							
							$update_cond = array('adminId' => $user['adminId']);
							
							$this->Admin_model->update_all($update_password,$update_cond,'admin');	
							
							$flashdata = array(

								'type' => "success",
		
								'msg' => "Password Reset Successfully",
		
							);
		
							$this->session->set_flashdata('Reseted',$flashdata);
							
							redirect(base_url()."admin");
								
							}	
											
					}
			
					
					$this->load->view('admin/reset_password');	
						
					}
				
				
			
			}
			
			else
			
			{
			
				$flashdata = array(

					'type' => "error",

					'msg' => "Invalid Link",

				);

				$this->session->set_flashdata('Invalidlink',$flashdata);
				
				redirect(base_url()."admin");
					
			}
		
		
		
	}
	
	else
	{
		
	$this->session->set_flashdata('noti','Unauthorized Access');
		
	redirect(base_url());
		
	}
	
	
		
	}
	
	
	
			
	
}