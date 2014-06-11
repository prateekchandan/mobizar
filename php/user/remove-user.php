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

    $alluser=json_decode($user['studentlist'],true);
    if(in_array($_POST['id'],$alluser)){
        $pos = array_search($_POST['id'], $alluser);
        unset($alluser[$pos]);
        $toadd=mysqli_real_escape_string($con,json_encode($alluser));
        $q=mysqli_query($con,"update users set studentlist='".$toadd."' where email = '".$_SESSION['user-email']."'");
        die("done");
    }
   
    echo 'error';


?>