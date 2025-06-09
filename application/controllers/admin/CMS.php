<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				//$this->pr_details=get_profile_details();
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		
	
		
		// View CMS Pages   
        public function ViewCMS()
		{			 
			
			$data['seo_title'] 	= 	"View CMS Pages | ".$this->data['admin_title'].""; 
			 
			$parent =  $this->uri->segment(4);
				 
			$data['cms_data']	=	$this->Admin_model->fetch_all('content');
			
			$this->load->view('admin/view_cms_page', $data);
		
		}

		public function Why()
		{			
			
			
			$data['seo_title'] 	= 	"View CMS Pages | ".$this->data['admin_title'].""; 
			 
			$parent =  $this->uri->segment(4);
				 
			$data['cms_data']	=	$this->Admin_model->fetch_limit('content','6','0','contentId','Desc');
			
			$this->load->view('admin/view_cms_page', $data);
		
		}

		public function Top()
		{			
			
			
			$data['seo_title'] 	= 	"View CMS Pages | ".$this->data['admin_title'].""; 
			 
			$parent =  $this->uri->segment(4);
				 
			$data['cms_data']	=	$this->Admin_model->fetch_limit('content','4','6','contentId','Desc');
			
			$this->load->view('admin/view_top', $data);
		
		}
		

		public function EditTop($contentid){		
		
			
			$cond = array('contentId' => $contentid);
			
			$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('content',$cond);
			
			$data['seo_title'] 	= 	"Edit CMS | ".$this->data['admin_title'].""; 
											
			if($_POST):
				
			$url = $_SERVER['HTTP_REFERER'];
													
				//Update CMS
				$cms_data  = array(
			'pageName'  => preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->input->post('page_name')),
			'pageDescription'  => preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->input->post('content')));
			$cms_cond  		= 	array('contentId'  => $contentid,);
			$this->Admin_model->update_all($cms_data,$cms_cond,'content');			
			$this->session->set_flashdata('success', 'CMS Page Updated Successfully.'); 
			redirect($url);
		endif;
			
		$this->load->view('admin/edit_top', $data);
			}
		
				
		
	 public function EditCMS($contentid){		
		
			
			$cond = array('contentId' => $contentid);
			
			$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('content',$cond);
			
			$data['seo_title'] 	= 	"Edit CMS | ".$this->data['admin_title'].""; 
											
			if($_POST):
				
			$url = $_SERVER['HTTP_REFERER'];
													
				//Update CMS
				$cms_data  = array(
			'pageName'  => preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->input->post('page_name')),
			'pageDescription'  => preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->input->post('page_description')),
			
			'pageSlug'  => $this->change_slug($this->input->post('page_name'),$contentid));

				$cms_cond  		= 	array('contentId'  => $contentid,);
				$this->Admin_model->update_all($cms_data,$cms_cond,'content');
				
				$this->session->set_flashdata('success', 'CMS Page Updated Successfully.'); 

				 if(!empty($_FILES["image"]["name"]))
				   {						
					 for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
					    {
							if($_FILES["image"]["name"][$i]!='')
							 {	
							   	
							    @unlink('uploads/'.$data['cms_data']['image']);	
						 
								$filename2 	= 	basename($_FILES["image"]["name"][$i]);


								
								$ext2 		= 	@end(explode('.', $filename2));
								$ext2 		= 	strtolower($ext2);			
								$file2    = 	"about_".rand().'.'.$ext2;	

							
								$uploadfile2 = 	"uploads";
								move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile2."/".$file2);
							

								  $con = array('contentId'=> $contentid);
								  $stud_data  	= 	array('image'  => $file2);

					
								  $this->Admin_model->update_all($stud_data,$con,'content');
								  $this->session->set_flashdata('success', 'Image updated successfully.');
							}
						}
				   }	
		
				
				redirect($url);
				
			endif;
			
			$this->load->view('admin/edit_cms_pages', $data);
        }
		
		
		
		
		
		public function change_slug($name,$id)
		{
			$count 	= 	0;
			$name 	= 	url_title($name);
			$slug_name 	= 	$name;  
			//echo $slug_name;
			//exit;           // Create temp name
			while(true) 
			
			{
				$this->db->select('*');
				$this->db->where('pageSlug', $slug_name); 
				$this->db->where_not_in('contentId', $id);  // Test temp name
				$query 	= 	$this->db->get('content');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}
				
			    			
}