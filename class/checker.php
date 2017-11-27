<?php 
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
echo $url;
if (false !== strpos($url,'.php')) {
    echo "<script>window.location='../cp/dashboard.php?action=notfound.php';</script>";
}
?>