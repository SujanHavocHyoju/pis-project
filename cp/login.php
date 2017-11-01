<?php

session_start();

if(isset($_SESSION['username']) || isset($_SESSION['user_type'])){
    echo "<script>window.location='dashboard.php';</script>";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Welcome to Progress Reporting Software</title>
    <style>
        body {
            height: 100%;
            background: #0079a6 url('img/bg.gif') repeat-x;
            margin: 0px auto;
            text-align: center;

        }

        p {
            color: #FFF;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        #login {
            margin: 0px auto;
            width: 100%;
            text-align: center;
            height: 100%;
            padding-top: 17%;

        }

        #login table {
            background: #FFF;
            padding: 10px;
        }

        #login table tr td {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .txt {
            color: #5d5d5d;
        }

        .danger {
            margin-bottom: 18px;
            color: #fffaf7;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
            background-color: #970004;
            border: 1px solid #fbeed5;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }


    </style>
</head>
<body>
<p>नेपाल सरकार<br/>
<p>शिक्षा मन्त्रालय<br/>
<p>शिक्षा विभाग<br/>
    प्रगति विवरण सूचना प्रणाली
</p>
<div id="login">

    <form action="loginCheck.php" method="post">
        <table border="0" align="center">
<!--            --><?php //if (isset($_GET['error'])): ?>
<!--                <td align="right" class="danger">-->
<!--                    Your username or password is incorrect-->
<!--                </td>-->
<!--            --><?php //endif; ?>
            <tr>
                <td align="center">Username</td>
                <td align="center"><input class="txt" required type="text" name="txtUser"/></td>
            </tr>
            <tr>
                <td align="center">Password</td>
                <td align="center"><input class="txt" required type="password" name="txtPass"/></td>
            </tr>
            <tr>
                <td align="center">Fiscalyear</td>


                <td align="left">
                    <select name="txtfiscalyear" style="width:100px; height:30px;" class="preeti">

                        <option value="2073/74">2073/74</option>
                    </select>

                </td>


            </tr>
            <tr>
                <td align="right"></td>
                <td align="left"><input type="submit" value=" Login " name="btnLogin"/></td>
            </tr>
        </table>
    </form>
</div>
</body>