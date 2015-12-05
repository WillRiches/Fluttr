<?php

class User extends CI_Controller{

	public function index(){
		if($this->session->userdata('data')){
			redirect(site_url('user/view/' . $this->session->userdata('data')->username));
		} else {
			redirect(site_url('user/login'));
		}
	}
	
	//View a user based on their username
	function view($username = false){
		//If no username, display error
		if(!$username){
			redirect(site_url('user/login'));
		}
		//Load required models
		$this->load->model('db_user');
		$this->load->model('db_message');

		//If logged in
		if($this->session->userdata('data')){
			//Define current username
			$currentUsername = $this->session->userdata('data')->username;
		} else {
			//Otherwise leave as undefined
			$currentUsername = null;
		}
		
		//Prepare data to send to view including the name of the user, the messages to show,
		//wether or not to show the follow button, and the title of the page
		$data = array(
			'name' => $username,
			'messages' => $this->db_message->byUser($username),
			'follow' => !($currentUsername == $username) && !($this->db_user->following($currentUsername, $username)),
			'data' => array(
				'title' => ucwords($username) . '\'s messages'
			)
		);
		$this->load->view('messages', $data);
	}

	//Displays the login form
	function login(){
		$data = array(
			'data' => array(
				'title' => 'Login'
			),
			'username' => $this->input->get('username')
		);
		$this->load->view('login_form', $data);
	}

	//The login procedure that takes the user's credentials and checks them against the database
	function doLogin(){
		$this->load->model('db_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		//Determine if valid credentails
		$valid = $this->db_user->login($username, $password);
		if($valid){
			//Save the session userdata
			$userdata['data'] = $valid;
			$this->session->set_userdata($userdata);
			redirect(site_url('user/view/' . $username));
		} else {
			//Go back to the login form and display an error
			redirect(site_url('user/login?incorrect&username=' . $username));
		}
	}

	//Logs out by destroying the session
	function logout(){
		$this->session->sess_destroy();
		redirect(site_url('user/login?loggedout'));
	}

	//Displays a list of messages for which a given user is subscribed to
	//Very similar to the 'view' function above, although takes messages from a different model method
	function feed($username = false){
		if(!$username){
			redirect(site_url('user/login'));
		}
		$this->load->model('db_message');
		
		$data = array(
			'name' => $username,
			'messages' => $this->db_message->followedMessages($username),
			'singleUser' => false,
			'data' => array(
				'title' => ucwords($username) . '\'s feed'
			)
		);

		$this->load->view('messages', $data);
	}

	//Follows a user based on their username
	function follow($target){
		if(!$target){
			echo 'Please enter a username';
			return;
		}
		$subject = $this->session->userdata('data')->username;
		$this->load->model('db_user');

		//Check if you are trying to follow yourself
		if($subject === $target){
			echo 'You cannot follow yourself';
			return;
		}
		//Check if you are already following the user, if not follow them
		else if(!$this->db_user->follow($subject, $target)){
			echo 'Already following user';
			return;
		} else {
			//Go back to the view of the person just followed
			redirect(site_url('/user/view/' . $target));
		}
	}
}