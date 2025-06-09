<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Available_dates extends MY_Controller {
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

$cond = array('hotel'=>0);
	$data['all_rooms']	=	$this->Admin_model->fetch_data_cond('room',$cond,'roomid','DESC');



 if(isset($_GET['id']))
{		
$id         = $_GET['id'];
$data['id'] = $id;

}

 if($_POST)

{

$id             = $_POST['event_id'];

$avail_room     =  $_POST['avail_room'];


$data_imgg  = array('avail_room'  =>$avail_room);
$condd  	= 	array('id'  =>$id);
$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'available_date');
			

$this->session->set_flashdata('success', 'Updated Successfully.'); 
redirect(base_url().'admin/Available_dates');
	
}
			
			//$data['view_data']	=	$this->Admin_model->fetch_all_new('available_date','id','Desc');
		
			$data['seo_title'] 	= 	"View Available Date | ".$this->data['admin_title']."";		
			
		    $this->load->view('admin/view_available_dates',$data); 
        }
		
		public function FetchEvent()

		{ 
			
			
    $json = array();
	
	$show = array('hotel'=>0);
	$data['pass_select']	=	$this->Admin_model->fetch_data_cond('available_date',$show,'roomid','DESC');

	
    foreach ($data['pass_select'] as $new=>$val)

	{
	
	$cond  	                = 	array('roomid'=> $val->roomid);
	$data['pass_select']	=	$this->Admin_model->fetch_one_row('room',$cond);
		
		
        $eventArray[]= array(
		'id' => $val->id,
		'title' => $val->avail_room,
		'start' => $val->startdate,
		'end' => $val->end_date,
		'color'=> $data['pass_select']['color'],
		'description'=>$data['pass_select']['name'],
		'roomid'=>$data['pass_select']['roomid']
		);
    }
	
   echo json_encode($eventArray);
		
			
        }
	  
		 
       
	
	  
		 
     
			    			
}