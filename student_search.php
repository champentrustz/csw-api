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

$studentCode = $jsonArray['studentCode'];
$semesterSearch = $jsonArray['semester'];
$yearSearch = $jsonArray['year'];

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
$studentAbsentArray = array();
$studentLateArray = array();
$studentRuleArray = array();
$studentDataArray = array();
$studentArray = array();
$sql_student = "SELECT * FROM tb_students WHERE tb_student_code = '".$studentCode."'";
$result_student = mysqli_query($conn, $sql_student);
$count = mysqli_num_rows($result_student);
if($count > 0){
    $row_student = mysqli_fetch_assoc($result_student);
    $sql_student_room = "SELECT * FROM tb_rooms WHERE tb_room_id = '".$row_student['tb_student_degree']."'";
    $result_student_room = mysqli_query($conn, $sql_student_room);
    $row_student_room = mysqli_fetch_assoc($result_student_room);
    $studentDataArray[] = $row_student + $row_student_room;

    $studentData = array('data' => $studentDataArray);



    $sql_time_absent = "SELECT * FROM tb_times WHERE tb_time_stucode = '".$row_student['tb_student_code']."' and tb_time_semester = '".$semesterSearch."' and tb_time_year = '".$yearSearch."' and tb_time_type != 1";
    $result_time_absent = mysqli_query($conn, $sql_time_absent);
    while($row_time_absent = mysqli_fetch_assoc($result_time_absent)){
        $studentAbsentArray[] = $row_time_absent;

    }
    $studentAbsent = array('time_absent' => $studentAbsentArray);


    $sql_time_late = "SELECT * FROM tb_times WHERE tb_time_stucode = '".$row_student['tb_student_code']."' and tb_time_semester = '".$semesterSearch."' and tb_time_year = '".$yearSearch."' and tb_time_type_update = 2";
    $result_time_late = mysqli_query($conn, $sql_time_late);
    while($row_time_late = mysqli_fetch_assoc($result_time_late)){
        $studentLateArray[] = $row_time_late;
    }

    $studentLate = array('time_late' => $studentLateArray);

    $sql_rule = "SELECT * FROM tb_rules WHERE tb_student_code = '".$row_student['tb_student_code']."' and tb_rule_semester = '".$semesterSearch."' and tb_rule_year = '".$yearSearch."'";
    $result_rule = mysqli_query($conn, $sql_rule);
    while($row_rule = mysqli_fetch_assoc($result_rule)){
        $sql_ruletype = "SELECT * FROM tb_ruletypes WHERE tb_ruletype_id = '".$row_rule['tb_ruletype_id']."'";
        $result_ruletype = mysqli_query($conn, $sql_ruletype);
        $row_ruletype = mysqli_fetch_assoc($result_ruletype);
        $studentRuleArray[] = $row_rule + $row_ruletype;
    }



    $studentRule = array('rule' => $studentRuleArray);



    $studentArray[] = $studentData + $studentAbsent + $studentLate + $studentRule;
}
else{
    $studentArray = null;
}




echo json_encode($studentArray);







