<?php
class Check extends MY_Controller {
	
	function __construct()
	{
		        parent::__construct();
				$this->load->database();
    $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
    $this->load->model("Admin_model");
				$this->load->library('pagination');
				$this->load->library('session');				
			}
			
			
    public function Book(){
        
 $cond=array('seoid' => 7);
 $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
	$this->load->view("bookonline",$data);

	}
	
	public function index()
	{
		$startdate =  $_GET['checkindate']; 
		$enddate   =  $_GET['checkoutdate'];		
		$startdate1         =  date('Y-m-d', strtotime($startdate)); 
	 $enddate1           =  date('Y-m-d', strtotime($enddate)); 
	 $diff               =  strtotime($startdate) - strtotime($enddate); 
  $data['datediff']   =  abs(round($diff / 86400)); 			
		$hotel             =  $_GET['hotel'];
		$roomf = $_GET['room'];
		$adults             =  $_GET['adults'];
		$children           =  $_GET['children'];
		$rooms_count        =  $_GET['rooms_count'];
		$total_room = $rooms_count;			

$data['available_rooms'] = $this->Admin_model->check_availability($startdate1,$enddate1,$total_room,$hotel,$roomf);	

$data['roomdet'] = $this->Admin_model->fetch_one_row('room',array('roomid'=>$roomf));
		$rate = $data['roomdet']['rate'];
		$tot = $rate*$data['datediff'];
		$data['total_rate'] = $tot*$rooms_count;
		$data['room_gst'] = $data['roomdet']['tax'];
		$gstr = ($data['total_rate']*$data['roomdet']['tax'])/100;
		$data['grand_rate'] = $data['total_rate']+$gstr;


if($_POST && isset($_POST['roomid']))
{

	if(!isset($_POST['roomid']))
	{

		$url = $_SERVER['HTTP_REFERER'];
		$this->session->set_flashdata('error','Select Room To Continue');
		redirect($url);

	}

	
	$create_date                  =  date('Y-m-d'); 			
	
	$roomid                          =  $_POST['roomid'];
	$room_nights                 =  $_POST['room_nights'];
	$checkindate_get          =  date("Y-m-d", strtotime($_POST['checkindate_get']));
	$checkoutdate_get        =   date("Y-m-d", strtotime($_POST['checkoutdate_get'])); 
	$rooms_count_get         =  $_POST['rooms_count_get'];
	$adults_get                    =  $_POST['adults_get'];
	$children_count_get       =  $_POST['children_count_get'];
	$extra_bed                     =  $_POST['extra_bed'];
	$total_price_nights         =  $_POST['total_price_nights'];
	$disc_price_nights          =  $_POST['disc_price_nights'];
	$total_price_extra_bed   =  $_POST['total_price_extra_bed'];
	$total_gst                        =  $_POST['total_gst'];
	$total_amount                 =  $_POST['total_amount'];
	$name                             =  $_POST['name'];
	$email                             =  $_POST['email'];
	$mobile                           =  $_POST['mobile'];
	$address                         =  $_POST['address'];
	$city                                 =  $_POST['city'];
	$country                           =  $_POST['country'];
	$bed_pref                        =  $_POST['bed_pref'];
	$post_code                      =  $_POST['post_code'];
	
	if($children_count_get == 0)
	{
	$children                          =  '';	
	}
	else
	{
	$children                          =  implode(',',$_POST['children']);	
	}
	
	
	
	
	$add_data  	= 	array(
	'custName'	        =>	$name,
	'custEmail'	            =>	$email,	
	'custMob'		    =>	$mobile,
	'custAddress'		    =>	$address,
	'custCity'	                =>	$city,
	'custCountry'	        =>	$country,
	'custRequest'	            =>	$bed_pref,
	'custPost'	            =>	$post_code,
	'roomId'              =>    $roomid,	
	'rooms'		    =>	$rooms_count_get,	
	'roomNights'              =>    $room_nights,
	'checkIn'           =>    $checkindate_get,
	'checkOut'		=>	$checkoutdate_get,
	'roomAdults'		    =>	$adults_get,
	'roomChildren'	        =>	$children_count_get,
	'roomChildrenAge'	        =>	$children,
    'roomBeds'		        =>	$extra_bed,
    'totalStrike'	            =>	$total_price_nights,	
    'totalDisc'		    =>	$disc_price_nights,
	'roomBedPrice'		    =>	$total_price_extra_bed,
	'roomGST'		    =>	$total_gst,
	'grandTotal'	                =>	$total_amount,
	'create_date'	        =>	$create_date
	);
	
$book_id_add = 	$this->Home_model->inserALL('pavilion_booking',$add_data);

$this->session->set_userdata('book_id_add', $book_id_add);

$this->session->set_userdata('room_id_add', $roomid);

redirect(base_url().'Payment');	

}

 $cond=array('seoid' => 1);
 $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);

$this->load->view('check_room',$data);


}

