<?php
	include "../encrypt.php";
	include "../dbconnect.php";
	session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die("error");

    $q=mysqli_query($con,"select * from users where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        die("error");

    $userm=mysqli_fetch_assoc($q);

    if($userm['usertype']!='Instructor'){
    	die("error");
    }

   	if(!isset($_FILES['file'])){
   		die("No file present");
   	}

   	if($_FILES['file']['error']!=0){
   		die("Error in file upload");
   	}

   	$tmpname='./temp/'.substr( str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789") ,mt_rand( 0 ,50 ) ,10 ).'.'.$ext= pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);;
   	if (move_uploaded_file($_FILES['file']['tmp_name'], $tmpname)) {
        } 
    else {
            die( "File cant be uploaded");
    }

    require_once 'excel_reader2.php';

    $data = new Spreadsheet_Excel_Reader($tmpname,false);
     unlink($tmpname);

    $noofrow=$data->rowcount($sheet_index=0);
    $noofcol=$data->colcount($sheet_index=0);

    if($noofcol!=7)
    	die("The excel sheet must have 7 columns. Please download the sample excel sheet to edit");

    if($noofrow<=1)
    	die("The first row is considored to be heading. Sheet should have atleast 1 row");

    $alluser=array();
    for ($i=2; $i <= $noofrow ; $i++) { 
    	$user= array();
    	// email , firstname , 'lastname ' , organization designation , phone
    	for ($j=2; $j <= $noofcol ; $j++) { 
    		array_push($user, mysqli_real_escape_string($con,$data->val($i,$j)));
    	}

    	$q=mysqli_query($con,"select * from users where email='".$user[0]."'");
    	if(mysqli_num_rows($q)==0){
    		$pass=substr( str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789") ,mt_rand( 0 ,50 ) ,10 );
    		$qstr="insert into users (`email`,`firstname`,`lastname`,`organisation`,`designation`,`phone`,`password`,`createdby`) values ('".$user[0]."' , '".$user[1]."' , '".$user[2]."' ,'".$user[3]."' , '".$user[4]."' , '".$user[5]."' , '".encrypt_decrypt('encrypt',$_POST['password'])."' , '".$userm['userid']."')";
    		$user[0]=filter_var($user[0], FILTER_VALIDATE_EMAIL);
    		if($user[0]){
    			mysqli_query($con,$qstr);
    			$user=mysqli_fetch_assoc(mysqli_query($con,"select * from users where email='".$user[0]."'"));

    		}
    	}
    	else{
    		$user=mysqli_fetch_assoc($q);
    	}

    	array_push($alluser, $user);

	}
	$studentlist=json_decode($userm['studentlist']);
	echo '<h4>List of users added</h4><table class="table table-responsive" style="width:auto"><thead><tr><th>Sl no</th><th>Email</th><th>Name</th><th>Phone</th><th>Action</th></thead>';
	$i=0;
	foreach ($alluser as $key => $value) {
		$i++;
		
		if(isset($value[0]))
		{
			echo '<tr class="warning">';
			echo '<td>'.$i.'</td>';
			echo '<td></td>';
			echo '<td>'.$value[1]." ".$value[2].'</td>';
			echo '<td>'.$value[5].'</td>';
			echo '<td>User not added</td>';
		}
		else{
			if(!in_array($value['userid'],$studentlist)){
				array_push($studentlist, $value['userid']);
			}
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$value['email'].'</td>';
			echo '<td>'.$value['firstname']." ".$value['lastname'].'</td>';
			echo '<td>'.$value['phone'].'</td>';
			echo '<td>User added</td>';
		}
		echo '</tr>';

	}
	echo '</table>';
	$toadd=mysqli_real_escape_string($con,json_encode($studentlist));
	mysqli_query($con,"update users set studentlist='".$toadd."' where userid = '".$userm['userid']."'");

	echo 'Please <a href=".">refresh the page </a> to see users';
?>


