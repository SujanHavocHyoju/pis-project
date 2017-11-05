<?php
session_start();
include('../class/common.php');
include('../class/utils.php');
if(!isset($_SESSION['username']) || !isset($_SESSION['user_type']))
    echo "<script>window.location='login.php';</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="Description" content=""/>
    <meta name="Keywords" content=""/>
    <meta name="robots" content="all,follow"/>
    <meta name="author" content=""/>
    <meta name="copyright" content=""/>
    <meta http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/style.css" type="text/css" media="screen, projection, tv"/>
    <!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" href="../public/css/style-ie.css" media="screen, projection, tv"/>
    <![endif]-->
    <link rel="stylesheet" href="../public/css/style-print.css" type="text/css" media="print"/>
    <link rel="stylesheet" href="../public/css/tableexport.min.css" type="text/css" media="screen, projection, tv"/>

    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon"/>
    <script>
        function validateForm() {
            var agree = confirm("this function is not provided right now.");
            if (agree)
                return true;
            else
                return false;
        }
    </script>
    <title>शिक्षा विभाग</title>
</head>
<body>

<!-- Header -->
<script src="../public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../public/js/jquery.combobox.js"></script>
<link rel="stylesheet" type="text/css" href="../public/js/style.css">
<script type='text/javascript' src='../public/js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='../public/js/jquery.dcmegamenu.1.3.3.js'></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href="../public/css/skins/white.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    $(document).ready(function ($) {
        $('#mega-menu-1').dcMegaMenu({
            rowItems: '4',
            speed: 0,
            effect: 'slide',
            event: 'click',
            fullWidth: true

        });
    });
</script>
<script src="../public/js/jquery.maskedinput.min.js"></script>
<script src="../public/js/functions.js"></script>
<script src="../public/js/FileSaver.min.js"></script>
<script src="../public/js/tableexport.min.js"></script>
<div id="header">
    <div id="logged-in">
        <p class="logged-in-right">हालको प्रयोगकर्ता : <?php echo $_SESSION['fullname']; ?></p>
    </div>
    <!-- Your gallery name  -->
    <h1 style="font-size:24px"><a href="dashboard.php?action=home">शिक्षा विभाग</a></h1>
    <!-- Your gallery name end -->

    <!-- Your slogan -->
    <h2 class="hide" style="font-size:18px">प्रगति विवरण सूचना प्रणाली</h2>
    <!-- Your slogan end -->

    <!-- Search form -->

    <!-- Search end -->

    <a href="#skip-menu" class="hidden">Skip menu</a>
    <?php if($_SESSION['user_type'] == 0): ?>
    <div class="white" id="cssmenu">
        
        <!-- Menu -->
        <ul id="mega-menu-1" class="mega-menu">
            <li><a href="dashboard.php?action=home" class="active">गृहपृष्ठ</a></li>
            <li><a href="#">डाटा प्रविष्टि</a>
                <ul>
                    <li><a href="dashboard.php?action=program" title="" class="preeti none"
                           style="font-size:14px; font-weight:normal">कार्यक्रम प्रविष्टी</a></li>
                    
                     <li class="sub-office"><a href="dashboard.php?action=eduoffice" title="" class="preeti none" style="font-size:14px; font-weight:normal">शैक्षिक कार्यालय प्रविष्टि </a></li><li class="sub-office"><a href="dashboard.php?action=office" title="" class="preeti none" style="font-size:14px; font-weight:normal">स्थानीय कार्यालय प्रविष्टि </a></li>
                    
                    <li><a href="dashboard.php?action=users" title="" class="preeti none"
                           style="font-size:14px; font-weight:normal">प्रयोगकर्ता
                            व्यवस्थापन</a></li>
                    <li><a href="dashboard.php?action=fiscalYear" title="" class="preeti none"
                           style="font-size:14px; font-weight:normal">आर्थिक वर्ष प्रविष्टि </a></li>


                    <li><a href="dashboard.php?action=programlist" title="" class="preeti none"
                           style="font-size:14px; font-weight:normal">क्रियाकलाप प्रविष्टि</a></li>


                </ul>
            </li>
                
    

            <li><a href="#">प्रगति प्रविष्टि</a>
                <ul>
                    
                    <li><a href="dashboard.php?action=entry" class="preeti none"
                           style="font-size:14px; font-weight:normal">शैक्षिक कार्यालय</a></li>
                   
                    <li><a href="dashboard.php?action=entryLocal" class="preeti none"
                           style="font-size:14px; font-weight:normal">स्थानीय कार्यालय</a></li>
                    </li>
                </ul>
            </li>


            <li><a href="report.php">प्रतिवेदनहरु</a>
                <ul>


                    <li><a class="preeti none" style="font-size:14px; font-weight:normal" href="finalexcelreport.php">कार्यक्रमगत
                            एकमुष्ट प्रतिवेदन</a></li>
                    <li><a class="preeti none" style="font-size:14px; font-weight:normal" href="officewise.php">कार्यालयगत
                            प्रतिवेदन</a></li>
                    <li><a class="preeti none" style="font-size:14px; font-weight:normal" href="activitywise.php">क्रियाकलापगत
                            प्रतिवेदन</a></li>
                    <!-- <li><a class="preeti none" style="font-size:14px; font-weight:normal" href="totalexcelreport.php">एकमुष्ट प्रतिवेदन</a></li>

            <li><a class="preeti none" style="font-size:14px; font-weight:normal" href="regionwise.php">क्षेत्रगत प्रतिवेदन</a></li>-->


                </ul>
            </li>

            <li><a href="#">अन्य प्रयोग</a>
                <ul>

                    <li><a href="dashboard.php?action=changepassword" class="preeti none" style="font-size:14px; font-weight:normal">पासवर्ड
                            परिवर्तन</a></li>
                    <li><a href="backup.php" class="preeti none" style="font-size:14px; font-weight:normal">डाटाबेस
                            ब्याक अप </a></li>
                    <li><a href="dashboard.php?action=logout" class="preeti none"
                           style="font-size:14px; font-weight:normal">लग आउट</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
    <?php endif; ?>
        <!-- Menu end -->
