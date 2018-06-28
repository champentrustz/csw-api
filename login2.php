<?php

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $content = file_get_contents("php://input");
    $jsonArray = json_decode($content, true);

    $username = $jsonArray['username'];
    $password = $jsonArray['password'];

    $sql_login = "SELECT * FROM tb_teachers WHERE tb_teacher_number = 047 and tb_teacher_password = 7590 and tb_teacher_status = 1";
    $result = mysqli_query($conn, $sql_login);
    $count = mysqli_num_rows($result);
    if ($count > 0) {

        $teacherArray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $teacherArray[] = $row;
        }
        echo json_encode($teacherArray);
    }
}






