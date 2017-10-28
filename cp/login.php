<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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

    </style>
</head>
<body>
<p>नेपाल सरकार<br/>
<p>शिक्षा मन्त्रालय<br/>
<p>शिक्षा विभाग<br/>
    प्रगति विवरण सूचना प्रणाली
</p>
<div id="login">
    <form action="http://pis.doe.gov.np/logincheck.php" method="post">
        <table border="0" align="center">
            <tr>
                <td align="right">Username</td>
                <td align="left"><input class="txt" required type="text" name="txtUser"/></td>
            </tr>
            <tr>
                <td align="right">Password</td>
                <td align="left"><input class="txt" required type="password" name="txtPass"/></td>
            </tr>
            <tr>
                <td align="right">Fiscalyear</td>


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