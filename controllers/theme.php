<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Theme extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('thememodel');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');


		//$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		//$this->session->set_flashdata('error', '');
		$this->load->view('register');

		//$this->load->model('thememodel');
		//$email = $this->input->post('email');
		//$password = $this->input->post('password');


	}

	public function check()
	{

		if ($this->input->post('register')) {
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[register.email]');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[2]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', "<div style='color:red;'>" . validation_errors());
				$this->load->view('register');
			} else {
				$this->session->set_flashdata('error', '');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->thememodel->insert($email, $password);
				redirect("theme/login");
			}
		}
	}
	public function loginview()
	{
		$this->load->view('login');
	}

	public function registerview()
	{
		$this->load->view('register');
	}


	public function login()
	{

		if ($this->input->post('login')) {
			$email = $this->input->POST('email');
			$password = md5($this->input->POST('password'));

			$query = $this->db->get_where('register', ['email' => $email, 'password' => $password]);

			$x = $query->result_array();
			// print_r($x[0]['id']); exit;

			$j = sizeof($x);

			if ($j == 0) {
				echo "<h3><center><div style ='color:red;'>Incorrect Email/Password</div></center></h3>";
				$this->load->view('login');
			} else {


				$data = array('id' => $x[0]['id'], 'email' => $email);
				// echo "<pre>"; print_r($data); exit;
				$this->session->set_userdata('user', $data);

				redirect('theme/afterlogin');
			}
		} else {
			$this->load->view('login');
		}
	}


	public function like($postId)
	{

		$abc =  $this->session->userdata('user');

		// echo "<pre>"; print_r($abc); exit;
		$id_sel = $abc['id'];
		// echo $id_sel;
		// exit;

		$this->thememodel->like($postId, $id_sel);
		echo $this->db->last_query(); exit;
		// echo "<pre>";  print_r($data); exit; 
		$isPostExists = $this->thememodel->checkLikeExistsOrNot($postId, $id_sel);

		if (count($isPostExists) == 0) {
			$this->thememodel->like($postId, $id_sel);
		} else {
			$this->thememodel->post_unlike($postId, $id_sel);
		}

		return true;
	}


	function afterlogin()
	{
		$abc =  $this->session->userdata('user');

		// echo "<pre>"; print_r($abc); exit;
		$id_sel = $abc['id'];
		//	$this->load->view('afterlogin');
		$data = array();

		$this->template->set('title', 'afterlogin');
		$this->template->load('default_layout', 'contents', 'afterlogin', $data);
	}


	public function post_back()
	{
		$data = array();

		$this->template->set('title', 'afterlogin');
		$this->template->load('default_layout', 'contents', 'afterlogin', $data);
	}


	public function post_list()

	{

		$this->session->userdata('email');
		/* print_r($result);

		exit; */
		//$data = array();

		$result['list'] = $this->thememodel->post_list();
		$result['user_likes'] = $this->thememodel->user_likes();
		// echo '<pre>';
		// print_r($result);
		// exit;
		$this->template->set('title', 'post_list');
		$this->template->load('default_layout', 'contents', 'post_list', $result);
	}

	public function post()
	{
		$abc =  $this->session->userdata('user');

		// echo "<pre>"; print_r($abc); exit;
		$id_sel = $abc['id'];
		//	$this->load->view('afterlogin');
		// echo $id_sel; exit;

		if ($this->input->post('submit')) {

			//exit;
			$data = array(
				'post_title' => $this->input->post('post_title'),
				'post_desc' => $this->input->post('post_desc'),
				'register_id' => $id_sel,
			);
			//	print_r($data);	exit;
			$this->thememodel->postinsert($data);
			redirect('theme/afterlogin');
		}
	}

	public function unlike($id)
	{

		$abc =  $this->session->userdata('user');

		// echo "<pre>"; print_r($abc); exit;
		$id_sel = $abc['id'];

		// echo $id_sel;
		// exit;

		$data = array(
			'post_id' => $id,
			'register_id' => $id_sel,

		);

		/* 	echo "<pre>";  print_r($data); exit;  */
		$this->thememodel->post_unlike($id, $id_sel);
		// echo "hi"; exit;
		 redirect('theme/post_list');
		// return $id;
	}

	public function logout()
	{
		redirect('theme/login');
	}
}
