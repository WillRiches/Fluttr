<?php
$this->load->view('templates/header', $data);
?>


<div class="h1wrap">
	<h1><?php echo $data['title'] ?></h1>
</div>

<?php
//If the current user is allowed to be followed, display the follow button
if(isset($follow) and $follow){
	?>
	<div class="follow">
		<a href="<?php echo base_url('user/follow/' . $messages[0]->user_username); ?>">Follow <?php echo ucwords($messages[0]->user_username); ?></a>
	</div>
	<?php
}
?>

<div class="messages">
	<?php
	//Display each message in a new division
	foreach($messages as $message){
		echo '<div class="message">';
		//Provide meta data about post
		echo '<p class="meta"><span class="author"><a href="' . base_url('user/view/' . $message->user_username) .'">@' . $message->user_username . '</a></span> | <span class="age">' . $message->age . '</span></p>';
		//Output post text
		echo '<p class="text">' . $message->text . '</p>';
		echo '</div>';
	}
	//If there are no messages passed to the view
	if(!$messages){
		echo '<p>Sorry, we couldn\'t find the messages you were looking for. <a href="javascript:window.history.back()">Go back.</a></p>';
	}
	?>
</div>
<?php
$this->load->view('templates/footer');