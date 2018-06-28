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

function display_date($date,$type){//shortthai, longthai, shorteng, longeng
    if($date!='0000-00-00' && $date){
        $arr = explode("-",$date);
        if($arr[2]<10){
            $arr[2] = substr($arr[2],1,1);
        }
        $datevalue = $arr[2]." ".convert_month($arr[1],$type)." ".cut_zero($arr[0]+543);
    }else{
        $datevalue = "";
    }
    return $datevalue;
}

function convert_month($month,$language){
    if($language=='longthai'){
        if($month=='01' || $month=='1'){
            $month = "มกราคม";
        }elseif($month=='02' || $month=='2'){
            $month = "กุมภาพันธ์";
        }elseif($month=='03' || $month=='3'){
            $month = "มีนาคม";
        }elseif($month=='04' || $month=='4'){
            $month = "เมษายน";
        }elseif($month=='05' || $month=='5'){
            $month = "พฤษภาคม";
        }elseif($month=='06' || $month=='6'){
            $month = "มิถุนายน";
        }elseif($month=='07' || $month=='7'){
            $month = "กรกฎาคม";
        }elseif($month=='08' || $month=='8'){
            $month = "สิงหาคม";
        }elseif($month=='09' || $month=='9'){
            $month = "กันยายน";
        }elseif($month=='10'){
            $month = "ตุลาคม";
        }elseif($month=='11'){
            $month = "พฤศจิกายน";
        }elseif($month=='12'){
            $month = "ธันวาคม";
        }
        return $month;
    }elseif($language=='shortthai'){
        if($month=='01' || $month=='1'){
            $month = "ม.ค.";
        }elseif($month=='02' || $month=='2'){
            $month = "ก.พ.";
        }elseif($month=='03' || $month=='3'){
            $month = "มี.ค.";
        }elseif($month=='04' || $month=='4'){
            $month = "เม.ย.";
        }elseif($month=='05' || $month=='5'){
            $month = "พ.ค.";
        }elseif($month=='06' || $month=='6'){
            $month = "มิ.ย.";
        }elseif($month=='07' || $month=='7'){
            $month = "ก.ค.";
        }elseif($month=='08' || $month=='8'){
            $month = "ส.ค.";
        }elseif($month=='09' || $month=='9'){
            $month = "ก.ย.";
        }elseif($month=='10'){
            $month = "ต.ค.";
        }elseif($month=='11'){
            $month = "พ.ย.";
        }elseif($month=='12'){
            $month = "ธ.ค.";
        }
        return $month;
    }elseif($language=='shorteng'){
        if($month=='01' || $month=='1'){
            $month = "Jan";
        }elseif($month=='02' || $month=='2'){
            $month = "Feb";
        }elseif($month=='03' || $month=='3'){
            $month = "Mar";
        }elseif($month=='04' || $month=='4'){
            $month = "Apr";
        }elseif($month=='05' || $month=='5'){
            $month = "May";
        }elseif($month=='06' || $month=='6'){
            $month = "Jun";
        }elseif($month=='07' || $month=='7'){
            $month = "Jul";
        }elseif($month=='08' || $month=='8'){
            $month = "Aug";
        }elseif($month=='09' || $month=='9'){
            $month = "Sep";
        }elseif($month=='10'){
            $month = "Oct";
        }elseif($month=='11'){
            $month = "Nov";
        }elseif($month=='12'){
            $month = "Dec";
        }
        return $month;
    }elseif($language=='longeng'){
        if($month=='01'  || $month=='1'){
            $month = "January";
        }elseif($month=='02' || $month=='2'){
            $month = "February";
        }elseif($month=='03' || $month=='3'){
            $month = "March";
        }elseif($month=='04' || $month=='4'){
            $month = "April";
        }elseif($month=='05' || $month=='5'){
            $month = "May";
        }elseif($month=='06' || $month=='6'){
            $month = "June";
        }elseif($month=='07' || $month=='7'){
            $month = "July";
        }elseif($month=='08' || $month=='8'){
            $month = "August";
        }elseif($month=='09' || $month=='9'){
            $month = "September";
        }elseif($month=='10'){
            $month = "October";
        }elseif($month=='11'){
            $month = "November";
        }elseif($month=='12'){
            $month = "December";
        }
        return $month;
    }
}

function cut_zero($val){
    $cut = substr($val,0,1);
    if($cut=='0'){
        $val = substr($val,1,1);
    }
    return $val;
}

function display_timetype($status){
    if($status=='1'){
        $show_status = "มาเรียน";
    }elseif($status=='2'){
        $show_status = "สาย";
    }elseif($status=='3'){
        $show_status = "ลา";
    }elseif($status=='4'){
        $show_status = "ลาป่วย";
    }elseif($status=='5'){
        $show_status = "ขาดเรียน";
    }elseif($status=='6'){
        $show_status = "ลากิจ";
    }elseif($status=='7'){
        $show_status = "กิจกรรม";
    }
    return $show_status;
}

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

$data = array();

$sql_time = "SELECT * FROM tb_times WHERE tb_time_date = '".$date_day."' and tb_time_type != 1 and tb_time_type_update != 2 order by  tb_time_degree asc, tb_time_stucode asc";
$result_time = mysqli_query($conn, $sql_time);
while ($row_time = mysqli_fetch_assoc($result_time)) {

    $sql_student = "SELECT * FROM tb_students WHERE tb_student_code = '".$row_time['tb_time_stucode']."'";
    $result_student = mysqli_query($conn, $sql_student);
    $row_student = mysqli_fetch_assoc($result_student);

    $sql_room = "SELECT * FROM tb_rooms WHERE tb_room_id = '".$row_student['tb_student_degree']."'";
    $result_room = mysqli_query($conn, $sql_room);
    $row_room = mysqli_fetch_assoc($result_room);

       $sql_num_absent = "SELECT * FROM tb_times WHERE tb_time_stucode = '".$row_time['tb_time_stucode']."' and tb_time_type != 1 and tb_time_type_update != 2  and tb_time_semester = '".$semester."' and tb_time_year = '".$year."'";
       $result_num_absent = mysqli_query($conn, $sql_num_absent);
       $count = mysqli_num_rows($result_num_absent);
       $studentName = $row_student['tb_student_name'].' '.$row_student['tb_student_sname'];
        $dataStudent = array(
            "description" => display_timetype($row_time['tb_time_type']),
            "student_code" => $row_student['tb_student_code'],
            "student_name" => $studentName,
            "room" => $row_room['tb_room_name'],
            "num_absent" => $count,
            "date" => display_date($date_day,'shortthai'),
            "telephone" => $row_student['tb_student_phone']
        );

    $data[] = $dataStudent;
}






echo json_encode($data);








