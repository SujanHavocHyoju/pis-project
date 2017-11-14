<div id="skip-menu"></div>
<?php
if(isset($_GET['message'])){
    $message= $utils->successMessage($_GET['message']);
}
if(isset($_GET['error'])){
    $message= $utils->successMessage($_GET['error']);
}
if(isset($_GET['pid'])||isset($_GET['mid'])){
    $program_code = $_GET['pid'];
    $main_id = $_GET['mid'];
    if(isset($_POST["btnaddsubactivity"])){
        $sub_activity_code =  $_POST["txtsubactivitycode"];
        $sub_activity_name = $_POST["txtsubactivity"];
        $sub_activity_name_en = $_POST["txtsubactivity_en"];
        $result = $dbc->insertSubActivity($sub_activity_code,$sub_activity_name,$main_id,$sub_activity_name_en);
        if($result>0){
            $message= $utils->successMessage(" सहायक क्रियाकलाप विवरण ".$sub_activity_name." दर्ता भैसाकेको छ!");
        }
        else if($result == -1){
            $message= $utils->infoMessage(" सहायक क्रियाकलाप विवरण ".$sub_activity_name." पहिलै दर्ता भैसाकेको छ!! पुन प्रयाश गर्र्नु होला!!");
        }else{
            $message= $utils->errorMessage(" सहायक क्रियाकलाप विवरण ".$sub_activity_name." दर्ता हुन्न सकेना!  ्पुन प्रयाश गर्र्नु होला!");
        }
    }
    $program = mysqli_fetch_array($dbc->selectOneProgram($program_code));
    $mainActivity = mysqli_fetch_array($dbc->selectOneMainActivity($main_id));
}
else{
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=programlist';</script>";
}
?>
<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">सहायक क्रियाकलाप विवरण</span></h3>

                <!-- My latest work -->
                <div class="galerie">
                    <p style="font-size:18px;">कार्यक्रम : <?php echo $program['name_np'] ?><br/>
                        मुख्य क्रियाकलाप : <?php echo $mainActivity['name_np'] ?>                        </p>

                    <p><?php echo isset($message)?$message:"";?></p>
                    <form  action="http://localhost/pis-project/cp/dashboard.php?action=subActivity&pid=<?php echo $program_code."&mid=".$main_id?>" method="post">

                        <table width="100%" align="center" border="1" class="table">

                            <tr>
                                <th align="right" colspan="5"><span class="preeti"><a href="mainactivity.php">Back to Main Page</a></span>
                                </th>


                            </tr>
                            <tr>
                                <th align="left"><span class="preeti">संकेत नम्बर</span></th>

                                <th><span class="preeti">सहायक क्रियाकलाप</span></th>

                                <th><span class="preeti">सहायक क्रियाकलाप (अँग्रेजी)</span></th>
                                <th>&nbsp;</th>
                                <th align="center"></th>
                                <th align="center"></th>
                            </tr>
                            <tr>
                                <th align="left"><span class="preeti"><input class="siddhi" size="10" maxlength="50"
                                                                             type="text"
                                                                             name="txtsubactivitycode"/></span></th>

                                <th width="60%"><span class="preeti"><input type="text" class="preeti" size="30"
                                                                            maxlength="350" name="txtsubactivity"
                                                                            required/></span></th>

                                <th width="60%"><span class="preeti"><input type="text" class="preeti" size="30"
                                                                            maxlength="350" name="txtsubactivity_en"
                                                                            required/></span></th>
                                <th colspan="3"><input type="submit" name="btnaddsubactivity" value="  सेभ गर्ने  "
                                                       style="width:150px;height:30px;"/></th>
                            </tr>
                            <?php
                            $sql = $dbc->selectSubActivity($_GET['mid']);
                            
                            while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><span class="siddhi"><?php echo $row["code"] ?></span></td>
                                    <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                    <td><span class="siddhi"><?php echo $row['name_en'] ?></span></td>
                                    <td align="center"><p><a href="dashboard.php?action=editsubactivity&id=<?php echo $row["id"] ?>&s_code=<?php echo $row["code"];?>&s_name=<?php echo $row['name_np'] ?>&pid=<?php echo $program['id'] ?>&s_name_en=<?php echo $row['name_en']; ?>&mid=<?php echo $mainActivity['id']?>" class="edit">Edit</a></p>
                                    </td>

                                    <td align="center"><p><a onclick="return validateForm()" href="#"
                                                             class="delete">Delete</a></p></td>
                                    <td align="center"><p><a href="dashboard.php?action=activity&pid=<?php echo $_GET['pid']?>&mid=<?php echo $_GET['mid'] ?>&sid=<?php echo $row['code']?>" class="delete">Add
                                                Activity</a></p></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </form>
                    <br/>
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