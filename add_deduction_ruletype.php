<?php

date_default_timezone_set("Asia/Bangkok");

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-alloworigin,
access-control-allow-methods, access-control-allow-headers');

$servername = "localhost";
$username = "rachai_check";
$password = "Check@CSW108";
$dbname = "rachai_check";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = new DateTime();


//$username = $_REQUEST['username'];
//$password = $_REQUEST['password'];

$content = file_get_contents("php://input");

$jsonArray = json_decode($content,true);



$ruletype_name = $jsonArray['ruletype_name'];
$ruletype_score = $jsonArray['ruletype_score'];


$sql_insert = "INSERT INTO tb_ruletypes
VALUES (null , '".$ruletype_name."', '".$ruletype_score."', 1 , '".$date->format('Y-m-d H:i:s')."');";
$result = mysqli_query($conn, $sql_insert);









