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

$teacherNumber = $jsonArray['teacherNumber'];


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

$teacherArray = array();

$sql_teacher = "SELECT * FROM tb_teachers WHERE tb_teacher_number = '".$teacherNumber."'";
$result_teacher = mysqli_query($conn, $sql_teacher);
$row_teacher = mysqli_fetch_assoc($result_teacher);

$sql_room = "SELECT * FROM tb_rooms WHERE tb_room_id = '".$row_teacher['tb_teacher_degree']."'";
$result_room = mysqli_query($conn, $sql_room);
$row_room = mysqli_fetch_assoc($result_room);


$sql_position = "SELECT * FROM tb_positions WHERE tb_position_id = '".$row_teacher['tb_teacher_position']."'";
$result_position = mysqli_query($conn, $sql_position);
$row_position = mysqli_fetch_assoc($result_position);

$sql_department = "SELECT * FROM tb_departments WHERE tb_department_id = '".$row_teacher['tb_department_id']."'";
$result_department = mysqli_query($conn, $sql_department);
$row_department = mysqli_fetch_assoc($result_department);

    $teacherArray[] = $row_teacher + $row_room + $row_position + $row_department;

echo json_encode($teacherArray);








