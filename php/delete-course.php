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
    $id=mysqli_real_escape_string($con,$_POST['id']);
    $q=mysqli_query($con,"select * from courses where courseid='".$id."'");
    $q=mysqli_fetch_assoc($q);
    if($q['createdby']!=$user['userid'])
        die('error');
    unlink('.'.$q['filepath']);
    mysqli_query($con,"delete from courses where courseid='".$id."'");

    echo 'done';
?>