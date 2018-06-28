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

$teacherDegree = $jsonArray['teacherDegree'];
$teacherCode = $jsonArray['teacherCode'];
$timeType = $jsonArray['timeType'];
$studentCode = $jsonArray['studentCode'];

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

$checkStatusArray = array();
$checkStatus = array("status" => "success");

$sql_time = "SELECT * FROM tb_times WHERE tb_time_stucode = '".$studentCode."' and tb_time_date = '".$date_day."'";
$result_time = mysqli_query($conn, $sql_time);
$count = mysqli_num_rows($result_time);

if($count > 0){

    $sql_time_update = "UPDATE tb_times SET tb_time_type = '".$timeType."' WHERE tb_time_stucode = '".$studentCode."'";
    $result_time_update = mysqli_query($conn, $sql_time_update);

}
else{
    $sql_time_insert = "INSERT INTO tb_times (tb_time_stucode, tb_time_date, tb_time_semester, tb_time_year, tb_time_type, tb_time_degree, tb_time_time, tb_time_teacher) VALUES ('".$studentCode."', '".$date_day."', '".$semester."', '".$year."', '".$timeType."', '".$teacherDegree."', '".$date_day."', '".$teacherCode."');";
    $result_time_insert = mysqli_query($conn, $sql_time_insert);
}

$checkStatusArray[] = $checkStatus;

echo json_encode($checkStatusArray);








