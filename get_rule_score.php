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


//$username = $_REQUEST['username'];
//$password = $_REQUEST['password'];

$content = file_get_contents("php://input");

$jsonArray = json_decode($content,true);

$ruleTypeID = $jsonArray['ruleTypeID'];

$sql_ruletype = "SELECT *  FROM tb_ruletypes WHERE tb_ruletype_id = '".$ruleTypeID."'";
$result_ruletype = mysqli_query($conn, $sql_ruletype);
$row_ruletype = mysqli_fetch_assoc($result_ruletype);

$date_day = array("score" => $row_ruletype['tb_ruletype_score']);

$ruleTypeArray =array();
$ruleTypeArray[] = $date_day;
echo json_encode($ruleTypeArray);








