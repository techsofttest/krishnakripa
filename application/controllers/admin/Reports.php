<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {
		// construct
        public function __construct()
		{
		parent::__construct();
		$this->load->database();
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'text'));
        $this->load->model("Admin_model");	
		$this->load->model("BookingModel");			
		$this->load->library('session');		
		if(!$this->session->userdata('adminId'))
		{
			redirect(base_url().'admin/login');	
		}	
			
        }
		
		
		public function View()
		
		{ 

		$date_from = "";

		$date_to = "";

		$payment_status = "";

		$customer = "";

		$room = "";

		$hotel_type ="";

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

    	$data['bookings']	=	$this->BookingModel->ViewBookingReport($date_from,$date_to,$payment_status,$customer,$room,$hotel_type);	

		$data['customers'] = $this->Admin_model->fetch_where_order('customers',array(),'first_name','asc');

		$data['rooms'] = $this->Admin_model->fetch_where_order('room',array(),'name','asc');

    	$data['seo_title']  = "View Reports | ".$this->data['admin_title'].""; 

		$this->load->view('admin/view_reports',$data);     

  		}





		public function Print()
		{


		$date_from = "";

		$date_to = "";

		$payment_status = "";

		$customer = "";

		$room = "";

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

    	$bookings	=	$this->BookingModel->ViewBookingReport($date_from,$date_to,$payment_status,$customer,$room);

		
				$this->load->library('Pdf');
				$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Krishnakripa');
				$pdf->SetTitle('');
				$pdf->SetSubject('Report');
				

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

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
				width:100%;
				font-size:8px;
				}

				

				</style>

				<table cellpadding="10">

				<tr>
				
				<th width="50%" align="left">
				<h3>
				Report
				</h3>
				</th>

				<th width="50%" align="right">
					
				<img style="height:40px;" src="'.base_url().'assets/img/logo1.png">

				</th>

				</tr>

				</table>
				

				';


				$item_sec="";

				foreach($bookings as $bookin)
				{

				$payments = $this->BookingModel->ViewPaymentsByBookingId($bookin->booking_id,"credit");


				//Checkin & Time
				if(!empty($bookin->actual_check_in_date))
				{
					$check_in = date('d-m-y',strtotime($bookin->actual_check_in_date))."<br>".date('h:i a',strtotime($bookin->actual_check_in_date));
				}
				else
				{
					$check_in = date('d-m-y',strtotime($bookin->check_in_date));
				}

				if(!empty($bookin->actual_check_out_date))
				{
					$check_out = date('d-m-y',strtotime($bookin->actual_check_out_date))."<br>".date('h:i a',strtotime($bookin->actual_check_out_date));
				}
				else
				{
					$check_out = date('d-m-y',strtotime($bookin->check_out_date));
				}



				//Payments Table Rows
				
				$payment_rows = "";

				if(!empty($payments))
				{
				foreach($payments as $payment)
				{

				$payment_rows .=
				"<tr>
				<td>".date('d-m-y',strtotime($payment->bp_paid_on))."</td>
				<td>".$payment->bp_amount."</td>
				<td>".$payment->bp_pay_method."</td>
				<td>".$payment->bp_notes."</td>
				</tr>";
				
				}
				}

				
				$item_sec .='
				
				<tr>

					<th>'.$bookin->name.'</th>

					<th>'.$bookin->first_name.' '.$bookin->last_name.' <br> '.$bookin->phone_number.'</th>

					<th>
					'.$check_in.'
					
					</th>

					<th>
					'.$check_out.'
					
					</th>


					<th>'.$bookin->uid.'</th>
						

					<th align="right">
					<table>
					'.$payment_rows.'
					</table>
					</th>

					<th>'.$bookin->booking_status.'</th>

					
					
				</tr>

				';


				}
				
				//<th>'.$bookin->booking_status.'</th>

				//<th>'.$bookin->uid.'</th>

				$html .='

					<table cellpadding="5" border="1">

					<tr style="background-color:white">

						<th width="10%" style="text-align:center"><b>Room</b></th>

						<th width="20%" style="text-align:center"><b>Customer</b></th>

						<th width="10%" style="text-align:center"><b>Check In</b></th>

						<th width="10%" style="text-align:center"><b>Check Out</b></th>

						<th width="10%" style="text-align:center"><b>Book ID</b></th>

						<th width="30%">
						<table>

						<tr><td colspan="4" style="text-align:center"><b>Amount</b></td></tr>
						
						<tr>
						<td style="text-align:center">Date</td>
						<td style="text-align:center">Amount</td>
						<td style="text-align:center">Method</td>
						<td style="text-align:center">UTR No</td>
						</tr>

						</table>
						</th>

						<th width="10%" style="text-align:center"><b>Status</b></th>
					
					</tr>
					

					'.$item_sec.'

					

				</table>

				';

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			$pdf->Output("Report.pdf", "I");


		}


		
		
	
	
}