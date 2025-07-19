<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SpecialRates extends MY_Controller {
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

		$cond = array();

		$data['room_categories']	=  $this->Admin_model->fetch_data_cond('categories',$cond,'cat_title','DESC');

 		if($_POST)
		{

		$date_from = $this->input->post('date_from');

		$date_to = $this->input->post('date_to');

		$room = $this->input->post('room_id');

		$rate = $this->input->post('rate');

		$special_price_data = array(

			'rroom_id' => $room,

			'from_date' => date('Y-m-d',strtotime($date_from)),

			'to_date' => date('Y-m-d',strtotime($date_to)),

			'rate' => $rate

		);

		$this->Admin_model->insertsection('room_rates',$special_price_data);

		$this->session->set_flashdata('success', 'Special rate added successfully.'); 

		redirect(base_url().'SpecialRates');

		}
		
		$data['seo_title'] 	= 	"View Special Rates | ".$this->data['admin_title']."";
			
		$this->load->view('admin/view_special_rates',$data);

        }


		public function View($id)
		{

		$cond = array('rroom_id' => $id);

		$data['special_rates']	=  $this->Admin_model->fetch_data_cond('room_rates',$cond,'from_date','DESC');

		$cat_cond = array('cat_id' => $id);

		$data['category'] =  $this->Admin_model->fetch_one_row('categories',$cat_cond);

		$data['seo_title'] 	= 	"View  Rates | ".$this->data['admin_title']."";
			
		$this->load->view('admin/view_special_rate_details',$data);

		}



		public function Delete($id)
		{

		$url = $_SERVER['HTTP_REFERER'];

		$this->db->where('rid',$id);

		$this->db->delete('room_rates');

		$this->session->set_flashdata('error', 'Special rate deleted.'); 

		redirect($url);

		}
		

	  
		 
     
			    			
}