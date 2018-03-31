<?php
include "connect.php";

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$username = $_SESSION['email'];
}else{
	header("location:index.php");
}



$sql = "SELECT * FROM `registry` WHERE email = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$email = $row['email'];
		$first_name = $row['first_name'];
	}
}

//GET method being used to assign variables from the fields to PHP variables in the next page

if(isset($_GET['ex_name'])){
	$ex_name = $_GET['ex_name'];
}

if(isset($_GET['weighttype'])){
	$weighttype = $_GET['weighttype'];
}

$adjustedWeight = 1;
if ($weighttype == 'lbs'){

	$adjustedWeight = 2.2;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Track</title>
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

<!-- google open source graph -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- function to handle the data stream from the database to the graph -->
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'X');
      data.addColumn('number', '<?php echo $ex_name ?>');

	  var donutRangeSlider = new google.visualization.ControlWrapper({
		'controlType': 'NumberRangeFilter',
		'containerId': 'filter_div',
		'options': {
		  'filterColumnLabel': 'Donuts eaten'
		}
	  });


	  var programmaticSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'programmatic_control_div',
          'options': {
            'filterColumnLabel': 'date',
            'ui': {'labelStacking': 'vertical'}
          }
        });


	data.addRows([


  <?php

	include "connect.php";
	$username = $_SESSION['email'];
	$sql = "SELECT * FROM `user_input` WHERE '$username' = email AND '$ex_name' = ex_name ORDER BY input_time";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {

			$inputDate = $row['input_time'];

			$input_day = substr($inputDate, -11, 2); // returns day
			$input_month = substr($inputDate, -14, 2); // returns month
			$input_year = substr($inputDate, -19,4); //returns year

			echo "[new Date(" . $input_year . ", " . $input_month . ", " . $input_day . "), " . ($row['weight_used']*$adjustedWeight) . "], ";
		}
	}
	$conn->close();
	?>
      ]);

      var options = {
        hAxis: {
          title: 'time (quarter)',
		  viewWindow:{
		  //change min to scale between weeks/months/etc

		  //past week
		  //min: new Date(<?php echo ($input_year).",".(($input_month)).",".(($input_day-7))?>),

		  //past month
		  //min: new Date(<?php echo ($input_year).",".(($input_month-1)%12).",".(($input_day-7)%30)?>),

		  //past 3 months
		  //min: new Date(<?php echo ($input_year).",".(($input_month-3)%12).",".(($input_day-7))?>),


		  min: new Date(<?php echo ($input_year).",".(($input_month-3)%12).",".(($input_day-7))?>),
		  max: new Date(<?php echo $input_year.",".($input_month).",".$input_day?>)
          },
		  viewWindowMode: 'explicit'

		}
		 ,
        vAxis: {
          title: '<?php
		  $lbs = "lbs";
		  if ($weighttype == 'lbs'){

				echo "weight (lbs)";

			}else

				echo "weight (kg)";

	?>'
        }

      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);

	  changeRange = function() {
          programmaticSlider.setState({'lowValue': "2016,10,04", 'highValue': "2016,11,04"});
          programmaticSlider.draw();
        };
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
				<a class="navbar-brand" href="main">TRACK</a>
			</div>
			<br>

		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="main.php"><span class="glyphicon glyphicon-home"></span> home</a></li>
				<li><a href="browse.php"><span class="glyphicon glyphicon-saved"></span> browse</a></li>
				<li><a href="input.php"><span class="glyphicon glyphicon-book"></span></span> input</a></li>
				<li class="active"><a href="track.php"><span class="glyphicon glyphicon-blackboard"></span> track</a></li>
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
	<h4 class="text-center"><b>View your quarters results <?php

		  if ($weighttype == 'lbs'){

				echo "(lbs)";

			}else

				echo "(kg)";

	?></b></h4> <span class="h4">

  <hr>

	<!-- title with personalised message -->
	<h4 class="text-center"><b><?php echo $first_name ?>'s progress on <?php echo $ex_name ?></b></h4> <span class="h4">


		<!-- buttons to change between quarterly, monthy and weekly views of the graph -->
		<div class="btn-group btn-group-justified">
			<a href='postTrackQuarter.php?ex_name=<?php echo $ex_name ?>&weighttype=<?php echo $weighttype ?>' type='button' name='Quarter' value='Quarter' class='btn btn-primary'>Quarter</a>
			<a href='postTrack.php?ex_name=<?php echo $ex_name ?>&weighttype=<?php echo $weighttype ?>' type='button' name='Month' value='Month' class='btn btn-primary'>Month</a>
			<a href='postTrackWeek.php?ex_name=<?php echo $ex_name ?>&weighttype=<?php echo $weighttype ?>' type='button' name='Week' value='Week' class='btn btn-primary'>Week</a>
		</div>

		<br>

		<!-- div to hold the graph -->
		<div id="chart_div" ></div>

		<br>

		<!-- buttons to change between kilograms and pounds as the weight type -->
		<div class="btn-group btn-group-justified">
			<a href="postTrackQuarter.php?ex_name=<?php echo $ex_name ?>&weighttype=kg" type='button' name="kg" class='btn btn-primary' value="track">Change to kg</a>
			<a href="postTrackQuarter.php?ex_name=<?php echo $ex_name ?>&weighttype=lbs"  type='button' name="lbs" class='btn btn-primary' value="track">Change to lbs</a>
			</div>

		<br>

		<!-- button to track another exercise -->
		<div class="col-md-4 col-md-offset-4 text-center">
			<a href="track.php"><button type='button' name="track" class="btn btn-info btn-block" value="track">Track another exercise</button></a>
		</div>

		<hr>

		<!-- displays the 5 last input records for the selected exercise -->
		<h4 class="text-center"><b>Last 5 records for <?php echo $ex_name?>:</b></h4> <span class="h4">
		<div class="col-md-4 col-md-offset-4 text-center"><h5 class="text-center">
			<?php
			include "connect.php";
			$username = $_SESSION['email'];

			//SQL command to return the 5 most recent inputs for the selected exercise -->
			$sql = "SELECT * FROM `user_input` WHERE '$username' = email AND '$ex_name' = ex_name ORDER BY input_time DESC LIMIT 5";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {

					$inputDate = $row['input_time'];

					$input_day = substr($inputDate, -11, 2); // returns day
					$input_month = substr($inputDate, -14, 2); // returns month
					$input_year = substr($inputDate, -19,4); //returns year


					echo "Weight: " . ($row['weight_used']*$adjustedWeight) . $weighttype . " - Reps: " . $row['rep_no'] . " - Date: " . $row['input_time'] . "<br>";

				}
			}
			$conn->close();
			?>
		</h5> <span class="h4"></div>

	</div>

	<br>

</body>
</html>
