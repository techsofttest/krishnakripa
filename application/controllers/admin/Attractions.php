<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attractions extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				
				$this->load->library('image_lib');
				
				//$this->pr_details=get_profile_details();
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		 public function index()

		{  
		   
		 $data['Attractions']	=	$this->Admin_model->fetch_all_by_desc('attractions','att_id');		   
			$parent =  $this->uri->segment(4);				 
			$data['seo_title'] 	= 	"View Attractions | ".$this->data['admin_title'].""; 			
			$this->load->view('admin/view_attractions',$data);
		
        }
		
		
	
		public function AddAttractions()
		
		{
			
			
			$data['seo_title'] 	= 	" Add Attractions | ".$this->data['admin_title'].""; 
			
			if($_POST):
			 
			$news_data  	= 	array(
			 
		    'att_title'  =>$this->input->post('title'),
		
		    'att_desc' => $this->input->post('desc'),

		    'meta_title'=>$this->input->post('meta_title'),
		    
			'meta_keyword'=>$this->input->post('meta_key'),
		    
			'meta_description'=>$this->input->post('meta_desc'),
		     
			'att_slug' =>  $this->Admin_model->create_slug($this->input->post('title'),'attractions','att_slug'), 
		
		 );
		
				
				$cid=  $this->Admin_model->insertsection('attractions',$news_data);
				
					
				$this->session->set_flashdata('success', 'Attractions Added Successfully.'); 
			
				
				if(!empty($_FILES["image"]["name"]))
							
							{
								
								for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
								  {
										if($_FILES["image"]["name"][$i]!='')
										{						
					$filename2 	= 	basename($_FILES["image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"att_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Attractions";
					move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
					$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  425,
                   'height'          =>  300,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
				
				

					
				$data_imgg  	= array('att_image'  =>$gallery2);
				$condd  	= 	array('att_id'  =>$cid);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'attractions');
				}}}
				
				
				$this->session->set_flashdata('success', 'Attractions Added Successfully.'); 
				
				redirect(base_url().'admin/Attractions');
			    
				endif;
			
			
				$this->load->view('admin/add_attractions',$data); 
			
		}
		
		
				
		
	 public function EditAttractions($nid)
		{
			
			
			$news_cond = array('att_id' => $nid); 
 			
			$data['Attractions'] = $this->Admin_model->fetch_one_row('attractions',$news_cond);
			
			$data['seo_title'] 	= 	"Edit Attractions | ".$this->data['admin_title'].""; 
			
						
			if($_POST):
			
			$att_data  	= 	array(
			 
			'att_title'  =>$this->input->post('title'),
			
			'att_desc' => $this->input->post('desc'),
	 	
			'meta_title'=>$this->input->post('meta_title'),
			
			'meta_keyword'=>$this->input->post('meta_key'),
			
			'meta_description'=>$this->input->post('meta_desc'),
			
			'att_slug' =>  $this->Admin_model->change_slug($this->input->post('title'),'att_slug',$nid,'att_id','attractions'), 
		
		 );
		
		$cond	= array('att_id' => $nid);
		
		$edit	=	$this->Admin_model->update_all($att_data,$cond,'attractions');
		
		$this->session->set_flashdata('success','Attractions Updated Succesfully');
			
					
				
				if(!empty($_FILES["image"]["name"]))
							
							{
								
								for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
								  {
										if($_FILES["image"]["name"][$i]!='')
										{				
										
							@unlink('uploads/Attractions/'.$data['attractions']['attractions']);			
										
												
					$filename2 	= 	basename($_FILES["image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"att_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Attractions";
					move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
				   $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  425,
                   'height'          =>  300,
                   );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
				
					
					
					$image  	= 	array( 'att_image'  => $gallery2);
					$cond		= 	array('att_id' 	=>	$nid);
					$add_img2	=	$this->Admin_model->update_all($image,$cond,'attractions');
						
				}}}
				
					
			
				$this->session->set_flashdata('success', 'Attractions Updated Successfully.'); 
				redirect(base_url().'admin/Attractions/EditAttractions/'.$nid);
				
				endif;
			
				$this->load->view('admin/edit_attractions', $data);
			
        }
		
			
		
		
		public function DeleteAttractions($nid)
		   
		   {
			
			
			$cond=array('att_id' => $nid);
			
			$data['attractions'] 	= 	$this->Admin_model->fetch_one_row('attractions',$cond);
			
			@unlink('uploads/Attractions/'.$data['attractions']['att_image']);	
			
			$this->db->where('att_id',$nid);
			
			$this->db->delete('attractions');
			
			$this->session->set_flashdata('success', 'Attractions Deleted Successfully.'); 
			
			redirect(base_url().'admin/Attractions');
			
		}
		
		
		
		
	
}