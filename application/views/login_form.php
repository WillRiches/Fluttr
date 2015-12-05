<?php
$this->load->view('templates/header', $data);
?>

<div class="h1wrap"><h1>Log in</h1></div>

<?php


//If password was incorrect
if($this->input->get('incorrect') !== null){
	//Show an error
	$data['error'] = 'Incorrect username or password';
	$this->load->view('error', $data);
}

?>



<form action="./doLogin" method="post" class="loginForm">
	<input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" />
	<input type="password" name="password" placeholder="Password" />
	<button>Log in</button>
</form>

<?php
$this->load->view('templates/footer');