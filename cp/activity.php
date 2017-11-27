
<div id="skip-menu"></div>
<?php
if(isset($_GET['message'])){
    $message = $utils->successMessage($_GET['message']);
}
if(isset($_GET['error'])){
    $message = $utils->errorMessage($_GET['error']);
}
if(isset($_GET['pid'])&&isset($_GET['mid'])&&isset($_GET['sid'])){
    $program_code = $_GET['pid'];
    $main_id = $_GET['mid'];
    $sub_id=$_GET['sid'];
    if(isset($_POST["btnaddactivity"])){
        $activity_code = $_POST["txtactivitycode"];
        $activity_name = $_POST["txtactivity"];
        $activity_name_en = $_POST["txtactivity_en"];
        $unit = $_POST["txtunit"];
        $result = $dbc->insertActivity($activity_code,$activity_name,$unit,$sub_id,$activity_name_en);
        if($result>0){
            $message= $utils->successMessage("क्रियाकलाप विवरण ".$activity_name." दर्ता भैसाकेको छ!");
        }
        else if($result==-1){
            $message = $utils->infoMessage(" क्रियाकलाप विवरण ".$activity_name." पहिलै दर्ता भैसाकेको छ!! पुन प्रयाश गर्र्नु होला!!");
        }
        else{
            $message = $utils->errorMessage(" क्रियाकलाप विवरण ".$activity_name." दर्ता हुन्न सकेना!  ्पुन प्रयाश गर्र्नु होला!");
        }
    }
    $program = mysqli_fetch_array($dbc->selectOneProgram($program_code));
    $mainActivity = mysqli_fetch_array($dbc->selectOneMainActivity($main_id));
    $subActivity = mysqli_fetch_array($dbc->selectOneSubActivity($sub_id));
}else{
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
                    <form action="dashboard.php?action=activity&pid=<?php echo $program_code."&mid=".$main_id."&sid=".$sub_id;?>" method="post">

                        <table align="center" border="1" class="table">

                            <tr>
     


                            <th  >&nbsp;</th>                           <th  align="right" colspan="5"><span class="preeti"><a href="#" onclick="return back();"> अघिल्लो पृष्टमा जाने </a></span></th>


                            </tr>
                            <tr>
                                <th align="left"><span class="preeti">संकेत नं.</span></th>

                                
                                <th><span class="preeti">क्रियाकलाप</span></th>
                                <th><span class="preeti">क्रियाकलाप (अँग्रेजी)</span></th>
                                <th><span class="preeti">इकाइ</span></th>


                                <th  >&nbsp;</th>
                                <th align="center"></th>

                            </tr>
                            <tr>
                                <th  align="left"><span class="preeti"><input class="siddhi"  size="10"
                                style="width:30px;"
                                 maxlength="20" type="text" name="txtactivitycode" /></span></th>

                                <th><span class="preeti"><input type="text" class="preeti" size="50"
                                
                                style="width:250px;"
                                 maxlength="150" name="txtactivity" required  /></span></th>
                                <th  ><span class="preeti"><input type="text" style="width:250px;" class="preeti" size="50" maxlength="150" name="txtactivity_en" required  /></span></th>
                                <th  ><span class="preeti"><input type="text" style="width:30px;" class="preeti" size="20" maxlength="50" name="txtunit"  /></span></th>


                                <th colspan="2"><input type="submit" name="btnaddactivity" value="  सेभ गर्ने  "  style="width:150px;height:30px;"/> </th>

                            </tr>
                            <?php $sql = $dbc->selectActivity($_GET['sid']);
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><span class="siddhi"><?php echo $row['code'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['name_en'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['unit'] ?></span></td>

                                <td align="center" ><p><input type="button" onclick="window.location.href='dashboard.php?action=editactivity&id=<?php echo $row['id'];?>&code=<?php echo $row['code'] ?>,&a_name=<?php echo $row['name_np'] ?>&a_name_en=<?php echo $row['name_en'] ?>&qty=<?php echo $row['unit'] ?>&pid=<?php echo $program_code?>&mid=<?php echo $main_id?>&sid=<?php echo $sub_id?>'" class="edit" value=" सम्पादन गर्ने "></p></td>

                                <td align="center" ><p><input type="button"  onclick="return validateForm()" value=" मेट्ने " disabled class="delete"/></p></td>

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