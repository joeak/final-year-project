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

if(isset($_GET['ex_name'])){
	$ex_name = $_GET['ex_name'];
}

if(isset($_GET['weight_used'])){
	$weight_used = $_GET['weight_used'];
}

if(isset($_GET['weight_type'])){
	$weight_type = $_GET['weight_type'];
}

if(isset($_GET['rep_no'])){
	$rep_no = $_GET['rep_no'];
}



echo $ex_name;
echo $weight_used;
echo $weight_type;
echo $rep_no;

//SQL command to insert the user's workout information to the database
$sql = "INSERT INTO `user_input` (email, ex_name, weight_used, weight_type, rep_no) VALUES ('$email', '$ex_name', '$weight_used', '$weight_type', '$rep_no')";
$result = $conn->query($sql);
header("location:input.php?sent=true");


?>
