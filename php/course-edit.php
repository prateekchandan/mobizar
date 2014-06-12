<?php
	include "dbconnect.php";
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
	foreach ($_GET as $key => $value) {
		$_GET[$key]=mysqli_real_escape_string($con,$value);
	}
    $q=mysqli_query($con,'select * from courses where courseid="'.$_GET['courseid'].'"');
    $course=mysqli_fetch_assoc($q);

	if($_FILES['file']['error']==0){
            $ext= pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $name= substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
            $uploaddir = '../courses/';
            $uploadfile = $uploaddir.$name.".".$ext;
            $path = './courses/'.$name.".".$ext;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                unlink(".".$course['filepath']);
            } 
            else {
                die( "File cant be uploaded");
            }
        }
        else
        {
            $path=$course['filepath'];
            $ext=$course['filetype'];
        }

    $date = date('Y-m-d h:i:s', time());
    $q="update courses set `coursename`= '".$_GET['course-name']."' ,`filetype` = '".$ext."', 
        `filepath` ='".$path."', `courseduration`='".($_GET['hour']*60 + $_GET['minute'])."',
            `modifiedon`='".$date."' where courseid='".$_GET['courseid']."'";			 
    mysqli_query($con,$q);
    echo 'done';
?>