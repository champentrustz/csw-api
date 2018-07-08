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

$month = date('n');
$year = date('Y');
if($month>='5'  && $month <='10'){
    $semester =1;

}else{
    $semester =2;
    if($month >= 1 && $month <5){
        $year = $year-1;
    }
}

$content = file_get_contents("php://input");

$jsonArray = json_decode($content,true);


$adminID = $jsonArray['admin_id'];
$studentCode= $jsonArray['studentCode'];
$ruleID = $jsonArray['ruletype'];
$score = $jsonArray['score'];
$place = $jsonArray['place'];
$dateFull = $jsonArray['date'];

if($place == '' || $place == null || $place == 'undefined'){
    $place = '';
}





$sql_rule = "INSERT INTO tb_add_rule_score (student_code, ruletype_id, score, area, semester, year, date, status, admin_id)
VALUES ('".$studentCode."', '".$ruleID."', '".$score."', '".$place."', '".$semester."', '".$year."', '".$dateFull."', '1', '".$adminID."');";
$result = mysqli_query($conn, $sql_rule);

