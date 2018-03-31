<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	include "connect.php";
	$email = $_SESSION['email'];
	$sql = "SELECT email FROM `registry` WHERE email = '$email'";
	$result = $conn->query($sql);
	//assigns the email of the currently logged in user to a variable
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$emailval = $row['email'];
		}
	}
	 $conn->close();

}
else{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link href="css/normalize.css" rel="stylesheet">
	<link id="default" type="text/css" href="css/bootstrap.css"
			rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/
			jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

	<!-- function to change language using google translate -->
	<script type="text/javascript">
		function googleTranslateElementInit() {

			new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');

		}
	</script>


	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<!-- function to change css to high contrast -->
	<script>
	function cssToggle(){

		var x=document.getElementById('cssToggle');
		if(x.checked){
			swapSheet('css/altstyle.css');
			document.body.style = "black";

		}
		else{
			swapSheet('css/bootstrap.css');
			document.body.style = "background: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/kindajean.png);";
		}
	}
	</script>

	<!-- function to actually make the css change, used in conjunction with function cssToggle(); -->
	<script>
	function swapSheet(x){
		document.getElementById('default').setAttribute('href', x)
	}
	</script>

	<!-- incomplete function to increase font size, currently only working with nav bar -->
	<script>
	function zoomText(){
		var x = document.getElementById('zoomText');
		if(x.checked){

			document.body.style.fontSize = '200%';
		}
		else{

			document.body.style.fontSize = 'initial';
		}
	}
	</script>

</head>
<body  style="background: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/kindajean.png);">
	<nav class="navbar navbar-inverse">
		<div  id="outer" class="container-fluid">
			<div id="inner" class="navbar-header" >
				<button  ype="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="main">PROFILE</a>
			</div>
			<br>

		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="main"><span class="glyphicon glyphicon-home"></span> home</a></li>
				<li><a href="browse"><span class="glyphicon glyphicon-saved"></span> browse</a></li>
				<li><a href="input"><span class="glyphicon glyphicon-book"></span></span> input</a></li>
				<li><a href="track"><span class="glyphicon glyphicon-blackboard"></span> track</a></li>
				<li class="active"><a href="profile"><span class="glyphicon glyphicon-user"></span> profile</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span> settings
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="logout"> sign out</a></li>
					<li><a><label><input type='checkbox' id='cssToggle' onchange='cssToggle();' style="width:15px;height: 15px;"/> high contrast</label></a></li>
					<li><a><label style='font-size:2em;'><input type='checkbox' id='zoomText' onchange='zoomText();' style="width:15px; height:15px;"/> font assist</label></a></li>
					</ul>
				</li>
				<li><a id="google_translate_element"></a></li>
				</ul>
			</div>
	</nav>
	<div id='main-content' class="container-fluid">

	<form class="form-horizontal" action="postInput.php" method="get">
  <fieldset>

		<h4 class="text-center"><b>Manage your account</b></h4> <span class="h4">

			  <hr>

				<label class="col-md-3 control-label" for="ex_name">name: </label>
					<div class="col-md-8">
						<p>
											<?php
											include "connect.php";
											$username = $_SESSION['email'];

											//SQL command to return profile information from the registry in the database
											$sql = "SELECT * FROM `registry` WHERE email = '$email'";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													echo $row['first_name']." ".$row['last_name'];
												}
											}
											$conn->close();
											?>
							</p>
						</div>

				<br>

				<!-- Displays the email address of the currently logged in user -->
				<label class="col-md-3 control-label" for="ex_name">email: </label>
					<div class="col-md-8">
						<p>
							<?php
							include "connect.php";
							$username = $_SESSION['email'];

							//SQL command to return the email address of the currently logged in user
							$sql = "SELECT * FROM `registry` WHERE email = '$email'";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
							// output data of each row
								while($row = $result->fetch_assoc()) {
									echo $row['email'];
								}
							}
							$conn->close();
							?>
						</p>
					</div>


			<br>
			</br>

		<div class="col-md-4 col-md-offset-4 text-center">
			<a href="editProfile.php"><button type='button' name="edit_profile" class="btn btn-success btn-block" value="edit_profile">EDIT PROFILE</button></a>
		</div>

		<br>

		<div class="col-md-4 col-md-offset-4 text-center">
			<a href="changePassword.php"><button type='button' name="change_pass" class="btn btn-info btn-block" value="change_pass">CHANGE PASSWORD</button></a>
		</div>

</form>

</div>

</body>
</html>
