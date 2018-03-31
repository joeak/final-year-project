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
	<title>Edit Profile</title>
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

<!-- function to handle various pop-ups depending on situation -->
<script>
$(document).ready(function(){
	var x = '<?php if(isset($login)){echo $login;}?>';

	if(x == 'false'){
		$('#myModal').modal('show');
	}

	if(x == 'true'){
		$('#myModalTrue').modal('show');
	}
});
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
				<a class="navbar-brand" href="main">EDIT PROFILE</a>
			</div>
			<br>

		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="main.php"><span class="glyphicon glyphicon-home"></span> home</a></li>
				<li><a href="browse.php"><span class="glyphicon glyphicon-saved"></span> browse</a></li>
				<li><a href="input.php"><span class="glyphicon glyphicon-book"></span></span> input</a></li>
				<li><a href="track.php"><span class="glyphicon glyphicon-blackboard"></span> track</a></li>
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

			<!-- Hidden until password is INCORRECT -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Incorrect Password</h4>
							</div>
							<div class="modal-body">
								<p>The password you entered is incorrect!</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


			<!-- Hidden until password is CORRECT -->
				<div class="modal fade" id="myModalTrue" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Profile saved</h4>
							</div>
							<div class="modal-body">
								<p>You have successfully changed your profile information!</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


	<div id='main-content' class="container-fluid">

	<!-- form to display all current profile information from the database using SQL commands with PHP -->
	<form class="form-horizontal" action="postEditProfile.php" method="get">
  <fieldset>

	<!-- first name from database -->
	<label class="col-md-3 control-label" for="first_name">first name: </label>
		<div class="col-md-4">
            <input placeholder="" id="first_name" name="first_name" type="text" value="<?php
								include "connect.php";
								$username = $_SESSION['email'];
								$sql = "SELECT * FROM `registry` WHERE email = '$email'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo $row['first_name'];
									}
								}
								$conn->close();
									?>" class="form-control input-md" ></input>
            </div>

		</br>
	<!-- last name from database -->
	<label class="col-md-3 control-label" for="last_name">last name: </label>
		<div class="col-md-4">
            <input placeholder="" id="last_name" name="last_name" type="text" value="<?php
								include "connect.php";
								$username = $_SESSION['email'];
								$sql = "SELECT * FROM `registry` WHERE email = '$email'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo $row['last_name'];
									}
								}
								$conn->close();
									?>" class="form-control input-md" ></input>
            </div>

		</br>

	<!-- email from database -->
	<label class="col-md-3 control-label" for="email">email: </label>
		<div class="col-md-4">
            <input placeholder="" id="email" name="email" type="text" value="<?php
								include "connect.php";
								$username = $_SESSION['email'];
								$sql = "SELECT * FROM `registry` WHERE email = '$email'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo $row['email'];
									}
								}
								$conn->close();
									?>" class="form-control input-md" ></input>
            </div>

		</br>

	<!-- height from database -->
	<label class="col-md-3 control-label" for="height">height: </label>
		<div class="col-md-4">
            <input placeholder="" id="height" name="height" type="number" value="<?php
								include "connect.php";
								$username = $_SESSION['email'];
								$sql = "SELECT * FROM `registry` WHERE email = '$email'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo $row['height'];
									}
								}
								$conn->close();
									?>" class="form-control input-md" ></input>
            </div>

		</br>

	<!-- weight from database -->
	<label class="col-md-3 control-label" for="weight">weight: </label>
		<div class="col-md-4">
            <input placeholder="" id="weight" name="weight" type="number" value="<?php
								include "connect.php";
								$username = $_SESSION['email'];
								$sql = "SELECT * FROM `registry` WHERE email = '$email'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo $row['weight'];
									}
								}
								$conn->close();
									?>" class="form-control input-md" ></input>
            </div>

		</br>

	<!-- age from database -->
	<label class="col-md-3 control-label" for="age">age: </label>
		<div class="col-md-4">
            <input placeholder="" id="age" name="age" type="number" value="<?php
								include "connect.php";
								$username = $_SESSION['email'];
								$sql = "SELECT * FROM `registry` WHERE email = '$email'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo $row['age'];
									}
								}
								$conn->close();
									?>" class="form-control input-md" ></input>
            </div>

		</br>

	<!-- gender -->
	<label class="col-md-3 control-label" for="gender">gender: </label>
		<div class="col-md-4">
			<input type='radio' name='gender' value='male' checked> male <input type='radio' name='gender' value='female'> female </br>
		   </div>

		<br>

		<label class="col-md-3 control-label" for="confirmPass"><b>confirm password:  <span style="font-size:1.25em;color:red;">*</span></b></label>
		<div class="col-md-4">
            <input placeholder="" id="confirmPass" name="confirmPass" type="password" value="" class="form-control input-md" required></input>
            </div>


		<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4 col-md-offset-4 text-center">
				<input class="btn btn-success btn-block" type="submit" value="SAVE">
			</div>

			</br>

</form>

</div>

</body>
</html>
