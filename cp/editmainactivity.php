<div id="skip-menu"></div>

<?php 
global $program_code,$message;
if(!isset($_GET['id'])){
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=programlist&message=';</script>";
}else{
    $id = $_GET["id"];
    $result = $dbc->selectOneMainActivity($id);
    $row = mysqli_fetch_array($result);
    $main_activity_code = $row["code"];
    $main_activity_name = $row["name_np"];
    $main_activity_name_en = $row['name_en'];
    $program_code = $row["program_id"];
}
if(isset($_GET["type"])){
    $main_activity_code = $_GET["id"];
    $result = $dbc->deleteMainActivity($main_activity_code);
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=mainActivity&pid=".$program_code."';</script>";
}
   else{
    if(isset($_POST["btnaddmainactivity"])){
            $main_activity_code =$_POST["txtmaincode"];
            $main_activity_name = $_POST["txtmainactivity"];
            $main_activity_name_en = $_POST["txtmainactivity_en"];
            $result = $dbc->updateMainActivity($id,$main_activity_code,$main_activity_name,$main_activity_name_en);
            if($result>0){
                $message= $main_activity_name." परिबर्तन भैसकेको छ!!";
                echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=mainActivity&pid=".$program_code."&message=".$message."';</script>";
            }
            else{
                $message= $main_activity_name." परिबर्तन हुन्न सकेन!!";
                echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=mainActivity&pid=".$program_code."&error=".$message."';</script>";
            }
        }
   }
    $sql = $dbc->selectOneProgram($program_code);
    $program = mysqli_fetch_array($sql);
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
                    <p style="font-size:18px;">कार्यक्रम : <?php echo $program["name_np"] ?><br />

                    </p>
                    <p><?php echo isset($message)?$message:"";?></p>

                    <form action="dashboard.php?action=editmainactivity&id=<?php echo $id?>" method="post">

                        <table width="100%" align="center" border="1" class="table">
                            <tr>
                                <td align="left"><span class="preeti">
                                <input class="siddhi"  size="10" maxlength="50" type="text" name="txtmaincode" value="<?php echo $main_activity_code?>"></span></td>

                                <td  width="60%"><span class="preeti"><input type="text" class="preeti" size="30" maxlength="350" name="txtmainactivity" value="<?php echo $main_activity_name?>" required  /></span></td>

                                <td  width="60%"><span class="preeti"><input type="text" class="preeti" size="30" maxlength="350" name="txtmainactivity_en" value="<?php echo $main_activity_name_en?>" required  /></span></td>

                                <td colspan="3"><input type="submit" name="btnaddmainactivity" value="  अपडेट गर्ने  "  style="width:150px;height:30px;"/> </td>
                           
                            </tr>
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