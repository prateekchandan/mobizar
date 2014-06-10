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
	foreach ($_POST as $key => $value) {
		$_POST[$key]=mysqli_real_escape_string($con,$value);
	}$date = date('Y-m-d h:i:s', time());
    $qstr='insert into `group` (`groupname`,`createdby`,`createdon`) values ("'.$_POST['groupname'].'","'.$user['userid'].'","'.$date.'")';
    echo $qstr;
   mysqli_query($con,$qstr);
   
    echo 'done';


?>