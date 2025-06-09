<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BookingModel extends CI_model {

	
	public function __construct() { 
		parent::__construct();
	}
	
	


    public function get_available_rooms($check_in, $check_out, $category)
    {
        $this->db->select('r.*');
        $this->db->from('room r');

        if ($category != 0) {
            $this->db->where('category', $category);
        }

        // Subquery to filter out rooms with overlapping bookings	
        $this->db->where("(
            SELECT COUNT(*) FROM {$this->db->dbprefix('bookings')}
            WHERE {$this->db->dbprefix('bookings')}.booking_room_id = r.roomid
            AND {$this->db->dbprefix('bookings')}.booking_status != 'cancelled'
            AND (
                ('$check_in' BETWEEN {$this->db->dbprefix('bookings')}.check_in_date AND DATE_SUB({$this->db->dbprefix('bookings')}.check_out_date, INTERVAL 1 DAY)) OR
                ('$check_out' BETWEEN {$this->db->dbprefix('bookings')}.check_in_date AND DATE_SUB({$this->db->dbprefix('bookings')}.check_out_date, INTERVAL 1 DAY)) OR
                ({$this->db->dbprefix('bookings')}.check_in_date BETWEEN '$check_in' AND '$check_out')
            )
        ) = 0");

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



	
		
}