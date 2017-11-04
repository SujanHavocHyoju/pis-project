<div id="skip-menu"></div>

<?php 
if(isset($_GET['message'])){
    $message = $utils->infoMessage($_GET['message']);
}
if(isset($_GET['error'])){
    $message = $utils->errorMessage($_GET['message']);
}
    if(isset($_GET['pid'])){
        $program_code= $_GET['pid'];
        if(isset($_POST["txtmaincode"])){
            $main_activity_code =  $_POST["txtmaincode"];
            $main_activity_name = $_POST["txtmainactivity"];
            $result = $dbc->insertMainActivity($main_activity_code,$main_activity_name,$program_code);
            if($result>0){
                $message= $utils->successMessage('क्रियाकलाप विवरण '.$main_activity_name." दर्ता भैसाकेको छ!");
            }
            else if($result==-1){
                $message= $utils->infoMessage('क्रियाकलाप विवरण ' .$main_activity_name." पहिलै दर्ता भैसाकेको छ!! पुन प्रयाश गर्र्नु होला!!");
            }
            else{
                $message= $utils->errorMessage('क्रियाकलाप विवरण ' .$main_activity_name." दर्ता हुन्न सकेना!  ्पुन प्रयाश गर्र्नु होला!");
            }
        }
        $sql = $dbc->selectOneProgram($program_code);
        $program = mysqli_fetch_array($sql);
        if(!isset($program)){
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=programlist&message=क्रियाकलाप विवरण भेतौन सकेन!';</script>";
        }
    }else{
        echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=programlist';</script>";
    }
    
?>

<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">क्रियाकलाप विवरण</span></h3>

                <!-- My latest work -->
                <div class="galerie">
                    <p style="font-size:18px;">कार्यक्रम : <?php echo $program['name_np'] ?><br />

                    </p>
                    <?php 
                        echo isset($message)?$message:"";
                    ?>

                    <form action="http://localhost/pis-project/cp/dashboard.php?action=mainActivity&pid=<?php echo $program_code?>" method="post">

                        <table width="100%" align="center" border="1" class="table">

                            <tr>
                                <th  align="left"><span class="preeti">संकेत नम्बर</span></th>

                                <th ><span class="preeti">मुख्य क्रियाकलाप</span></th>
                                <th  >&nbsp;</th>
                                <th align="center"></th>
                                <th align="center"></th>
                            </tr>
                            <tr>
                                <th  align="left"><span class="preeti">
                                <input class="siddhi"  size="10" maxlength="50" type="text" name="txtmaincode" /></span></th>

                                <th  width="60%"><span class="preeti"><input type="text" class="preeti" size="30" maxlength="350" name="txtmainactivity" required  /></span></th>



                                <th colspan="3"><input type="submit" name="btnaddmainactivity" value="  सेभ गर्ने  "  style="width:150px;height:30px;"/> </th>
                           
                            </tr>
                            <?php
                            $sql = $dbc->selectMainActivity($_GET['pid']);
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><span class="siddhi"><?php echo $row["code"] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                <td align="center" ><p><a href="dashboard.php?action=editmainactivity&id=<?php echo $row['id']?>&p_id=<?php echo $program['id']?>&m_name=<?php echo $row['name_np']?>&m_code=<?php echo $row["code"];?>" class="edit">Edit</a></p></td>

                                <td align="center" ><p><a onclick="return validateForm()" href="dashboard.php?action=editmainactivity&type=del&id=<?php echo $row['id']?>&p_id=<?php echo $program['id']?>&m_name=<?php echo $row['name_np']?>" class="delete">Delete</a></p></td>
                                <td align="center" ><p><a href="dashboard.php?action=subActivity&pid=<?php echo $_GET['pid']?>&mid=<?php echo $row['id'] ?>" class="delete">Add Sub Activity</a></p></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </form>
                    <br />
                    <div class="cleaner">&nbsp;</div>
                </div>
                <!-- My latest work end -->
            </div>
        </div>
        <!-- Content left end -->

        <!-- Content right --><!-- Content right end -->
        <div class="cleaner">&nbsp;</div>
    </div>
</div>
<!-- Content box end -->