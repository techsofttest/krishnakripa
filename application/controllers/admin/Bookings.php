<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookings extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				$this->load->model("BookingModel");
				
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
		   
		 	$data['bookings']	=	$this->BookingModel->ViewBookings();		   
			$parent =  $this->uri->segment(4);				 
			$data['seo_title'] 	= 	"View Bookings | ".$this->data['admin_title'].""; 			
			$this->load->view('admin/view_bookings',$data);
		
        }
		
		
	
		public function Add()
		
		{
			
			
			$data['seo_title'] 	= 	" Add Bookings | ".$this->data['admin_title'].""; 

			$data['room_types']	=	$this->Admin_model->fetch_all_order('categories','cat_title','asc');	
			
			if($_POST):
			 
			$booking_data  	= 	array(

			'uid' => date('ymdhis'),
			 
		    'check_in_date'  => date('Y-m-d',strtotime($this->input->post('check_in'))),
		
		    'check_out_date' => date('Y-m-d',strtotime($this->input->post('check_out'))),

			'booking_room_id' => $this->input->post('room_select'),

		    'adults'=>$this->input->post('adults'),
		    
			'children'=>$this->input->post('childrens'),
		    
			'no_of_rooms'=>$this->input->post('rooms'),

			'total_amount' => $this->input->post('total_amount'),
		      
			'paid_amount'=> $this->input->post('current_payment'),

			'payment_type'=>$this->input->post('payment_method'),

			'payment_notes'=>$this->input->post('payment_notes'),

			'booking_notes'=>$this->input->post('booking_notes'),

			'booking_status'=>$this->input->post('booking_status'),
		
		 );
		

			//Customer Data 

			$phone_number = trim($this->input->post('phone'));

			$check_customer = $this->Admin_model->fetch_one_row('customers',array('phone_number' => $phone_number));

			if(empty($check_customer))
			{

			$cus_data = array(

				'first_name' => $this->input->post('f_name'),

				'last_name' => $this->input->post('l_name'),

				'email_address' => $this->input->post('email'),

				'phone_number' => trim($this->input->post('phone')),

				'address' => $this->input->post('address'),
			);

			$cus_id = $this->Admin_model->insertsection('customers',$cus_data);

			$bid =  $this->Admin_model->insertsection('bookings',$booking_data);

			$update_booking_data = array(
				'booking_customer_id' => $cus_id,
			);
			$update_booking_cond = array('booking_id' => $bid);

			$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');

			}

			else
			{

			$bid =  $this->Admin_model->insertsection('bookings',$booking_data);

			$update_booking_data = array(
				'booking_customer_id' => $check_customer['cus_id'],
			);
			$update_booking_cond = array('booking_id' => $bid);

			$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');

			}




					
			$this->session->set_flashdata('success', 'Booking Added Successfully.'); 
				
			redirect(base_url().'admin/Bookings');
			    
			endif;
			
			
			$this->load->view('admin/add_booking',$data); 
			
		}





		public function CheckCustomer()
		{

		$phone = trim($this->input->post('phone'));

		$this->db->where('phone_number', $phone);

    	$query = $this->db->get('customers');

		 if ($query->num_rows() > 0) {
        echo json_encode([
            'status' => 1,
            'data' => $query->row()
        ]);
    	} else {
        echo json_encode([
            'status' => 0
        ]);
    	}


		}





		public function CalculatePrice()
		{

		$room_id = $this->input->post('room_id');
		$no_of_room = $this->input->post('no_of_rooms');
		$check_in = $this->input->post('check_in');
		$check_out = $this->input->post('check_out');

		$room_det = $this->Admin_model->fetch_one_row('room',['roomid' => $room_id]);

		$base_price = $room_det['rate'];
		//$tax = isset($room_det['tax']) ? $room_det['tax'] : 0;

		$tax = 0;

		// Calculate number of nights
		$check_in_date = new DateTime($check_in);
		$check_out_date = new DateTime($check_out);
		$interval = $check_in_date->diff($check_out_date);
		$nights = $interval->days;

		// Calculate total price
		$subtotal = $base_price * $no_of_room * $nights;
		$tax_amount = ($subtotal * $tax) / 100;
		$total = $subtotal + $tax_amount;

		echo json_encode([
			'status' => 1,
			'base_price' => $base_price,
			'nights' => $nights,
			'rooms' => $no_of_room,
			'subtotal' => $subtotal,
			'tax' => $tax,
			'tax_amount' => $tax_amount,
			'total' => $total
		]);

		}




		public function GetRoomsAvailable()
		{

			$check_in = $this->input->post('check_in');
			$check_out = $this->input->post('check_out');
			$room_type = $this->input->post('room_type');

			$data['html'] ="";
			
			if($check_in && $check_out)
			{
				$data['status'] = 1;

				$available_rooms = $this->BookingModel->get_available_rooms($check_in, $check_out,$room_type);

				if(!empty($available_rooms))
				{
				foreach($available_rooms as $room)
				{
				$data['html'] .= "<tr>
				
							<td><input class='room_select' type='radio' name='room_select' value='".$room->roomid."' required></td>

							<td><img src='".base_url()."/uploads/Rooms/".$room->image."' style='height:80px;width:80px;'></td>

							<td>{$room->name}</td>

							<td>{$room->avail_room}</td>

							<td>{$room->rate}</td>

							</tr>";
				}
				}
				else
				{

							$data['html'] .= "<tr>
				
							<td colspan='5' style='color:red;text-align:center'>No Rooms Available</td>

							</tr>";

				}	



				echo json_encode($data);
			}
			else
			{
				$data['status'] = 0;
				$data['msg'] = "Enter check in and checkout first";

				echo json_encode($data);
			}	

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