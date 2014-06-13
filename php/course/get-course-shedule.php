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
    $id=mysqli_real_escape_string($con,$_POST['id']);
    $q=mysqli_query($con,"select * from courses where courseid='".$id."'");
    $course=mysqli_fetch_assoc($q);
    $return=array();
    $return['courseid']=$course['courseid'];
    $return['name']=$course['coursename'];

    $q=mysqli_query($con,"select * from calendar where courseid='".$id."'");
    if(mysqli_num_rows($q)==0){
        $return['error']=1;
        echo json_encode($return);
        die("");
    }
    $temp=mysqli_fetch_assoc($q);
    $temp['error']=0;
    $temp['name']=$return['name'];
    echo json_encode($temp);
?>