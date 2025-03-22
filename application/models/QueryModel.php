<?php
	class QueryModel extends CI_model{
		public function __construct()
		{
			parent::__construct();
			$db = $this->load->database('default', true);
		}
	function select_no_where($fields, $table_name, $single = false)
	{

		$query = $this->db->select($fields)
			->from($table_name)
			->get();

		if ($query->num_rows() > 0):
			return ($single == true) ? $query->row()->$fields : $query->result_array();
		endif;

		return false;
	}

	function select_where($fields, $table_name, $where, $boolean = false, $single = false)
	{

		$query = $this->db->select($fields)
			->from($table_name)
			->where($where)
			->get();

		if ($query->num_rows() > 0):
			if ($boolean == true) :
				return true;
			else:
				if ($single == true) :
					return $query->row()->$fields;
				else:
					return $query->result_array();
				endif;
			endif;
		endif;

		return false;
	}

	function select_where_orderby($fields, $table_name, $where, $order_by, $order_type = 'asc', $boolean = false, $single = false)
	{

		$query = $this->db->select($fields)
			->from($table_name)
			->where($where)
			->order_by($order_by, $order_type)
			->get();

		if ($query->num_rows() > 0):
			if ($boolean == true) :
				return true;
			else:
				if ($single == true) :
					return $query->row()->$fields;
				else:
					return $query->result_array();
				endif;
			endif;
		endif;

		return false;
	}

	function select_order_by($fields, $table_name, $order_field, $order_by = 'asc', $limit = 1, $offset = 0)
	{
		$query = $this->db->select($fields)
			->from($table_name)
			->order_by($order_field, $order_by)
			->limit($limit, $offset)
			->get();
		if ($query->num_rows() > 0):
			return ($limit == 1) ? $query->row()->$fields : $query->result_array();
		endif;

		return false;
	}

	function insert($values, $table_name, $getLastId = false)
	{

		$query = $this->db->insert($table_name, $values);

		if ($getLastId == true) {
			return $this->db->insert_id();
		}
	}

	function insert_batch($values, $table_name)
	{
		$this->db->insert_batch($table_name, $values);
	}


	function query($query)
	{

		$_query = $this->db->query($query);

		if ($_query->num_rows() > 0) {
			return $_query->result_array();
		}
	}

	function update_where($values, $table_name, $where)
	{
		$query = $this->db->where($where)
			->update($table_name, $values);

		return $this->db->affected_rows();
	}

	function update_batch($values, $table_name, $where)
	{
		$this->db->update_batch($table_name, $values, $where);
	}

	function delete($table_name, $where)
	{
		$this->db->where($where)
			->delete($table_name);
		return true;
	}

	function truncate($table_name)
	{
		$this->db->truncate($table_name);
		return true;
	}
	}
?>
