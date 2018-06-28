<?php




header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-alloworigin,
access-control-allow-methods, access-control-allow-headers');

date_default_timezone_set("Asia/Bangkok");

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
$dateSearch = $jsonArray['date'];

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
$studentArray = array();
$sql_student = "SELECT * FROM tb_students WHERE tb_student_degree = '".$teacherDegree."' order by tb_student_number asc";
$result_student = mysqli_query($conn, $sql_student);


while ($row = mysqli_fetch_assoc($result_student)) {

    $sql_time = "SELECT * FROM tb_times WHERE tb_time_stucode = '".$row['tb_student_code']."' and tb_time_date = '".$dateSearch."'";
    $result_time = mysqli_query($conn, $sql_time);
    $count = mysqli_num_rows($result_time);
    if($count > 0){
        while ($row_time = mysqli_fetch_assoc($result_time)) {
            $time_type = array("tb_time_type" => $row_time['tb_time_type']);
            $studentArray[] = $row + $time_type;
        }

    }


}
echo json_encode($studentArray);







