<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {
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

    $data['scat'] 		    = $this->Admin_model->fetch_all_order("categories",'cat_id','desc');
    $data['seo_title'] 			    = "View  Categories | ".$this->data['admin_title'].""; 
				$this->load->view('admin/view_categories',$data);                 
  }
	
		public function AddCategory()
		
		{               
               
			    if($_POST):
				
			    
				
				$insert_data = array(
				
				'cat_title' => $this->input->post('title'));			
				
				$sid = $this->Admin_model->insertsection('categories',$insert_data);			

				$this->session->set_flashdata('success','Room Type Added Successfully');
				
				redirect(base_url().'admin/Categories/AddCategory');
				
				endif;
			    
    $data['seo_title'] 			    = "Add Product | ".$this->data['admin_title'].""; 

				$this->load->view('admin/add_category',$data);  
				               
        }
		


								public function Addroom()
		
								{               
																					
													if($_POST):
										
													$slug_con = array('scat_slug' => $this->input->post('scat_slug'));
											
													$data['slug_service']      = $this->Admin_model->fetch_one_row("service_categories",$slug_con);	
										
													if(!empty($data['slug_service']))
													
													{
										
													$this->session->set_flashdata('error','Slug Already Used');
											
													redirect(base_url().'admin/Categories/AddCategory');
												
													exit;
												
													}
						
										
										$insert_data = array(
										
										'scat_name' => $this->input->post('name'),
										
										'scat_desc' => $this->input->post('desc'),
										
										'scat_slug' => $this->input->post('scat_slug'), 
										
										'meta_title' => $this->input->post('meta_title'),
										
										'meta_desc' => $this->input->post('meta_desc'),
										
										'meta_keywords' => $this->input->post('meta_keywords'),
										
										);
										
										
										$sid = $this->Admin_model->insertsection('service_categories',$insert_data);
										
										
										
										if(!empty($_FILES["image"]["name"])){
										
										for($i=0;$i<count($_FILES['image']['name']);$i++){
											
										if($_FILES['image']['name'][$i]!=''){
											
											
													$filename2	=	basename($_FILES['image']['name'][$i]);
													
													$ext2		= 	@end(explode('.',$filename2));
													
													$ext2 		= 	strtolower($ext2);
													
													$gallery2	=	"scat_".rand().'.'.$ext2;
													
													$uploadfile2=	"uploads/Products";
													
													move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$gallery2);
						
														$configer =  array(
																									'image_library'   => 'gd2',
																									'source_image'    =>  $uploadfile2."/".$gallery2,
																									'maintain_ratio'  =>  TRUE,
																									'width'           =>  460,
																									'height'          =>  460,
																							);
																									$this->image_lib->clear();
																									$this->image_lib->initialize($configer);
																									$this->image_lib->resize();
													
													$cond_img = array('scat_id' => $sid );
													
													$data_img	=	array('scat_image' => $gallery2);
													
													$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_categories');
													
													}}}
						
													if(!empty($_FILES["icon"]["name"])){
										
														for($i=0;$i<count($_FILES['icon']['name']);$i++){
															
														if($_FILES['icon']['name'][$i]!=''){
															
															
																	$filename2	=	basename($_FILES['icon']['name'][$i]);
																	
																	$ext2		= 	@end(explode('.',$filename2));
																	
																	$ext2 		= 	strtolower($ext2);
																	
																	$gallery2	=	"scat_".rand().'.'.$ext2;
																	
																	$uploadfile2=	"uploads/Products";
																	
																	move_uploaded_file($_FILES['icon']['tmp_name'][$i],$uploadfile2."/".$gallery2);
										
																		$configer =  array(
																													'image_library'   => 'gd2',
																													'source_image'    =>  $uploadfile2."/".$gallery2,
																													'maintain_ratio'  =>  TRUE,
																													'width'           =>  460,
																													'height'          =>  460,
																											);
																													$this->image_lib->clear();
																													$this->image_lib->initialize($configer);
																													$this->image_lib->resize();
																	
																	$cond_img = array('scat_id' => $sid );
																	
																	$data_img	=	array('scat_icon' => $gallery2);
																	
																	$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_categories');
																	
																	}}}
										
										
										
									
										
										$this->session->set_flashdata('success','Product Added Successfully');
										
										redirect(base_url().'admin/Categories/AddCategory');
										
										endif;
													
										$data['seo_title'] 			    = "Add Product | ".$this->data['admin_title'].""; 
						
										$this->load->view('admin/add_service_category',$data);  
																									
														}
								


		public function EditCategory($id)
		
		{


			  $data['seo_title']    = "Edit Product | ".$this->data['admin_title']."";

			  $con = array('cat_id' => $id);

			  $data['scat']   = $this->Admin_model->fetch_one_row("categories",$con);	


	    if($_POST){
			
			$data_update = array('cat_title' => $this->input->post('cat_name'));

			$this->Admin_model->update_all($data_update,$con,'categories');
			
			$this->session->set_flashdata('success', 'Room Type Updated Successfully');
			
			redirect(base_url().'admin/Categories/EditCategory/'.$id);	
			  				
			}

			
			$this->load->view('admin/edit_category', $data);
			

		}



		public function EditRoom($id)
		
		{


			  $data['seo_title']    = "Edit Product | ".$this->data['admin_title']."";

			  $con = array('scat_id' => $id);

			  $data['scat']   = $this->Admin_model->fetch_one_row("service_categories",$con);	


	    if(isset($_REQUEST['update'])){
			
			  //Check If Slug Updated
				 
			  if($this->input->post('scat_slug') != $data['scat']['scat_slug'])	
				
				{
				
			  //Check Slug Already In Table
				 
			  $slug_con = array('scat_slug' => $this->input->post('scat_slug'));
			  
			  $data['slug_service']      = $this->Admin_model->fetch_one_row("service_categories",$slug_con);	
				
			  if(!empty($data['slug_service']))
			  {
				
			  $this->session->set_flashdata('error','Slug Already Used');
			  
			  redirect(base_url().'admin/Categories/EditCategory/'.$id);
				  
			  exit;
				  
			  }
				
				}
				 
				 $data_update = array(
				 
				'scat_name' => $this->input->post('name'),
			
				'scat_desc' => $this->input->post('desc'),
					
				'scat_slug' => $this->input->post('scat_slug'), 
					
				'meta_title' => $this->input->post('meta_title'),
					
				'meta_desc' => $this->input->post('meta_desc'),
					
				'meta_keywords' => $this->input->post('meta_keywords'),				
				 
				 );
				 
				 $this->Admin_model->update_all($data_update,$con,'service_categories');
				 


				 				 
				if(!empty($_FILES["image_main"]["name"])){
				
				for($i=0;$i<count($_FILES['image_main']['name']);$i++){
					
				if($_FILES['image_main']['name'][$i]!=''){
					
							@unlink('uploads/Products/'.$data['scat']['scat_image']);	
					
					  $filename2	=	basename($_FILES['image_main']['name'][$i]);
							
							$ext2		= 	@end(explode('.',$filename2));
							
							$ext2 		= 	strtolower($ext2);
							
							$gallery2	=	"scat_".rand().'.'.$ext2;
							
							$uploadfile2=	"uploads/Products";

							move_uploaded_file($_FILES['image_main']['tmp_name'][$i],$uploadfile2."/".$gallery2);

								$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  460,
                   'height'          =>  460,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
							
							$cond_img = array('scat_id' => $id );
							
							$data_img	=	array('scat_image' => $gallery2);
							
							$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_categories');
							
			  
			    }}}



							if(!empty($_FILES["icon"]["name"])){
				
								for($i=0;$i<count($_FILES['icon']['name']);$i++){
									
								if($_FILES['icon']['name'][$i]!=''){
									
									
											$filename2	=	basename($_FILES['icon']['name'][$i]);
											
											$ext2		= 	@end(explode('.',$filename2));
											
											$ext2 		= 	strtolower($ext2);
											
											$gallery2	=	"scat_".rand().'.'.$ext2;
											
											$uploadfile2=	"uploads/Products";
											
											move_uploaded_file($_FILES['icon']['tmp_name'][$i],$uploadfile2."/".$gallery2);
				
												$configer =  array(
																							'image_library'   => 'gd2',
																							'source_image'    =>  $uploadfile2."/".$gallery2,
																							'maintain_ratio'  =>  TRUE,
																							'width'           =>  460,
																							'height'          =>  460,
																					);
																							$this->image_lib->clear();
																							$this->image_lib->initialize($configer);
																							$this->image_lib->resize();
											
											$cond_img = array('scat_id' =>  $id );
											
											$data_img	=	array('scat_icon' => $gallery2);
											
											$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_categories');
											
											}}}
				
				
			
			$this->session->set_flashdata('success', 'Service Category Updated Successfully');
			
			redirect(base_url().'admin/Categories/EditCategory/'.$id);	
			  				
			}

			
			$this->load->view('admin/edit_service_category', $data);
			

		}
		
		
		public function DeleteCategory($id)
		
		{		

		
		$this->db->where('cat_id',$id);
		
		$this->db->delete('categories');
		
		$this->session->set_flashdata('success','Room Type Deleted Successfully');
		
		redirect(base_url().'admin/Categories');
		
		}


		





		//Sub Category

		public function ViewSubCategory($id)

		{

			$data['service_cat'] = $this->Admin_model->fetch_one_row('service_categories', array('scat_id' => $id));			

			$condd = array('sscat_main' => $id);
			$data['sscat'] = $this->Admin_model->fetch_data("service_sub_categories",$condd);

			$data['seo_title'] 	 = "View Service Sub Category  | ".$this->data['admin_title'].""; 

			$this->load->view('admin/view_service_sub_categories',$data);


		}




		public function AddSubCategory($id)

		{

  
			$data['service_cat'] = $this->Admin_model->fetch_one_row('service_categories', array('scat_id' => $id));


			if($_POST):
				
				$slug_con = array('sscat_slug' => $this->input->post('sscat_slug'));
		
				$data['slug_service']  = $this->Admin_model->fetch_one_row("service_sub_categories",$slug_con);	
	
				if(!empty($data['slug_service']))

				{
	
				$this->session->set_flashdata('error','Slug Already Used');
		
				redirect(base_url().'admin/Categories/AddSubCategory/'.$id);
			
				exit;
			
				}
	
		
	
	$insert_data = array(
	
	'sscat_main' => $id, 

	'sscat_name' => $this->input->post('name'),
	
	'sscat_desc' => $this->input->post('desc'),
	
	'sscat_slug' => $this->input->post('sscat_slug'), 
	
	'meta_title' => $this->input->post('meta_title'),
	
	'meta_desc' => $this->input->post('meta_desc'),
	
	'meta_keywords' => $this->input->post('meta_keywords'),
	
	);
	
	
	$sid = $this->Admin_model->insertsection('service_sub_categories',$insert_data);
	
	
	if(!empty($_FILES["image"]["name"])){
	
	for($i=0;$i<count($_FILES['image']['name']);$i++){
		
	if($_FILES['image']['name'][$i]!=''){
		
		
				$filename2	=	basename($_FILES['image']['name'][$i]);
				
				$ext2		= 	@end(explode('.',$filename2));
				
				$ext2 		= 	strtolower($ext2);
				
				$gallery2	=	"sscat_".rand().'.'.$ext2;
				
				$uploadfile2=	"uploads/Products";
				
				move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$gallery2);

						$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  460,
                   'height'          =>  460,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
				
				$cond_img = array('sscat_id' => $sid);
				
				$data_img	=	array('sscat_image' => $gallery2);
				
				$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_sub_categories');
				
				}}}
	
	
	
	if(!empty($_FILES["image_banner"]["name"])){
	
	for($i=0;$i<count($_FILES['image_banner']['name']);$i++){
		
	if($_FILES['image_banner']['name'][$i]!=''){
		
		
				$filename2	=	basename($_FILES['image_banner']['name'][$i]);
				
				$ext2		= 	@end(explode('.',$filename2));
				
				$ext2 		= 	strtolower($ext2);
				
				$gallery2	=	"sscat_banner_".rand().'.'.$ext2;
				
				$uploadfile2=	"uploads/Products";
				
				move_uploaded_file($_FILES['image_banner']['tmp_name'][$i],$uploadfile2."/".$gallery2);
				

						$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  1349,
                   'height'          =>  300,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();


				$cond_img = array('sscat_id' => $sid );
				
				$data_img	=	array('sscat_banner' => $gallery2);
				
				$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_sub_categories');
				
				}}}

	
	$this->session->set_flashdata('success','Category Added Successfully');
	
	redirect(base_url().'admin/Categories/AddSubCategory/'.$id);
	
	endif;
				
	$data['seo_title'] 	= "Add Category | ".$this->data['admin_title'].""; 

	$this->load->view('admin/add_service_sub_category',$data);  
										
		}


		public function EditSubCategory($id)

		{


			$data['seo_title']    = "Edit Service Sub Category | ".$this->data['admin_title']."";

			$con = array('sscat_id' => $id);
			
			$data['sscat']   = $this->Admin_model->fetch_one_row("service_sub_categories",$con);	

			$data['service_cat'] = $this->Admin_model->fetch_one_row('service_categories', array('scat_id' => $data['sscat']['sscat_main']));


			if(isset($_REQUEST['update'])){
	
			//Check If Slug Updated
			
			if($this->input->post('sscat_slug') != $data['sscat']['sscat_slug'])	
		
		 {
		
			//Check Slug Already In Table
			
			$slug_con = array('sscat_slug' => $this->input->post('sscat_slug'));
			
			$data['slug_service']      = $this->Admin_model->fetch_one_row("service_sub_categories",$slug_con);	
		
			if(!empty($data['slug_service']))
			{
		
			$this->session->set_flashdata('error','Slug Already Used');
			
			redirect(base_url().'admin/Categories/EditSubCategory/'.$id);
				
			exit;
				
			}
		
		}
			
			$data_update = array(
			
				'sscat_name' => $this->input->post('name'),
		
				'sscat_desc' => $this->input->post('desc'),
				
				'sscat_slug' => $this->input->post('sscat_slug'), 
				
				'meta_title' => $this->input->post('meta_title'),
				
				'meta_desc' => $this->input->post('meta_desc'),
				
				'meta_keywords' => $this->input->post('meta_keywords'),
		
			);
			
			$this->Admin_model->update_all($data_update,$con,'service_sub_categories');
			
								
		if(!empty($_FILES["image_main"]["name"])){
		
		for($i=0;$i<count($_FILES['image_main']['name']);$i++){
			
		if($_FILES['image_main']['name'][$i]!=''){
			
					@unlink('uploads/Products/'.$data['sscat']['sscat_image']);	
			
					$filename2	=	basename($_FILES['image_main']['name'][$i]);
					
					$ext2		= 	@end(explode('.',$filename2));
					
					$ext2 		= 	strtolower($ext2);
					
					$gallery2	=	"sscat_".rand().'.'.$ext2;
					
					$uploadfile2=	"uploads/Products";

					move_uploaded_file($_FILES['image_main']['tmp_name'][$i],$uploadfile2."/".$gallery2);

							$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  460,
                   'height'          =>  460,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
					
					$cond_img = array('sscat_id' => $id );
					
					$data_img	=	array('sscat_image' => $gallery2);
					
					$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_sub_categories');
					
			
					}}}
		
		
		
		if(!empty($_FILES["image_banner"]["name"])){
		
		for($i=0;$i<count($_FILES['image_banner']['name']);$i++){
			
		if($_FILES['image_banner']['name'][$i]!=''){
			
					@unlink('uploads/Products/'.$data['sscat']['sscat_banner']);
				
					$filename2	=	basename($_FILES['image_banner']['name'][$i]);
					
					$ext2		= 	@end(explode('.',$filename2));
					
					$ext2 		= 	strtolower($ext2);
					
					$gallery2	=	"sscat_banner_".rand().'.'.$ext2;
					
					$uploadfile2=	"uploads/Products";
					
					move_uploaded_file($_FILES['image_banner']['tmp_name'][$i],$uploadfile2."/".$gallery2);

							$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  1349,
                   'height'          =>  300,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
					
					$cond_img = array('sscat_id' => $id );
					
					$data_img	=	array('sscat_banner' => $gallery2);
					
					$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_sub_categories');
					
		}}}


	
		
	$this->session->set_flashdata('success', 'Product Sub Category updated successfully.');
	
	redirect(base_url().'admin/Categories/EditSubCategory/'.$id);	
	
								
	}
	
	
				
	$this->load->view('admin/edit_service_sub_category', $data);
	


		}




		public function DeleteSubCategory($id)
		{

			$url = $_SERVER['HTTP_REFERER'];

			$service = $this->Admin_model->fetch_one_row('service_sub_categories', array('sscat_id' => $id));
		
			@unlink('uploads/Products/'.$service['sscat_image']);	
			
			@unlink('uploads/Products/'.$service['sscat_banner']);
			
			$this->db->where('sscat_id',$id);
			
			$this->db->delete('service_sub_categories');
			
			$this->session->set_flashdata('success','Product Sub Category Deleted Successfully');
			
			redirect($url);


		}

			public function ViewSecondary($id)

		{

			$data['service_cat'] = $this->Admin_model->fetch_one_row('service_sub_categories', array('sscat_id' => $id));			

			$condd = array('second_main' => $id);
			$data['second'] = $this->Admin_model->fetch_data("service_secondary",$condd);

	$data['seo_title'] 	 = "View Secondary | ".$this->data['admin_title'].""; 

    $this->load->view('admin/view_secondary',$data);


		}




		public function AddSecondary($id)

		{

  
			$data['service_cat'] = $this->Admin_model->fetch_one_row('service_sub_categories', array('sscat_id' => $id));

			if($_POST):
				
				$slug_con = array('second_slug' => $this->input->post('sscat_slug'));
		
				$data['slug_service']  = $this->Admin_model->fetch_one_row("service_secondary",$slug_con);	
	
				if(!empty($data['slug_service']))

				{
	
				$this->session->set_flashdata('error','Slug Already Used');
		
				redirect(base_url().'admin/Categories/AddSecondary/'.$id);
			
				exit;
			
				}
	
		
	
	$insert_data = array(
	
	'second_main' => $id, 

	'second_name' => $this->input->post('name'),
	
	'second_desc' => $this->input->post('desc'),
	
	'second_slug' => $this->input->post('sscat_slug'), 
	
	'meta_title' => $this->input->post('meta_title'),
	
	'meta_desc' => $this->input->post('meta_desc'),
	
	'meta_keywords' => $this->input->post('meta_keywords'),
	
	);
	
	
	$sid = $this->Admin_model->insertsection('service_secondary',$insert_data);
	
	
	if(!empty($_FILES["image"]["name"])){
	
	for($i=0;$i<count($_FILES['image']['name']);$i++){
		
	if($_FILES['image']['name'][$i]!=''){
		
		
				$filename2	=	basename($_FILES['image']['name'][$i]);
				
				$ext2		= 	@end(explode('.',$filename2));
				
				$ext2 		= 	strtolower($ext2);
				
				$gallery2	=	"second_".rand().'.'.$ext2;
				
				$uploadfile2=	"uploads/Products";
				
				move_uploaded_file($_FILES['image']['tmp_name'][$i],$uploadfile2."/".$gallery2);

						$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  460,
                   'height'          =>  460,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
				
				$cond_img = array('second_id' => $sid);
				
				$data_img	=	array('second_image' => $gallery2);
				
				$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_secondary');
				
				}}}
	
	
	
	if(!empty($_FILES["image_banner"]["name"])){
	
	for($i=0;$i<count($_FILES['image_banner']['name']);$i++){
		
	if($_FILES['image_banner']['name'][$i]!=''){
		
		
				$filename2	=	basename($_FILES['image_banner']['name'][$i]);
				
				$ext2		= 	@end(explode('.',$filename2));
				
				$ext2 		= 	strtolower($ext2);
				
				$gallery2	=	"banner_".rand().'.'.$ext2;
				
				$uploadfile2=	"uploads/Products";
				
				move_uploaded_file($_FILES['image_banner']['tmp_name'][$i],$uploadfile2."/".$gallery2);

						$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  1349,
                   'height'          =>  300,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
				
				$cond_img = array('second_id' => $sid );
				
				$data_img	=	array('second_banner' => $gallery2);
				
				$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_secondary');
				
				}}}

	
	$this->session->set_flashdata('success','Category Added Successfully');
	
	redirect(base_url().'admin/Categories/AddSubCategory/'.$id);
	
	endif;
				
	$data['seo_title'] 	= "Add Category | ".$this->data['admin_title'].""; 

	$this->load->view('admin/add_secondary',$data);  
										
		}


		public function EditSecondary($id)

		{


			$data['seo_title']    = "Edit Service Secondary Category | ".$this->data['admin_title']."";

			$con = array('second_id' => $id);			
			$data['service_cat']   = $this->Admin_model->fetch_one_row("service_secondary",$con);	

			$data['sscat'] = $this->Admin_model->fetch_one_row('service_sub_categories', array('sscat_id' => $data['service_cat']['second_main']));


			if(isset($_REQUEST['update'])){
	
			//Check If Slug Updated
			
			if($this->input->post('sscat_slug') != $data['service_cat']['second_slug'])	
		
		 {
		
			//Check Slug Already In Table
			
			$slug_con = array('second_slug' => $this->input->post('sscat_slug'));
			
			$data['slug_service']      = $this->Admin_model->fetch_one_row("service_secondary",$slug_con);	
		
			if(!empty($data['slug_service']))
			{
		
			$this->session->set_flashdata('error','Slug Already Used');
			
			redirect(base_url().'admin/Categories/EditSecondary/'.$id);
				
			exit;
				
			}
		
		}
			
			$data_update = array(
			
			'second_name' => $this->input->post('name'),
		
				'second_desc' => $this->input->post('desc'),
				
				'second_slug' => $this->input->post('sscat_slug'), 
				
				'meta_title' => $this->input->post('meta_title'),
				
				'meta_desc' => $this->input->post('meta_desc'),
				
				'meta_keywords' => $this->input->post('meta_keywords'),
		
			);
			
			$this->Admin_model->update_all($data_update,$con,'service_secondary');
			
								
		if(!empty($_FILES["image_main"]["name"])){
		
		for($i=0;$i<count($_FILES['image_main']['name']);$i++){
			
		if($_FILES['image_main']['name'][$i]!=''){
			
					@unlink('uploads/Products/'.$data['sscat']['second_image']);	
			
					$filename2	=	basename($_FILES['image_main']['name'][$i]);
					
					$ext2		= 	@end(explode('.',$filename2));
					
					$ext2 		= 	strtolower($ext2);
					
					$gallery2	=	"sscat_".rand().'.'.$ext2;
					
					$uploadfile2=	"uploads/Products";

					move_uploaded_file($_FILES['image_main']['tmp_name'][$i],$uploadfile2."/".$gallery2);

							$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  460,
                   'height'          =>  460,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
					
					$cond_img = array('second_id' => $id );
					
					$data_img	=	array('second_image' => $gallery2);
					
					$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_secondary');
					
			
					}}}
		
		
		
		if(!empty($_FILES["image_banner"]["name"])){
		
		for($i=0;$i<count($_FILES['image_banner']['name']);$i++){
			
		if($_FILES['image_banner']['name'][$i]!=''){
			
					@unlink('uploads/Products/'.$data['sscat']['sscat_banner']);
				
					$filename2	=	basename($_FILES['image_banner']['name'][$i]);
					
					$ext2		= 	@end(explode('.',$filename2));
					
					$ext2 		= 	strtolower($ext2);
					
					$gallery2	=	"second_banner_".rand().'.'.$ext2;
					
					$uploadfile2=	"uploads/Products";
					
					move_uploaded_file($_FILES['image_banner']['tmp_name'][$i],$uploadfile2."/".$gallery2);

						$configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  TRUE,
                   'width'           =>  1349,
                   'height'          =>  300,
                 );
                   $this->image_lib->clear();
                   $this->image_lib->initialize($configer);
                   $this->image_lib->resize();
					
					$cond_img = array('second_id' => $id );
					
					$data_img	=	array('second_banner' => $gallery2);
					
					$add_img	=	$this->Admin_model->update_all($data_img,$cond_img,'service_secondary');
					
		}}}


	
		
	$this->session->set_flashdata('success', 'Product Sub Category updated successfully.');
	
	redirect(base_url().'admin/Categories/EditSecondary/'.$id);	
	
								
	}
	
	
				
	$this->load->view('admin/edit_secondary', $data);
	


		}




		public function DeleteSecondary($id)
		{

			$url = $_SERVER['HTTP_REFERER'];

			$service = $this->Admin_model->fetch_one_row('service_secondary', array('second_id' => $id));
		
			@unlink('uploads/Products/'.$service['second_image']);	
			
			@unlink('uploads/Products/'.$service['second_banner']);
			
			$this->db->where('second_id',$id);
			
			$this->db->delete('service_secondary');
			
			$this->session->set_flashdata('success','Product Secondary Deleted Successfully');
			
			redirect($url);


		}





		//Ajax

		public function GetSub()
		{


			$id = $this->input->post('category');


			$cond = array('sscat_main' => $id);

			$subcats = $this->Admin_model->fetch_where_order('service_sub_categories',$cond,'sscat_name','asc');

					$option ="<option value=''>Select Sub Category</option>";

					foreach($subcats as $subcat)
					{
						
						$option.= "<option value='".$subcat->sscat_id."'>".$subcat->sscat_name."</option>";

					}

					echo $option;


		}
















		
		
	
	
}