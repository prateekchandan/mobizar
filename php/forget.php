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
	$pass=$data['password'];
	$pass=encrypt_decrypt('decrypt',$pass);
	$to = $_POST['email'];
	$subject = "[MOBIZAR] : Password Recovery";
	$message = "<h2>Pasword Recovery</h2>";
	$message .= "<h4>Hi ".$data['name']." ,</h4> Your password is : ".$pass;
	$message.="<br><br> Note : If you haven't requested for password then your account might be misused. Please change your password now";
	$headers = 'From: no-reply@shezartech.com' . "\r\n" .
	   'Reply-To: help@shezartech.com' . "\r\n" .
	   'X-Mailer: no-reply@shezartech.com';
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($to,$subject,$message,$headers,'-fno-reply@shezartech.com');
	echo "done";

	

?>