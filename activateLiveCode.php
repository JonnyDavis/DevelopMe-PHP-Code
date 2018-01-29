<?php

$db_server = "localhost";
$db_username = "root";
$db_password = "root";
$db_database = "scotchbox";

$db_connection = new mysqli($db_server, $db_username, $db_password, $db_database);

if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);

}







?>