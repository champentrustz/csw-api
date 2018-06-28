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

$date_day = date("Y-m-d");

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
$teacherCheck = array();

$sql_time = "SELECT * FROM tb_times WHERE tb_time_degree = '".$teacherDegree."' and tb_time_date = '".$date_day."'";
$result_time = mysqli_query($conn, $sql_time);
$row_time = mysqli_fetch_assoc($result_time);
$count = mysqli_num_rows($result_time);

    if($count > 0){

        $sql_teacher = "SELECT * FROM tb_teachers WHERE tb_teacher_number = '".$row_time['tb_time_teacher']."'";
        $result_teacher = mysqli_query($conn, $sql_teacher);
        $row_teacher = mysqli_fetch_assoc($result_teacher);
            $check = array("teacher_check" => true,
                            "teacher_name" => $row_teacher['tb_teacher_name']);

    }
    else{
        $check = array("teacher_check" => false,
                        "teacher_name" => null);
    }

    $studentArray[] = $check;


echo json_encode($studentArray);







