<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");				
				$this->load->library('session');
				$this->load->library('image_lib');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
			
        }		
		
		   
        public function index()
		{			 
			
			
			$data['seo_title'] 	= 	"View Contact | ".$this->data['admin_title'].""; 
			 
			 $parent =  $this->uri->segment(4);
			
				 
			  $data['contact_data']	=	$this->Admin_model->fetch_all("contact");
			 
			 $this->load->view('admin/view_contact', $data);
		}
				
		
	 public function EditContact($id)
		{

			$cond = array('id' => $id);
			
			$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('contact',$cond);
			
					
			$data['seo_title'] 	= 	"Edit Contact | ".$this->data['admin_title'].""; 
											
			if($_POST):							
				
				$cms_data  = array(
					'maddress'  => $this->input->post('maddress'),
					'phone'  =>  $this->input->post('phone'),
					'phone2'  =>  $this->input->post('phone2'),
					'phone3'  =>  $this->input->post('phone3'),
					//'raddress'  => $this->input->post('raddress'),
					'rphone'  => $this->input->post('rphone'),
					'email'  => $this->input->post('email'),
				);	
				$cms_cond  		= 	array('id'  => $id,);
				$this->Admin_model->update_all($cms_data,$cms_cond,'contact');
				$this->session->set_flashdata('success', 'Contact details updated Successfully.'); 
				redirect(base_url().'admin/Contact');
				
			endif;
		  $this->load->view('admin/edit_contact', $data);
        }
		    			
}