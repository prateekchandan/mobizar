<?php
	include "../dbconnect.php";
	include "../encrypt.php";
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
		$_POST[$key]=mysqli_real_escape_string($con,$_POST[$key]);
	}

	$q=mysqli_query($con,"select * from users where email = '".$_POST['email']."'");
	if(mysqli_num_rows($q)>0){
		$toadd=mysqli_fetch_assoc($q);
	    $alluser=json_decode($user['studentlist'],true);
	    if(in_array($toadd['userid'],$alluser)){
	        die("alreadypresent");
	    }
	    array_push($alluser, $toadd['userid']);
	    $toadd=mysqli_real_escape_string($con,json_encode($alluser));
	    $q=mysqli_query($con,"update users set studentlist='".$toadd."' where email = '".$_SESSION['user-email']."'");
			die('done');
	}
	
	$_POST['password']= substr( str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789") ,mt_rand( 0 ,50 ) ,10 );
	
	$qstr="insert into users (`email`,`password`,`firstname`,`lastname`,`organisation`,`designation`,`phone`) values ('".$_POST['email']."' , '".encrypt_decrypt('encrypt',$_POST['password'])."' , '".$_POST['firstname']."' ,'".$_POST['lastname']."' , '".$_POST['organization']."' , '".$_POST['designation']."' , '".$_POST['phone']."')";
	
	mysqli_query($con,$qstr);

	/*
		Code to mail user

	*/

	$q=mysqli_query($con,"select * from users where email = '".$_POST['email']."'");
	if(mysqli_num_rows($q)>0){
		$toadd=mysqli_fetch_assoc($q);
	    $alluser=json_decode($user['studentlist'],true);
	    if(in_array($toadd['userid'],$alluser)){
	        die("alreadypresent");
	    }
	    array_push($alluser, $toadd['userid']);
	    $toadd=mysqli_real_escape_string($con,json_encode($alluser));
	    $q=mysqli_query($con,"update users set studentlist='".$toadd."' where email = '".$_SESSION['user-email']."'");
			die('done');
	}

?>
