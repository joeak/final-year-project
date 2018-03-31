<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	session_destroy();
}else{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Refresh" content="5; url=index.php">
	<title>logout</title>
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

</head>
<body style="background: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/kindajean.png);">
	<div class="container">
	<div class="jumbotron text-center">
	<h1>logging out..</h1>
	<hr>
	<p>you will be redirected shortly!</p>

	<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				if you are not redirected automatically, press on the button to return to the login page
				<br>
				<br>
				<a class="btn btn-danger btn-block" href="index.php" role="button">login page</a>
			</div>
		</div>

	</div>
	</div>

</body>
</html>
