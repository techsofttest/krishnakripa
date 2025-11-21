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


    /*
    public function get_available_rooms($room_count, $check_in, $check_out, $category,$hotel)
    {
    //$this->db->select('r.*, (r.avail_room - IFNULL(b.booked_rooms, 0)) as available_rooms', false);
    
    $this->db->select('
        r.*, 
        (r.avail_room - IFNULL(b.booked_rooms, 0)) as available_rooms,
        COALESCE(rr.rate, rr_ordinary.rate, 0) as current_rate
    ', false);

    $this->db->from('room r');

    if ($category != 0) {
        $this->db->where('r.category', $category);
    }


    if($hotel != "")
    {
    $this->db->where('r.hotel',$hotel);
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

     // Subquery for special rates
    $rate_subquery = "(SELECT rroom_id, MIN(rate) as rate
                       FROM {$this->db->dbprefix('room_rates')}
                       WHERE from_date <= '$check_in'
                       AND to_date >= '$check_out'
                       GROUP BY rroom_id
                     ) as rr";


    // Join subquery
    $this->db->join($subquery, 'b.booking_room_id = r.roomid', 'left');

    $this->db->join($rate_subquery, 'rr.rroom_id = r.roomid', 'left');

    // Ensure enough rooms are available
    $this->db->having('available_rooms >=', $room_count);

    $query = $this->db->get();
    return $query->result();
    }

    */



    public function get_available_rooms($room_count, $check_in, $check_out, $category, $hotel)
    {
    $this->db->select('
        r.*, 
        (r.avail_room - IFNULL(b.booked_rooms, 0)) as available_rooms,
        COALESCE(rr_special.rate, r.rate, 0) as rate
    ', false);

    $this->db->from('room r');

    if ($category != 0) {
        $this->db->where('r.category', $category);
    }

    if($hotel != "") {
        $this->db->where('r.hotel', $hotel);
    }

    // Subquery to calculate total booked rooms for each room in the date range
    $booking_subquery = "(SELECT booking_room_id, SUM(no_of_rooms) as booked_rooms
                          FROM {$this->db->dbprefix('bookings')}
                          WHERE booking_status NOT IN ('cancelled','checked_out')
                          AND (
                              ('$check_in' < check_out_date AND '$check_out' > check_in_date)
                          )
                          GROUP BY booking_room_id
                        ) as b";

    // Subquery for special rates (date-specific rates)
    $special_rate_subquery = "(SELECT rroom_id as category_id, MIN(rate) as rate
                               FROM {$this->db->dbprefix('room_rates')}
                               WHERE from_date <= '$check_in'
                               AND to_date >= '$check_out'
                               AND from_date > '1970-01-01'
                               GROUP BY rroom_id
                             ) as rr_special";

    // Subquery for ordinary rates (default rates with old dates)
    /*$ordinary_rate_subquery = "(SELECT rroom_id as category_id, MIN(rate) as rate
                                FROM {$this->db->dbprefix('room_rates')}
                                WHERE from_date <= '1970-01-01'
                                GROUP BY rroom_id
                              ) as rr_ordinary";*/

    // Join subqueries
    $this->db->join($booking_subquery, 'b.booking_room_id = r.roomid', 'left');
    $this->db->join($special_rate_subquery, 'rr_special.category_id = r.category', 'left');
    //$this->db->join($ordinary_rate_subquery, 'rr_ordinary.category_id = r.category', 'left');
   

    // Ensure enough rooms are available
    $this->db->having('available_rooms >=', $room_count);

    $query = $this->db->get();
    return $query->result();
    }






    public function room_available_check_edit($room_id, $check_in, $check_out, $room_count, $current_booking_id)
{
    // Subquery to count overlapping bookings for the room, excluding current booking
    $this->db->select_sum('no_of_rooms', 'booked_rooms');
    $this->db->from('bookings');
    $this->db->where('booking_room_id', $room_id);
    //$this->db->where('booking_status !=', 'cancelled');
    $this->db->where_not_in('booking_status', ['cancelled','checked_out']);
    $this->db->where('booking_id !=', $current_booking_id);
    //$this->db->where("('$check_in' < check_out_date AND '$check_out' > check_in_date)", null, false);
    $this->db->group_start();
    $this->db->where("$check_in < check_out_date", null, false);
    $this->db->where("$check_out > check_in_date", null, false);
    $this->db->group_end();
    $query = $this->db->get();
    $result = $query->row();

    $booked_rooms = $result ? (int)$result->booked_rooms : 0;

    // Now fetch total available rooms from room table
    $this->db->select('avail_room');
    $this->db->from('room');
    $this->db->where('roomid', $room_id);
    $room = $this->db->get()->row();

    if (!$room) {
        return false; // room not found
    }

    $available = (int)$room->avail_room - $booked_rooms;

    return $available >= $room_count;
}






    public function get_available_room_count_by_date($date)
    {
    $this->db->select('r.roomid,r.room_slug_name, r.name, r.avail_room, IFNULL(b.booked_rooms, 0) as booked_rooms, 
                      (r.avail_room - IFNULL(b.booked_rooms, 0)) as available_rooms', false);
    $this->db->from('room r');

    // Subquery: Sum no_of_rooms booked on the given date
    $subquery = "(SELECT booking_room_id, SUM(no_of_rooms) as booked_rooms
                  FROM {$this->db->dbprefix('bookings')}
                  WHERE booking_status NOT IN ('cancelled', 'pending', 'checked_out')
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







    /* Datatable Server Side */

    public function countAllBookings()
    {
        $this->db->from('bookings');
        $totalBookings = $this->db->count_all_results();
        return $totalBookings;
    }


    public function countFilteredBookings($search,$date_from,$date_to,$payment_status,$customer,$room,$room_no,$register_no,$hotel_type)
    {
    

    $this->db->from('bookings');

    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');

    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    $this->db->join('sources','sources.source_id=bookings.booking_source','left');

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

    if($room_no!="")
    {

        //$this->db->where('booking_room_no',str_replace(" ","",$room_no));

        $this->db->like('booking_room_no',str_replace(" ","",$room_no), 'both'); 

    }

     if($register_no!="")
    {

        $this->db->where('booking_register_no',str_replace(" ","",$register_no));

    }
    
    if($hotel_type!="")
    {
        $this->db->where('room.hotel',$hotel_type);
    }

    if($search!="")
    {

    $this->db->group_start();

    $this->db->like('uid',str_replace(" ","",$search), 'both');
    
    $this->db->or_like('customer_first_name',trim($search), 'both');

    $this->db->or_like('customer_last_name',trim($search), 'both');

    $this->db->or_like('customer_phone_number',str_replace(" ","",$search), 'both');

    $this->db->or_like('booking_register_no',str_replace(" ","",$search), 'both');

    $this->db->or_like('booking_room_no',str_replace(" ","",$search), 'both');

    $this->db->group_end();

    }

    $totalBookings = $this->db->count_all_results();
    return $totalBookings;

    }


    public function ViewBookingsPaginate($search,$date_from,$date_to,$payment_status,$customer,$room,$room_no,$register_no,$hotel_type,$columnName,$columnSortOrder,$rowperpage,$start)
    {

    $this->db->select('*');

    $this->db->from('bookings');

    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');

    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    $this->db->join('sources','sources.source_id=bookings.booking_source','left');

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

    if($room_no!="")
    {

        //$this->db->where('booking_room_no',str_replace(" ","",$room_no));

        $this->db->like('booking_room_no',str_replace(" ","",$room_no), 'both'); 

    }

     if($register_no!="")
    {

        $this->db->where('booking_register_no',str_replace(" ","",$register_no));

    }
    
    if($hotel_type!="")
    {
        $this->db->where('room.hotel',$hotel_type);
    }

    if($search!="")
    {

    $this->db->group_start();

    $this->db->like('uid',str_replace(" ","",$search), 'both');
    
    $this->db->or_like('customer_first_name',trim($search), 'both');

    $this->db->or_like('customer_last_name',trim($search), 'both');

    $this->db->or_like('customer_phone_number',str_replace(" ","",$search), 'both');

    $this->db->or_like('booking_register_no',str_replace(" ","",$search), 'both');

    $this->db->or_like('booking_room_no',str_replace(" ","",$search), 'both');

    $this->db->group_end();

    }


    $this->db->order_by('bookings.created_at','desc');

    if ($rowperpage != -1) {
    $this->db->limit($rowperpage, $start);
    }

    $query = $this->db->get();

    return $query->result();

    }





    /* ###### */










    public function ViewBookings($date_from,$date_to,$payment_status,$customer,$room,$room_no,$register_no,$hotel_type)
    {

    $this->db->select('*');

    $this->db->from('bookings');

    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');

    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    $this->db->join('sources','sources.source_id=bookings.booking_source','left');

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

    if($room_no!="")
    {

        //$this->db->where('booking_room_no',str_replace(" ","",$room_no));

        $this->db->like('booking_room_no',str_replace(" ","",$room_no), 'both'); 

    }

     if($register_no!="")
    {

        $this->db->where('booking_register_no',str_replace(" ","",$register_no));

    }
    
    if($hotel_type!="")
    {
        $this->db->where('room.hotel',$hotel_type);
    }


    $this->db->order_by('bookings.created_at','desc');

    $query = $this->db->get();

    return $query->result();

    }




    public function ViewBookingsToday($date="")
    {

    $this->db->select('*');

    $this->db->from('bookings');

    if($date!="")
    {

    $this->db->where('check_in_date',date('Y-m-d',strtotime($date)));

    $this->db->or_where('check_out_date',date('Y-m-d',strtotime($date)));

    }

    else
    {

    $this->db->where('check_in_date',date('Y-m-d'));

    $this->db->or_where('check_out_date',date('Y-m-d'));

    }

    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');

    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    

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




    public function ViewPayments($date_from="",$date_to="",$customer="",$hotel_type="")
    {

    $this->db->select('*');
    $this->db->from('booking_payments');    
    $this->db->join('bookings','bookings.booking_id=booking_payments.bp_booking','left');
    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');
    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    if($date_from!="" && $date_to!=""){
        $this->db->where('bp_paid_on >=', $date_from);
        $this->db->where('bp_paid_on <=', $date_to);
    }

    if($customer!=""){
        $this->db->where('customers.cus_id', $customer);
    }

    if($hotel_type!="")
    {
        $this->db->where('room.hotel',$hotel_type);
    }

    $this->db->order_by('bp_paid_on', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }

    }




    public function ViewBookingReport($date_from,$date_to,$time_from,$time_to,$payment_status,$customer,$room,$room_no,$register_no,$room_type,$overlapping)
    {

    $this->db->select('*');
    $this->db->from('bookings');    
    $this->db->join('customers','customers.cus_id=bookings.booking_customer_id','left');
    $this->db->join('room','room.roomid=bookings.booking_room_id','left');

    /*
    if($date_from!="")
    {
        $this->db->where('check_in_date >=', $date_from);
    }

    if($date_to!="")
    {
        $this->db->where('check_in_date <=', $date_to);
    }
    */

    $this->db->where_not_in('booking_status', ['cancelled']);

    if($date_from != "" && $date_to != "") {

    $date_from = $date_from . ' 00:00:00';
    $date_to   = $date_to   . ' 23:59:59';
    //$this->db->where('check_in_date <=', $date_to);
       
    //$this->db->where('check_out_date >=', $date_from);

    /* New Condition */
   
    if($overlapping != "")
    {

    $this->db->where('check_in_date <=', $date_to);
       
    $this->db->where('check_out_date >=', $date_from);

    }

    else
    {

    $from = $this->db->escape($date_from . ' 00:00:00'); // escaped string
    $to   = $this->db->escape($date_to   . ' 23:59:59');

// Build a single overlap condition using COALESCE:
// start = COALESCE(actual_check_in_date, CONCAT(check_in_date,' 00:00:00'))
// end   = COALESCE(actual_check_out_date, CONCAT(check_out_date,' 23:59:59'))
    

    $this->db->group_start();

    // Case 1: actual_check_in_date is NOT NULL → compare actual date
    $this->db->group_start();
        $this->db->where('actual_check_in_date IS NOT NULL', null, false);
        $this->db->where('actual_check_in_date >=', $date_from);
    $this->db->group_end();

    // Case 2: actual_check_in_date is NULL → fallback to check_in_date
    $this->db->or_group_start();
            $this->db->where('actual_check_in_date IS NULL', null, false);
            $this->db->where('check_in_date >=', $date_from);
    $this->db->group_end();

    $this->db->group_end();


    $this->db->group_start();

    // Case 1: actual_check_out_date is NOT NULL → compare actual date
    $this->db->group_start();
        $this->db->where('actual_check_out_date IS NOT NULL', null, false);
        $this->db->where('actual_check_out_date <=', $date_to);
    $this->db->group_end();

    // Case 2: actual_check_out_date is NULL → fallback to check_out_date
    $this->db->or_group_start();
        $this->db->where('actual_check_out_date IS NULL', null, false);
        $this->db->where('check_out_date <=', $date_to);
    $this->db->group_end();

    $this->db->group_end();


    }

    /* New COndition */
       
        if ($time_from != "") {
        $this->db->group_start(); // open bracket
        $this->db->where('TIME(actual_check_in_date) >=', $time_from);
        $this->db->or_where('actual_check_in_date IS NULL');
        $this->db->group_end(); // close bracket
        }

        if ($time_to != "") {
        $this->db->group_start();
        $this->db->where('TIME(actual_check_out_date) <=', $time_to);
        $this->db->or_where('actual_check_out_date IS NULL');
        $this->db->group_end();
        }

    } elseif($date_from != "") {
        $this->db->where('check_out_date >=', $date_from);
         if ($time_from != "") {
        $this->db->group_start();
        $this->db->where('TIME(actual_check_in_date) >=', $time_from);
        $this->db->or_where('actual_check_in_date IS NULL');
        $this->db->group_end();
        }
    } elseif($date_to != "") {
        $this->db->where('check_in_date <=', $date_to);
        if ($time_to != "") {
        $this->db->group_start();
        $this->db->where('TIME(actual_check_out_date) <=', $time_to);
        $this->db->or_where('actual_check_out_date IS NULL');
        $this->db->group_end();
        }
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

    if($room_no!="")
    {
        //$this->db->where('booking_room_no',str_replace(" ","",$room_no));
        $this->db->like('booking_room_no',str_replace(" ","",$room_no), 'both'); 
    }


     if($register_no!="")
    {

    $this->db->where('booking_register_no',str_replace(" ","",$register_no));

    }


    $this->db->order_by('booking_id','desc');

    $query = $this->db->get();

    //echo $this->db->last_query(); exit;

    return $query->result();


    }






    public function get_price_per_day($room_id, $checkin_date, $checkout_date) {
            $price_list = [];
            $start = new DateTime($checkin_date);
            $end = new DateTime($checkout_date);

            $interval = $start->diff($end);
            $nights = max(1, $interval->days);

            // Load default room rate
            $this->db->select('rate,category');

            $this->db->where('roomid', $room_id);
            $row = $this->db->get('room')->row();
            $default_rate = $row->rate;
            $category_id = $row->category;

            $price_list = [];
            for ($i = 0; $i < $nights; $i++) {
                $current_date = $start->format('Y-m-d');

                // Check for special rate
                $this->db->select('rate');
                $this->db->where('rroom_id', $category_id);
                $this->db->where('from_date <=', $current_date);
                $this->db->where('to_date >=', $current_date);
                $query = $this->db->get('room_rates');

                if ($query->num_rows() > 0) {
                    $rate = $query->row()->rate;
                } else {
                    $rate = $default_rate;
                }

                $price_list[] = [
                    'date' => $current_date,
                    'rate' => $rate
                ];

                $start->modify('+1 day');
            }

            return $price_list;
        }



        public function get_single_booking_addons($booking_id)
        {

            $this->db->select('
                a.ao_id,
                a.ao_name,
                a.ao_description,
                a.ao_price,
                a.charge_type,
                a.status,
                ba.bao_id,
                ba.quantity,
                ba.unit_price,
                ba.total_price,
                ba.add_on_remarks
            ');

        $this->db->from('booking_addons ba');
        $this->db->join(
        'addons a',
        'a.ao_id = ba.addon_id AND ba.booking_main_id = '.$this->db->escape($booking_id),
        'left'
        );
        $this->db->where('a.status', 1);
        $this->db->order_by('a.ao_name', 'ASC');

        return $this->db->get()->result();

        }




      public function get_booking_addons($booking_id)
        {
             $this->db->select('
            a.ao_id,
            a.ao_name,
            a.ao_description,
            a.ao_price,
            a.charge_type,
            a.status,
            ba.bao_id,
            ba.quantity,
            ba.unit_price,
            ba.total_price,
            ba.add_on_remarks
            ');
            $this->db->from('addons a');

            // LEFT JOIN: get booking_addons if exists
            $this->db->join(
                'booking_addons ba',
                'ba.addon_id = a.ao_id AND ba.booking_main_id = '.$this->db->escape($booking_id),
                'left'
            );

            // Only active addons
            $this->db->where('a.status', 1);

            // Optional: order by name
            $this->db->order_by('a.ao_name', 'ASC');

            $query = $this->db->get();
            return $query->result();
        }




         public function get_all_addons()
        {
             $this->db->select('
            a.ao_id,
            a.ao_name,
            a.ao_description,
            a.ao_price,
            a.charge_type,
            a.status,
            ');
            $this->db->from('addons a');

            // Only active addons
            $this->db->where('a.status', 1);

            // Optional: order by name
            $this->db->order_by('a.ao_name', 'ASC');

            $query = $this->db->get();
            return $query->result();
        }
    


	
		
}