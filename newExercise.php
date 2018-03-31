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
	<title>New Exercise</title>
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

<!-- functions to handle the pop-ups -->
<script>
	$(document).ready(function(){
		var x = '<?php if(isset($sent)){echo $sent;}?>';

		if(x == 'true'){
			$('#myModal').modal('show');
		}
	});
</script>

<script>
$(document).ready(function(){
	var x = '<?php if(isset($login)){echo $login;}?>';

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
				<a class="navbar-brand" href="main">NEW EXERCISE</a>
			</div>
			<br>

		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="main.php"><span class="glyphicon glyphicon-home"></span> home</a></li>
				<li><a href="browse.php"><span class="glyphicon glyphicon-saved"></span> browse</a></li>
				<li class="active"><a href="input.php"><span class="glyphicon glyphicon-book"></span></span> input</a></li>
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

			<!-- Hidden until exercise is added -->
				<div class="modal fade" id="myModalTrue" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Exercise added</h4>
							</div>
							<div class="modal-body">
								<p>You have successfully added a new exercise!</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


	<div id='main-content' class="container-fluid">


<!-- Form for adding a new exercise to the database -->
<form class="form-horizontal" action="postNewExercise.php" method="get">
<fieldset>
	<!-- Exercise name -->
	<label class="col-md-3 control-label" for="ex_name">exercise name<span style="font-size:1.25em;color:red;">*</span>: </label>
		<div class="col-md-4">
            <input placeholder="" id="ex_name" name="ex_name" type="text" value="" class="form-control input-md" required></input>
            </div>
		</br>
	<!-- Exercise category -->
	<label class="col-md-3 control-label" for="ex_category">exercise category: </label>
		<div class="col-md-4">
            <input placeholder="" id="ex_category" name="ex_category" type="text" value="" class="form-control input-md" ></input>
            </div>
		</br>
	<!-- Exercise description -->
	<label class="col-md-3 control-label" for="ex_desc">exercise description: </label>
		<div class="col-md-4">
			<textarea placeholder="" id="ex_desc" name="ex_desc" value="" class="form-control" ></textarea>
            </div>
		</br>

		<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4 col-md-offset-4 text-center">
				<input class="btn btn-success btn-block" type="submit" value="ADD EXERCISE">
			</div>
			</br>

		<!-- button to go back to the previous page -->
		<div class="col-md-4 col-md-offset-4 text-center">
			<a href="input.php"><button type='button' name="back" class="btn btn-info btn-block" value="BACK">BACK</button></a>
		</div>
			</br>

</form>


</div>

</body>
</html>
