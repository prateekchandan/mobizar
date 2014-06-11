<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mobizar is a mobile based reinforcement platform which helps in refreshing the key takeaways of the training. It delivers courselets(short duration courses) to your learners' mobile devices on a shedule.">
    <meta name="author" content="Prateek Chandan">
    <link rel="icon" type="image/png" href="http://shezartech.com/SZ/wp-content/uploads/2013/09/logo_1.png" />


    <title>Mobizar | Shezartech</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">MOBIZAR</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <?php
              include "php/dbconnect.php";
              session_start();
              if(isset($_SESSION['user-email']))
              {
                $q=mysqli_query($con,"select * from users where email = '".$_SESSION['user-email']."'");
                $q=mysqli_fetch_assoc($q);
                echo '<li><a onclick="return false">Welcome '.$q['firstname'].'</a></li>';
                echo '<li><a onclick="return false">|</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
              }

            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
