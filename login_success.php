<?php
session_start();
if(!session_is_registered(username)){
	$_SESSION['loggedin'] = true;
	header("location:main.php");
}
?>

<html>
<body>
Login Successful
</body>
</html>