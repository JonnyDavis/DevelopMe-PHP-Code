<?php 

session_start();

if ('YES' == $_SESSION['logged_in']) {
	echo 'You have successfully logged in!';
}

if ('NO' == $_SESSION['logged_in']) {
	header('Location: login.php');
}

if ($_POST) {

	$_SESSION['logged_in'] = 'NO';

	header( 'Location: login.php' );
}

?>


<form method="post">
	
	<input type="submit" name="logout" value="logout">
</form>