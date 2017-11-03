<?php 
    if(isset($_GET['message'])){
        $message =$utils->successMessage($_GET['message']);
    }
    if(isset($_GET['error'])){
        $message = $utils->errorMessage($_GET['error']);
    }
    if(isset($_POST["btnaddmainsubhead"])){
        $exp_head_code = $_POST["txtmainsubheadcode"];
        $program_name =$_POST["txtmainsubhead"];
        $result = $dbc->insertProgram($exp_head_code,$program_name);
        if($result>0){
            $message =$utils->successMessage($program_name . ' दर्ता भैसाकेको छ!');
        }
        else if($result==-1){
            $message =$utils->infoMessage(' बजेट उपशीर्षक नम्बर '.$exp_head_code. ' पहिलै हालि सकेको छ!! पुन प्रयाश गर्र्नु होला!');
        }else{
            $message = $utils->errorMessage('दर्ता हुन्न सकेना!  ्पुन प्रयाश गर्र्नु होला!');
        }
    }
}
?>
<div id="skip-menu"></div>

<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">कार्यक्रम विवरण</span></h3>
<<<<<<< HEAD
                    <?php echo isset($message)?$message:'';?>
                    <!-- My latest work -->
                    <div class="galerie">
                <form name="addProgram" action="http://localhost/pis-project/cp/dashboard.php?action=program" method="post">
                    <table width="100%" align="center" border="0" class="table">
=======

                <!-- My latest work -->
                <div class="galerie">
                    <form name="addProgram" action="http://localhost/pis-project/cp/dashboard.php?action=program" method="post">
                        <table width="100%" align="center" border="0" class="table">
>>>>>>> b5301f022ba99044b45f1ae6e92ff7e97cf7e3ad
                            <tr>
                                <td  align="right"><span class="preeti">बजेट उपशीर्षक नम्बर</span></td>
                                <td  align="left"><p><input class="siddhi"  size="20" maxlength="50" type="text" name="txtmainsubheadcode" required autofocus /></p></td>

                                <td align="right"><span class="preeti">कार्यक्रम विवरण</span></td>
                                <td align="left"><p><input type="text" class="preeti" size="40" maxlength="350" name="txtmainsubhead" required  /></p></td>

                            </tr>

                            <tr>

                                <td align="center" colspan="4"><p><input type="submit" name="btnaddmainsubhead" value="  सेभ गर्ने  " /> </p></td>
                            </tr>
                        </table>
                    </form>


                    <form name="searchstaff" action="" method="post">
                        <table width="100%" align="center" border="1" class="table">
                            <tr>
                                <td align="right">
                                    नामको आधारमा खोजी गर्ने : <input type="text" size="30" maxlength="100" name="txtsearch" class="preeti" />
                                    <input type="submit" name="btnsearch" value="खोजी गर्ने" />


                                </td>

                            </tr>
                        </table>
                    </form>




                    <form name="del" action="" method="post">
                        <table width="100%" align="center" border="1" class="table">

                            <tr>
                                <th width="10%"><span class="preeti">बजेट उपशीर्षक नम्बर</span></th>
                                <th><span class="preeti">कार्यक्रम</span></th>


                                <th>&nbsp;</th>
                                <th align="center"><input type="submit" value="मेट्ने" name="btnDelete" onclick="return validateForm()" id="btnDelete" /></th>
                            </tr>
                            <?php
                            $i = 1;
                            $sql = $dbc->selectProgram();
                            while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><span class="siddhi"><?php echo $row["exp_head_code"];?></span></td>
                                    <td width="25%"><span class="preeti"><?php echo $row["name_np"];?></span></td>

                                    <td align="center" width="8%"><p><a href="dashboard.php?action=editprogram&id=<?php echo $row["id"];?>&exp_code=<?php echo $row["exp_head_code"];?>&program_name=<?php echo $row["name_np"];?>" class="edit">सम्पादन गर्ने</a></p></td>

                                    <td align="center" width="8%"><p><input type="checkbox" name="delrec[]" value="350806" /></p></td>
                                </tr>
                                <?php
                            }
                            ?>

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

<hr class="noscreen" />

</body>
</html>