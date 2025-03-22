<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuth extends CI_controller{
	protected $content = '';
	
	public function __construct()
	{
		parent::__construct();
        $this->db = $this->load->database("default",true);
        $this->load->dbforge();    
	}
	public function index($form){
		
	}
	public function User_login() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$data = array(
				'user_name' =>  $this->input->post('usern_name'),
				'password' => $this->input->post("user_password")
			);
			$this->QueryModel->insert($data, 'users', true);
				echo '1';
			
		}
        $this->load->view('Auth/register');
	}
}
?>
