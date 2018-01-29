<?php 

session_start();

if ('YES' == $_SESSION['logged_in']){
	header('Location: account.php');
}
// create database connection //
$db_server = "localhost";
$db_username = "root";
$db_password = "root";
$db_database = "scotchbox";

// create connection
$db_connection = new mysqli($db_server, $db_username, $db_password, $db_database);

// Check connection
if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
   
} 

// set defaults
$error_messages = [];
$error = false;
$email = '';
$password = '';

$headers = "From: Dev Me <team@example.com>\r\n";
$headers .= "Reply-To: Help <help@example.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html;\r\n";




if ($_POST) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$to_email = $email;

	if ($email) {
	$clean_email = mysqli_real_escape_string($db_connection, $email);	
	} else {
		$error_messages[] = 'Please provide an Email!';
		$error = true;
	}

	if ($password){
	$clean_password = mysqli_real_escape_string($db_connection, $password);
    }else{
        $error_messages[] = 'Please provide a Password!';
        $error = true;
    }


    if ($error){
    
    }else{

    	$email_query = "SELECT `email` FROM `login` WHERE `email` = '$email'";
    	$email_result = mysqli_query($db_connection, $email_query);

    	$row = mysqli_fetch_assoc($email_result);

    	if (mysqli_num_rows($key_result || $email_result) > 0) {


	    	$activation_code = substr(md5(uniqid(rand(), true)), 20, 20);

	    	$link = 'http://jonny.davis/activation.php?code='.$activation_code.'';
			$subject = "Hello";
			$message = '"Please follow this <a href="'.$link.'">link</a> to activate your account"';


	    	$query = "INSERT INTO `login`
	    				(`email`, `password`, `activation_key`, `activation_status`)
	    				VALUES
	    				('$clean_email', '$clean_password', '$activation_code', 'pending');";

	    	$result = mysqli_query($db_connection, $query);

	    	if ($result) {

	    		if (mysqli_affected_rows($db_connection) > 0) {
	    			mail($to_email, $subject, $message, $headers);

	    			echo "Success! Your activation code has been sent to your inbox!";
	    		}else{
	    			$error_messages[] = 'There was a problem creating your account';
	    			$error = true;
	    		}
	    	}else{
	    		$error_messages[] = 'There was a problem creating  account';
	    		$error = true;
	  		}
    	}
    }
}


if ($error){ ?> 
	<div style="color:red";>
		<h2>There were some problems</h2>

		<?php
		foreach($error_messages AS $error_message){
			echo $error_message . '<br>';
		}  ?>
	</div>
	<?php } 


	?>



<h2>Register</h2>

<form method="post">
	Email:
	<input type="email" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>"><br>
	Password:
	<input type="password" name="password"><br>

	<input type="submit" value="Create Account">

</form>





