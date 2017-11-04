<div id="skip-menu"></div>
<?php


$isExists = isset($_GET["id"])
            &&isset($_GET['pid'])
            &&isset($_GET['mid'])
            &&isset($_GET['sid'])
            &&isset($_GET["code"])
            &&isset($_GET["a_name"])
            &&isset($_GET["qty"]);
if($isExists){
    $id = $_GET["id"];
    $program_code = $_GET['pid'];
    $main_id = $_GET['mid'];
    $sub_id=$_GET['sid'];
    $activity_code =  $_GET["code"];
    $activity_name = $_GET["a_name"];
    $unit = $_GET["qty"];
    if(isset($_POST["btneditactivity"])){
      
        $activity_code = $_POST['txtactivitycode'];
        $activity_name = $_POST["txtactivity"];
        $unit = $_POST["txtunit"];
        $result = $dbc->updateActivity($id,$activity_code,$activity_name,$unit);
        if($result){
            $message= $activity_name." परिबर्तन भैसकेको छ!!";
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=activity&pid=".$program_code."&mid=".$main_id."&sid=".$sub_id."&message=".$message."';</script>";
        }else{
            $message= $activity_name." परिबर्तन हुन्न सकेन!!";
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=activity&pid=".$program_code."&mid=".$main_id."&sid=".$sub_id."&error=".$message."';</script>";
        }
    }
    $program = mysqli_fetch_array($dbc->selectOneProgram($program_code));
    $mainActivity = mysqli_fetch_array($dbc->selectOneMainActivity($main_id));
    $subActivity = mysqli_fetch_array($dbc->selectOneSubActivity($id));
}
else{
    echo "<script>window.history.back();</script>";
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
                        मुख्य क्रियाकलाप : <?php echo $mainActivity['name_np'] ?><br />
                        सहायक क्रियाकलाप : <?php echo $subActivity['name_np'] ?>                        </p>

                        <p><?php echo isset($message)?$message:"";?></p>
                    <form action="dashboard.php?action=editactivity&id=<?php echo $id;?>&code=<?php echo $activity_code?>&a_name=<?php echo $activity_name ?>&qty=<?php echo $unit ?>&pid=<?php echo $program_code?>&mid=<?php echo $main_id?>&sid=<?php echo $sub_id?>" method="post">

                        <table width="100%" align="center" border="1" class="table">

                            <tr>
     


                            <th  >&nbsp;</th>                           <th  align="right" colspan="5"><span class="preeti"><a href="subactivity.php">Back to Main Page</a></span></th>


                            </tr>
                            <tr>
                                <th  align="left"><span class="preeti">संकेत नम्बर</span></th>

                                <th ><span class="preeti">क्रियाकलाप</span></th>
                                <th ><span class="preeti">इकाइ</span></th>


                                <th  >&nbsp;</th>
                                <th align="center"></th>

                            </tr>
                            <tr>
                                <td align="left"><span class="preeti"><input  class="siddhi" value="<?php echo $activity_code?>" size="10" maxlength="50" type="text" name="txtactivitycode" /></span></td>

                                <td  width="60%"><span class="preeti"><input type="text" class="preeti" size="50" maxlength="350" value="<?php echo $activity_name?>" name="txtactivity" required  /></span></td>
                                <td  ><span class="preeti"><input type="text" class="preeti" size="20" maxlength="350" name="txtunit"  value="<?php echo $unit?>"/></span></td>


                                <td colspan="2"><input type="submit" name="btneditactivity" value="  अपडेट गर्ने  "  style="width:150px;height:30px;"/> </td>

                            </tr>
                            
                        </table>
                    </form>
                    <br />
                    <div class="cleaner">&nbsp;</div>
                </div>
                <!-- My latest work end -->
            </div>
        </div>
        <!-- Content left activity_codeend -->

        <!-- Content right --><!-- Content right end -->
        <div class="cleaner">&nbsp;</div>
    </div>
</div>
<!-- Content box end -->