<?php
	include "dbconnect.php";
	include "encrypt.php";
	
	foreach ($_POST as $key => $value) {
		$_POST[$key]=mysqli_real_escape_string($con,$_POST[$key]);
	}

	if($_POST['password']!=$_POST['repass'])
	{
		die("passnotmatch");
	}
	if(strlen($_POST['password'])<8)
	{
		die("passworderr");
	}
	$q=mysqli_query($con,"select * from user where email = '".$_POST['email']."'");
	if(mysqli_num_rows($q)>0){
		die('emailerr');
	}
		echo 'done';
	$qstr="insert into users (`email`,`password`,`firstname`,`lastname`,`organisation`,`designation`,`phone`) values ('".$_POST['email']."' , '".encrypt_decrypt('encrypt',$_POST['password'])."' , '".$_POST['firstname']."' ,'".$_POST['lastname']."' , '".$_POST['organization']."' , '".$_POST['designation']."' , '".$_POST['phone']."')";
	
	mysqli_query($con,$qstr);

?>
