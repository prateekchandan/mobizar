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

    $usermain=mysqli_fetch_assoc($q);

    if($usermain['usertype']!='Instructor'){
    	die("error");
    }

	foreach ($_POST as $key => $value) {
		$_POST[$key]=mysqli_real_escape_string($con,$_POST[$key]);
	}

	$q=mysqli_query($con,'select * from `group` where groupid="'.$_POST['group'].'"');
	if(mysqli_num_rows($q)==0)
		die('error');

	$group=mysqli_fetch_assoc($q);
	$q=mysqli_query($con,'select * from `users` where userid="'.$_POST['id'].'"');
	if(mysqli_num_rows($q)==0)
		die('error');

	$user=mysqli_fetch_assoc($q);

	$studentingroup=json_decode($group['students'],true);
	if(in_array($_POST['id'],$studentingroup)){
		$pos = array_search($_POST['id'], $studentingroup);
        unset($studentingroup[$pos]);
	}
	else{
		array_push($studentingroup, $_POST['id']);
	}

	mysqli_query($con, 'update `group` set students="'.mysqli_real_escape_string($con,json_encode($studentingroup)).'" where groupid="'.$_POST['group'].'"');

	$groupinstudent=json_decode($user['grouplist'],true);
	if(in_array($_POST['group'],$groupinstudent)){
		$pos = array_search($_POST['group'], $groupinstudent);
        unset($groupinstudent[$pos]);
	}
	else{
		array_push($groupinstudent, $_POST['group']);
	}

	mysqli_query($con, 'update `users` set grouplist="'.mysqli_real_escape_string($con,json_encode($groupinstudent)).'" where userid="'.$_POST['id'].'"');

	$q=mysqli_query($con,'select * from `group` where createdby="'.$usermain['userid'].'"');
    $allgroup=array();
    while($row=mysqli_fetch_assoc($q)){
    	$allgroup[$row['groupid']]=$row;
    }

	echo '<table id=\'pop-table'.$_POST['id'].'\'>';
			        				$grouppresent=$groupinstudent;

			        				foreach ($allgroup as $key => $value) {
			        					echo '<tr>';
			        					echo '<td>'.$value['groupname'].'</td>';
			        					echo ' <td><input id=\'groupcheck'.$_POST['id'].$value['groupid'].'\'
			        					 type=checkbox onchange=\'addusergroup('.$_POST['id'].','.$value['groupid'].')\' ';
			        					if(in_array($value['groupid'],$grouppresent))
			        						echo 'checked';
			        					echo '></td>';
			        				}
			        				echo '</table>';


?>