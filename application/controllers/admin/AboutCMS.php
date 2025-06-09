<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AboutCMS extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));              		
				$this->load->library('session');
				$this->load->library('image_lib');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
			
        }		
		
		   
        public function index()
		{			 
			
			
			$data['seo_title'] 	= 	"View About CMS | ".$this->data['admin_title'].""; 
			 
			 $parent =  $this->uri->segment(4);		
				 
			$data['contact_data'] 	= 	$this->Admin_model->fetch_limit('about',"3","0",'about_id','asc');
			 
			 $this->load->view('admin/view_about', $data);
		}
				
		
	 public function EditAbout($id)
		{
			
			$url = $_SERVER['HTTP_REFERER'];

			$cond = array('about_id' => $id);
			
			$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('about',$cond);
			
					
			$data['seo_title'] 	= 	"Edit About CMS | ".$this->data['admin_title'].""; 
											
			if($_POST):							
				
				$cms_data  = array(
					'about_heading'  => $this->input->post('heading'),
					'about_desc'  =>  $this->input->post('description'));
				$cms_cond  		= 	array('about_id'  => $id);
				$this->Admin_model->update_all($cms_data,$cms_cond,'about');
				
			
				
				
								if(!empty($_FILES["image_left"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['image_left']['name']); $i++) 
								  {
										if($_FILES["image_left"]["name"][$i]!='')
										{				
										
							@unlink('uploads/'.$data['cms_data']['about_image_left']);			
										
												
					$filename2 	= 	basename($_FILES["image_left"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"about_left_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads";
					move_uploaded_file($_FILES["image_left"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
				
					
					$image  	= 	array( 'about_image_left'  => $gallery2);
					//$cond		= 	array('prod_id' 	=>	$pid);
					$add_img2	=	$this->Admin_model->update_all($image,$cms_cond ,'about');
						
				}}}
				
				
				
				
				
				if(!empty($_FILES["image_right"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['image_right']['name']); $i++) 
								  {
										if($_FILES["image_right"]["name"][$i]!='')
										{				
										
							@unlink('uploads/'.$data['cms_data']['about_image_right']);			
										
												
					$filename2 	= 	basename($_FILES["image_right"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"about_right_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads";
					move_uploaded_file($_FILES["image_right"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
				
					
					
					$image  	= 	array( 'about_image_right'  => $gallery2);
					//$cond		= 	array('prod_id' 	=>	$pid);
					$add_img2	=	$this->Admin_model->update_all($image,$cms_cond ,'about');
						
				}}}
				
				
				
				
				
				
				
				
				
				
				$this->session->set_flashdata('success', 'About CMS updated Successfully.'); 
				redirect($url);
				
			endif;
		  $this->load->view('admin/edit_about', $data);
        }


         public function Whychoose()
		{			 
			
			
			$data['seo_title'] 	= 	"View About CMS | ".$this->data['admin_title'].""; 
			 
			 $parent =  $this->uri->segment(4);
				 
			 $data['contact_data'] 	= 	$this->Admin_model->fetch_limit('about',"7","3",'about_id','asc');
			 $this->load->view('admin/view_about', $data);
		}
		
		
		
		 
			    			
}