<?php
class Rooms extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');			
	}
	
	//index	   
	function index($slug)
	{  
	      if($_POST) {	
	          
	  
	        
$fname 		=  $this->input->post('name');	
$cemail 	=  $this->input->post('email');
$number	    =  $this->input->post('number');	
$adults   =  $this->input->post('adults');
$children   =  $this->input->post('children');
$checkin   =  date("d-m-Y",strtotime($this->input->post('checkin')));	
$checkout   = date("d-m-Y",strtotime($this->input->post('checkout')));	
$rooms   =  $this->input->post('rooms');
$captcha   = $this->input->post('g-recaptcha-response'); // Captcha response

    // Verify the CAPTCHA
    $secretKey = "6LdhoLAqAAAAAMDXdlG__dGL4HLhfwR5pFshJfjL"; // Replace with your reCAPTCHA secret key
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyURL . "?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "<script>alert('CAPTCHA validation failed. Please try again.');</script>";
        redirect(base_url().'Rooms');
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
  
  <tr><th>Room</th><td>'.$slug.'</td></tr>	

  <tr><th>Name</th><td>'.$fname.'</td></tr>		

  <tr><th>Email</th><td>'.$cemail.'</td></tr>
  
  <tr><th>Phone</th><td>'.$number.'</td></tr>
  
  <tr><th>Adults</th><td>'.$adults.'</td></tr>	
  
 <tr><th>Children</th><td>'.$children.'</td></tr>
    
 <tr><th>Check In</th><td>'.$checkin.'</td></tr>
 
 <tr><th>Check Out</th><td>'.$checkout.'</td></tr>
 
 <tr><th>Rooms</th><td>'.$rooms.'</td></tr>

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

redirect(base_url().'rooms/'.$slug);				

}	
catch (Exception $e) {

$this->session->set_flashdata('error', 'Message could not be sent.Please try again later.');
redirect(base_url().'rooms/'.$slug);

}

}
  $cond=array('seoid' => 5);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('seopage',$cond);
  $res= array('room_slug_name'=>$slug);
  $data['room']	=	$this->Admin_model->fetch_one_row('room',$res);
  $mainid =  $data['room']['roomid'];
  $data['fac'] 	        = 	$this->Admin_model->fetch_data('room_facility',array('roomid'=>$mainid));
  $more = array('roomid'=>$mainid); 
  $data['moreimages']	=	$this->Admin_model->fetch_data('room_images',$more);
		$this->load->view('rooms',$data);		
	}
		
}
