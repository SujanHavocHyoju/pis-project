<div id="skip-menu"></div>

<?php 
global $program_code,$message;
$id = $_GET["id"];
$main_activity_code = $_GET["m_code"];
$main_activity_name = $_GET["m_name"];
$program_code = $_GET["p_id"];
if(isset($_GET["type"])){
$main_activity_code = $_GET["id"];
$result = $dbc->deleteMainActivity($main_activity_code);
echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=mainActivity&pid=".$program_code."';</script>";
}
   else{
    if(isset($_POST["btnaddmainactivity"])){
            $main_activity_code =$_POST["txtmaincode"];
            $main_activity_name = $_POST["txtmainactivity"];
            $result = $dbc->updateMainActivity($id,$main_activity_code,$main_activity_name);
            if($result){
                $message= $main_activity_name." has been update successfully";
                echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=mainActivity&pid=".$program_code."';</script>";
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

                    <form action="dashboard.php?action=editmainactivity&id=<?php echo $id?>&p_id=<?php echo $program['id']?>&m_name=<?php echo $main_activity_name?>&m_code=<?php echo $main_activity_code;?>" method="post">

                        <table width="100%" align="center" border="1" class="table">
                            <tr>
                                <td align="left"><span class="preeti">
                                <input class="siddhi"  size="10" maxlength="50" type="text" name="txtmaincode" value="<?php echo $main_activity_code?>"></span></td>

                                <td  width="60%"><span class="preeti"><input type="text" class="preeti" size="30" maxlength="350" name="txtmainactivity" value="<?php echo $main_activity_name?>" required  /></span></td>



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