function Enquiry()	{   

  if(isset($_REQUEST['sub'])) {	
	        
$fname 		=  $this->input->post('name');	
$cemail 	=  $this->input->post('email');
$mobile	    =  $this->input->post('mobile');	
$address   =  $this->input->post('address');
$city   =  $this->input->post('city');	
$postcode   =  $this->input->post('post_code');
$country  =  $this->input->post('country');
$bed   =  $this->input->post('bed_pref');
$checkin = date("d-m-Y",strtotime($this->input->post('checkin')));
$checkout = date("d-m-Y",strtotime($this->input->post('checkout')));
if($this->input->post('hotel')==0){
   $hotel = "Residency"; 
} 
if($this->input->post('hotel')==1){
   $hotel = "Excecutive Stay"; 
} 
$adults = $this->input->post('adults');
$children = $this->input->post('children'); 
$rooms_count =$this->input->post('rooms_count'); 
$TotalRate =$this->input->post('totalrate'); 
$Gst =$this->input->post('gst'); 
$Grand =$this->input->post('grand'); 


$captcha   = $this->input->post('g-recaptcha-response'); // Captcha response

    // Verify the CAPTCHA
    $secretKey = "6LdhoLAqAAAAAMDXdlG__dGL4HLhfwR5pFshJfjL"; // Replace with your reCAPTCHA secret key
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyURL . "?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "<script>alert('CAPTCHA validation failed. Please try again.');</script>";
        redirect(base_url().'book-online');
        exit;
    }

$body  = '<div style="font-family:Arial,Helvetica,sans-serif; 						line-height:18px;">

 <p>Dear Admin,</p>

  <p>You have received an enquiry from <b>'.$fname.'</b>. Contact him/her immediately.</p>				 

    <table width="600" border="0" cellpadding="0" cellspacing="0">

     <tbody><tr>

    <td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c4891f">

  <tbody><tr style="">

 <td align="left" valign="top" background="" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tbody><tr>

 <td width="100%" align="left" valign="top" colspan="2" style="text-align:center; padding: 2%; border-bottom:1px solid #c4891f;">

  <h4 style="text-transform: uppercase;font-size: 26px;color: #58595b;font-weight: 800;">Krishnakripa Residency</h4>

 </td>							

 </tr>

 </tbody></table></td>

  </tr>

   <tr>

 <td height="22" align="center" valign="top" bgcolor="#FFFFFF"><table width="92%" border="0" cellspacing="0" cellpadding="0">

 <tbody><tr>

    <td height="14" align="left" valign="middle">&nbsp;</td>

 </tr>

 <tr>

  <table align="center" width="500px" cellpadding="5">

  <thead style="background-color:#5e95f5;color:white">

  <tr><th colspan="2"><h3>Enquiry</h3></th></tr>

  </thead>

  <tbody style="background-color:#eee">

  <tr><th>Name</th><td>'.$fname.'</td></tr>		

  <tr><th>Email</th><td>'.$cemail.'</td></tr>
  
  <tr><th>Phone</th><td>'.$mobile.'</td></tr>
  
  <tr><th>Address</th><td>'.$address.'</td></tr>	
  
  <tr><th>City</th><td>'.$city.'</td></tr>	
  <tr><th>Post Code</th><td>'.$postcode.'</td></tr>	
<tr><th>Country</th><td>'.$country.'</td></tr>	
<tr><th>Bed Preference</th><td>'.$bed.'</td></tr>
<tr><th>Check In</th><td>'.$checkin.'</td></tr>
<tr><th>Check Out</th><td>'.$checkout.'</td></tr>
<tr><th>Hotel</th><td>'.$hotel.'</td></tr>
<tr><th>Adult</th><td>'.$adults.'</td></tr>
<tr><th>Children</th><td>'.$children.'</td></tr>
<tr><th>Room Count</th><td>'.$rooms_count.'</td></tr>
<tr><th>Total Rate</th><td>'.$TotalRate.'</td></tr>
<tr><th>Gst</th><td>'.$Gst.'</td></tr>
<tr><th>Grand Total</th><td>'.$Grand.'</td></tr>

  </tbody>

 </table>

 </tr>						  

    <tr>

  <td align="left" valign="top">&nbsp;</td>

   </tr>

   <tr>

  <td align="left" valign="top">&nbsp;</td>

   </tr>						  

    <tr>

  <td style="border-top:1px solid #c4891f; padding:10px; text-align:center;">&nbsp;</td>							

   </tr>			 

   

   <tr>

   <td align="center" valign="top" style="font-family:Tahoma;font-size:12px;font-weight:normal;color:#333333;text-decoration:none"><strong> Krishnakripa Residency</strong></td>

   </tr>

 

   <tr>

  <td align="left" valign="top">&nbsp;</td>

   </tr>

 </tbody></table></td>

   </tr>

  

   <tr>

 <td align="left" valign="middle">&nbsp;</td>

   </tr>				  

  

 </tbody></table></td>

   </tr>

 </tbody></table>';



 

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

$subject = "Enquiry";

//$this->email->to('techsofttest@gmail.com');

$this->email->to(['krishnakriparesidency@gmail.com', 'residency@krishnakripagroup.com']);

$this->email->subject($subject);					

$this->email->message($body);                

$this->email->set_newline("\r\n");

$this->email->set_mailtype("html");						

if(!$this->email->send()){					

 show_error($this->email->print_debugger());						

}
$this->session->set_flashdata('success', 'Enquiry has been sent,We will get back to you soon..');

redirect(base_url().'book-online');				

}	
catch (Exception $e) {

$this->session->set_flashdata('error', 'Message could not be sent.Please try again later.');
redirect(base_url().'book-online');

}

}
}


public function FetchData()
	{				
		$hotel = $this->input->post("hotel");	
		$item = $this->Admin_model->fetch_data('room',array('hotel'=>$hotel));	
		$output = "";
	 foreach($item as $itm){	 
		$output .= '<option value='.$itm->roomid.'>'.$itm->name.'</option>';
		}
		echo $output;
	}


}
