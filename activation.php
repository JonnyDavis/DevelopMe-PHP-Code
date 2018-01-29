<?php
// connect to database (we'll need it later)
$db_server = "localhost";
$db_username = "root";
$db_password = "root";
$db_database = "scotchbox";

$db_connection = new mysqli($db_server, $db_username, $db_password, $db_database);

if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);

}



// we'll probably set some variables here

$error = false;
$error_messages = [];
$success = false;



if (isset($_GET['code'])) {
	// get code from query string
	$activation_key = $_GET['code'];

	$clean_activation_key = mysqli_real_escape_string($db_connection, $activation_key);
	





		$key_query = "SELECT `activation_status` FROM `login` WHERE `activation_key` = '$clean_activation_key'";
		$key_result = mysqli_query($db_connection, $key_query);
		
		if ($key_result) {
			

			if (mysqli_num_rows($key_result) > 0) {

				$row = mysqli_fetch_assoc($key_result);


				if ($row['activation_status'] !== 'activated') {

					$status_query = "UPDATE `login` SET `activation_status` = 'activated' WHERE `activation_key` = '$clean_activation_key'";
					$status_result = mysqli_query($db_connection, $status_query);

					if ($status_result) {

						if (mysqli_affected_rows($db_connection) > 0) {

						} else {

							$error = true;
							$error_messages[] = 'something went wrong';
						}



					} else {

						$error = true;
						$error_messages[] = 'Something went wrong';

					}


				} else {
					$error = true;
					$error_messages[] = 'Your account has already been activated';
				}


			} else {
				$error = true;
				$error_messages[] = 'Activation code in incorrect, please click the link in your email';
			}
		

		} else {
			$error = true;
			$error_messages[] = 'Activation code is incorrect, please check your email';
		}

} else {
	$error = true;
	$error_messages[] = 'Can not find activation code, please click the link in your email';
}

if ($error){ ?>
	<div style="color:red";>
		<h2>There were some problems</h2>

		<?php
		foreach($error_messages AS $error_message){
			echo $error_message . '<br>';
		}  ?>
	</div>
<?php } else { ?>
	<div style="color:blue";>
		<h2> Success! Your account has now been activated! </h2> <br>

		<a href="./login.php">login here</a>

	</div>
<?php }






// check the code exists (in query string)



// go into the database and check there is a matching code in database

// if yes, then is that account already activated

// build and run a query to activate (read: update) the account

// show a message to the user, we have succeeded, prompt them to log in next

// error messages

?>