<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookings extends MY_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text','number'));
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





		public function FetchData()
    	{

			/*pagination start*/
			$request = service('request');
			$postData = $request->getPost();
			$dtpostData = $postData['data'];
			$response = array();
	
			## Read value
			$draw = $dtpostData['draw'];
			$start = $dtpostData['start'];
			$rowperpage = $dtpostData['length']; // Rows display per page
			$columnIndex = $dtpostData['order'][0]['column']; // Column index
			$columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
			$searchValue = $dtpostData['search']['value']; // Search value

			// Check if the current sort order is 'asc', then set it to 'desc'
			if ($columnSortOrder === 'asc') {
				$columnSortOrder = 'desc';
			} 

	
			## Total number of records without filtering
		
			$totalRecords = $this->common_model->GetTotalRecords('hr_payrolls','pr_id','DESC');
	
			## Total number of records with filtering
		
			$searchColumns = array('pr_id');

			$totalRecordwithFilter = $this->common_model->GetTotalRecordwithFilter('hr_payrolls','pr_id',$searchValue,$searchColumns);
		
			##Joins if any //Pass Joins as Multi dim array
			$joins = array();
			## Fetch records
			$records = $this->common_model->GetRecord('hr_payrolls','pr_id',$searchValue,$searchColumns,$columnName,$columnSortOrder,$joins,$rowperpage,$start);
		
			$data = array();

			$i=1;

			foreach($records as $record ){

			//$action = '<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> View</a> <a  href="javascript:void(0)" class="edit edit-color edit_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->ts_id.'" data-original-title="Edit"><i class="ri-pencil-fill"></i> Edit</a> <a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->ts_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> Delete</a>';
			
			$action='<a  href="javascript:void(0)" class="edit edit-color view_btn" data-toggle="tooltip" data-placement="top" title="edit"  data-id="'.$record->pr_id.'" data-original-title="Edit"><i class="ri-eye-fill"></i> </a> 
			<a href="javascript:void(0);" data-id="'.$record->pr_id.'" class="print_color" title="Print"><i class="ri-file-pdf-2-line " aria-hidden="true"></i> </a>
			<a href="javascript:void(0)" class="delete delete-color delete_btn" data-toggle="tooltip" data-id="'.$record->pr_id.'"  data-placement="top" title="Delete"><i  class="ri-delete-bin-fill"></i> </a>';

			$data[] = array( 
				"pr_id"=>$i,
				"pr_month" => date('M Y',strtotime("1-{$record->pr_month}-{$record->pr_year}")),
				"total_salary" => format_currency($record->pr_total_salary),
				"action" =>$action,
			);

			$i++; 

			}
	
			## Response
			$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data,
			"token" => csrf_hash() // New token hash
			);
	
			//return $this->response->setJSON($response);

			echo json_encode($response);

			exit;

			/*pagination end*/
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
			
			
			$data['seo_title'] 	= 	"Add Bookings | ".$this->data['admin_title'].""; 

			$data['room_types']	=	$this->Admin_model->fetch_all_order('categories','cat_title','asc');	
			
			if($_POST):
			 
			$booking_data  	= 	array(

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

			'customer_first_name' => $this->input->post('f_name'),

			'customer_last_name' => $this->input->post('l_name'),

			'customer_email' => $this->input->post('email'),

			'customer_phone_number' => trim($this->input->post('phone')),

			'customer_address' => $this->input->post('address'),
		
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


			$payment_data = array(
			'bp_booking' => $bid,
			'bp_pay_method' => $this->input->post('payment_method'),
			'bp_paid_on' => date('Y-m-d'),
			'bp_notes' => $this->input->post('payment_notes'),
			'bp_amount' => $this->input->post('current_payment'),
			'bp_type' => 'credit',
			);

			$pay_id = $this->Admin_model->insertsection('booking_payments',$payment_data);



			$booking_uid = 'KK' . str_pad($bid, 5, '0', STR_PAD_LEFT);

			$update_booking_data = array(
				'uid' => $booking_uid,
			);
			$update_booking_cond = array('booking_id' => $bid);

			$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');


			if($_FILES['id_proof']['tmp_name']!='')
					{
					
					$filename 	= 	basename($_FILES["id_proof"]["name"]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	$bid."id".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Booking";
					
					move_uploaded_file($_FILES["id_proof"]["tmp_name"],  $uploadfile."/".$gallery);
					
					$update_id_proof_data = array(
					'id_proof' => $gallery,
					);

					$update_booking_cond = array('booking_id' => $bid);

					$this->Admin_model->update_all($update_id_proof_data,$update_booking_cond,'bookings');

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
			$room_count = $this->input->post('room_count');

			$data['html'] ="";
			
			if($check_in && $check_out)
			{
				$data['status'] = 1;

				$available_rooms = $this->BookingModel->get_available_rooms($room_count,$check_in, $check_out,$room_type);

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




		public function View($id)
		{

		$data['booking'] = $this->BookingModel->ViewBookingById($id);

		$data['payments'] = $this->BookingModel->ViewPaymentsByBookingId($id,"credit"); 

		$data['refunds'] = $this->BookingModel->ViewPaymentsByBookingId($id,"debit");

		$data['total_payments'] = $this->BookingModel->BookingTotalPayments($id);

		$data['total_refunds'] = $this->BookingModel->BookingTotalRefunds($id);

		$this->load->view('admin/view_booking_single',$data);
 
		}


		public function Edit($id)
		{

		$data['booking'] = $this->BookingModel->ViewBookingById($id);

		$data['room_types']	=	$this->Admin_model->fetch_all_order('categories','cat_title','asc');

		if(!empty($this->input->post()))
		{

		$room_count = $this->input->post('room_count');

		$check_in = $this->input->post('check_in');

		$check_out = $this->input->post('check_out');

		$current_booking_id = $id;

		$is_available = $this->BookingModel->room_available_check_edit($data['booking']['booking_room_id'], $check_in, $check_out, $room_count, $current_booking_id);

		if(!$is_available)
		{

		$this->session->set_flashdata('error', 'Room Unavailable.'); 
				
		redirect(base_url().'admin/Bookings/Edit/'.$id);

		}

		else
		{
		//Update date and payments


		$base_price = $data['booking']['rate'];
		//$tax = isset($room_det['tax']) ? $room_det['tax'] : 0;
		$tax = 0;

		// Calculate number of nights
		$check_in_date = new DateTime($check_in);
		$check_out_date = new DateTime($check_out);
		$interval = $check_in_date->diff($check_out_date);
		$nights = $interval->days;

		// Calculate total price
		$subtotal = $base_price * $room_count * $nights;
		$tax_amount = ($subtotal * $tax) / 100;
		$total = $subtotal + $tax_amount;


		$update_booking_data = array(

		'check_in_date'  => date('Y-m-d',strtotime($this->input->post('check_in'))),
		
		'check_out_date' => date('Y-m-d',strtotime($this->input->post('check_out'))),

		'no_of_rooms'=> $room_count,

		'total_amount' => $total,

		'customer_first_name' => $this->input->post('f_name'),

		'customer_last_name' => $this->input->post('l_name'),

		'customer_email' => $this->input->post('email'),

		'customer_phone_number' => trim($this->input->post('phone')),

		'customer_address' => $this->input->post('address'),

		);

		$update_booking_cond = array('booking_id' => $id);

		$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');

		$this->session->set_flashdata('success', 'Booking Updated.'); 
				
		redirect(base_url().'admin/Bookings/Edit/'.$id);

		}


		}

		$this->load->view('admin/edit_booking',$data);


		}



		public function Delete($id)
		{

		$this->db->where('booking_id',$id);
		
		$this->db->delete('bookings');

		$this->db->where('bp_booking',$id);
		
		$this->db->delete('booking_payments');

		redirect(base_url().'admin/Bookings');

		}





		public function GetPending()
		{

		$booking_id = $this->input->post('bid');
		if(empty($booking_id))
		{
			echo json_encode(['status' => 'error', 'message' => 'Booking ID is missing']);
			return;
		}

		$booking = $this->BookingModel->ViewBookingById($booking_id);

		$total_amount = $booking['total_amount'];

		$total_paid = $this->BookingModel->CheckPending($booking_id);
		

		$pending = $total_amount-$total_paid;

		echo json_encode(['status' => 'success', 'pending' => $pending,'total_paid' => $total_paid]);

		return;

		}



		public function AddPayment()
		{

		$booking_id = $this->input->post('booking_id');
		if(empty($booking_id))
		{
			echo json_encode(['status' => 'error', 'message' => 'Booking ID is missing']);
			return;
		}
		$booking = $this->BookingModel->ViewBookingById($booking_id);

		// Validate the payment date
		$payment_date = $this->input->post('payment_date');
		if (empty($payment_date) || !DateTime::createFromFormat('Y-m-d', $payment_date)) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid payment date']);
			return;
		}
		// Validate the amount
		$amount = $this->input->post('amount');
		if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid amount']);
			return;
		}

		$total_already_paid = $this->BookingModel->BookingTotalPayments($booking_id);

		if($amount>($booking['total_amount']-$total_already_paid))
		{
			echo json_encode(['status' => 'error', 'message' => 'Cannot be greater than total amount']);
			return;
		}


		// Validate the payment method
		$payment_method = $this->input->post('payment_method');
		if (empty($payment_method)) {
			echo json_encode(['status' => 'error', 'message' => 'Payment method is required']);
			return;
		}

		// Validate the payment method
		$payment_type = $this->input->post('payment_type');
		if (empty($payment_method)) {
			echo json_encode(['status' => 'error', 'message' => 'Something went wrong, Please try again']);
			return;
		}
	
		$payment_data = array(
			'bp_booking' => $booking_id,
			'bp_pay_method' => $this->input->post('payment_method'),
			'bp_paid_on' => date('Y-m-d', strtotime($this->input->post('payment_date'))),
			'bp_notes' => $this->input->post('payment_notes'),
			'bp_amount' => $this->input->post('amount'),
			'bp_type' => $this->input->post('payment_type')
		);

		$pay_id = $this->Admin_model->insertsection('booking_payments',$payment_data);

		if($pay_id)
		{
			// Update the booking with the new payment amount

			if($payment_type=="credit")
			{

			$update_booking_data = array(
				'paid_amount' => $this->BookingModel->BookingTotalPayments($booking_id)
			);

			$update_booking_cond = array('booking_id' => $booking_id);

			$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');

			}

			echo json_encode(['status' => 'success', 'message' => 'Payment added successfully']);
		}
		else
		{
			echo json_encode(['status' => 'error', 'message' => 'Failed to add payment']);
		}


		}




		public function Status()
		{

		if(!empty($this->input->post()))
		{

			$booking_id = $this->input->post('booking_id');
			if(empty($booking_id))
			{
				$this->session->set_flashdata('error', 'Booking ID is missing');
				redirect(base_url().'admin/Bookings');
			}

			$update_data = array(
				'booking_status' => $booking_status = $this->input->post('booking_status')
			);

			if($booking_status=="checked_in")
			{

			$update_data['actual_check_in_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('status_date') . ' ' . $this->input->post('status_time')));

			}


			if($booking_status=="checked_out")
			{

			$update_data['actual_check_out_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('status_date') . ' ' . $this->input->post('status_time')));

			}

			$update_cond = array('booking_id' => $booking_id);

			$this->Admin_model->update_all($update_data,$update_cond,'bookings');

			$this->session->set_flashdata('success', 'Booking status updated successfully');

			redirect(base_url().'admin/Bookings');
		}


		}







		public function CheckIn()
		{

		if(!empty($this->input->post()))
		{

			$booking_id = $this->input->post('booking_id');
			if(empty($booking_id))
			{
				$this->session->set_flashdata('error', 'Booking ID is missing');
				redirect(base_url().'admin/Bookings');
			}

			// Validate the check-in date and time
			$check_in_date = $this->input->post('check_in_date');
			$check_in_time = $this->input->post('check_in_time');
			if (empty($check_in_date) || !DateTime::createFromFormat('Y-m-d', $check_in_date)) {
				$this->session->set_flashdata('error', 'Invalid check-in date');
				redirect(base_url().'admin/Bookings');
			}
			if (empty($check_in_time) || !DateTime::createFromFormat('H:i', $check_in_time)) {
				$this->session->set_flashdata('error', 'Invalid check-in time');
				redirect(base_url().'admin/Bookings');
			}

			$update_data = array(
				'check_in_status' => $this->input->post('check_in_status'),
				'actual_check_in_date' => date(
					'Y-m-d H:i:s',
					strtotime(
						$this->input->post('check_in_date') . ' ' . $this->input->post('check_in_time')
					)
				)
			);

			$update_cond = array('booking_id' => $booking_id);

			$this->Admin_model->update_all($update_data,$update_cond,'bookings');

			$this->session->set_flashdata('success', 'Check-in successful');

			redirect(base_url().'admin/Bookings');

		}

		}




		public function CheckOut()
		{

		if(!empty($this->input->post()))
		{

			$booking_id = $this->input->post('booking_id');
			if(empty($booking_id))
			{
				$this->session->set_flashdata('error', 'Booking ID is missing');
				redirect(base_url().'admin/Bookings');
			}

			// Validate the check-in date and time
			$check_out_date = $this->input->post('check_out_date');
			$check_out_time = $this->input->post('check_out_time');
			if (empty($check_out_date) || !DateTime::createFromFormat('Y-m-d', $check_out_date)) {
				$this->session->set_flashdata('error', 'Invalid check-in date');
				redirect(base_url().'admin/Bookings');
			}
			if (empty($check_out_time) || !DateTime::createFromFormat('H:i', $check_out_time)) {
				$this->session->set_flashdata('error', 'Invalid check-in time');
				redirect(base_url().'admin/Bookings');
			}

			$update_data = array(
				'check_out_status' => $this->input->post('check_out_status'),
				'actual_check_out_date' => date(
					'Y-m-d H:i:s',
					strtotime(
						$this->input->post('check_out_date') . ' ' . $this->input->post('check_out_time')
					)
				)
			);

			$update_cond = array('booking_id' => $booking_id);

			$this->Admin_model->update_all($update_data,$update_cond,'bookings');

			$this->session->set_flashdata('success', 'Check Out successful');

			redirect(base_url().'admin/Bookings');

		}

		}
		
		
			
		public function Invoice($id)	
			{
			
				$booking = $this->BookingModel->ViewBookingById($id);

				$this->load->library('Pdf');
				$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Krishnakripa');
				$pdf->SetTitle('');
				$pdf->SetSubject('Booking Invoice');
				
				// set default header data

				//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

				// set header and footer fonts 
				// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				// ---------------------------------------------------------

				// set font
				$pdf->SetFont('dejavusans', '', 10);

				// add a page
				$pdf->AddPage();


				$html = '

				<style>
				
				table
				{
				line-height: 1.5;
				font-size:10px;
				}

				</style>

				<table cellpadding="10">


				<tr>
				
				<th width="50%" align="left">
					
				<img style="height:80px;" src="'.base_url().'assets/img/logo1.png">

				</th>

				<th width="50%" align="right">
				<b>Krishnakripa Residency</b><br>
				Ambalamedu PO<br>
				Kakkanadu,Ernakulam<br>
				Pin : 682303<br>
				+91 8086100803<br>
				+91 8086100885<br>
				krishnakriparesidency@gmail.com
				</th>


				</tr>


				<tr>
				
				<td colspan="2"><b style="text-align:center;font-size:20px;">INVOICE</b></td>

				</tr>

			

				</table>
				


				<table cellpadding="5">

				<tr>

				<td width="50%" align="left">
				To<br>
				<b>'.$booking['first_name'].' '.$booking['last_name'].'<br>
				'.nl2br($booking['address']).'<br>
				'.$booking['phone_number'].'<br>
				'.$booking['email_address'].'
				</b>
				</td>
				
				<td width="50%" align="right">
				Booking ID : <b>'.$booking['uid'].'</b><br>
				Invoice Date : <b>'.date('d-M-Y',strtotime($booking['created_at'])).'</b><br>
				Check In : <b>'.date('d-M-Y',strtotime($booking['check_in_date'])).'</b><br>
				Check Out : <b>'.date('d-M-Y',strtotime($booking['check_out_date'])) .'</b>
				</td>

				
				</tr>
				

				</table>

				';


				$html .='

				<table cellpadding="10" style="border-top:.5px solid black;">


				
				<tr >

				<td align="center"></td>

				<td align="center"></td>
			  
			  </tr>



				<tr >

				<td align="center"></td>

				<td align="center"></td>
			  
			  </tr>

				</table>
				
			';


				$item_sec="";
		
				$item_sec .="
				
				<tr>

				<td>{$booking['name']}</td>

				<td>{$booking['rate']}</td>

				<td>".date('d-M-Y',strtotime($booking['check_in_date']))."</td>
				
				<td>".date('d-M-Y',strtotime($booking['check_out_date']))."</td>

				<td>{$booking['no_of_rooms']}</td>

				<td align=\"right\">Rs. ".$booking['total_amount']."</td>
				
				</tr>
				
				";


				$html .='

					<table cellpadding="10" border="1">

					<tr style="">
						
						<th width="20%"><b>Room</b></th>

						<th width="20%"><b>Price / Day</b></th>

						<th width="15%"><b>Check In</b></th>

						<th width="15%"><b>Check Out</b></th>

						<th width="10%"><b>No Of Rooms</b></th>

						<th width="20%"><b>Amount</b></th>
					
					</tr>
					

					'.$item_sec.'


					<tr>
					<td align="right" colspan="5" style="font-size:16px;"><b>Grand Total</b></td>
					<td align="right" style="font-size:16px;"><b>Rs. '.$booking['total_amount'].'</b></td>
					</tr>

				</table>

				';

				$footer_html = '
					<hr>
					<table width="100%" style="font-size:9px;">
						<tr>
							<td width="50%" align="left">
								Krishnakripa Residency, Ambalamedu PO, Kakkanad, Kochi
							</td>
							<td width="50%" align="right">
								Page '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages().'
							</td>
						</tr>
					</table>
				';

				$pdf->setHtmlFooter($footer_html);

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			$pdf->Output("{$booking['uid']}.pdf", "I");


			}
		


		
		
	
}