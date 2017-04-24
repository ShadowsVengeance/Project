<?php

// Connecting to the MySQL database
$user = 'whelanb1';
$password = '25ycQGFf';

$database = new PDO('mysql:host=localhost;dbname=db_spring17_whelanb1', $user, $password);

// Start the session
session_start();

function autoLoader($class) {
    include 'classes/class.' . $class . '.php';
}
spl_autoload_register('autoLoader');

$current_url = basename($_SERVER['REQUEST_URI']);



// if customerID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["customerID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION["customerID"])) {
	$customer = new customer($_SESSION['customerID'], $database);
}


