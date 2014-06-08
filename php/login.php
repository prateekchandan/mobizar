<?php
	include "dbconnect.php";
	include "encrypt.php";
	
	foreach ($_POST as $key => $value) {
		$_POST[$key]=mysqli_real_escape_string($con,$_POST[$key]);
	}
	$q=mysqli_query($con,"select * from users where email = '".$_POST['email']."'");
	if(mysqli_num_rows($q)==0){
		die('emailerr');
	}
	$data=mysqli_fetch_assoc($q);
	if($data['password']==encrypt_decrypt('encrypt',$_POST['password']))
	{
		session_start();
		$_SESSION['user-email']=$_POST['email'];
		echo "done";
	}
	else
	{
		echo "passerr";
	}


?>