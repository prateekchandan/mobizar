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
	}

   $q=mysqli_query($con,'select * from `group` where `groupid`="'.$_POST['id'].'"');
   $q=mysqli_fetch_assoc($q);
   $students=json_decode($q['students'],true);

   foreach ($students as $key) {
   		$q=mysqli_query($con,'select * from users where `userid`="'.$key.'"');
   		$q=mysqli_fetch_assoc($q);
   		$group=json_decode($q['grouplist']);
   		$pos = array_search($_POST['id'], $group);
        unset($group[$pos]);
        mysqli_query($con , "update users set grouplist='".mysqli_real_escape_string($con,json_encode($group))."' where `userid`='".$key."'");
   }

   mysqli_query($con,'delete from `group` where groupid="'.$_POST['id'].'"');
   echo 'done';
 ?>