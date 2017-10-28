<?php
session_start();
include('../class/common.php');
session_destroy();
echo "<script>window.location='index.php';</script>";
?>