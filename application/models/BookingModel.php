<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BookingModel extends CI_model {

	
	public function __construct() { 
		parent::__construct();
	}



    //Fetch Datatable Start

    public function FetchData()
    {



    }

    //Fetch Datatable End



    public function get_daily_booking_summary($date)
    {
    $prefix = $this->db->dbprefix;

    $sql = "
        SELECT 
            (SELECT COUNT(*) FROM {$prefix}bookings WHERE booking_status != 'cancelled' AND check_in_date = ?) AS checkin_count,
            (SELECT COUNT(*) FROM {$prefix}bookings WHERE booking_status != 'cancelled' AND check_out_date = ?) AS checkout_count,
            (SELECT COUNT(*) FROM {$prefix}bookings WHERE DATE(created_at) = ?) AS booked_count
    ";

    $query = $this->db->query($sql, [$date, $date, $date]);
    return $query->row_array(); // returns an object with checkin_count, checkout_count, booked_count
    }

	
	

    /*
    public function get_available_rooms($room_count, $check_in, $check_out, $category)
    {
        $this->db->select('r.*');
        $this->db->from('room r');

        if ($category != 0) {
            $this->db->where('r.category', $category);
        }

        $this->db->where('r.avail_room >=', $room_count);

        // Subquery to calculate total booked rooms for each room type in the given date range
        $subquery = "(SELECT booking_room_id, 
                      SUM(no_of_rooms) as booked_rooms
                      FROM {$this->db->dbprefix('bookings')}
                      WHERE booking_status != 'cancelled'
                      AND (
                          ('$check_in' BETWEEN check_in_date AND DATE_SUB(check_out_date, INTERVAL 1 DAY)) OR
                          ('$check_out' BETWEEN check_in_date AND DATE_SUB(check_out_date, INTERVAL 1 DAY)) OR
                          (check_in_date BETWEEN '$check_in' AND '$check_out')
                      )
                      GROUP BY booking_room_id
                    ) b";

        // First, join the subquery to get booked rooms for each room
        $this->db->join($subquery, 'b.booking_room_id = r.roomid', 'left');

        // Select available rooms (from room table) and booked rooms (from subquery)
        

        // Calculate available rooms after bookings
        $this->db->select('r.avail_room - (IFNULL(b.booked_rooms, 0)) as available_rooms', false);

        // Only show rooms where available_rooms >= requested room_count
        $this->db->having('available_rooms >=', $room_count);

        $query = $this->db->get();

        return $query->result();
    }
    */

    public function get_available_rooms($room_count, $check_in, $check_out, $category)
    {
    $this->db->select('r.*, (r.avail_room - IFNULL(b.booked_rooms, 0)) as available_rooms', false);
    $this->db->from('room r');

    if ($category != 0) {
        $this->db->where('r.category', $category);
    }

    // Subquery to calculate total booked rooms for each room in the date range
    $subquery = "(SELECT booking_room_id, SUM(no_of_rooms) as booked_rooms
                  FROM {$this->db->dbprefix('bookings')}
                  WHERE booking_status != 'cancelled'
                  AND (
                      ('$check_in' < check_out_date AND '$check_out' > check_in_date)
                  )
                  GROUP BY booking_room_id
                ) as b";

    // Join subquery
    $this->db->join($subquery, 'b.booking_room_id = r.roomid', 'left');

    // Ensure enough rooms are available
    $this->db->having('available_rooms >=', $room_count);

    $query = $this->db->get();
    return $query->result();
    }




    public function get_available_room_count_by_date($date)
    {
    $this->db->select('r.roomid,r.room_slug_name, r.name, r.avail_room, IFNULL(b.booked_rooms, 0) as booked_rooms, 
                      (r.avail_room - IFNULL(b.booked_rooms, 0)) as available_rooms', false);
    $this->db->from('room r');

    // Subquery: Sum no_of_rooms booked on the given date
    $subquery = "(SELECT booking_room_id, SUM(no_of_rooms) as booked_rooms
                  FROM {$this->db->dbprefix('bookings')}
                  WHERE booking_status != 'cancelled'
                  AND booking_status != 'pending'
                  AND '$date' >= check_in_date
                  AND '$date' < check_out_date
                  GROUP BY booking_room_id
                ) AS b";

    // Left join to room table
    $this->db->join($subquery, 'b.booking_room_id = r.roomid', 'left');

    $query = $this->db->get();
    return $query->result();
    }



    public function get_available_room_counts($check_in = null, $check_out = null, $category = 0)
    {
        // Default to today if no dates provided
        if (!$check_in) {
            $check_in = date('Y-m-d');
        }
        if (!$check_out) {
            $check_out = $check_in;
        }

        $this->db->select('r.roomid, r.title, r.total_rooms, 
            (r.total_rooms - IFNULL(b.booked_count, 0)) AS available_count');
        $this->db->from('room r');

        if ($category != 0) {
            $this->db->where('r.category', $category);
        }

        // Subquery to count overlapping bookings for each room
        $subquery = "(SELECT booking_room_id, COUNT(*) as booked_count
            FROM {$this->db->dbprefix('bookings')}
            WHERE booking_status != 'cancelled'
            AND booking_status != 'pending'
            AND (
            ('$check_in' BETWEEN check_in_date AND DATE_SUB(check_out_date, INTERVAL 1 DAY)) OR
            ('$check_out' BETWEEN check_in_date AND DATE_SUB(check_out_date, INTERVAL 1 DAY)) OR
            (check_in_date BETWEEN '$check_in' AND '$check_out')
            )
            GROUP BY booking_room_id
        ) b";

        $this->db->join($subquery, 'b.booking_room_id = r.roomid', 'left');

        $query = $this->db->get();

        return $query->result();
    }




    public function ViewBookings()
    {

    $this->db->select('*');

    $this->db->from('bookings');

    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');

    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    $query = $this->db->get();

    return $query->result();

    }




    public function ViewBookingsToday()
    {

    $this->db->select('*');

    $this->db->from('bookings');

    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');

    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    $this->db->where('check_in_date',date('Y-m-d'));

    $query = $this->db->get();

    return $query->result();

    }



    public function ViewBookingById($id)
    {   
    $this->db->select('*');
    $this->db->from('bookings');    
    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');
    $this->db->join('room','room.roomid=bookings.booking_room_id','left');
    $this->db->where('bookings.booking_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->row_array();
    } else {
        return false;
    }
    }


    public function BookingTotalPayments($id)
    {

    $this->db->select_sum('bp_amount');
    $this->db->from('booking_payments');
    $this->db->where('bp_type', 'credit');
    $this->db->where('bp_booking', $id);
    $query = $this->db->get();
    $result = $query->row_array();
    return isset($result['bp_amount']) ? $result['bp_amount'] : 0;

    }


    public function BookingTotalRefunds($id)
    {

    $this->db->select_sum('bp_amount');
    $this->db->from('booking_payments');
    $this->db->where('bp_type', 'debit');
    $this->db->where('bp_booking', $id);
    $query = $this->db->get();
    $result = $query->row_array();
    return isset($result['bp_amount']) ? $result['bp_amount'] : 0;

    }



    public function ViewPaymentsByBookingId($id,$type="")
    {
    $this->db->select('*');
    $this->db->from('booking_payments');    
    $this->db->join('bookings','bookings.booking_id=booking_payments.bp_booking','left');
    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');
    if($type!="")
    {
        $this->db->where('bp_type', $type);
    }
    $this->db->where('booking_payments.bp_booking', $id);
    $this->db->order_by('bp_paid_on', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }

    }





    public function CheckPending($id)
    {

        $this->db->select_sum('bp_amount');
        $this->db->from('booking_payments');
        $this->db->where('bp_booking', $id);
        $this->db->where('bp_type','credit');
        $query = $this->db->get();
        $result = $query->row_array();
        return isset($result['bp_amount']) ? $result['bp_amount'] : 0;

    }




    public function ViewPayments($date_from="",$date_to="",$customer="")
    {

    $this->db->select('*');
    $this->db->from('booking_payments');    
    $this->db->join('bookings','bookings.booking_id=booking_payments.bp_booking','left');
    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');
    if($date_from!="" && $date_to!=""){
        $this->db->where('bp_paid_on >=', $date_from);
        $this->db->where('bp_paid_on <=', $date_to);
    }
    if($customer!=""){
        $this->db->where('customers.cus_id', $customer);
    }
    $this->db->order_by('bp_paid_on', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }

    }




    public function ViewBookingReport($date_from,$date_to,$payment_status,$customer,$room)
    {

    $this->db->select('*');
    $this->db->from('bookings');    
    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');
    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    if($date_from!="")
    {
        $this->db->where('check_in_date >=', $date_from);
    }

    if($date_to!="")
    {
        $this->db->where('check_in_date <=', $date_to);
    }

    if($payment_status!="")
    {
        $this->db->where('payment_status', $payment_status);
    }

    if($customer!="")
    {
        $this->db->where('booking_customer_id', $customer);

    }

    if($room!="")
    {
        $this->db->where('booking_room_id', $room);
    }


    $query = $this->db->get();

    return $query->result();


    }


	
		
}