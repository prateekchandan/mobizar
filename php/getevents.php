<?php
    include "dbconnect.php";
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
   
   	$courses=array();
   	$q=mysqli_query($con,"select * from courses");
   	while($row=mysqli_fetch_assoc($q)){
   		$courses[$row['courseid']]=$row;
   	}

   	$result=array();
   	$time=time()*1000;
   	$q=mysqli_query($con , "select * from calendar where userid='".$user['userid']."'");
   	while($row=mysqli_fetch_assoc($q)){
   		$event=array();
   		$event['id']=$row['calendarid'];
   		$event['title']=$courses[$row['courseid']]['coursename'];
   		$event['url']=$courses[$row['courseid']]['filepath'];
   		$event['start']=$row['sttime'];
   		$event['end']=$row['endtime'];
   		if($row['sttime']<$time)
   			$event['class']="event-warning";
   		else
   			$event['class']="event-success";
   		array_push($result, $event);
   	}

   	$all=array();
   	$all['success']=1;
   	$all['result']=$result;
   	print_r(json_encode($all));
?>
