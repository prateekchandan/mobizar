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
   if(sizeof($students)==0)
    die("<blockquote>This group has no user added right now<blockquote>");
    
    echo '<h4 style="margin-top: 0px;">'.$q['groupname'].'</h4>';
    echo '<table class="table table-striped"><thead><tr><td>Sl no</td><td>Name</td><td>Email</td><td>Phone no</td><td>Action</td></tr></thead>';
    $q=mysqli_query($con,'select * from users');
    $i=0;
    while($row=mysqli_fetch_assoc($q)){
        if(in_array($row['userid'],$students)){
            $i++;
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$row['firstname']." ".$row['lastname'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['phone'].'</td>';
            echo '<td>
                    <button class="btn btn-danger" onclick="addusergroup('.$row['userid'].','.$_POST['id'].'); show_users('.$_POST['id'].')" title="Remove this user from '.$row['groupname'].'">
                    <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    </td>';
            echo '</tr>';
        }
    }

    echo '</table>';


?>