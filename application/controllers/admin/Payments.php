<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MY_Controller {
		// construct
        public function __construct()
		{
		parent::__construct();
		$this->load->database();
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'text','number'));
        $this->load->model("Admin_model");	
		$this->load->model("BookingModel");			
		$this->load->library('session');		
		if(!$this->session->userdata('adminId'))
		{
			redirect(base_url().'admin/login');	
		}	
			
        }
		
		
		public function Paid()
		
		{ 

		$date_from = "";
		$date_to = "";
		$customer = "";
		$hotel_type ="";
	

		if(!empty($this->input->get('date_from')))
		{
			$date_from = $this->input->get('date_from');
		}

		if(!empty($this->input->get('date_to')))
		{
			$date_to = $this->input->get('date_to');
		}

		if(!empty($this->input->get('customer')))
		{
			$customer = $this->input->get('customer');
		}

		if(!empty($this->input->get('hotel_type')))
		{
			$hotel_type = $this->input->get('hotel_type');
		}

		$data['customers'] = $this->Admin_model->fetch_where_order('customers',array(),'first_name','asc');

    	$data['payments']  =  $this->BookingModel->ViewPayments($date_from,$date_to,$customer,$hotel_type);	

    	$data['seo_title'] = "View Payments | ".$this->data['admin_title'].""; 

		$this->load->view('admin/view_payments',$data);     

  		}
		

		public function Pending()
		
		{ 

    	$data['bookings']	=	$this->BookingModel->ViewBookings();	

    	$data['seo_title'] = "View Payments | ".$this->data['admin_title'].""; 

		$this->load->view('admin/view_payments',$data);     

  		}



			public function Print()
		{


		$date_from = "";
		$date_to = "";
		$customer = "";
		$hotel_type ="";
	

		if(!empty($this->input->get('date_from')))
		{
			$date_from = $this->input->get('date_from');
		}

		if(!empty($this->input->get('date_to')))
		{
			$date_to = $this->input->get('date_to');
		}

		if(!empty($this->input->get('customer')))
		{
			$customer = $this->input->get('customer');
		}

		if(!empty($this->input->get('hotel_type')))
		{
			$hotel_type = $this->input->get('hotel_type');
		}

    	$payments	=	$this->BookingModel->ViewPayments($date_from,$date_to,$customer,$hotel_type);

		
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


				$payment_sec="";

				$i=1;

				foreach($payments as $val)
				{


				if($val->bp_type=="debit") { $debit = $val->bp_amount; } else { $debit="-"; }

				if($val->bp_type=="credit") { $credit = $val->bp_amount; } else { $credit="-"; }

				//Payments Table Rows
				
				$payment_sec .='
				
				<tr>

					<th>'.$i.'</th>

					<th>'.date('d-m-Y',strtotime($val->bp_paid_on)).'</th>

					<th>
					'.$val->uid.'
					
					</th>

					<th>
					'.$val->first_name.' '.$val->last_name.'
					
					</th>


					<th>'.$val->phone_number.'</th>
						

					<th>
					'.$val->bp_pay_method.'
					</th>

					<th>'.$val->bp_notes.'</th>

					<th>'.$debit.'</th>

					<th>'.$credit.'</th>
					
				</tr>

				';

				$i++;

				}
				
				//<th>'.$bookin->booking_status.'</th>

				//<th>'.$bookin->uid.'</th>

				$html .='

					<table cellpadding="5" border="1">

					<tr style="background-color:white">

										<th>SL No</th>

										<th>Date</th>
                                     
                                        <th>Booking ID</th>

                                        <th>Name</th>

                                        <th>Phone</th>
                                        
                                        <th>Method</th>

                                        <th>Notes</th>

                                        <th>Debit</th>

                                        <th>Credit</th>
					
						</tr>
					

					'.$payment_sec.'

					

				</table>

				';

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			$pdf->Output("Payment Report.pdf", "I");


		}


		
		
	
	
}