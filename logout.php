<?php
 session_start();
unset($_SESSION['user-email']);
header("Location:./");
?>