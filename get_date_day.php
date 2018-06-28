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

$username = $jsonArray['username'];
$password = $jsonArray['password'];

$date = date("d");
$day = date("N");
$month = date("m");
$year = date("Y");

switch ($month){
    case 1:
        $month = 'มกราคม';
        break;
    case 2:
        $month = 'กุมภาพันธ์';
        break;
    case 3:
        $month = 'มีนาคม';
        break;
    case 4:
        $month = 'เมษายน';
        break;
    case 5:
        $month = 'พฤษภาคม';
        break;
    case 6:
        $month = 'มิถุนายน';
        break;
    case 7:
        $month = 'กรกฎาคม';
        break;
    case 8:
        $month = 'สิงหาคม';
        break;
    case 9:
        $month = 'กันยายน';
        break;
    case 10:
        $month = 'ตุลาคม';
        break;
    case 11:
        $month = 'พฤศจิกายน';
        break;
    case 12:
        $month = 'ธันวาคม';
        break;
}


switch ($day){
    case 7:
        $day = 'อาทิตย์';
        break;
    case 1:
        $day = 'จันทร์';
        break;
    case 2:
        $day = 'อังคาร';
        break;
    case 3:
        $day = 'พุธ';
        break;
    case 4:
        $day = 'พฤหัส';
        break;
    case 5:
        $day = 'ศุกร์';
        break;
    case 6:
        $day = 'เสาร์';
        break;
}

$date_day = array("date" => $date,
                    "day" => $day,
                    "month" => $month,
                    "year" => $year+543);

$dateArray =array();
$dateArray[] = $date_day;
echo json_encode($dateArray);








