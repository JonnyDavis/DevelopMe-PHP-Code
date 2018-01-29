<?php

session_start();

if ('YES' == $_SESSION['logged_in']){
	header('Location: account.php');
}



 // start session
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


if ($_POST) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	if ($email) {	
	} else {
		$error_messages[] = 'Please provide an Email!';
		$error = true;
	}

	if ($password){
    }else{
        $error_messages[] = 'Please provide a Password!';
        $error = true;
    }

    if ($error) {

    } else {

    	$email_query = "SELECT `email` FROM `login` WHERE `email` = '$email'";
    	$email_result = mysqli_query($db_connection, $email_query);

    	$password_query = "SELECT `password` FROM `login` WHERE `email` = '$email'";
    	$password_result = mysqli_query($db_connection, $password_query);

    	$active_query = "SELECT `activation_status` FROM `login` WHERE `email` = '$email'";
    	$active_result = mysqli_query($db_connection, $active_query);

    	if ($email_result) {

    		if (mysqli_num_rows($email_result) > 0) {

    			$row = mysqli_fetch_assoc($email_result);

    			if ($row['email'] == $email) {

			    	if ($password_result) {

			    		if (mysqli_num_rows($password_result) > 0) {

			    			$row = mysqli_fetch_assoc($password_result);

			    			if ($row['password'] == $password) {

			    				if ($active_result) {

			    					if (mysqli_num_rows($active_result) > 0) {

			    						$row = mysqli_fetch_assoc($active_result);

			    						if ($row['activation_status'] == 'activated' ) {

			    							

			    							$_SESSION['logged_in'] = 'YES';

			    							header( 'Location: account.php' );
			    							

			    						} else {
			    							$error_messages[] = 'Your account has not been activated';
			        						$error = true;			    							
			    						}

			    					} else {
			    						$error_messages[] = 'Your account has not been activated';
			        					$error = true;				    						
			    					}

			    				} else {
			    					$error_messages[] = '5Something went wrong';
			        				$error = true;			    					
			    				}

							} else {
			    				$error_messages[] = 'Your password was incorrect';
			        			$error = true;
							}

			    		} else {
			    			$error_messages[] = '1Something went wrong!';
			        		$error = true;
			    		}

			    	} else {
			    		$error_messages[] = '2Something went wrong!';
			        	$error = true;
			    	}



				} else {
    				$error_messages[] = 'Your account cannot be found';
        			$error = true;
				}

    		} else {
    			$error_messages[] = 'Your account cannot be found';
        		$error = true;
    		}

    	} else {
    		$error_messages[] = '4Something went wrong!';
        	$error = true;
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
<?php } else { 

	
 }



?>


<h2>Login</h2>

<form method="post">
	Email:
	<input type="email" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>"><br>
	Password:
	<input type="password" name="password"><br>


	<input type="submit" value="Login">

</form>

