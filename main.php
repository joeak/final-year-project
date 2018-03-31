<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	//contributions by: Joseph, Jake
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
	<title>Homepage</title>
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
<!-- image texture as background sourced from the internet -->
<body id="mainBody" style="background: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/kindajean.png);">
	<nav class="navbar navbar-inverse">
		<div  id="outer" class="container-fluid">
			<div id="inner" class="navbar-header" >
				<button  type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="main">HOMEPAGE</a>
			</div>
			<br>

		</div>
		<!-- navigation bar -->
		<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="main"><span class="glyphicon glyphicon-home"></span> home</a></li>
				<li><a href="browse"><span class="glyphicon glyphicon-saved"></span> browse</a></li>
				<li><a href="input"><span class="glyphicon glyphicon-book"></span></span> input</a></li>
				<li><a href="track"><span class="glyphicon glyphicon-blackboard"></span> track</a></li>
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

<!-- introduction message, with user's first name -->
<h3 class="text-center"><b>
	<?php

        include "connect.php";
        $username = $_SESSION['email'];

			 	//SQL command to return the user's first name from the database
				$sql = "SELECT first_name, email FROM `registry` WHERE email = '$username'";

				$result = $conn->query($sql);

        if ($result->num_rows > 0) {
        //output data of each row returned
        	while($row = $result->fetch_assoc()) {
          	echo "Welcome back, ".$row['first_name']."...";

        		}
        }
      	$conn->close();
        ?>
</b></h3> <span class="h4">


		<br>
	<p class="text-center">
	Click <a href="editProfile"> here </a> to personalise your profile!
	</p>

	<hr>

	<h4 class="text-center"><b>Since joining, you have...</b></h4>

	<!-- Generates the statistic for number of inputs by any given user -->
	<dd>
	<span class="glyphicon glyphicon-stats"></span> - Made <?php
			include "connect.php";
            $username = $_SESSION['email'];

						//SQL command to return the number of rows in the input table by the logged in user
            $sql = "SELECT COUNT(*) as input_count FROM `user_input` WHERE email = '$username'";

						$result = $conn->query($sql);

            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {

									echo $row['input_count'];

                                        }
                                    }

								  $conn->close();

	?> exercise inputs
	</dd>


	<dd>
	<span class="glyphicon glyphicon-thumbs-up"></span> - Accomplished <?php
			include "connect.php";
            $username = $_SESSION['email'];

						//SQL command to return the row with the maximum weight entered by the user
						$sql = "SELECT MAX(weight_used) AS max_weight, ex_name FROM `user_input` WHERE email = '$username'";

						$result = $conn->query($sql);


            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {

									echo $row['max_weight'] . "kg in " . $row['ex_name'];

                                        }
                                    }


								  $conn->close();

	?>
	</dd>


	<hr>
		<!-- Button to take the user to a graph of their latest input exercise -->
		<div class="col-md-4 col-md-offset-4 text-center">
			<a href="postTrack.php?ex_name=<?php

			include "connect.php";
			$username = $_SESSION['email'];

			//SQL command to select the name of the latest input exercise by the logged in user
			$sql = "SELECT * FROM `user_input` WHERE '$username' = email ORDER BY input_date DESC LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {

					echo $row['ex_name'];

				}
			}
			$conn->close();
			?>&weighttype=kg"><button type='button' name="track" class="btn btn-info btn-block" value="track">VIEW LATEST GRAPH</button></a>
		</div>


	<hr>


	<p class="text-center">
	<b> Please read the <a href="healthSafety"> health & safety </a> information page <b>
	</p>


	</div>

</body>
</html>
