<?php
    include "../dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die("error");

    $q=mysqli_query($con,"select * from users where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        die("error");

    $user=mysqli_fetch_assoc($q);

    if($user['usertype']!='Instructor'){
        die("error");
    }
    $id=mysqli_real_escape_string($con,$_POST['courseid']);
    
    $q=mysqli_query($con,"select * from courses where courseid='".$id."'");
    $course=mysqli_fetch_assoc($q);
    
    mysqli_query($con,"delete from `calendar` where courseid='".$id."'");
    
    $date=$_POST['date'];
    $time=$_POST['time'];
    $sttime=mktime( substr($time, 0,2) , substr($time, 3,2) , 0 , substr($date, 6,2) , substr($date, 8,2) , substr($date, 0,4)) * 1000;
    $endtime=$sttime + $course['courseduration'] * 60 * 1000;

    $q=mysqli_query($con,'select * from `group` where createdby="'.$user['userid'].'"');
    $grouppresent=array();
    while($row=mysqli_fetch_assoc($q)){
        if(isset($_POST[$row['groupid']])){
            array_push($grouppresent, $row['groupid']);
        }
    }

    $qstr="insert into `calendar` (`courseid`,`groups`,`userid`,`time`,`date`,`sttime`,`endtime`) values (
        '".$id."',
        '".mysqli_real_escape_string($con,json_encode($grouppresent))."',
        '".$user['userid']."',
        '".$time."',
        '".$date."',
        '".$sttime."',
        '".$endtime."'
        )";
    
    mysqli_query($con,$qstr);

    echo 'done';
?>