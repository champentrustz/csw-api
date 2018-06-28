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

$timeID = $jsonArray['timeID'];
$reason = $jsonArray['reason'];

if($reason == ''){
    $reason = null;
}

$date_day = date("Y-m-d");
$date_time = date('H:i:s');

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


$sql_time_update = "UPDATE tb_times SET tb_time_type_update = 2, tb_time_reason = '".$reason."', tb_time_time = '".$date_time."' WHERE tb_time_id = '".$timeID."'";
$result_time_update = mysqli_query($conn, $sql_time_update);








