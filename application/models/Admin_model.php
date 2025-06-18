<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_model {

	
	public function __construct() { 
		parent::__construct();
	}



	/* Datatable ajax start */

	public function get_total_records($table, $column, $order, $cond = "")
	{
		$this->db->select($column);
		$this->db->from($table);

		if ($cond != "") {
			$this->db->where($cond);
		}

		return $this->db->count_all_results();
	}

	public function get_total_record_with_filter($table, $column, $searchValue, $searchColumn,$joins,$cond = "")
	{
		$this->db->select($column);
		$this->db->from($table);

		if (!empty($joins)) {
			foreach ($joins as $join) {
				$this->db->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
			}
		}

		if (!empty($searchColumn)) {
			$this->db->group_start();
			foreach ($searchColumn as $col) {
				$this->db->or_like($col, $searchValue);
			}
			$this->db->group_end();
		}

		if ($cond != "") {
			$this->db->where($cond);
		}

		return $this->db->count_all_results();
	}

	public function get_record($table, $column, $searchValue, $searchColumn, $columnName, $joins, $rowperpage, $start, $cond = "")
	{
		$this->db->select('*');
		$this->db->from($table);

		if (!empty($searchColumn)) {
			$this->db->group_start();
			foreach ($searchColumn as $col) {
				$this->db->or_like($col, $searchValue);
			}
			$this->db->group_end();
		}

		if ($columnName != "" && $columnSortOrder != "") {
			$this->db->order_by($columnName, $columnSortOrder);
		}

		if (!empty($joins)) {
			foreach ($joins as $join) {
				$this->db->join($join['table'], $join['table'] . '.' . $join['pk'] . ' = ' . $table . '.' . $join['fk'], 'left');
			}
		}

		if ($cond != "") {
			$this->db->where($cond);
		}

		$this->db->limit($rowperpage, $start);

		$query = $this->db->get();
		return $query->result();
	}


	/* Datatable Ajax end */


	
	
public function get_profile_details($id)

	{

		$this->db->select('*');

        $this->db->from('admin');

	    $this->db->where('adminId', $id);

	    $query = $this->db->get();

        return $query->result_array();

	}
	
	
	public function insertsection($table,$fields)
		{
			$this->db->insert($table,$fields);
			return ($this->db->insert_id());	
		}
			public function fetch_data($table,$fields)
		{
			$this->db->where($fields);
			$query = $this->db->get($table);
			return $query->result();
		}  

		public function check_data_room($table,$fields,$Roomid)
		{
			$this->db->where($fields);
			$this->db->where('roomid !=',$Roomid);
			$query = $this->db->get($table);
			return $query->result();
		}  

		public function fetch_data_cond($table,$fields,$id,$order)
		{
			$this->db->where($fields);
			$this->db->order_by($id,$order);
			$query = $this->db->get($table);
			return $query->result();
		}  

		public function fetch_cat($table,$fields)
		{
			$this->db->where($fields);
			$this->db->order_by('sscat_id','Desc');
			$query = $this->db->get($table);
			return $query->result();
		}  


		public function fetch_all($table)
		{
			$query = $this->db->get($table);
			return $query->result();
		} 
		
		public function update_all($fields,$cond,$table)
		{
			return $this->db->update($table, $fields, $cond);
		}
		public function fetch_one_row($table,$cond)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($cond);
			$query  = $this->db->get();
			$row    = $query->row_array();		
			return $row;
		}
		
		
		public function fetch_where($table,$cond){
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($cond);
			$query  = $this->db->get();
			return $query->result();
		
		}
		
		
		
	   public function fetch_where_desc($table,$cond,$primaryid){
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($cond);
			$this->db->order_by($primaryid,'desc');
			$query  = $this->db->get();
			return $query->result();
		
		}
		
		
		public function fetch_where_order($table,$cond,$primaryid,$order){
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($cond);
			$this->db->order_by($primaryid,$order);
			$query  = $this->db->get();
			return $query->result();
		
		}
		
		


		
		public function fetch_room(){		
			
			$this->db->select('*');
			$this->db->from('room');			
			$this->db->where('hotel',0);
			$this->db->join('categories','room.category = categories.cat_id','left');	
			$this->db->order_by('roomid','Desc');
			$query  = $this->db->get();
			return $query->result();
		
		}

		
		public function fetch_stay(){		
			
			$this->db->select('*');
			$this->db->from('room');			
			$this->db->where('hotel',1);
			$this->db->join('categories','room.category = categories.cat_id','left');	
			$this->db->order_by('roomid','Desc');
			$query  = $this->db->get();
			return $query->result();
		
		}
		
		
		public function fetch_all_order($table,$primaryid,$order){
			
			
			$this->db->select('*');
			$this->db->from($table);
			
			$this->db->order_by($primaryid,$order);
			$query  = $this->db->get();
			return $query->result();
		
		}
		
		
			
			
			
	    public function fetch_all_by_desc($table,$primary)
		
		{
		
		$this->db->select('*');
		
		$this->db->from($table);
		
		$this->db->order_by($primary,'desc');
		
		$query = $this->db->get();	
		
		return $query->result();
			
		}
		
		
		
		
		public function count_where($table,$cond)
		
		{
		
		$this->db->select('*');
		
		$this->db->from($table);
		
		$this->db->where($cond);
		
		$query = $this->db->get();	
			
		return $query->num_rows();	
			
		}
		
		
		
		
		//Slug Functions
		
		public function create_slug($name,$table,$field)
		{
			$count = 0;
			$name = url_title($name);
			$slug_name = $name;            
			while(true) 
			
			{
				$this->db->select('*');
				
				$this->db->where($field,$slug_name); 
				  
				$query = $this->db->get($table);
				
				if ($query->num_rows() == 0) break;
				
				$slug_name = $name . '-' . (++$count); 
				 
			}
			return strtolower($slug_name);
		}
		
		
		// create slug
		
		public function change_slug($name,$slugfield,$id,$primarykey,$table)
		
		{
			$count = 0;
			$name = url_title($name);
			$slug_name = $name;            
			while(true) 
			
			{
				$this->db->select('*');
				$this->db->where($slugfield, $slug_name); 
				$this->db->where_not_in($primarykey,$id); 
				$query = $this->db->get($table);
				if ($query->num_rows() == 0) break;
				$slug_name = $name . '-' . (++$count);  
			}
			
			return strtolower($slug_name);
		}
		
		
		
		
		//##############
		
		
		
		public function fetch_sub_cat($cat_id)
		{
		
		$this->db->select('*');
		
		$this->db->from('anj_categories');
		
		$this->db->where('cat_parent',$cat_id);
		
		$this->db->order_by('cat_name','asc');
		
		$query = $this->db->get();
		
		return $query->result();	
			
		}
		
		
		
		
		
		
		
		
		
		public function fetch_category_only()
		
		{
		
		$this->db->select('*');	
		
		$this->db->from('subcategory_table');	
		
		$result_array = $this->db->get();	
		
			foreach($result_array as $sub){
			
				
			}	
				
			
		}

   public function fetch_limit($table,$limit,$start,$primary,$order)
		{
		 
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($primary,$order);
		$this->db->limit($limit,$start);
		$query  = $this->db->get();
		$row    = $query->result();			
		return $row;		
		
		}	

		public function get_sub()
	{
	  
	 $this->db->select('*');
		$this->db->from('services');		
		$this->db->order_by('service_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		$i = 0;	
	 foreach($return_list as $prod){		
		$cond =array('sscat_main' => $prod->service_id);
		$return_list[$i]->catsub = $this->fetch_cat('service_sub_service',$cond);		
		$i++;
	}
	
	 return $return_list;
	
	}


	public function get_product()
	{
	  
	 $this->db->select('*');
		$this->db->from('service_categories');		
		$this->db->order_by('scat_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		$i = 0;	
	 foreach($return_list as $prod){		
		$cond =array('sscat_main' => $prod->scat_id);
		$return_list[$i]->catpro = $this->fetch_cat('service_sub_categories',$cond);		
		$i++;
	}
	
	 return $return_list;
	
	}
public function check_data($table,$col,$data)
	{
	
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col,$data);
		$query = $this->db->get();
		return $query->row_array(); 

	}
	
	public function check_availability($startdate,$enddate,$total_room,$hotel,$roomf)
	{
	$this->db->select('*');

	$this->db->from('available_date');

	$this->db->join('room','room.roomid=available_date.roomid','left');
	
	$this->db->where('available_date.hotel',$hotel);
	
	$this->db->where('available_date.roomid',$roomf);

	$this->db->where('available_date.startdate >=',$startdate);

	$this->db->where('available_date.end_date <=',$enddate);

	$this->db->where('available_date.avail_room >=',$total_room);
	
	$this->db->group_by("room.roomid");

	$query = $this->db->get();

// 	echo $this->db->last_query(); exit;

	$result = $query->result();


	return $result;

	}

// 	public function check_availability($startdate,$enddate,$total_room,$hotel)
// 	{
	
// 	$this->db->select('*');
// 	$this->db->from('room');
// 	$this->db->where('room.avail_room >=',$total_room);	
// 	$this->db->where('room.hotel',$hotel);
// 	$this->db->where('room.startdate >=',$startdate);
// 	$this->db->where('room.enddate <=',$enddate);	
// 	$query = $this->db->get();
//     echo $this->db->last_query();exit;
// 	$result = $query->result();
// 	return $result;

// 	}

	
	public function check_room_each_day($rid,$start_date,$end_date)
	{

		$this->db->select('*');

		$this->db->from('available_date');

		$this->db->where('roomid',$rid);

		$this->db->where('available_date.startdate >=',date('Y-m-d',strtotime($start_date)));

		$this->db->where('available_date.end_date <=',date('Y-m-d',strtotime($end_date)));

		$query = $this->db->get();

		return $query->result();

	}


	
}