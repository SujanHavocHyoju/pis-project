<?php
$timer = time()-$_SESSION['start'];
$stay = "Username ".$_SESSION['username']." stays for ".$timer. " sec";
$dbc->updateUserLog($_SESSION['username'],$stay);
session_destroy();
echo "<script>window.location='login.php';</script>";
?>