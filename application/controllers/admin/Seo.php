<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		 public function index()

		{  
		   
			$data['seo_data']	=	$this->Admin_model->fetch_all('seopage');
			
			
			$data['seo_title'] 	= 	"View Seo Page | ".$this->data['admin_title']."" ; 
			
			
			$this->load->view('admin/view_seo',$data);
		
        }
	
		
		// Add Qualification   
       
		
	 public function EditSeo($seoid)
		{
			
			
			$cond=array('seoid' => $seoid);
			
			$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
			
			
			
			$data['seo_title'] 	= 	"Edit Seo Page | ".$this->data['admin_title'].""; 
			
											
			if($_POST):
				
			
			 
				$stud_data  	= 	array(
				
		'm_title'  =>$this->input->post('m_title'),
		'm_dis'  =>$this->input->post('m_dis'),
		'm_key'  =>$this->input->post('m_key'),
		
		
		 );
				
				
				
				$cond  	= 	array('seoid'  =>$seoid);
				
				$add_img	=	$this->Admin_model->update_all($stud_data,$cond,'seopage');
				
					
				$this->session->set_flashdata('success', 'Seo Page Updated Successfully.'); 
				
				
				redirect(base_url().'admin/Seo/EditSeo/'.$seoid);
				
			    endif;
			
			    $this->load->view('admin/edit_seo', $data);
        }
		
			
	 
		
		
		
		
		
	
}