<!--FOR EDU-LOCAL-OFFICE-->
<?php if($_SESSION['user_type'] != 0):
    $edu_office_url = "dashboard.php?action=entryTwo&oid=".$_SESSION['office_id']."&name=".$_SESSION['office_name'];
    $local_office_url = "dashboard.php?action=entryLocalTwo&oid=".$_SESSION['office_id']."&name=".$_SESSION['office_name'];
    ?>
    <div class="white">
        <!-- Menu -->
        <ul id="mega-menu-1" class="mega-menu">
            <li><a href="dashboard.php?action=home" class="active">गृहपृष्ठ</a></li>
            <li><a href="<?php echo $_SESSION['user_type'] ==1 ? $edu_office_url:$local_office_url?>">प्रगति प्रविष्टि</a></li>
            <li><a href="#">अन्य प्रयोग</a>
                <ul>

                    <li><a href="dashboard.php?action=changepassword" class="preeti none" style="font-size:14px; font-weight:normal">पासवर्ड
                            परिवर्तन</a></li>
                    <li><a href="dashboard.php?action=logout" class="preeti none"
                           style="font-size:14px; font-weight:normal">लग आउट</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <?php endif; ?>
        <!--END FOR EDU LOCAL OFFICE-->

</div>    <!-- Header end -->

<hr class="noscreen"/>

<?php
if (isset($_GET['action']) and !empty($_GET['action'])) {
    $page = $_GET['action'] . ".php";
    if (file_exists($page)) {
        $now = time();
        if ($now > $_SESSION['expire']) {
            session_destroy();
            echo "<script>location.href='login.php?error=तपाईंको सेसन समाप्त भएको छ। (Your session has been timed out.)';</script>";
        }else{
            switch($_SESSION['user_type']){
                case 0:
                    include($page);
                    break;
                case 1:
                    $rba_for_edu = array('entryTwo.php','entryThree.php','home.php','changepassword.php','logout.php');
                    if(in_array($page,$rba_for_edu)){
                        if($page=='entryThree.php'){
                            if($_GET['oid']==$_SESSION['office_id']){
                                include($page);
                                break;
                            }
                            else{
                                echo "<script>location.href='dashboard.php?action=home';</script>";
                            }
                        }
                        if(isset($_GET['oid'])&&isset($_GET['name'])){
                            
                            if($_GET['oid']==$_SESSION['office_id']&&$_GET['name']==$_SESSION['office_name']){
                                include($page);
                                break;
                            }
                            else{
                                echo "<script>location.href='dashboard.php?action=home';</script>";    
                            }
                        }
                        include($page);
                        break;
                    }else{
                        echo "<script>location.href='dashboard.php?action=home';</script>";  
                    }
                case 2:
                    $rba_for_local = array('entryLocalTwo.php','entryLocalThree.php','home.php','changepassword.php','logout.php');
                    if(in_array($page,$rba_for_local)){
                    if($page=='entryLocalThree.php'){
                            if($_GET['oid']==$_SESSION['office_id']){
                                include($page);
                                break;
                            }
                            else{
                                echo "<script>location.href='dashboard.php?action=home';</script>";
                            }
                    }
                    if(isset($_GET['oid'])&&isset($_GET['name'])){
                        if($_GET['oid']==$_SESSION['office_id']&&$_GET['name']==$_SESSION['office_name']){
                            include($page);
                            break;
                        }
                        else{
                            echo "<script>location.href='dashboard.php?action=home';</script>";    
                        }
                    }
                        include($page);
                        break;
                    }else{
                    echo "<script>location.href='dashboard.php?action=home';</script>";  
                    }
            }
        }
        
    } else {
        echo "<script>location.href='dashboard.php?action=notfound';</script>";  
    }
} else {
    ?>
    <?php include('home.php'); ?>
    <?php
}
?>
<!-- Content box -->
<!-- Content box end -->

<hr class="noscreen"/>
s

<!-- Footer -->
<div id="footer">
    <div id="footer-in">
        <p class="footer-left">&copy; <a href="#">शिक्षा विभाग</a>, <span class="siddhi">2074/75. </span></p>
    </div>
</div>
<!-- Footer end -->

</body>
</html>
