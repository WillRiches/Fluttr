<p class="loggedIn">
<?php
//If logged in
if ($username){
	//Show logged in user and provide profile and logout link
	echo 'Logged in as <a href="' . base_url('user/view/' . $username) .'">' . ucwords($username) . '</a> | <a href="' . base_url('user/logout') .'">log out</a>';
} else {
	//Otherwise show log in link
	echo '<a href="' . base_url('user/login') .'">log in</a>';
}
?>
</p>