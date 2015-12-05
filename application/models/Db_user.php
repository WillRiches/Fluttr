<?php

class Db_user extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	//Returns the validity of login credentials
	public function login($username, $password){
		$this->db->select('password, username');
		$this->db->where('username', $username);
		$query = $this->db->get('Users');
		$results = $query->result();
		//Compares the hashed version of the password given by user with password in the database
		if($results[0]->password === sha1($password)){
			//Returns information about the user to convey correct details
			return $results[0];
		} else {
			//Returns false to convey incorrect details
			return false;
		}
	}

	//Evaluates if a subject is following a target
	public function following($subject, $target){
		$this->db->where('follower_username', $subject);
		$this->db->where('followed_username', $target);
		$this->db->from('User_Follows');
		//Evaluates if there are at least 1 results showing that the subject is following the target
		return $this->db->count_all_results() > 0;
	}

	//Makes a subject follow a target
	public function follow($subject, $target){
		if(!$this->userExists($target)){
			die('No such user exists');
		}

		//Prevent a user from following themselves
		if($subject === $target){
			die('Tried to follow self');
		}
		//Prevent a user from following a target multiple times
		if($this->following($subject, $target)){
			return false;
		}
		//Add new relationship to database
		$data = array(
			'follower_username' => $subject,
			'followed_username' => $target
		);
		$this->db->insert('User_Follows', $data);
		return true;
	}

	private function userExists($username){
		$this->db->where('username', $username);
		$this->db->from('Users');
		return $this->db->count_all_results() > 0;
	}
}