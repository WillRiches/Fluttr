<?php
//If there is no title, just call it page
if(!isset($title)){
	$title = 'Page';
}
?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>assets/styles.css" />
<meta charset="utf-8" />
<?php
//Show title as double wrapped through controller
?>
<title><?php echo $title; ?> - Flutter</title>
</head>
<body>
<div class="wrapper">
	<header>
		<?php

		//Determine if logged in, if so save username
		$username = null;
		if ($this->session->userdata('data')){
			$username = $this->session->userdata('data')->username;
		}
		//Display logged in as bar
		$this->load->view('logged_in', array('username' => $username));

		//Display logo and top-bar links
		?>
		<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/fluttr.png" alt="" /></a>
		<ul class="options">
			<li><a href="<?php echo base_url('search'); ?>">Search</a></li>
			<li><a href="<?php echo base_url('user/feed/' . $username); ?>">Feed</a></li>
			<li><a href="<?php echo base_url('message'); ?>">Post</a></li>
			<li><a href="<?php echo base_url('user/view/' . $username); ?>">My page</a></li>
		</ul>
	</header>
