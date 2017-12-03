<?php

include('../class/common.php');
include('../log/PISLogger.php');
$LOG = new PISLogger();
if (isset($_POST['btnLogin'])) {
    if (isset($_POST['txtUser']) && isset($_POST['txtPass'])) {
        $username = $_POST['txtUser'];
        $password = $_POST['txtPass'];

        $LOG->logInfo("Username : " . $username . " attempt login");
        $LOG->logInfo("Username : " . $username . " requested url : " . $_SERVER["REMOTE_ADDR"]);
        $LOG->logInfo("Username : " . $username . " User agent  : " . $_SERVER["HTTP_USER_AGENT"]);
        $isMobile = isMobile();
        $device = $isMobile == true ? "Mobile Device" : "Computer";
        $result = $dbc->selectUserLogin($username, crypt($password, 'st'));

        $row = mysqli_fetch_array($result);
        $fiscal_year_row = mysqli_fetch_array($dbc->selectFiscalYearByStatus());

        $count = mysqli_num_rows($result);

        if (count($row) > 0) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['start'] = time();
            $_SESSION['fiscal_year'] = $fiscal_year_row['fiscal_year'];
            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
            if ($row['user_type'] != 0) {
                $_SESSION['office_id'] = ($_SESSION['user_type'] != 0) ? $row['office_id'] : null;
                if ($_SESSION['user_type'] == 1) {
                    $_SESSION['is_edu'] = true;
                    $officeResult = $dbc->selectOneEduOffice($_SESSION['office_id']);
                } else {
                    $_SESSION['is_edu'] = false;
                    $officeResult = $dbc->selectOneLocalOffice($_SESSION['office_id']);
                }
                $resultOff = mysqli_fetch_array($officeResult);
                $_SESSION['office_name'] = $resultOff['name_np'];

                $_SESSION['district_id'] = $resultOff['district_id'];
            } else {
                $_SESSION['office_name'] = 'ADMIN';
            }

            $_SESSION['fullname'] = $row['fullname'];
            if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
                $successMessage = $username . " able to login";
                $LOG->logInfo("Username :" . $successMessage);
                $LOG->closeFile();
                $dbc->insertOrUpdateUserLog($username,
                    $_SESSION['office_name'],
                    $_SESSION['user_type'],
                    $_SERVER["REMOTE_ADDR"],
                    $device, "SUCCESS");
                header('location:dashboard.php');
            }

        } else {
            $LOG->logInfo("Username : " . $username . " not able to login due to password unmatch");
            $LOG->closeFile();
            header('location:login.php?error=तपाईको प्रयोगकर्ता नाम अथवा पासवर्ड मिल्न सकेन!!!');
        }

    }
}


function isMobile()
{
    if (isset($_SERVER['HTTP_USER_AGENT']) and !empty($_SERVER['HTTP_USER_AGENT'])) {
        $user_ag = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis', $user_ag)) {
            return true;
        } else {
            return false;
        };
    } else {
        return false;
    };
}

;


?>



