<?php
session_start();
include('../class/common.php');
if(isset($_SESSION['user_type'])){
    echo "HERE";
    if($_SESSION['user_type']==0){
        $host= "127.0.0.1";
        $user="root";
        $pass = "admin";
        $name="db_pis";
        $result = $dbc->EXPORT_TABLES($host,$user,$pass,$name);
        if($result){
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home&m=here';</script>";
        }
    }else{
        echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home';</script>";
    }
}
else{
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home';</script>";
}
?>

