<?php
include('../class/common.php');
$host= "127.0.0.1";
$user="root";
$pass = "admin";
$name="db_pis";
$result = $dbc->EXPORT_TABLES($host,$user,$pass,$name);
if($result){
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home&message=".$message."';</script>";
}
?>

