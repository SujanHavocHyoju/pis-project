<?php

include('../class/common.php');

if (isset($_POST['btnLogin'])) {
    if (isset($_POST['txtUser']) && isset($_POST['txtPass'])) {
        $username = $_POST['txtUser'];
        $password = $_POST['txtPass'];

        $result = $dbc->selectUserLogin($username, $password);

        $row = mysqli_fetch_array($result);

        var_dump($row);

        $count = mysqli_num_rows($result);

        if (count($row) > 0) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['office_id'] = ($_SESSION['user_type'] != 0) ? $row['office_id'] : null;
            echo "Miliraxa ta";
            if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
                header('location:dashboard.php');

            } else {
                header('location:login.php?error');
                exit();
            }
        } else {
            header('location:login.php?error');
        }

    }
}


?>



