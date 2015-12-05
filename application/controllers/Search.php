<?php

class Search extends CI_Controller{

	//Show the search form
	public function index(){
		$this->load->view('search');
	}
	
	//Carries out the search
	function dosearch(){
		$this->load->model('db_message');

		//Decodes from URL safe form back to text
		$search = trim(base64_decode(urldecode($this->input->get('query'))));

		//Checks if the search was empty	
		if(strlen($search) < 1){
			redirect(site_url('search?error=empty'));
		}

		//Collects the matching messages and passes them to the messages view
		$data['messages'] = $this->db_message->search($search);
		$data['data']['title'] = 'Search';
		$this->load->view('messages', $data);
	}
}