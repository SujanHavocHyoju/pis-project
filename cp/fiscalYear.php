<?php 
    if(isset($_POST['btnaddfiscalyear'])){
        $result = $dbc->insertFiscalYear($_POST['txtfiscalyear']);
        if($result>0){
            $message = $utils->successMessage($utils->success(" आर्थिक वर्ष प्रविष्टि ",$_POST['txtfiscalyear']));
        }else if($result==-1){
            $message = $utils->infoMessage($utils->alreadyExists(" आर्थिक वर्ष प्रविष्टि ",$_POST['txtfiscalyear']));
        }else{
            $message = $utils->errorMessage($utils->error(" आर्थिक वर्ष प्रविष्टि ",$_POST['txtfiscalyear']));
        }
    }
?>
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">आर्थिक वर्ष प्रविष्टि </span></h3>

                <!-- My latest work -->
                <div class="galerie">
                <p><?php echo isset($message)?$message:"";?></p>
                    <form name="addstaff" action="http://localhost/pis-project/cp/dashboard.php?action=fiscalYear" method="post">
                        <table width="100%" align="center" border="0" class="table">
                            <tr>
                                <td  align="right"><span class="preeti">आर्थिक वर्ष</span></td>
                                <td  align="left"><p><input class="siddhi"  size="20" maxlength="50" type="text" name="txtfiscalyear" required autofocus /></p></td>

                                <td align="right"><span class="preeti"><input type="submit" name="btnaddfiscalyear" value="  सेभ गर्ने  " /></span></td>
                                <td align="left"><p></p></td>

                            </tr>


                        </table>
                    </form>






                    <form name="del" action="" method="post">
                        <table width="100%" align="center" border="1" class="table">
                        <tr>
                                    <th width="10%"><span class="preeti">सि.नं.</span></th>
                                    <th><span class="preeti">आर्थिक वर्ष</span></th>
    
    
                                    <th align="center"><input type="submit" value="मेट्ने" name="btnDelete" onclick="return validateForm()" id="btnDelete" /></th>
                                </tr>
                            <?php 
                                $sql=$dbc->selectFiscalYear();
                                while($row=mysqli_fetch_array($sql)){?>
                                 
                                <tr>
                                    <td><span class="siddhi"><?php echo $row['id'];?></span></td>
                                    <td width="25%"><span class="preeti"><?php echo $row['fiscal_year'];?></span></td>
    
    
                                    <td align="center" width="8%"><p><input type="checkbox" name="delrec[]" value="2073/74" /></p></td>
                                </tr>
                                <?php }
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