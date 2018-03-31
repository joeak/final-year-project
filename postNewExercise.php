<?php
include "connect.php";

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$username = $_SESSION['email'];
}else{
	header("location:index.php");
}



$sql = "SELECT * FROM `registry` WHERE email = '$username'";
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

if(isset($_GET['ex_category'])){
	$ex_category = $_GET['ex_category'];
}

if(isset($_GET['ex_desc'])){
	$ex_desc = $_GET['ex_desc'];
}

echo $ex_name;
echo $ex_category;
echo $ex_desc;

//SQL command insert the new exercise into the database
$sql = "INSERT INTO `exercises` (ex_name, ex_category, ex_desc) VALUES ('$ex_name', '$ex_category', '$ex_desc')";


$result = $conn->query($sql);
header("location:newExercise.php?login=true");




?>
