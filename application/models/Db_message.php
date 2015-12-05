<?php

class Db_message extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	//Returns messages by username
	public function byUser($username){
		$this->db->select('text, posted_at, id');
		$this->db->where('user_username', $username);
		$this->db->order_by('posted_at', 'DESC');
		$query = $this->db->get('Messages');
		$result = $query->result();
		if(!$result){
			echo 'User does not exist';
			die;
		}
		foreach($result as $key => $message){
			$result[$key]->user_username = $username;
			$result[$key]->age = $this->parseTime(strtotime($message->posted_at));
		}
		return $result;
	}
	
	//Returns messages by search string
	public function search($string){
		$search = trim(strtolower($string));
		$this->db->select('*');
		$this->db->like('LOWER(text)', $search);
		$query = $this->db->get('Messages');
		$result = $query->result();
		foreach($result as $key => $message){
			$result[$key]->age = $this->parseTime(strtotime($message->posted_at));
		}
		return $result;
	}

	//Submits a given message for a given user
	public function submit($poster, $string){

		$message = strip_tags($string);

		$data = array(
			'user_username' => $poster,
			'text' => $message,
			'posted_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('Messages', $data);
	}

	//Returns messages by users followed by given user
	public function followedMessages($username){
		$this->db->select('Messages.text, Messages.posted_at, Messages.user_username');
		$this->db->from('Messages');
		$this->db->join('User_Follows', 'User_Follows.followed_username = Messages.user_username');
		$this->db->where('User_Follows.follower_username', $username);
		$this->db->order_by('posted_at', 'DESC');
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $key => $message){
			$result[$key]->age = $this->parseTime(strtotime($message->posted_at));
		}
		return $result;
	}

	//Utility function to convert time to human-readable age (for posts)
	private function parseTime($time){
		$time = time() - $time; 

		if($time <= 0){
			$time = 1;
		}

		$timeDictionary = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($timeDictionary as $unit => $text) {
			if ($time >= $unit){
				$number = floor($time / $unit);
				$output = $number .' '. $text;
				if($number > 1){
					$output .= 's';
				}
				return $output;
			}
		}
	}
}