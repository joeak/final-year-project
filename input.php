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
	<title>Input</title>
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

<!-- function to handle pop-ups depending on situation -->
<script>
	$(document).ready(function(){
		var x = '<?php if(isset($sent)){echo $sent;}?>';

		if(x == 'true'){
			$('#myModal').modal('show');
		}
	});
</script>

<!-- functions to increment and decrement the rep value in the form -->
<script>
function incrementValue()
{
    var value = parseInt(document.getElementById('rep_no').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('rep_no').value = value;
}
</script>

<script>
function decrementValue()
{
    var value = parseInt(document.getElementById('rep_no').value, 10);
    value = isNaN(value) ? 0 : value;

	if(value>0){
		value = value - 1;
	}

    document.getElementById('rep_no').value = value;
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
				<a class="navbar-brand" href="main">INPUT</a>
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

	<!-- Hidden until submission is completed and request sent -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Progress added!</h4>
							</div>
							<div class="modal-body">
								<p>Please visit the progress page to view results!</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

	<div id='main-content' class="container-fluid">

	<form class="form-horizontal" action="postInput.php" method="get">
  <fieldset>

	<h4 class="text-center"><b>Input your progress</b></h4> <span class="h4">

	<hr>
				<!-- dropdown list of all exercises in the database -->
				<label class="col-md-3 control-label" for="ex_name">find exercise: <span style="font-size:1.25em;color:red;">*</span></label>
					<div class="col-md-8">
						<select id="ex_name" name="ex_name" class="form-control" required>
						<option value="" disabled selected>select an option...</option>
											<?php
											include "connect.php";
											$username = $_SESSION['email'];

											//SQL command to return all exercise names
											$sql = "SELECT ex_name FROM `exercises`";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													echo "<option value='" . $row['ex_name'] . "'>".$row['ex_name']."</option>";
												}
											}
											$conn->close();
											?>
							</select>
					</div>

				<br>

				<!-- input field for weight used, with radio buttons -->
				<label class="col-md-3 control-label" for="weight_used">weight used: <span style="font-size:1.25em;color:red;">*</span></label>
					<div class="col-md-4">
              <input placeholder="enter a weight..." id="weight_used" name="weight_used" type="number" pattern="\d*" value="" class="form-control input-md" required></input>
            </div>
					<div class="col-md-8">

						<?php
											if(isset($weight_type)){
												if($weight_type == 'kg'){
													echo "<input checked type='radio' name='weight_type' value='kg' checked> kg <input type='radio' name='weight_type' value='lbs'> lbs </br>";
												}
												else if($weight_type == 'lbs'){
													echo "<input type='radio' name='weight_type' value='kg' checked> kg <input checked type='radio' name='weight_type' value='lbs'> lbs </br>";
												}
												else{
													echo "<input type='radio' name='weight_type' value='kg' checked> kg <input type='radio' name='weight_type' value='lbs'> lbs </br>";
												}

											}
											else{
												echo "<input type='radio' name='weight_type' value='kg' checked> kg <input type='radio' name='weight_type' value='lbs'> lbs </br>";
											}
										?>

						</div>


		</br>

		<!-- number of reps field, with increment and decrement buttons -->
		<label class="col-md-3 control-label" for="rep_no">number of reps: <span style="font-size:1.25em;color:red;">*</span></label>

			<div class="input-group">

				  <span class="input-group-btn">
					  <button type="button" onclick="decrementValue()" class="btn btn-default btn-number" data-type="minus" data-field="quant">
						  <span class="glyphicon glyphicon-minus"></span>
					  </button>
				  </span>

				  <input type="number" id="rep_no" name="rep_no" class="form-control input-number" value="1" min="0" max="10" readonly="readonly">

				  <span class="input-group-btn">
					  <button type="button" onclick="incrementValue()" class="btn btn-default btn-number" data-type="plus" data-field="quant">
						  <span class="glyphicon glyphicon-plus"></span>
					  </button>
				  </span>

			  </div>

		<!-- submit button -->
		<label class="col-md-4 control-label" for="submit"></label>
			<div class="col-md-4 col-md-offset-4 text-center">
				<input class="btn btn-success btn-block" type="submit" value="SUBMIT">
			</div>

			</br>

		<!-- clear button to reload the page with empty fields -->
		<div class="col-md-4 col-md-offset-4 text-center">
			<a href="input.php"><button type='button' name="clear" class="btn btn-info btn-block" value="CLEAR">CLEAR</button></a>
		</div>

</form>

			<br>
			<br>
			<br>

	<p class="text-center">
	Exercise not here? Click <a href="newExercise"> here </a> to add a new exercise!
	</p>


	</div>

</body>
</html>
