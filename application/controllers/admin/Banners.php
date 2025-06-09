<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                				
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				
				
				//get user details
        }
		
		
		 public function index()

		{  
		   
		   	$data['banner_data']	=	$this->Admin_model->fetch_all('banners');
		   
			$parent =  $this->uri->segment(4);	
			
			$data['seo_title'] 	= 	"View Banners | ".$this->data['admin_title'].""; 
			
			
			$this->load->view('admin/view_banners',$data);
		
        }
	
	
		// Add Qualification   
       
	    public function EditBanner($bid)
		
		{
		
			$cond=array('ban_id' => $bid);
			
			$data['banner_data'] 	= 	$this->Admin_model->fetch_one_row('banners',$cond);
			
			$data['seo_title'] 	= 	"Edit Banner | ".$this->data['admin_title'].""; 
			
							
			if($_POST):
				
			$ban_data = array(
			
			'ban_main_heading' => $this->input->post('main_heading'),
			
			'ban_sub_heading' => $this->input->post('sub_heading'),
			
			'ban_desc' => $this->input->post('description'),
			
			);
			
			
			$this->Admin_model->update_all($ban_data,$cond,'banners');
			
			
		    if(!empty($_FILES["image"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
								  {
									  
										if($_FILES["image"]["name"][$i]!='')
										
										{	
										
										 @unlink('uploads/Banners/'.$data['banner_data']['ban_image']);
															
					$filename2 	= 	basename($_FILES["image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"banner_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Banners";
					move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);

						$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  1349,
                   'height'          =>  600,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();

					
					$more_docs  	= 	array(
					       'ban_id'  =>$bid,
		                   'ban_image'  => $gallery2,);
					$add_img2	=	$this->Admin_model->update_all($more_docs,$cond,'banners');
						
				}}}
					
			
				$this->session->set_flashdata('success', 'Banner updated Successfully.'); 
				
				redirect(base_url().'admin/Banners');
				
			    endif;
			
			    $this->load->view('admin/edit_banner', $data);
				
        }
		
	
}