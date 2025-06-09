<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooms extends MY_Controller {
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
			
			$data['view_data']	=	$this->Admin_model->fetch_room();		
			$data['seo_title'] 	= 	"View Rooms | ".$this->data['admin_title']."";					
		 $this->load->view('admin/view_rooms',$data); 
 }
		
		
	  
		 
        public function AddRooms(){			 

			$data['type_data']	=	$this->Admin_model->fetch_all_order('categories','cat_id','Desc');		
			$data['seo_title'] 	= 	"Add Rooms | ".$this->data['admin_title']."";			

			 
			 if($_POST)
			 {

$color_pic = substr(md5(rand()), 0, 6);
$color = '#'.$color_pic;

$type	        =	$_POST['type'];			 
$name		           =	$_POST['name'];
$daterange		   =	$_POST['daterange'];
$rate		   =	$_POST['rate'];
$facilities		       =	$_POST['facilities'];
$description		   =	$_POST['description'];
$avail_room		   =	$_POST['avail_room'];
$tax		              =	$_POST['tax']; 
$room_size		          =	$_POST['room_size']; 

$startdate = explode("-",$daterange);
$startdate1   =  date('Y-m-d', strtotime($startdate[0])); 
$enddate1    =  date('Y-m-d', strtotime($startdate[1])); 
				
$name_cond  =  array('name' => $name,'hotel'=>0);
$data['name_data'] 	= 	$this->Admin_model->fetch_data('room',$name_cond);


	$create_date =  date('Y-m-d'); 	
				
	 if(count($data['name_data'])>0)
	 {		
		$this->session->set_flashdata('error', 'Sorry! Room Name already taken'); 
		redirect(base_url().'admin/Rooms/AddRooms');
	 }
	 else
	 {
			
		$add_data  	= 	array(
	'category' =>    $type,	
	'name'     =>    $name,
	'rate'    =>    $rate,
	'facilities'		=>	$facilities,
	'description'	=>	$description,
	'avail_room'	        =>	$avail_room,
 'startdate'		        =>	$startdate1,
 'enddate'	            =>	$enddate1,	
	'tax'	                =>	$tax,
	'create_date'	        =>	$create_date,
	'room_size'	            =>	$room_size,
	'hotel'               =>0,
	'color'     =>    $color,
	'room_slug_name'  => $this->create_slug($this->input->post('name')),
	);
	
		$id = 	$this->Admin_model->insertsection('room',$add_data);

			$sTime = strtotime($startdate[0]); // Start as time  
			$eTime = strtotime($startdate[1]); // End as time  
			
			for ($i = $sTime; $i <= $eTime;  $i += (86400)) { 
                                      
			$betdates = date('Y-m-d', $i); 
			$nextdate = date('Y-m-d', strtotime($betdates .' +1 day'));
			
			$fieldsin  	= 	array(
	'roomid'           =>    $id,
	'avail_room'       =>    $avail_room,
	'startdate'		   =>	$betdates,
	'end_date'		   =>	$nextdate,
	'rate'     =>	$rate,	
	'hotel' => 0
	);
			
			$passin = 	$this->Admin_model->insertsection('available_date',$fieldsin);
		
		} 
			

			for ($i = 0; $i < count($_FILES['main_img']['name']); $i++) 
			{  
				if($_FILES['main_img']['tmp_name'][$i]!='')
				{
					
					$filename2 	= 	basename($_FILES["main_img"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"hotel_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Rooms";
					
					move_uploaded_file($_FILES["main_img"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
						
				$data_imgg  	= array('image'  =>$gallery2);
				$condd  	= 	array('roomid'  =>$id);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'room');
			
				}
			}
			for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
				{  
					if($_FILES['image']['tmp_name'][$i]!='')
					{
						
					$filename 	= 	basename($_FILES["image"]["name"][$i]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	"moreimg_".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Rooms";
					
					move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile."/".$gallery);
					
					
						
			$fieldsin  	= 	array('roomid'  => $id,'more_image'=>$gallery);
			$add_imgg2 = 	$this->Admin_model->insertsection('room_images',$fieldsin);
									
					}
				}	


				for ($i = 0; $i < count($_FILES['Facimage']['name']); $i++) 
				{  
					if($_FILES['Facimage']['tmp_name'][$i]!='')
					{
						
					$filename 	= 	basename($_FILES["Facimage"]["name"][$i]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	"Facimage_".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Rooms";
					
					move_uploaded_file($_FILES["Facimage"]["tmp_name"][$i],  $uploadfile."/".$gallery);
					
					
						
			$fieldsin  	= 	array('roomid'  => $id,'Facimage'=>$gallery,'Factitle'=>$_POST['Factitle'][$i]);
			$add_imgg2 = 	$this->Admin_model->insertsection('room_facility',$fieldsin);
									
					}
				}	
				
				
		
		$this->session->set_flashdata('success', 'Rooms Added Successfully.'); 
		redirect(base_url().'admin/Rooms/AddRooms');
		
	  
	  }	
				
			 }
		 $this->load->view('admin/add_rooms', $data);
		}
				

		
		public function DeleteRooms($roomid)
		{
			
			$cond                   =   array('roomid' => $roomid);
			$data['view_data'] 	= 	$this->Admin_model->fetch_data('room_images',$cond);
			
			foreach($data['view_data']  as $item=>$val)
			{
			 @unlink('uploads/Rooms/'.$val->image);
			 
			 $this->db->where('imageid',$val->imageid);
			 $this->db->delete('room_images');
			}
			

			$data['view_date'] 	= 	$this->Admin_model->fetch_data('available_date',$cond);
			
			foreach($data['view_date']  as $date)
			{	 
			 $this->db->where('roomid',$date->roomid);
			 $this->db->delete('available_date');
			}
			
			
			$cond2                  =   array('roomid' => $roomid);
			$data['view_dataa'] 	= 	$this->Admin_model->fetch_one_row('room',$cond2);
			
		   @unlink('uploads/Rooms/'.$data['view_dataa']['image']);
		 
			$this->db->where('roomid',$roomid);
			$this->db->delete('room');
								
			$this->session->set_flashdata('success', 'Room  Deleted Successfully.'); 
			redirect(base_url().'admin/Rooms');
		}
			
	 public function EditRooms($roomid)
		{			 
			$data['seo_title'] 	= 	"View Rooms | ".$this->data['admin_title']."";		

				$data['type_data']	=	$this->Admin_model->fetch_all_order('categories','cat_id','Desc');		
			 
			$cond1                  =   array('roomid' => $roomid);
			$data['arr_pack'] 	= 	$this->Admin_model->fetch_one_row('room',$cond1);
		
			$data['res'] 	        = 	$this->Admin_model->fetch_data('room_images',$cond1);
			$data['fac'] 	        = 	$this->Admin_model->fetch_data('room_facility',$cond1);
		 $data['nr_img']         = count($data['res']);
			 
			 if($_POST)
			 {			 
			
					$type	        =	$_POST['type'];			 
					$name		       =	$_POST['name'];
					$daterange		  =	$_POST['datefilter'];
					$rate		       =	$_POST['rate'];
					$facilities		   =	$_POST['facilities'];
					$description		  =	$_POST['description'];
					$avail_room		   =	$_POST['avail_room'];
					$tax		          =	$_POST['tax']; 
					$room_size		    =	$_POST['room_size']; 
					
					if(!empty($_POST['datefilter'])){
					
					$startdate = explode("-",$daterange);
					$startdate1   =  date('Y-m-d', strtotime($startdate[0])); 
					$enddate1    =  date('Y-m-d', strtotime($startdate[1])); 
				
					} else {
					
						$startdate1   =  	$data['arr_pack']['startdate']; 
						$enddate1    =  $data['arr_pack']['enddate'];

					}
	
     $name_cond2  =   array('name' => $name,'hotel'=>0);
     $data['name_data'] 	= 	$this->Admin_model->check_data_room('room',$name_cond2,$roomid);		

     if(count($data['name_data'])>0)
	 {
		$this->session->set_flashdata('error', 'Sorry! Room Name already taken'); 
		redirect(base_url().'admin/Rooms/EditRooms/'.$roomid);
	 }
	 else
	 {
	
	$datas  	= 	array(
	
			'category' =>    $type,	
			'name'     =>    $name,
			'rate'    =>    $rate,
			'facilities'		=>	$facilities,
			'description'	=>	$description,
			'avail_room'	        =>	$avail_room,
			'startdate'		        =>	$startdate1,
			'enddate'	            =>	$enddate1,	
			'tax'	                =>	$tax,			
			'room_size'	            =>	$room_size,
			'room_slug_name'  => $this->create_slug($this->input->post('name')),
			);	
			
$pass_add	=	$this->Admin_model->update_all($datas,$cond1,'room');

$format = 'Y-m-d'; 
			$sTime = strtotime($startdate1); 
			$eTime = strtotime($enddate1); 
			
				for ($i = $sTime; $i <= $eTime;  $i += (86400)) { 
                                      
			$betdates = date('Y-m-d', $i); 
			$nextdate=date('Y-m-d', strtotime($betdates .' +1 day'));
			
				
$cond_fet           =   array('startdate' => $betdates,'end_date' => $nextdate,'roomid' => $roomid);
$data['cat_fet'] 	= 	$this->Admin_model->fetch_data('available_date',$cond_fet);

		
			if(count($data['cat_fet'])>0)
			{
				
				
				$datass  	= 	array(
					'roomid'           =>  $roomid,
					'avail_room'       =>    $avail_room,
					'startdate'		   =>	$betdates,
					'end_date'		   =>	$nextdate,
					'rate'     =>	$rate,	
	);
	
			
$pass_adds	=	$this->Admin_model->update_all($datass,$cond_fet,'available_date');
	
			}
		
}
}

		if(!empty($_POST['datefilter'])){

             $this->db->where('roomid',$roomid);
			 $this->db->delete('available_date');
			 
		
			$startdate = explode("-",$daterange);
		    $startdate1   =  date('Y-m-d', strtotime($startdate[0])); 
		    $enddate1    =  date('Y-m-d', strtotime($startdate[1])); 
			 
			$sTime = strtotime($startdate[0]); // Start as time  
			$eTime = strtotime($startdate[1]); // End as time  
			
			for ($i = $sTime; $i <= $eTime;  $i += (86400)) { 
                                      
			$betdates = date('Y-m-d', $i); 
			$nextdate = date('Y-m-d', strtotime($betdates .' +1 day'));
			
			$fieldsin  	= 	array(
	'roomid'           =>    $roomid,
	'avail_room'       =>    $avail_room,
	'startdate'		   =>	$betdates,
	'end_date'		   =>	$nextdate,
	'rate'     =>	$rate,	
	'hotel' => 0
	);
			
			$passin = 	$this->Admin_model->insertsection('available_date',$fieldsin);
		
		} 

}



			
			for ($i = 0; $i < count($_FILES['main_img']['name']); $i++) 
			{  
				if($_FILES['main_img']['tmp_name'][$i]!='')
				{
				
					@unlink('uploads/Rooms/'.$data['arr_pack']['image']);	
				
					
					$filename2 	= 	basename($_FILES["main_img"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"hotel_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Rooms";
					
					move_uploaded_file($_FILES["main_img"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
						
				$data_imgg  = array('image'  =>$gallery2);
				$condd  	= 	array('roomid'  =>$roomid);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'room');
			
				}
			}
			for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
				{  
					if($_FILES['image']['tmp_name'][$i]!='')
					{
					
					$filename 	= 	basename($_FILES["image"]["name"][$i]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	"moreimg_".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Rooms";
					
					move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile."/".$gallery);
					
					
			$fieldsin  	= 	array('roomid'  => $roomid,'more_image'=>$gallery);
			$add_imgg2 = 	$this->Admin_model->insertsection('room_images',$fieldsin);
					}
				}
				
					for ($i = 0; $i < count($_FILES['Facimage']['name']); $i++) 
				{  
					if($_FILES['Facimage']['tmp_name'][$i]!='')
					{
						
					$filename 	= 	basename($_FILES["Facimage"]["name"][$i]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	"Facimage_".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Rooms";
					
					move_uploaded_file($_FILES["Facimage"]["tmp_name"][$i],  $uploadfile."/".$gallery);
					
					
						
			$fieldsin  	= 	array('roomid'  => $roomid,'Facimage'=>$gallery,'Factitle'=>$_POST['Factitle'][$i]);
			$add_imgg2 = 	$this->Admin_model->insertsection('room_facility',$fieldsin);
									
					}
				}	
				
				

		if($pass_add)
		{
			$this->session->set_flashdata('success', 'Room Details Updated successfully.'); 
			redirect(base_url().'admin/Rooms/EditRooms/'.$roomid);
		}
	 
				 
            }
		 $this->load->view('admin/edit_rooms', $data);
		}
		public function DeleteRoomsMore($roomid,$imageid)
		{
			
			$cond                   =   array('roomid' => $roomid,'imageid' => $imageid);
			$data['view_data'] 	= 	$this->Admin_model->fetch_one_row('room_images',$cond);
			
			
			@unlink('uploads/Rooms/'.$data['view_data']['image']);
			 
			 $this->db->where('roomid',$roomid);
			 $this->db->where('imageid',$imageid);
			 $this->db->delete('room_images');
					
			$this->session->set_flashdata('success', 'Room Deleted Successfully.'); 
			redirect(base_url().'admin/Rooms/EditRooms/'.$roomid);
		}

		public function DeleteRoomsFac($roomid,$imageid)
		{
			
			$cond                   =   array('roomid' => $roomid,'imageid' => $imageid);
			$data['view_data'] 	= 	$this->Admin_model->fetch_one_row('room_facility',$cond);
			
			
			@unlink('uploads/Rooms/'.$data['view_data']['Facimage']);
			 
			 $this->db->where('roomid',$roomid);
			 $this->db->where('imageid',$imageid);
			 $this->db->delete('room_facility');
					
			$this->session->set_flashdata('success', 'Facility Deleted Successfully.'); 
			redirect(base_url().'admin/Rooms/EditRooms/'.$roomid);
		}
			
		public function create_slug($name)
		{
			
			$count 	= 	0;
			$name 	= 	url_title($name);
			$slug_name 	= 	$name;           
			while(true) 
			{
				$this->db->select('*');
				$this->db->where('room_slug_name', $slug_name);  
				$query = $this->db->get('room');
				if ($query->num_rows() == 0) break;
				$slug_name 	=	$name . '-' . (++$count); 
			}
			return $slug_name;
		}
		
		public function change_slug($name,$id)
		{
			$count 	= 	0;
			$name 	= 	url_title($name);
			$slug_name 	= 	$name;            
			while(true) 
			{
				$this->db->select('*');
				$this->db->where('room_slug_name', $slug_name); 
				$this->db->where_not_in('roomid', $id);  
				$query 	= 	$this->db->get('room');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  
			}
			return $slug_name;
		}
			    			
}