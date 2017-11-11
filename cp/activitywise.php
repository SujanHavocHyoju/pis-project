<?php $sql = $dbc->selectAllActivities() ?>

<?php if (isset($_POST['btnfind'])) {
    $aid = $_POST['activitycode'];
    $acode = mysqli_fetch_assoc($dbc->selectActivityCode($aid));
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=activitywisereport&aid=" . $aid . "&acode=" . $acode['code']. "';</script>";
} ?>

<div id="skip-menu"></div>

<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px">क्रियाकलाप छान्नुहोस</span></h3>

                <!-- My latest work -->
                <div class="galerie">


                    <form name="activitywise" method="POST">
                        <table align="center" width="50%" class="table">
                            <tr>
                                <td width="50%" align="right"><p class="preeti">क्रियाकलाप &nbsp;</p></td>
                                <td>:</td>
                                <td width="50%">
                                    <select name="activitycode" class="preeti" style="width:300px; ">
                                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['code'] . ' ' . $row['name_np'] ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                            </tr>


                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><input type="submit" name="btnfind" value="  प्रतिवेदन हेर्ने  "/></td>
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