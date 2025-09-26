<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddOns extends MY_Controller {
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
			
        }
		
		
		public function index()
		
		{ 

    	$data['addons'] = $this->Admin_model->fetch_all_order("addons",'ao_name','asc');
    	$data['seo_title'] 	= "View  Add Ons | ".$this->data['admin_title'].""; 
		$this->load->view('admin/view_addons',$data);                 
  		}
	


		public function Add()
		
		{               
               
			    if($_POST):
				
				
				$sid = $this->Admin_model->insertsection('addons',$this->input->post());			

				$this->session->set_flashdata('success','New Add On Added Successfully');
				
				redirect(base_url().'admin/AddOns/Add');
				
				endif;
			    
    			$data['seo_title'] 			    = "Add Add On | ".$this->data['admin_title'].""; 

				$this->load->view('admin/add_addon',$data);  
				               
        }
		


		public function Edit($id)
		
		{

			$data['seo_title']    = "Edit Add On | ".$this->data['admin_title']."";

			$con = array('ao_id' => $id);

			$data['ao']   = $this->Admin_model->fetch_one_row("addons",$con);	


	    	if($_POST){

			$this->Admin_model->update_all($this->input->post(),$con,'addons');

			$this->session->set_flashdata('success', 'Add On Updated Successfully');

			redirect(base_url().'admin/AddOns/Edit/'.$id);
			
			}
			
			$this->load->view('admin/edit_addon', $data);
			

		}














		
		
	
	
}