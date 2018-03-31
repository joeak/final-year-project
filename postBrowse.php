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


if(isset($_GET['ex_name'])){
	$ex_name = $_GET['ex_name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Browse</title>
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

<script>
//function to show/hide the information div
function dispExercise(){

		var div = document.getElementById('test');
		if (div.style.display !== 'none') {
			div.style.display = 'none';
		}
		else {
			div.style.display = 'block';
		}


		var div2 = document.getElementById('before_search');
		if (div2.style.display == 'block') {
			div2.style.display = 'none';
		}
		else {
			div2.style.display = 'block';
		}

		var div3 = document.getElementById('test2');
		if (div3.style.display !== 'none') {
			div3.style.display = 'none';
		}
		else {
			div3.style.display = 'block';
		}


		var div4 = document.getElementById('ex_name');
		if (div4.style.display !== 'none') {
			div4.style.display = 'none';
		}
		else {
			div4.style.display = 'block';
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
				<a class="navbar-brand" href="main">BROWSE</a>
			</div>
			<br>

		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="main.php"><span class="glyphicon glyphicon-home"></span> home</a></li>
				<li class="active"><a href="browse.php"><span class="glyphicon glyphicon-saved"></span> browse</a></li>
				<li><a href="input.php"><span class="glyphicon glyphicon-book"></span></span> input</a></li>
				<li><a href="track.php"><span class="glyphicon glyphicon-blackboard"></span> track</a></li>
				<li><a href="profile"><span class="glyphicon glyphicon-user"></span> profile</a></li>
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
  <fieldset>

	<!-- error handling -->
	<h4 class="text-center">
		  <?php

					if($ex_name == 'select an option...'){

						echo $autocomplete;
					}else{

						echo $ex_name;
					}

					?>
		  </h4> <span class="h4">

		  <hr>

		 <!-- holds the exercise description from the database -->
		 <div name="before_search" id="before_search" style="display:block;">

		  <label class="col-md-3 control-label" for="ex_search">exercise description:</label>

				<div class="col-md-4">
					<form>
						<p>
						<?php
						include "connect.php";
						$username = $_SESSION['email'];

						//SQL command to return exercise information for the selected exercise
						$sql = "SELECT * FROM `exercises` WHERE '$ex_name' = ex_name";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo $row['ex_desc'];
								}
							}
						$conn->close();
						?>
						</p>
					</form>
				</div>


		</br>

		<label class="col-md-3 control-label" for="ex_search">video tutorial:</label>

				<br>

		     <!-- holds the exercise video from the database -->
				<div align="center" class="embed-responsive embed-responsive-16by9">
					<video autoplay loop class="embed-responsive-item">
						<source src="
						<?php

						include "connect.php";
						$username = $_SESSION['email'];

						//SQL command to return exercise information for the selected exercise
						$sql = "SELECT * FROM `exercises` WHERE '$ex_name' = ex_name";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo $row['ex_video'];
								}
							}
						$conn->close();


						?>
						" type="video/mp4">
					</video>
				</div>

		<h6 class="text-center"><i>video source: bodybuilding.com</i></h4><span class="h6">


		<label class="col-md-4 control-label" for="go_button"></label>
			<div class="col-md-4 col-md-offset-4 text-center">
				<input class="btn btn-success btn-block" onClick="window.location.href='/input.php'" type="submit" value="INPUT AN EXERCISE!">
			</div>


		<!-- button to go to the previous page -->
		<label class="col-md-4 control-label" for="go_button"></label>
			<div class="col-md-4 col-md-offset-4 text-center">
				<input class="btn btn-info btn-block" onClick="window.location.href='/browse.php'" type="submit" value="GO BACK">
			</div>

		</div>

	</div>

</body>
</html>
