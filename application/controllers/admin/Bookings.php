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

    	if ($this->input->post()) {

        
        $postData   = $this->input->post();

        $draw       = $postData['draw'];
        $start      = $postData['start'];
        $rowperpage = $postData['length'];

        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        // Filters from GET 8138983983
        $date_from      = $this->input->get('date_from') ?? "";
        $date_to        = $this->input->get('date_to') ?? "";
        $payment_status = $this->input->get('payment_status') ?? "";
        $customer       = $this->input->get('customer') ?? "";
        $room           = $this->input->get('room') ?? "";
        $room_no        = $this->input->get('room_no_search') ?? "";
        $register_no    = $this->input->get('register_no_search') ?? "";
        $hotel_type     = $this->input->get('hotel_type') ?? "";

        // Total records without filtering
        $totalRecords = $this->BookingModel->countAllBookings();

        // Total records with filtering
        $totalRecordwithFilter = $this->BookingModel->countFilteredBookings(
            $searchValue,
            $date_from, $date_to, $payment_status,
            $customer, $room, $room_no, $register_no, $hotel_type
        );

        // Fetch records
        $records = $this->BookingModel->ViewBookingsPaginate(
            $searchValue,
            $date_from, $date_to, $payment_status,
            $customer, $room, $room_no, $register_no, $hotel_type,
            $columnName, $columnSortOrder,
            $rowperpage, $start
        );

		//print_r($records);

        $data = [];
        foreach ($records as $val) {

            $actions = '<div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="'.base_url('admin/Bookings/Invoice/'.$val->booking_id).'" target="_blank"><i class="fa fa-file-text"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="'.base_url('admin/Bookings/View/'.$val->booking_id).'"><i class="fa fa-eye"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-warning" href="'.base_url('admin/Bookings/Edit/'.$val->booking_id).'"><i class="fa fa-pencil"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <a onclick="return confirm(\'Delete this booking?\')" class="btn btn-danger" href="'.base_url('admin/Bookings/Delete/'.$val->booking_id).'"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>';

				
				$checkIn = 
					(!empty($val->actual_check_in_date) 
						? date('d M Y', strtotime($val->actual_check_in_date)) . "<br>" .
						date('h:i a', strtotime($val->actual_check_in_date)) 
						: date('d M Y', strtotime($val->check_in_date))
					);

				$checkOut = 
					(!empty($val->actual_check_out_date) 
						? date('d M Y', strtotime($val->actual_check_out_date)) . "<br>" .
						date('h:i a', strtotime($val->actual_check_out_date)) 
						: date('d M Y', strtotime($val->check_out_date))
					);

				
					$period = $checkIn.'<br>To<br>'.$checkOut;


            $data[] = [
                "id"        => $val->uid . (!empty($val->source_name) ? "<br><br>".$val->source_name : ""),
                "period"    => $period,
                "room"      => $val->name."<br><b>".(!empty($val->booking_room_no) ? "Room : ".$val->booking_room_no : "")."</b><br>".(!empty($val->booking_register_no) ? "Reg No : ".$val->booking_register_no : ""),
                "customer"  => $val->first_name." ".$val->last_name."<br>".$val->phone_number,
                "total"     => "<b style='font-size:20px'>".$val->total_amount."</b><br><a class='btn btn-primary add_addon_btn' data-id='".$val->booking_id."'><i class='fa fa-plus'></i> Add On</a>",
                "paid"      => "<b style='color:green;font-size:20px'>".$val->paid_amount."</b>",
                "pending"   => "<b style='color:red;font-size:20px'>".format_currency($val->total_amount-$val->paid_amount)."</b>",
                "payments"  => ($val->booking_status=="cancelled")
                                ? '<a class="btn btn-warning add_refund_btn" data-type="debit" data-id="'.$val->booking_id.'"><i class="fa fa-reply"></i> Refund</a>'
                                : '<a class="btn btn-primary add_payment_btn" data-type="credit" data-id="'.$val->booking_id.'"><i class="fa fa-money"></i> Payment</a>',
                "status"    => $this->renderBookingStatus($val),
                "actions"   => $actions
            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        ];

        // Output JSON
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }
}

