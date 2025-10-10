<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	
	 public function __construct()

		{

			parent::__construct(); 

            $this->load->helper(array('form', 'url', 'text'));

            $this->load->model("BookingModel");

        }
	
        

        // initialized cURL Request
        private function curl_handler($payment_id, $amount){
        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
      
        $key_id         = config_item('rp_public');
        $key_secret     = config_item('rp_secret');
        
        $fields_string  = "amount=$amount";

        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        return $ch;

    }   
        
    // callback method
    public function callback() {   
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');

            
            $this->session->set_flashdata('razorpay_payment_id', $this->input->post('razorpay_payment_id'));
            $this->session->set_flashdata('merchant_order_id', $this->input->post('merchant_order_id'));
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {                
                $ch = $this->curl_handler($razorpay_payment_id, $amount);
                //execute post
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {

                    $response_array = json_decode($result, true);

                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                                log_message('error', $error);
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                                log_message('error', $error);
                            }
                        }
                }
                //close curl connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                //$error = 'Request to Razorpay Failed';
                $this->session->set_flashdata('error','Connection to razorpay failed!, Try again later');
                redirect(base_url());
            }
            
            if ($success === true) {

                //Update Status Of Order

                $order_id = $this->input->post('merchant_order_id');

                $update_cond = array('booking_id' =>$booking_id = $this->input->post('merchant_order_id'));

                $update_data = array(
                                'payment_status' => 2,
                                'paid_amount' => $response_array['amount']/100,
                                );

                $this->Admin_model->update_all($update_data,$update_cond,'bookings');


                $payment_insert_data = array(

                'bp_booking' => $this->input->post('merchant_order_id'),

                'bp_pay_method' => 'online',

                'bp_amount' => $response_array['amount']/100,

                'bp_notes' => $response_array['id'],

                'bp_type' => 'credit',

                'bp_paid_on' => date('Y-m-d H:i:s'),

                );

                $this->Admin_model->insertsection('booking_payments',$payment_insert_data);

                $booking = $this->BookingModel->ViewBookingById($order_id);
                
	            //#################################


                //Mail Function Start

                $body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Booking Confirmation</title>
                    <style>
            body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background: #a40000;
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .booking-details {
            background-color: #f8f9fa;
            border-left: 4px solid #a40000;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #555;
        }
        .detail-value {
            color: #333;
            text-align: right;
        }
        .confirmation-number {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #fff9e6;
            border-radius: 4px;
        }
        .confirmation-number strong {
            font-size: 24px;
            color: #a40000;
            letter-spacing: 2px;
        }
        .button {
            display: inline-block;
            background-color: #667eea;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 35px;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: 600;
            text-align: center;
        }
        .button-container {
            text-align: center;
        }
        .info-section {
            margin: 25px 0;
            padding: 20px;
            background-color: #f0f4ff;
            border-radius: 4px;
        }
        .info-section h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 16px;
        }
        .info-section p {
            margin: 8px 0;
            color: #555;
            line-height: 1.6;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #777;
            font-size: 14px;
            border-top: 1px solid #e0e0e0;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✓ Booking Confirmed</h1>
            <p>Your booking has been successfully confirmed</p>
        </div>
        
        <div class="content">
            <p class="greeting">Dear '.$booking['customer_first_name'].'</p>
            
            <p>Thank you for choosing Krishnakripa Residency! We are delighted to confirm your reservation and look forward to welcoming you.</p>
            
            <div class="confirmation-number">
                <p style="margin: 0; color: #666; font-size: 14px;">Booking ID</p>
                <strong>'.$booking['uid'].'</strong>
            </div>
            
            <div class="booking-details">
                <h2 style="margin-top: 0; color: #333; font-size: 20px;">Booking Details</h2>
                
                <div class="detail-row">
                    <span class="detail-label">Check-in : </span>
                    <span class="detail-value"> '.date('d M Y',strtotime($booking['check_in_date'])).'</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Check-out : </span>
                    <span class="detail-value"> '.date('d M Y',strtotime($booking['check_out_date'])).'</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Room : </span>
                    <span class="detail-value"> '.$booking['name'].'</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Guests : </span>
                    <span class="detail-value"> '.$booking['adults'].' Adults</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Total Amount : </span>
                    <span class="detail-value"><strong> Rs '.$booking['total_amount'].' /-</strong></span>
                </div>

            </div>
            

            <div class="info-section">
                <h3>Important Information</h3>
                <p><strong>Check-in Time:</strong> 10:00 AM</p>
                <p><strong>Check-out Time:</strong> 11:00 AM</p>
            </div>
           
            
            <p style="margin-top: 30px; color: #555; line-height: 1.6;">
                If you have any questions or need to modify your reservation, please dont hesitate to contact us. Were here to help make your stay exceptional!
            </p>
        </div>
        
        <div class="footer">
            <p>Thank you for choosing Krishnakripa Residency</p>
           
            <p style="margin-top: 15px; font-size: 12px; color: #999;">
                © '.date('Y').' Krishnakripa Residency. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>  
                ';

                try {

                    $this->load->library('email');					

                    $config['protocol']    = 'smtp';

                    $config['smtp_host']    = 'ssl://smtp.gmail.com';

                    $config['smtp_port']    = '465';

                    $config['smtp_timeout'] = '7';

                    $config['smtp_user']    = 'techsofttest@gmail.com';

                    $config['smtp_pass']    = 'celzboqebpcusnce';

                    $config['mailtype'] = 'text'; // or html

                    $config['validation'] = TRUE; // bool whether to validate email or not  

                    $config['charset'] = 'utf-8';				 

                    $config['newline'] = "\r\n";

                    $config['crlf'] = "\r\n";

                    $this->email->initialize($config);

                    $this->email->from('techsofttest@gmail.com','Krishnakripa Residency');

                    $subject = "Booking Confirmation : Krishnakripa Residency";	

                    $this->email->to($booking['customer_email']);

                    $this->email->subject($subject);					

                    $this->email->message($body);                

                    $this->email->set_newline("\r\n");

                    $this->email->set_mailtype("html");						

                    if(!$this->email->send()){					
                            
                    log_message('error',"Mailer Error : ".$this->email->print_debugger());

                    }


                    }	
                    catch (Exception $e) {

                    }

                    //Mail Function End


                $this->session->set_flashdata('summary_id',$booking_id);

                redirect(base_url().'Booking/Summary');


            } else {

                redirect($this->input->post('merchant_furl_id'));

            }

        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 

    public function success() {

        //Redirect
        redirect(base_url().'Booking/Summary');

    }  


    public function failed() {

        //Redirect
        redirect(base_url().'Booking/Summary');

    }


}