<?php
//Load header
$this->load->view('templates/header', $data);
?>

<div class="h1wrap"><h1>Post a message</h1></div>

<form action="<?php echo base_url(); ?>message/doPost" method="post">
	<textarea name="message"></textarea>
	<button>Post</button>
</form>

<?php
//Load footer
$this->load->view('templates/footer', $data);