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
		$password = $row['password'];
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$height = $row['height'];
		$weight = $row['weight'];
		$age = $row['age'];
		$gender = $row['gender'];
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

if(isset($_GET['height'])){
	$height = $_GET['height'];
}

if(isset($_GET['weight'])){
	$weight = $_GET['weight'];
}

if(isset($_GET['age'])){
	$age = $_GET['age'];
}

if(isset($_GET['gender'])){
	$gender = $_GET['gender'];
}

if(isset($_GET['confirmPass'])){
	$confirmPass = $_GET['confirmPass'];
}


if($confirmPass == $password){


echo $email;
echo $password;
echo $first_name;
echo $last_name;
echo $weight_type;
echo $height;
echo $weight;
echo $age;
echo $gender;


//SQL command to update the user's profile information in the database
$sql = "UPDATE `registry` SET email = '$email', first_name = '$first_name', last_name = '$last_name', height = '$height', weight = '$weight', age = '$age', gender = '$gender' WHERE email = '$email'";


$result = $conn->query($sql);
header("location:editProfile.php?login=true");

}else{
	header("location:editProfile.php?login=false");
}


?>
