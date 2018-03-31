<?php
$servername = "sci-project.lboro.ac.uk";
$username = "coja2";
$password = "0x1W8ON4Dx";
$dbname = "coja2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>