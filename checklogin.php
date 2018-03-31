<?php
include "connect.php";

session_start();

$myusername=$_POST['email']; 
$mypassword=$_POST['password'];

$sql="SELECT * FROM `registry` WHERE `email`='$myusername' and `password`='$mypassword'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $_SESSION['email'] = $myusername;
	$_SESSION['password'] = $mypassword;
	$_SESSION['loggedin'] = true;
	header("location:main");
} else {
    header("location:index.php?login=false");
}
$conn->close();
?>