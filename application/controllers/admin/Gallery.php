<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MY_Controller {
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
		   
		 $data['Gallery_data']	=	$this->Admin_model->fetch_all_order('gallery','Gallery_id','desc');
		   
			$parent =  $this->uri->segment(4);	
			 
			$data['seo_title'] 	= 	"View Gallery | ".$this->data['admin_title']."";		
			
			$this->load->view('admin/view_gallery',$data);
		
   }		
	
		public function AddGallery()
				
		{		

			$data['seo_title'] 	= 	"Add Image| ".$this->data['admin_title']." "; 			
					if(!empty($_FILES["image"]["name"])){			
				
				for($i=0;$i<count($_FILES['image']['name']);$i++){
					
						
						if($_FILES['image']['name'][$i]!=''){						
							
							$filename2	=	basename($_FILES['image']['name'][$i]);
							$ext2		= 	@end(explode('.',$filename2));
							$ext2 		= 	strtolower($ext2);
							$gallery2	=	"Gallery_".rand().'.'.$ext2;
							$uploadfile2=	"uploads/Gallery";
							move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$gallery2);				
							
							$data_img	=	array('gallery_img' => $gallery2);							
							
							$add_img	=	$this->Admin_model->insertsection('gallery',$data_img);
							
							
							
							}
					}
					
					$this->session->set_flashdata('success', 'New ImageAdded Successfully.'); 	
					
				}
		
							 
			 $this->load->view('admin/add_gallery', $data);
			 
			}
		 public function EditGallery($cid)
		{
			
			
			$cond=array('Gallery_id' => $cid);
			
			$data['photo_data'] 	= 	$this->Admin_model->fetch_one_row('gallery',$cond);
			
			
			
			$data['seo_title'] 	= 	"Edit Image| ".$this->data['admin_title'].""; 
			
			
			if(!empty($_FILES["image"]["name"])){
				
				for($i=0;$i<count($_FILES['image']['name']);$i++){
					
						
						if($_FILES['image']['name'][$i]!=''){
							
							
							@unlink ('uploads/Gallery/'.$data['photo_data']['Gallery_img']);
							$filename2	=	basename($_FILES['image']['name'][$i]);
							$ext2		= 	@end(explode('.',$filename2));
							$ext2 		= 	strtolower($ext2);
							$gallery2	=	"Gallery_".rand().'.'.$ext2;
							$uploadfile2=	"uploads/Gallery";
							move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$gallery2);
				
							
							$data_img	=	array('Gallery_img' => $gallery2);
							
							$cond		=	array('Gallery_id' => $cid);
							
							
							$add_img	=	$this->Admin_model->update_all($data_img,$cond,'gallery');
							
							
							
							}
					}
					
					$this->session->set_flashdata('success', 'Gallery Updated Successfully.'); 
			
							redirect(base_url().'admin/Gallery/EditGallery/'.$cid);
					
				}
			
			$this->load->view('admin/edit_gallery', $data);
        }
			
		
		public function DeleteGallery($cid)
		{
			
			$cond=array('Gallery_id' => $cid);
			$data['Gallery']=$this->Admin_model->fetch_one_row('gallery',$cond);
			
			@unlink('uploads/Gallery/'.$data['Gallery']['Gallery_img']);
			
			$this->db->where('Gallery_id',$cid);
			$this->db->delete('gallery');
			
						
			$this->session->set_flashdata('success', 'Gallery Deleted Successfully.'); 
			redirect(base_url().'admin/Gallery');
		}


		public function Yutube()

		{  
		   
		 $data['Gallery_data']	=	$this->Admin_model->fetch_all_order('video','vi_id','desc');
		   
			$parent =  $this->uri->segment(4);	
			 
			$data['seo_title'] 	= 	"View Yutube | ".$this->data['admin_title']."";		
			
			$this->load->view('admin/view_url',$data);
		
   }		

		public function AddYutube()
				
		{		

			$data['seo_title'] 	= 	"Add Yutube| ".$this->data['admin_title']." "; 		

					if($_POST){
						
							$valid = preg_match("/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $this->input->post('title'));
							if ($valid){  
							$data_img	=	array('title' => $this->input->post('title'));													
							$add_img	=	$this->Admin_model->insertsection('video',$data_img);					
					  $this->session->set_flashdata('success', 'Yutube Video Addedd Successfully.'); 	
							} if (!$valid){  
								$this->session->set_flashdata('error', 'Not a valid url'); 	
							}

				}
		
							 
			 $this->load->view('admin/add_url', $data);
			 
			}

			public function EditYutube($cid)
			{
				
				
				$cond=array('vi_id' => $cid);
				
				$data['photo_data'] 	= 	$this->Admin_model->fetch_one_row('video',$cond);	
				
				
				$data['seo_title'] 	= 	"Edit Yutube| ".$this->data['admin_title'].""; 
				
				if($_POST){

					$valid = preg_match("/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $this->input->post('title'));
					if ($valid){  
							
					$data_img	=	array('title' => $this->input->post('title'));													
					$add_img	=	$this->Admin_model->update_all($data_img,$cond,'video');
		
					$this->session->set_flashdata('success', 'Yutube Video updated Successfully.'); 			
					
					} if (!$valid){  
						$this->session->set_flashdata('error', 'Not a valid url'); 	
					}
		
								redirect(base_url().'admin/Gallery/EditYutube/'.$cid);				
			   
			}

			$this->load->view('admin/edit_url', $data);
		}

			public function DeleteYutube($cid)
		{
						
			$this->db->where('vi_id',$cid);
			$this->db->delete('video');					
			$this->session->set_flashdata('success', 'Yutube Video Deleted Successfully.'); 
			redirect(base_url().'admin/Gallery/Yutube');
		}
				
	
}