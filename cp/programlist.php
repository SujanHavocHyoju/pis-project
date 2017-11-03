<?php 
    if(isset($_GET['message'])){
        $message = $utils->infoMessage($_GET['message']);
    }
?>

<div id="skip-menu"></div>

<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">कार्यक्रम अनुसार क्रियाकलाप विवरण प्रविष्टि गर्ने</span></h3>

                <!-- My latest work -->
                <div class="galerie">
                <?php 
                        echo isset($message)?$message:"";
                        
                    ?>
                    <table width="100%" align="center" border="1" class="table">

                        <tr>
                            <th width="10%"><span class="preeti">बजेट उपशीर्षक नम्बर</span></th>
                            <th><span class="preeti">कार्यक्रम</span></th>

                            <th>&nbsp;</th>

                        </tr>
                            <?php
                            $sql = $dbc->selectProgram();
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                        <tr>
                            <td><span class="siddhi"><?php echo $row['exp_head_code'] ?></span></td>
                            <td width="50%"><span class="preeti"><?php echo $row['name_np'] ?></span></td>

                            <td align="center" ><p><a href="dashboard.php?action=mainActivity&pid=<?php echo $row['id'] ?>" class="edit">क्रियाकलाप विवरण प्रविष्टि गर्ने</a></p></td>
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