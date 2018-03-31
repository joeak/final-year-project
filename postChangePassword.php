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
	}
}

//GET method being used to assign variables from the fields to PHP variables in the next page

if(isset($_GET['currentPass'])){
	$currentPass = $_GET['currentPass'];
}

if(isset($_GET['newPass'])){
	$newPass = $_GET['newPass'];
}

if(isset($_GET['confirmPass'])){
	$confirmPass = $_GET['confirmPass'];
}

//not matching new passwords
if($newPass != $confirmPass){

header("location:changePassword.php?login=false");

}

//incorrect original password
if($currentPass != $password){

header("location:changePassword.php?login=false2");

}

//new password is already current password
if(($currentPass == $newPass) and ($newPass == $confirmPass)){

header("location:changePassword.php?login=false3");

}


if(($currentPass == $password) and ($newPass == $confirmPass) and ($currentPass != $newPass)){


echo $newPass;


//SQL command to update the users password in the database
$sql = "UPDATE `registry` SET password = '$newPass' WHERE email = '$email'";


$result = $conn->query($sql);
header("location:changePassword.php?login=true");

}





?>
