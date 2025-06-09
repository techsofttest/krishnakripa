<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurent extends MY_Controller {
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
		   
		 $data['Restaurent_data']	=	$this->Admin_model->fetch_all_order('restaurent','res_id','desc');
		   
			$parent =  $this->uri->segment(4);	
			 
			$data['seo_title'] 	= 	"View Restaurent | ".$this->data['admin_title']."";		
			
			$this->load->view('admin/view_restaurent',$data);
		
   }		
	
		public function AddRestaurent()
				
		{		

			$data['seo_title'] 	= 	"Add Image| ".$this->data['admin_title']." "; 			
					if(!empty($_FILES["image"]["name"])){			
				
				for($i=0;$i<count($_FILES['image']['name']);$i++){
					
						
						if($_FILES['image']['name'][$i]!=''){						
							
							$filename2	=	basename($_FILES['image']['name'][$i]);
							$ext2		= 	@end(explode('.',$filename2));
							$ext2 		= 	strtolower($ext2);
							$Restaurent2	=	"Restaurent_".rand().'.'.$ext2;
							$uploadfile2=	"uploads/Restaurent";
							move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$Restaurent2);				
							
							$data_img	=	array('res_img' => $Restaurent2);							
							
							$add_img	=	$this->Admin_model->insertsection('restaurent',$data_img);
							
							
							
							}
					}
					
					$this->session->set_flashdata('success', 'New ImageAdded Successfully.'); 	
					
				}
		
							 
			 $this->load->view('admin/add_restaurent', $data);
			 
			}
		 public function EditRestaurent($cid)
		{
			
			
			$cond=array('res_id' => $cid);
			
			$data['photo_data'] 	= 	$this->Admin_model->fetch_one_row('restaurent',$cond);
			
			
			
			$data['seo_title'] 	= 	"Edit Image| ".$this->data['admin_title'].""; 
			
			
			if(!empty($_FILES["image"]["name"])){
				
				for($i=0;$i<count($_FILES['image']['name']);$i++){
					
						
						if($_FILES['image']['name'][$i]!=''){
							
							
							@unlink ('uploads/Restaurent/'.$data['photo_data']['res_img']);
							$filename2	=	basename($_FILES['image']['name'][$i]);
							$ext2		= 	@end(explode('.',$filename2));
							$ext2 		= 	strtolower($ext2);
							$Restaurent2	=	"Restaurent_".rand().'.'.$ext2;
							$uploadfile2=	"uploads/Restaurent";
							move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$Restaurent2);
				
							
							$data_img	=	array('res_img' => $Restaurent2);
							
							$cond		=	array('res_id' => $cid);
							
							
							$add_img	=	$this->Admin_model->update_all($data_img,$cond,'restaurent');
							
							
							
							}
					}
					
					$this->session->set_flashdata('success', 'Restaurent Updated Successfully.'); 
			
							redirect(base_url().'admin/Restaurent/EditRestaurent/'.$cid);
					
				}
			
			$this->load->view('admin/edit_restaurent', $data);
        }
			
		
		public function DeleteRestaurent($cid)
		{
			
			$cond=array('res_id' => $cid);
			$data['restaurent']=$this->Admin_model->fetch_one_row('restaurent',$cond);
			
			@unlink('uploads/Restaurent/'.$data['restaurent']['res_img']);
			
			$this->db->where('res_id',$cid);
			$this->db->delete('restaurent');
			
						
			$this->session->set_flashdata('success', 'Restaurent Deleted Successfully.'); 
			redirect(base_url().'admin/Restaurent');
		}


		public function Yutube()

		{  
		   
		 $data['Restaurent_data']	=	$this->Admin_model->fetch_all_order('video','vi_id','desc');
		   
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
		
								redirect(base_url().'admin/Restaurent/EditYutube/'.$cid);				
			   
			}

			$this->load->view('admin/edit_url', $data);
		}

			public function DeleteYutube($cid)
		{
						
			$this->db->where('vi_id',$cid);
			$this->db->delete('video');					
			$this->session->set_flashdata('success', 'Yutube Video Deleted Successfully.'); 
			redirect(base_url().'admin/Restaurent/Yutube');
		}
				
	
}