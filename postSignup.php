<?php
include "connect.php";

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$username = $_SESSION['email'];
}else{
	header("location:index.php");
}



$sql = "SELECT email FROM `registry` WHERE email = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$email = $row['email'];
	}
}

//GET method being used to assign variables from the fields to PHP variables in the next page

if(isset($_GET['first_name'])){
	$first_name = $_GET['first_name'];
}

if(isset($_GET['last_name'])){
	$last_name = $_GET['last_name'];
}

if(isset($_GET['email'])){
	$email = $_GET['email'];
}

if(isset($_GET['password'])){
	$password = $_GET['password'];
}

echo $first_name;
echo $last_name;
echo $email;
echo $password;

//SQL command to create a new account for the user in the database
$sql = "INSERT INTO `registry` (email, password, first_name, last_name) VALUES ('$email', '$password', '$first_name', '$last_name')";
$result = $conn->query($sql);
header("location:signup.php?sent=true");


?>
