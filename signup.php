<?php
session_start();

if(isset($_GET['sent'])){
	$sent = $_GET['sent'];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>sign up</title>
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

	<!-- function to handle pop-ups depending on situation -->
	<script>
	$(document).ready(function(){
		var x = '<?php if(isset($sent)){echo $sent;}?>';

		if(x == 'true'){
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

		<!-- Hidden until submission is completed and request sent -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">You are now signed up!</h4>
							</div>
							<div class="modal-body">
								<p>Please visit the login page to log in!</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


	<div id='main-content' class="container-fluid">

		<form class="form-horizontal" action="postSignup.php" method="get">
        <fieldset>
          <h4 class="text-center">sign up today, for free!</h4> <span class="h4">

		  <hr>
					<!-- field to hold user's first name -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="first_name">first name<span style="font-size:1.25em;color:red;">*</span></label>
            <div class="col-md-4">
              <input id="first_name" name="first_name" type="text" value="" class="form-control input-md" required>
              </select>
            </div>
          </div>

			<!-- field to hold user's last name -->
		  <div class="form-group">
            <label class="col-md-4 control-label" for="last_name">last name<span style="font-size:1.25em;color:red;">*</span></label>
            <div class="col-md-4">
              <input id="last_name" name="last_name" type="text" value="" class="form-control input-md" required>
              </select>
            </div>
          </div>

			<!-- field to hold user's email addresss -->
		  <div class="form-group">
            <label class="col-md-4 control-label" for="email">email address<span style="font-size:1.25em;color:red;">*</span></label>
            <div class="col-md-4">
              <input id="email" name="email" type="email" value="" class="form-control input-md" required>
              </select>
            </div>
          </div>

					<!-- field to hold user's password -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="password">password<span style="font-size:1.25em;color:red;">*</span></label>
            <div class="col-md-4">
              <input id="password" name="password" type="password" value="" class="form-control input-md" required>
            </div>
          </div>

     <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4 col-md-offset-4 text-center">
        <input class="btn btn-success btn-block" type="submit" value="SIGN UP">
		<br>

		<!-- link to login page for user's with profiles -->
		<a href="index" target="_self"><i>already have an account? log in here</i> </a>
      </div>
    </div>

			</form>
		</div>
	</div>
</div>

<br><br><br>
</body>
</html>