// Helper to format status
private function renderBookingStatus($val)
{
    switch($val->booking_status) {
        case "pending":
            return '<span class="btn btn-warning status_btn" data-id="'.$val->booking_id.'"><i class="fa fa-clock-o"></i> Pending</span>';
        case "confirmed":
            return '<span class="btn btn-success status_btn" data-id="'.$val->booking_id.'"><i class="fa fa-check"></i> Confirmed</span>';
        case "cancelled":
            return '<span class="btn btn-danger status_btn" data-id="'.$val->booking_id.'"><i class="fa fa-times"></i> Cancelled</span>';
        case "checked_in":
            return '<span class="btn btn-success status_btn" data-id="'.$val->booking_id.'"><i class="fa fa-sign-in"></i> Checked In</span>'
                 .'<br><b>'.(!empty($val->actual_check_in_date)?date('d-m-Y', strtotime($val->actual_check_in_date)):'').'</b>'
                 .'<br><b>'.(!empty($val->actual_check_in_date)?date('h:i a', strtotime($val->actual_check_in_date)):'').'</b>';
        case "checked_out":
            return '<span class="btn btn-success status_btn" data-id="'.$val->booking_id.'"><i class="fa fa-sign-out"></i> Checked Out</span>'
                 .'<br><b>'.(!empty($val->actual_check_out_date)?date('d-m-Y', strtotime($val->actual_check_out_date)):'').'</b>'
                 .'<br><b>'.(!empty($val->actual_check_out_date)?date('h:i a', strtotime($val->actual_check_out_date)):'').'</b>';
    }
    return '';
}



		
		
		 public function index()

		{  
		   

			$date_from = "";

			$date_to = "";

			$payment_status = "";

			$customer = "";

			$room = "";

			$room_no = "";

			$register_no = "";

			$hotel_type = "";

			if(!empty($this->input->get('date_from')))
			{
				$date_from = $this->input->get('date_from');
			}

			if(!empty($this->input->get('date_to')))
			{
				$date_to = $this->input->get('date_to');
			}

			if(!empty($this->input->get('payment_status')))
			{
				$payment_status = $this->input->get('payment_status');
			}

			if(!empty($this->input->get('customer')))
			{
				$customer = $this->input->get('customer');
			}

			if(!empty($this->input->get('room')))
			{
				$room = $this->input->get('room');
			}

			if(!empty($this->input->get('hotel_type')))
			{
				$hotel_type = $this->input->get('hotel_type');
			}


			if(!empty($this->input->get('room_no_search')))
			{
				$room_no = $this->input->get('room_no_search');
			}


			if(!empty($this->input->get('register_no_search')))
			{
				$register_no = $this->input->get('register_no_search');
			}

			



		 	$data['bookings']	=	$this->BookingModel->ViewBookings($date_from,$date_to,$payment_status,$customer,$room,$room_no,$register_no,$hotel_type);		   
			$parent =  $this->uri->segment(4);	
			$data['customers'] = $this->Admin_model->fetch_where_order('customers',array(),'first_name','asc');
			$data['addons'] = $this->Admin_model->fetch_where_order('addons',array(),'ao_name','asc');
			$data['rooms'] = $this->Admin_model->fetch_where_order('room',array(),'name','asc');			 
			$data['seo_title'] 	= 	"View Bookings | ".$this->data['admin_title'].""; 			
			$this->load->view('admin/view_bookings',$data);
		
        }
		
		
	
		public function Add()
		
		{
			
			
			$data['seo_title'] 	= 	"Add Bookings | ".$this->data['admin_title'].""; 

			$data['room_types']	=	$this->Admin_model->fetch_all_order('categories','cat_title','asc');	

			$data['sources'] = $this->Admin_model->fetch_where_order('sources',array(),'source_name','asc');

			$data['hotels']	=	$this->Admin_model->fetch_all_order('hotels','hotel_name','asc');

			$data['addons']	=	$this->BookingModel->get_all_addons();
			
			
			if($_POST):

			$tax = (float) $this->input->post('tax_amount');

			$extra_price = (float)$this->input->post('extra_price');

			$extra_desc = $this->input->post('extra_desc');

			$total = (float) $this->input->post('total_amount');

			$tax_excluded_total = $total;

			if ($tax>0) {
				$tax_excluded_total = $total-$tax;
			}

			//$total = $total+$extra_price;

			$booking_data  	= 	array(

		    'check_in_date'  => date('Y-m-d',strtotime($this->input->post('check_in'))),
		
		    'check_out_date' => date('Y-m-d',strtotime($this->input->post('check_out'))),

			'booking_source' => $this->input->post('booking_source'),

			'booking_room_id' => $this->input->post('room_select'),

		    'adults'=>$this->input->post('adults'),
		    
			'children'=>$this->input->post('childrens'),
		    
			'no_of_rooms'=>$this->input->post('rooms'),

			'addon_amount' => $this->input->post('addon_amount'),

			'tax_amount' => $this->input->post('tax_amount'),

			'room_total' => $this->input->post('room_total'),

			'total_amount' => $total,

			'tax_excluded_total' => $tax_excluded_total,

			'extra_amount' => $extra_price,

			'extra_desc' => $extra_desc,

			'total_discounts' => $this->input->post('discount'),
		      
			'paid_amount'=> $this->input->post('current_payment'),

			'payment_type'=>$this->input->post('payment_method'),

			'payment_notes'=>$this->input->post('payment_notes'),

			'booking_notes'=>$this->input->post('booking_notes'),

			'booking_status'=> 'confirmed',

			'customer_first_name' => $this->input->post('f_name'),

			'customer_last_name' => $this->input->post('l_name'),

			'customer_email' => $this->input->post('email'),

			'customer_phone_number' => trim($this->input->post('phone')),

			'customer_phone_number_alt' => trim($this->input->post('phone_alt')),

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

			if(!empty($this->input->post('current_payment')))

			{

			$pay_id = $this->Admin_model->insertsection('booking_payments',$payment_data);

			}


			$add_on   = $this->input->post('add_on');     // array of addon ids
    		$quantity = $this->input->post('quantity');   // array of qty
    		$amount   = $this->input->post('amount');     // array of price
    		$ao_remarks  = $this->input->post('remarks');    // array of remarks

    		if (!empty($add_on)) {
        	foreach ($add_on as $index => $ao_id) {
            	$qty   = !empty($quantity[$index]) ? (int)$quantity[$index] : 0;
            	$amt   = !empty($amount[$index])   ? (float)$amount[$index] : 0;
            	$rem   = !empty($ao_remarks[$index])  ? $ao_remarks[$index] : '';

            // Skip empty rows
            if ($qty > 0 || $amt > 0) {

                $data = [
                    'booking_main_id' => $bid,
                    'addon_id'   => $ao_id,
                    'quantity'   => $qty,
                    'total_price'     => $amt,
                    'add_on_remarks'    => $rem
                ];

                $this->db->insert('booking_addons', $data);
           	 	}
        	}
			}



			$booking_uid = 'KK' . str_pad($bid, 5, '0', STR_PAD_LEFT);

			$update_booking_data = array(
				'uid' => $booking_uid,
			);
			$update_booking_cond = array('booking_id' => $bid);

			$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');

		$uploaded_files = array();

		$copied_old_files = array();

		if(isset($_FILES['id_proof']) && !empty($_FILES['id_proof']['tmp_name'][0])) {
    
    	
    	$uploadfile = "uploads/Booking";
    
    	// Loop through each uploaded file
    	for($i = 0; $i < count($_FILES['id_proof']['tmp_name']); $i++) {
        
        // Check if file was actually uploaded
        if($_FILES['id_proof']['tmp_name'][$i] != '' && $_FILES['id_proof']['error'][$i] == 0) {
            
            $filename = basename($_FILES["id_proof"]["name"][$i]);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            
            // Generate unique filename
            $gallery = $bid . "id" . rand() . '_' . ($i + 1) . '.' . $ext;
            
            // Validate file extension (optional security measure)
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
            if(in_array($ext, $allowed_extensions)) {
                
                // Move uploaded file
                if(move_uploaded_file($_FILES["id_proof"]["tmp_name"][$i], $uploadfile . "/" . $gallery)) {
                    $uploaded_files[] = $gallery;
                	}
            	}
        	}
    	}


		}


			// Merge with old proofs that are still in hidden inputs
			$old_proofs = $this->input->post('old_proofs') ?: [];


			foreach ($old_proofs as $old_file) {
				$old_path = "uploads/Booking/" . $old_file;
				if (file_exists($old_path)) {
					$ext = pathinfo($old_file, PATHINFO_EXTENSION);
					$new_file = $bid . "id" . rand() . '_old_' . time() . '.' . strtolower($ext);
					$new_path = "uploads/Booking/" . $new_file;

					// Copy the file
					if(copy($old_path, $new_path)) {
						$copied_old_files[] = $new_file;
					}
				}
			}

			$all_proofs = array_merge($copied_old_files, $uploaded_files);
		
			// Update database if files were uploaded
			if(!empty($all_proofs)) {
			
			// Convert array to JSON string for storage
			$id_proof_json = json_encode($all_proofs);
			
			$update_id_proof_data = array(
				'id_proof' => $id_proof_json,
			);

			$update_booking_cond = array('booking_id' => $bid);

			$this->Admin_model->update_all($update_id_proof_data, $update_booking_cond, 'bookings');
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
        $customer = $query->row();

		// Fetch last booking for this customer
        $this->db->where('booking_customer_id', $customer->cus_id);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1);
        $booking = $this->db->get('bookings')->row();

        // Decode id_proof JSON into array
         $id_proofs = [];
        if (!empty($booking) && !empty($booking->id_proof)) {
            $id_proofs = json_decode($booking->id_proof, true); // array of filenames
        }

        echo json_encode([
            'status' => 1,
            'data' => [
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'email_address' => $customer->email_address,
                'address' => $customer->address,
                'id_proofs' => $id_proofs, // send as array
            ]
        ]);
		} else {
			echo json_encode(['status' => 0]);
		}


		}






		




		public function CalculatePrice()
		{

		$room_id = $this->input->post('room_id');
		$no_of_room = $this->input->post('no_of_rooms')?: 0;
		$check_in = $this->input->post('check_in');
		$check_out = $this->input->post('check_out');
		$discounts = intval($this->input->post('discounts')) ?: 0;
		$children = intval($this->input->post('children')) ?: 0;

		$addons_total = 0;
		$addons = $this->input->post('addons') ?: [];

		foreach($addons as $addon){
			$ao_id = intval($addon['id']);
			$qty = intval($addon['quantity']);
			$price = intval($addon['price']);
			$ao_det = $this->Admin_model->fetch_one_row('addons', ['ao_id' => $ao_id]);
			if($ao_det){
				$addons_total += $price;
			}
		}

		if(!empty($this->input->post('addon_total')))
		{
			$addons_total = $this->input->post('addon_total');
		}

		$room_det = $this->Admin_model->fetch_one_row('room',['roomid' => $room_id]);

		if(empty($room_det))
		{

		echo json_encode([
			'status' => 0
		]);

		exit;

		}

		$base_price = $room_det['rate'];


		$tax = isset($room_det['tax']) ? $room_det['tax'] : 0;

		//$tax = 0;

		// Calculate number of nights 	
		$check_in_date = new DateTime($check_in);
		$check_out_date = new DateTime($check_out);
		$interval = $check_in_date->diff($check_out_date);
		$nights = $interval->days;

		$nights = max(1, $nights);

		$data['price_breakdown'] = $this->BookingModel->get_price_per_day($room_id,$check_in,$check_out);

		$room_total = 0;
		$room_price_bd = "";
		foreach ($data['price_breakdown'] as $item) {
			$room_total += $item['rate'];
		}

		if($this->input->post('booking_source')==0)
		{
		$room_total = $room_total*$no_of_room;
		}
		else
		{
		$room_total = $this->input->post('room_total');
		}


		$extra_price=0;
		$extra_desc="";
		if($children>0)
		{
		$extra_price = $room_det['kidPrice']*$children;
		$extra_desc = "Kids";
		}

		// Calculate total price

		$subtotal = $room_total+$extra_price+$addons_total;

		$tax_amount = (($subtotal) * $tax) / 100;

		$total = $subtotal + $tax_amount;

		$total = $total-$discounts;

		echo json_encode([
			'status' => 1,
			'base_price' => $room_total,
			'nights' => $nights,
			'rooms' => $no_of_room,
			'room_total' => $room_total,
			'addon_total' => $addons_total,
			'subtotal' => $subtotal,
			'tax' => $tax,
			'tax_amount' => $tax_amount,
			'extra_price' => $extra_price,
			'extra_desc' => $extra_desc,
			'total' => $total
		]);

		}




		public function GetRoomsAvailable()
		{

			$check_in = $this->input->post('check_in');
			$check_out = $this->input->post('check_out');
			$room_type = $this->input->post('room_type');
			$room_count = $this->input->post('room_count');
			$hotel_type = $this->input->post('hotel_type');

			$data['html'] ="";

			if($check_in && $check_out)
			{
				$data['status'] = 1;

				$available_rooms = $this->BookingModel->get_available_rooms($room_count,$check_in, $check_out,$room_type,$hotel_type);

				if(!empty($available_rooms))
				{
				foreach($available_rooms as $room)
				{

				$data['html'] .= "

						<div class='col-sm-6'>

						<div class='room-container'>
							<div class='row'>

							<div class='col-sm-4'>{$room->name}</div>

							<div class='col-sm-4'>Rs <b>{$room->rate}</b> /-</div>

							<div class='col-sm-4'><input class='room_select' type='radio' name='room_select' value='".$room->roomid."' required></div>

							</div>
						</div>
						</div>";
				}
				}
				else
				{

							$data['html'] .= "
							<div class='col-sm-12' style='text-align:center'>
				
							<p style='color:red;text-align:center'>No Rooms Available</p>

							</div>";

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

		$data['addons'] = $this->BookingModel->get_single_booking_addons($id);

		$data['payments'] = $this->BookingModel->ViewPaymentsByBookingId($id,"credit"); 

		$data['refunds'] = $this->BookingModel->ViewPaymentsByBookingId($id,"debit");

		$data['total_payments'] = $this->BookingModel->BookingTotalPayments($id);

		$data['total_refunds'] = $this->BookingModel->BookingTotalRefunds($id);

		$this->load->view('admin/view_booking_single',$data);
 
		}


		public function Edit($id)
		{

		$data['booking'] = $this->BookingModel->ViewBookingById($id);

		$room_det = $this->Admin_model->fetch_one_row('room',['roomid' => $data['booking']['booking_room_id']]);

		$data['room_types']	=	$this->Admin_model->fetch_all_order('categories','cat_title','asc');

		if(!empty($this->input->post()))
		{

		$room_count = $data['booking']['no_of_rooms'];

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
		$tax = isset($room_det['tax']) ? $room_det['tax'] : 0;
		//$tax = 0;

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

		'booking_room_no' => $this->input->post('room_no'),

		'booking_register_no' => $this->input->post('reg_no'),

		//'no_of_rooms'=> $room_count,
		//'tax_excluded_total' => $subtotal,

		'tax_amount' => $this->input->post('tax_amount'),

		'total_discounts' => $this->input->post('discount'),

		'total_amount' => $this->input->post('total_amount'),

		'room_total' => $this->input->post('room_total'),

		'customer_first_name' => $this->input->post('f_name'),

		'customer_last_name' => $this->input->post('l_name'),

		'customer_email' => $this->input->post('email'),

		'customer_phone_number' => trim($this->input->post('phone')),

		'customer_phone_number_alt' => trim($this->input->post('phone_alt')),

		'customer_address' => $this->input->post('address'),

		);


		$update_booking_cond = array('booking_id' => $id);

		$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');



		//Update Customer

		$update_customer_data = array(

		'first_name' => $this->input->post('f_name'),

		'last_name' => $this->input->post('l_name'),

		'last_name' => $this->input->post('email'),

		'phone_number' => trim($this->input->post('phone')),

		'phone_number_alt' => trim($this->input->post('phone_alt')),

		'address' => $this->input->post('address'),

		);

		$update_customer_cond = array('cus_id' => $data['booking']['booking_customer_id']);

		$this->Admin_model->update_all($update_customer_data,$update_customer_cond,'customers');


  			/**
             * -------------------------
             * Handle ID proof uploads
             * -------------------------
             */
            if (isset($_FILES['id_proof']) && !empty($_FILES['id_proof']['tmp_name'][0])) {

                $uploaded_files = [];
                $upload_path = "uploads/Booking";

                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                // loop through each uploaded file
                for ($i = 0; $i < count($_FILES['id_proof']['tmp_name']); $i++) {
                    if ($_FILES['id_proof']['tmp_name'][$i] != '' && $_FILES['id_proof']['error'][$i] == 0) {

                        $filename = basename($_FILES["id_proof"]["name"][$i]);
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                        $allowed_extensions = ['jpg','jpeg','png','pdf','doc','docx'];

                        if (in_array($ext, $allowed_extensions)) {
                            $new_name = $id . "_id_" . uniqid() . '_' . ($i + 1) . '.' . $ext;

                            if (move_uploaded_file($_FILES["id_proof"]["tmp_name"][$i], $upload_path . "/" . $new_name)) {
                                $uploaded_files[] = $new_name;
                            }
                        }
                    }
                }

                if (!empty($uploaded_files)) {
                    // get existing files from DB
                    $current = $this->db->select('id_proof')
                                        ->from('bookings')
                                        ->where('booking_id', $id)
                                        ->get()
                                        ->row();

                    $existing_files = [];
                    if ($current && !empty($current->id_proof)) {
                        $existing_files = json_decode($current->id_proof, true);
                        if (!is_array($existing_files)) {
                            $existing_files = [];
                        }
                    }

                    // merge new + old
                    $all_files = array_merge($existing_files, $uploaded_files);

                    $this->Admin_model->update_all(
                        ['id_proof' => json_encode($all_files)],
                        ['booking_id' => $id],
                        'bookings'
                    );
                }
            }
            
            
		$this->session->set_flashdata('success', 'Booking Updated.'); 
				
		redirect(base_url().'admin/Bookings/Edit/'.$id);

		}


		}

		$this->load->view('admin/edit_booking',$data);


		}


		
		public function Delete($id)
		{
		
		$this->db->where('booking_id', $id);
		$booking_query = $this->db->get('bookings');
		$booking_data = $booking_query->row_array();
		
		
		if(!empty($booking_data['id_proof'])) {
			$uploadfile = "uploads/Booking";
			
			
			$id_proofs = array();
			
			// Try to decode as JSON first
			$json_decoded = json_decode($booking_data['id_proof'], true);
			if(json_last_error() === JSON_ERROR_NONE && is_array($json_decoded)) {
				// It's JSON format
				$id_proofs = $json_decoded;
			} else {
				// It's comma-separated string or single file
				$id_proofs = explode(',', $booking_data['id_proof']);
			}
			
			// Delete each file
			foreach($id_proofs as $proof) {
				$proof = trim($proof); 
				if(!empty($proof)) {
					$file_path = $uploadfile . "/" . $proof;
					if(file_exists($file_path)) {
						unlink($file_path); // Delete the file
					}
				}
			}
		}
    
		$this->db->where('booking_id', $id);
		$this->db->delete('bookings');

		$this->db->where('bp_booking', $id);
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

			if(!empty($this->input->post('room_no')))
			{
				$room_no_update = $this->input->post('room_no');
			}
			else
			{
				$room_no_update = NULL;
			}

			if(!empty($this->input->post('reg_no')))
			{
				$reg_no_update = $this->input->post('reg_no');
			}
			else
			{
				$reg_no_update = NULL;
			}

			$update_data = array(
				'booking_status' => $booking_status = $this->input->post('booking_status'),
				'booking_room_no' => $room_no_update,
				'booking_register_no' => $reg_no_update
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


			if($booking_status=="cancelled" && $this->input->post('refund_eligible')=="yes")
			{

			$payment_data = array(
			'bp_booking' => $booking_id,
			'bp_pay_method' => $this->input->post('payment_method'),
			'bp_paid_on' => date('Y-m-d', strtotime($this->input->post('payment_date'))),
			'bp_notes' => $this->input->post('payment_notes'),
			'bp_amount' => $this->input->post('amount'),
			'bp_type' => $this->input->post('payment_type')
			);

			$pay_id = $this->Admin_model->insertsection('booking_payments',$payment_data);


			}



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

				$addons = $this->BookingModel->get_single_booking_addons($id);

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

				.amount
				{
				font-size:13px;
				text-align:right;
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
		
				$item_sec .='
				
				<tr>

				<td align="left" style="font-size:13px;">'.$booking['name'].' x '.$booking['no_of_rooms'].'</td>

				<td align="right" style="font-size:13px;">'.number_format(($booking['room_total']),2,'.').'</td>
				
				</tr>
				
				';


				if(!empty($addons))
				{

				foreach($addons as $ao)
				{

					if($ao->total_price>0)
					{
					$item_sec .='
					
					<tr>

					<td align="left" style="font-size:13px;">'.$ao->ao_name.' x '.$ao->quantity.'</td>

					<td align="right" style="font-size:13px;">'.$ao->total_price.'</td>
					
					</tr>

					';
					}

				}

				
				}

				



				$extra_sec ="";

				if(!empty($booking['extra_amount']) && $booking['extra_amount']>0)
				{

				$extra_sec .='
					<tr>
					<td align="left" style="font-size:13px;">'.$booking['extra_desc'].'</td>
					<td align="right" style="font-size:13px;">'.number_format($booking['extra_amount'],2,'.').'</td>
					</tr>';
				}




				$tax_sec ="";
				
				if(!empty($booking['tax_amount']) && $booking['tax_amount']>0)
				{

				$tax_sec .='
					<tr>
					<td align="left" style="font-size:13px;">Tax</td>
					<td align="right" style="font-size:13px;">'.number_format($booking['tax_amount'],2,'.').'</td>
					</tr>';
				}



				$discount_sec ="";

				if(!empty($booking['total_discounts']) && $booking['total_discounts']>0)
				{

				$discount_sec .='
					<tr>
					<td align="left" style="font-size:13px;">Discounts</td>
					<td align="right" style="font-size:13px;">-'.number_format($booking['total_discounts'],2,'.').'</td>
					</tr>';
				}





				$html .='

					<table cellpadding="10" border="1">

					<tr style="">
						
						<th width="60%" align="center"><b>Description</b></th>

						<th width="40%" align="center"><b>Amount</b></th>
					
					</tr>
					

					'.$item_sec.'



					'.$extra_sec.'


					'.$tax_sec.'

					'.$discount_sec.'


					<tr>
					<td align="left" style="font-size:13px;"><b>Grand Total</b></td>
					<td align="right" style="font-size:13px;color:red">'.number_format($booking['total_amount'],2,'.').'</td>
					</tr>




				</table>


					<table cellpadding="10" border="0" style="margin-top:40px;">

					<tr style="">

						<td align="center">Thank you for choosing Krishnakripa,Looking forward to your next visit!</td>
					
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



			public function GetAddOns()
			{

			$booking_id = $this->input->post('bid');

			$add_ons = $this->BookingModel->get_booking_addons($booking_id);

			echo json_encode([
        	'status' => 'success',
        	'data'   => $add_ons
    		]);

			}



			public function AddOn()
			{

			if(!empty($this->input->post()))
			{

			 $booking_id = $this->input->post('bid');

			 $add_on   = $this->input->post('add_on');     // array of addon ids
    		 $quantity = $this->input->post('quantity');   // array of qty
    		 $amount   = $this->input->post('amount');     // array of price
    		 $remarks  = $this->input->post('remarks');    // array of remarks

    		// Clear existing addons for this booking
    		$this->db->where('booking_main_id', $booking_id)->delete('booking_addons');

    		if (!empty($add_on)) {
        		foreach ($add_on as $index => $ao_id) {
            	$qty   = !empty($quantity[$index]) ? (int)$quantity[$index] : 0;
            	$amt   = !empty($amount[$index])   ? (float)$amount[$index] : 0;
            	$rem   = !empty($remarks[$index])  ? $remarks[$index] : '';

            // Skip empty rows
            if ($qty > 0 || $amt > 0) {

                $data = [
                    'booking_main_id' => $booking_id,
                    'addon_id'   => $ao_id,
                    'quantity'   => $qty,
                    'total_price'     => $amt,
                    'add_on_remarks'    => $rem
                ];

                $this->db->insert('booking_addons', $data);
           	 	}

        	}
    		}
			else
			{
			
			$data = [
				'addon_amount' => 0,
			];

			$this->db->where('booking_id', $booking_id);
			$this->db->update('bookings', $data);

			}

			$this->RecalculateBooking($booking_id);

    		$this->session->set_flashdata('success', 'Add-ons saved successfully.');
    		//redirect(base_url().'admin/Bookings/View/'.$booking_id);
			redirect(base_url().'admin/Bookings');

			

			}


			}



			public function RecalculateBooking($booking_id)
			{

			$booking = $this->BookingModel->ViewBookingById($booking_id);

    		if(!$booking) return false;

    		// 2. Get addon total
    		$addon_total = $this->db->select_sum('total_price')
                            ->where('booking_main_id', $booking_id)
                            ->get('booking_addons')
                            ->row()->total_price ?? 0;

			// 3. Subtotal before tax
    		$subtotal = $booking['room_total'] + $booking['extra_amount'] + $addon_total - $booking['total_discounts'];

			// 4. Tax
    		$tax_amount = ($subtotal * $booking['tax']) / 100;

			// 5. Update booking
			$data = [
				'addon_amount' => $addon_total,
				'tax_amount' => $tax_amount,
				'tax_excluded_total' => $subtotal,
				'total_amount' => $subtotal + $tax_amount
			];

			$this->db->where('booking_id', $booking_id);
			$this->db->update('bookings', $data);

			return true;



			}
		


		
		
	
}