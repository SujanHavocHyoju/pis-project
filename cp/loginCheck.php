<?php

include('../class/common.php');

if (isset($_POST['btnLogin'])) {
    if (isset($_POST['txtUser']) && isset($_POST['txtPass'])) {
        $username = $_POST['txtUser'];
        $password = $_POST['txtPass'];

        $result = $dbc->selectUserLogin($username, crypt($password,'st'));
        
        $row = mysqli_fetch_array($result);

        var_dump($row);

        $count = mysqli_num_rows($result);

        if (count($row) > 0) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            if($row['user_type']!=0){
                $_SESSION['office_id'] = ($_SESSION['user_type'] != 0) ? $row['office_id'] : null;
                if($_SESSION['office_id']==1){
                    $_SESSION['is_edu']=true;
                    $officeResult=$dbc->selectOneEduOffice($_SESSION['office_id']); 
                }
                else{
                    $_SESSION['is_edu']=false;
                    $officeResult=$dbc->selectOneEduOffice($_SESSION['office_id']); 
                }
                $resultOff = mysqli_fetch_array($officeResult);
                $_SESSION['office_name'] = $resultOff['name_np'];
            }else{
                $_SESSION['office_name'] = 'ADMIN';
            }
            
            $_SESSION['fullname'] = $row['fullname'];
            if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
                header('location:dashboard.php');
            }
        } else {
            header('location:login.php?error=तपाईको प्रयोगकर्ता नाम अथावा पासवर्ड मिल्न सकेन!!!');
        }

    }
}


?>



