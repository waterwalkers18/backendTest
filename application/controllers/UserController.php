<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class UserController extends CI_Controller{
		
		public function __construct()
		{
			parent::__construct();
			$this->db = $this->load->database('default',true);
			$this->load->dbforge();
			$this->load->library('form_validation');
        	$this->load->library('session');
		}

		public function index(){
			$data['users'] = $this->UserModel->getAllUsers('users');
			$this->load->view('user_list',$data);
		}
		
		public function create(){
			$this->load->view('user_form');
		}

		public function store(){

			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('errors', validation_errors());
				redirect('users/create');
			} else {
				$data = array(
					'name'  => $this->input->post('name'),
					'email' => $this->input->post('email'),
				);

				$this->UserModel->insert($data,'users');

				$this->session->set_flashdata('success', 'User added successfully.');
				redirect('users/create');
			}
		}
	}
?>
