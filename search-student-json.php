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
$studentArray = array();

$sql_student = "SELECT * FROM tb_students where tb_student_status = 1";
$result_student = mysqli_query($conn, $sql_student);
while ($row = mysqli_fetch_assoc($result_student)) {
    $name = $row['tb_student_name'].' '.$row['tb_student_sname'];
    $studentAll = array('name' => $name,
        'code' => $row['tb_student_code']);
    $studentArray[] = $studentAll;
}



echo json_encode($studentArray);








