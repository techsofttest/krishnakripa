<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GuestBooking extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation', 'session', 'upload'));
		$this->load->helper(array('form', 'url', 'text'));
		$this->load->model('Admin_model');
		$this->load->model('BookingModel');
	}

	private function loadHotelBySlug($slug)
	{
		$hotel = $this->Admin_model->getHotelBySlug($slug);
		if (empty($hotel)) {
			show_404();
		}
		return $hotel;
	}

	public function index($slug = '')
	{
		$hotel = $this->loadHotelBySlug($slug);
		$sources = $this->Admin_model->fetch_where_order('sources', array(), 'source_name', 'asc');

		$data = array(
			'hotel' => $hotel,
			'sources' => $sources,
			'seo_title' => 'Guest Registration | ' . (!empty($hotel['hotel_name']) ? $hotel['hotel_name'] : 'Hotel'),
		);

		$this->load->view('guest_booking', $data);
	}

	public function save()
	{
		if (!$this->input->post()) {
			redirect(base_url());
		}

		$slug = trim($this->input->post('hotel_slug'));
		$hotel = $this->loadHotelBySlug($slug);
		$sources = $this->Admin_model->fetch_where_order('sources', array(), 'source_name', 'asc');
		$guest_source_id = 0;
		foreach ($sources as $source) {
			if (isset($source->source_name) && strtolower(trim($source->source_name)) === 'direct guest') {
				$guest_source_id = (int) $source->source_id;
				break;
			}
		}

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');

		if ($this->form_validation->run() === false) {
			$data = array(
				'hotel' => $hotel,
				'sources' => $sources,
				'seo_title' => 'Guest Registration | ' . (!empty($hotel['hotel_name']) ? $hotel['hotel_name'] : 'Hotel'),
			);
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('guest_booking', $data);
			return;
		}

		$phone = trim($this->input->post('mobile'));
		$alt_phone = trim($this->input->post('alt_mobile'));
		$email = trim($this->input->post('email'));
		$first_name = trim($this->input->post('first_name'));
		$last_name = trim($this->input->post('last_name'));
		$address = trim($this->input->post('address'));
		$remarks = trim($this->input->post('remarks'));
		$vehicle_number = trim($this->input->post('vehicle_number'));
		$no_of_guests = trim($this->input->post('no_of_guests'));
		$no_of_nights = trim($this->input->post('no_of_nights'));

		$customer = $this->Admin_model->fetch_one_row('customers', array('phone_number' => $phone));
		$customer_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email_address' => $email,
			'phone_number' => $phone,
			'address' => $address,
		);

		if (empty($customer)) {
			$customer_id = $this->Admin_model->insertsection('customers', $customer_data);
		} else {
			$customer_id = $customer['cus_id'];
			$this->Admin_model->update_all($customer_data, array('cus_id' => $customer_id), 'customers');
		}

		$booking_uid = 'KR' . date('ymdHis') . rand(10, 99);
		if ($guest_source_id === 0) {
			$guest_source_id = null;
		}

		

		$booking_data = array(
			'booking_customer_id' => $customer_id,
			'hotel_id' => !empty($hotel['hotel_id']) ? (int) $hotel['hotel_id'] : null,
			'customer_first_name' => $first_name,
			'customer_last_name' => $last_name,
			'customer_phone_number' => $phone,
			'customer_phone_number_alt' => $alt_phone,
			'customer_email' => $email,
			'customer_address' => $address,
			'booking_source' => $guest_source_id,
			'booking_status' => 'draft',
			'booking_notes' => $remarks,
			'vehicle_number' => !empty($vehicle_number) ? $vehicle_number : null,
			'no_of_guests' => $no_of_guests !== '' ? (int) $no_of_guests : null,
			'no_of_nights' => $no_of_nights !== '' ? (int) $no_of_nights : null,
			'extra_desc' => !empty($id_type) ? trim($id_type . (!empty($id_number) ? ' - ' . $id_number : '')) : $remarks,
			'actual_check_in_date' => date('Y-m-d H:i:s'),
		);

		$proof_file = '';
		if (!empty($_FILES['id_proof']['name'])) {
			$upload_path = FCPATH . 'uploads/Booking/';
			if (!is_dir($upload_path)) {
				@mkdir($upload_path, 0777, true);
			}
			$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'max_size' => 2048,
				'encrypt_name' => true,
			);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('id_proof')) {
				$upload_data = $this->upload->data();
				$proof_file = $upload_data['file_name'];
				$booking_data['id_proof'] = json_encode(array($proof_file));
			}
		}

		$bid = $this->Admin_model->insertsection('bookings', $booking_data);

		$booking_uid = 'KK' . str_pad($bid, 5, '0', STR_PAD_LEFT);

				$update_booking_data = array(
					'uid' => $booking_uid,
				);
				$update_booking_cond = array('booking_id' => $bid);

		$this->Admin_model->update_all($update_booking_data,$update_booking_cond,'bookings');

		if (!$bid) {
			//$this->session->set_flashdata('error', 'Unable to save registration. Please try again.');
			redirect(base_url('user-booking/' . $slug));
			return;
		}

		//$this->session->set_flashdata('success', 'Your details have been submitted successfully.');
		redirect(base_url('user-booking/' . $slug . '/success'));
	}

	public function success($slug = '')
	{
		$hotel = $this->loadHotelBySlug($slug);
		$data = array(
			'hotel' => $hotel,
		);
		$this->load->view('guest_booking_success', $data);
	}
}
