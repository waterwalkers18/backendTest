<?php
class UserModel extends CI_model{

		protected $fields = ['name','email','created_at'];

		public function __construct()
		{
			parent::__construct();
			$db = $this->load->database('default',true);
		}

		function getAllUsers($table_name, $single = false)
		{
			$query = $this->db->select($this->fields)
				->from($table_name)
				->get();

			if ($query->num_rows() > 0):
				return ($single) ? $query->row_array() : $query->result_array();
			endif;

			return false;
		}

		function insert($values, $table_name, $getLastId = false) {
        
			$query = $this->db->insert($table_name, $values);
			
			if ($getLastId == true) {
				return $this->db->insert_id();
			}
			
		}
		
}
?>
