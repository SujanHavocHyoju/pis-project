<div id="skip-menu"></div>
<?php
$program = mysqli_fetch_array($dbc->selectOneProgram($_GET['pid']));
$mainActivity = mysqli_fetch_array($dbc->selectOneMainActivity($_GET['mid']));
$subActivity = mysqli_fetch_array($dbc->selectOneSubActivity($_GET['sid']));
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


                    <form name="addstaff" action="" method="post">

                        <table width="100%" align="center" border="1" class="table">

                            <tr>
                                <th  align="right" colspan="5"><span class="preeti"><a href="subactivity.php">Back to Main Page</a></span></th>


                            </tr>
                            <tr>
                                <th  align="left"><span class="preeti">संकेत नम्बर</span></th>

                                <th ><span class="preeti">क्रियाकलाप</span></th>
                                <th ><span class="preeti">इकाइ</span></th>


                                <th  >&nbsp;</th>
                                <th align="center"></th>

                            </tr>
                            <tr>
                                <th  align="left"><span class="preeti"><input class="siddhi"  size="10" maxlength="50" type="text" name="txtactivitycode" /></span></th>

                                <th  width="60%"><span class="preeti"><input type="text" class="preeti" size="50" maxlength="350" name="txtactivity" required  /></span></th>
                                <th  ><span class="preeti"><input type="text" class="preeti" size="20" maxlength="350" name="txtunit"  /></span></th>


                                <th colspan="2"><input type="submit" name="btnaddactivity" value="  सेभ गर्ने  "  style="width:150px;height:30px;"/> </th>

                            </tr>
                            <?php $sql = $dbc->selectActivity($_GET['sid']);
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><span class="siddhi"><?php echo $row['code'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                <td><span class="siddhi"></span></td>

                                <td align="center" ><p><a href="#" class="edit">Edit</a></p></td>

                                <td align="center" ><p><a onclick="return validateForm()" href="deluser.php?id=1.0" class="delete">Delete</a></p></td>

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