<?php

class Message extends CI_Controller {

	//Displays the post message view
	public function index(){
		//Requires login
		$this->requireLogin();
		$data = array(
			'data' => array(
				'title' => 'Post message'
			)
		);
		$this->load->view('post', $data);
	}

	//Carries out the posting of the message
	public function doPost(){
		//Requires login
		$this->requireLogin();
		$this->load->model('db_message');
		//Takes username from session data and message from post data
		$username = $this->session->userdata('data')->username;
		$message = $this->input->post('message');
		//Submits the message using the submit method in the message model
		$this->db_message->submit($username, $message);
		redirect(site_url());
	}

	//Utility function to require users to log in to avoid a redirection away from the routine
	public function requireLogin(){
		if (!$this->session->userdata('data')){
			redirect(site_url());
		}
	}
}