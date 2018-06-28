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
$showSemester = array();
$sql_time = "SELECT DISTINCT tb_time_semester,tb_time_year FROM tb_times WHERE tb_time_stucode = '".$studentCode."' order by tb_time_year desc ,  tb_time_semester desc";
$result_time = mysqli_query($conn, $sql_time);
$count = mysqli_num_rows($result_time);
if($count > 0){
    while ($row_time = mysqli_fetch_assoc($result_time)) {
        $year = (int)$row_time['tb_time_year']+543;
        $showSemester[] = $row_time['tb_time_semester'].'-'.$year;
    }
}
else{
    $showSemester = null;
}




echo json_encode($showSemester);







