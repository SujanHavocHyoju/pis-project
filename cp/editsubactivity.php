<div id="skip-menu"></div>
<?php
if(isset($_GET['id'])&&isset($_GET["s_code"])&&isset($_GET["s_name"])){
    $program_code = $_GET['pid'];
    $main_id = $_GET['mid'];
    $id= $_GET['id'];
    $sub_activity_code = $_GET["s_code"];
    $sub_activity_name = $_GET["s_name"];
    $sub_activity_name_en = $_GET["s_name_en"];
    if(isset($_POST["btnaddsubactivity"])){
        $sub_activity_code =  $_POST["txtsubactivitycode"];
        $sub_activity_name = $_POST["txtsubactivity"];
        $sub_activity_name_en = $_POST["txtsubactivity_en"];
        $result = $dbc->updateSubActivity($id,$sub_activity_code,$sub_activity_name,$sub_activity_name_en);
        echo $result;
        if($result>0){
            $message= " सहायक क्रियाकलाप विवरण ".$sub_activity_name." परिबर्तन भैसकेको छ!!";
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=subActivity&pid=".$program_code."&mid=".$main_id."&message=".$message."';</script>";
        }else{
            $message=" सहायक क्रियाकलाप विवरण ".$sub_activity_name." परिबर्तन हुन्न सकेन!!";
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=subActivity&pid=".$program_code."&mid=".$main_id."&error=".$message."';</script>";
        }
    }
    $program = mysqli_fetch_array($dbc->selectOneProgram($program_code));
    $mainActivity = mysqli_fetch_array($dbc->selectOneMainActivity($main_id));
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
                <h3 class="line"><span class="preeti" style="font-size:23px;">सहायक क्रियाकलाप विवरण</span></h3>

                <!-- My latest work -->
                <div class="galerie">
                    <p style="font-size:18px;">कार्यक्रम : <?php echo $program['name_np'] ?><br/>
                        मुख्य क्रियाकलाप : <?php echo $mainActivity['name_np'] ?>                        </p>

                    <p><?php echo isset($message)?$message:"";?></p>
                    <form  action="
                    dashboard.php?action=editsubactivity&id=<?php echo $id ?>&s_code=<?php echo $sub_activity_code;?>&s_name=<?php echo $sub_activity_name ?>&pid=<?php echo $program['id'] ?>&mid=<?php echo $mainActivity['id'] ?>
                    " method="post">

                        <table width="100%" align="center" border="1" class="table">

                            <tr>
                                <th align="right" colspan="5"><span class="preeti"><a href="mainactivity.php">Back to Main Page</a></span>
                                </th>


                            </tr>
                            
                            <tr>
                                <td align="left"><span class="preeti"><input class="siddhi" size="10" maxlength="50" 
                                                                             type="text"
                                                                             
                                                                             name="txtsubactivitycode"
                                                                             value="<?php echo $sub_activity_code?>"/></span></td>

                                <td width="60%"><span class="preeti"><input type="text" class="preeti" size="30"
                                                                            maxlength="350" name="txtsubactivity"
                                                                            value="<?php echo $sub_activity_name?>"
                                                                            required/></span></td>
                                <td width="60%"><span class="preeti"><input type="text" class="preeti" size="30"
                                                                            maxlength="350" name="txtsubactivity_en"
                                                                            value="<?php echo $sub_activity_name_en;?>"
                                                                            required/></span></td>                          

                                <td colspan="3"><input type="submit" name="btnaddsubactivity" value="  अपडेट गर्ने  "
                                                       style="width:150px;height:30px;"/></td>
                            </tr>
                        
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