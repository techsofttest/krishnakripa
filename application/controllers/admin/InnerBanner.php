<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InnerBanner extends MY_Controller {
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
                $data['banner_list'] 		    = $this->Admin_model->fetch_all_order("innerbanner",'title','ASC');
                $data['seo_title'] 			    = "Inner Banners| ".$this->data['admin_title'].""; 
				$this->load->view('admin/view_innerbanners',$data);                 
        }

		


		public function EditBanner($id)
		
		{


			  $data['seo_title']              = "Edit Inner Banners | ".$this->data['admin_title']."";
			  $con = array('id' => $id);
			  $data['banners_details']      = $this->Admin_model->fetch_one_row("innerbanner",$con);	


	         if(isset($_REQUEST['update'])){

 				 $con = array('id'=> $id);
				 $stud_data  	= 	array('title' => $this->input->post("title"));
					
				 $this->Admin_model->update_all($stud_data,$con,'innerbanner');
				 $this->session->set_flashdata('success', 'Banner updated successfully.');

				  if(!empty($_FILES["image"]["name"]))
				   {					  
					
					 for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
					    {
							if($_FILES["image"]["name"][$i]!='')
							 {	
							 
							    @unlink('uploads/Banner/'.$data['banners_details']['image']);	
						 
								$filename2 	= 	basename($_FILES["image"]["name"][$i]);
								
								$ext2 		= 	@end(explode('.', $filename2));
								$ext2 		= 	strtolower($ext2);			
								$file2    = 	"ban_".rand().'.'.$ext2;			
								$uploadfile2 = 	"uploads/Banner";
								move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile2."/".$file2);

								$configer =  array(
									'image_library'   => 'gd2',
									'source_image'    =>  $uploadfile2."/".$file2,
									'maintain_ratio'  =>  TRUE,
									'width'           =>  1349,
									'height'          =>  300,
								  );
								  $this->image_lib->clear();
								  $this->image_lib->initialize($configer);
								  $this->image_lib->resize();

								  $con = array('id'=> $id);
								  $stud_data  	= 	array('image'  => $file2,
								  'title' => $this->input->post("title"));
					
								  $this->Admin_model->update_all($stud_data,$con,'innerbanner');
								  $this->session->set_flashdata('success', 'Banners updated successfully.');
							}
						}
				   }	 
				   redirect(base_url().'admin/InnerBanner');					
				  }
				  $this->load->view('admin/edit_innerbanners', $data);	
		}
		
		
	
	
}