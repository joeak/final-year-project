<?php
if(isset($_GET['login'])){
	$login = $_GET['login'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login</title>
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

<!-- function to handle pop-ups depending on situation -->
	<script>
	$(document).ready(function(){
		var x = '<?php if(isset($login)){echo $login;}?>';

		if(x == 'false'){
			$('#myModal').modal('show');
		}
	});
	</script>

</head>
<body style="background: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/kindajean.png);">
	<div class="container">
	<div class="jumbotron">
	<h1 class="text-center">Strength Tracker</h1>
		<hr>

		<!-- Hidden until login is incorrect -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Incorrect Login</h4>
							</div>
							<div class="modal-body">
								<p>The username and/or password you entered is incorrect!</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


		<div id='main-content' class="container-fluid">

		<!-- form to hold email and password of user -->
		<form name="form1" method="post" action="checklogin.php">
		<div class="row">
			<div class="col-md-12">
				<div class="input-group input-group-lg">
					<span class="input-group-addon" id="sizing-addon1">email</span>
					<input type="text" class="form-control" aria-describedby="sizing-addon1" name="email" id="email" value="">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="input-group input-group-lg">
					<span class="input-group-addon" id="sizing-addon1">password</span>
					<input type="password" class="form-control" aria-describedby="sizing-addon1" name="password" id="password" value="">
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 text-center">
				<input class="btn btn-primary btn-block" type="submit" name="Submit" id="loginButton" value="LOGIN">
				<br>
				<a href="signup" target="_self"><i>don't have an account? sign up here</i> </a>
			</div>
		</div>
		</form>

		</div>

		</div>
		</div>

<br><br><br>
</body>
</html>
