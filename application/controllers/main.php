<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class Main extends CI_Controller
	{
		public function index()
		{
			if (!file_exists('../data/xbmcdm.db'))
			{
				redirect(base_url().'install','refresh');
			}
			$this->load->helper(array('form', 'url'));				// Load the url helper
			$data['title'] = 'Main';								// Set page title
			$this->load->view('common/header', $data);						// Load page header
			$this->load->view('main/navigation');										// Load page navigation
			$this->load->view('main/content');						// Load content
			$this->load->view('common/footer');							// Load page footer
		}
		
		public function logout()
		{
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('view');
			session_destroy();
			redirect('main', 'refresh');
		}
	}
/* End of file main.php */
/* Location: ./application/controllers/main.php */
