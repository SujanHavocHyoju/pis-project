<?php
if(isset($_GET['message'])){
    $message = $utils->successMessage($_GET['message']);
}
if(isset($_GET['error'])){
    $message = $utils->errorMessage($_GET['error']);
}
    if(isset($_POST['addsec'])){
        $sn =$_POST['txtofficecode'];
        $office_name_np=$_POST['txtofficename'];
        $office_name_ep=$_POST['txtEofficename'];
        $region = $_POST['txtregion'];
        $result = $dbc->insertEduOffice($sn,$office_name_np,$office_name_ep,$region);
        if($result>0){
            $message = $utils->successMessage($utils->success(" शैक्षिक कार्यालय प्रविष्टि ",$office_name_np));
        }
        else if($result==-1){
            $message = $utils->infoMessage($utils->alreadyExists(" शैक्षिक कार्यालय प्रविष्टि ",$office_name_np));
        }
        else{
            $message = $utils->errorMessage($utils->error(" शैक्षिक कार्यालय प्रविष्टि ",$office_name_np));
        }

    }
    if(isset($_POST['btnsearch'])){
        $sql = $dbc->searchOffice($_POST['txtsearch']);
    }else{
        $sql = $dbc->selectEduOffice();
    }
?>
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">शैक्षिक कार्यालय प्रविष्टि </span></h3>

                <!-- My latest work -->
                <div class="galerie">




                    <form action="http://localhost/pis-project/cp/dashboard.php?action=eduoffice" method="post">
                        <table width="80%" align="center" border="0" class="table">
                            <tr>
                                <td width="35%" align="right"><span class="preeti">सि. नं.</span></td>
                                <td width="65%" align="left"><p><input class="siddhi"  size="40" maxlength="50" type="text" name="txtofficecode" " /></p></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">कार्यालयको नाम </span></td>
                                <td align="left"><p><input type="text" class="preeti" size="40" maxlength="500" name="txtofficename" required autofocus /></p></td>

                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">कार्यालयको नाम (अंग्रेजीमा)</span></td>
                                <td align="left"><p><input type="text" class="preeti" size="40" maxlength="500" name="txtEofficename" required autofocus /></p></td>

                            </tr>
                            <tr>
                            <td align="right"><span class="preeti">जिल्ला</span></td>
                            <td align="left"><p>
                                    <select name="txtregion"  class="preeti" style="width:232px; ">
                                  
                                        <?php 
                                        $res=$dbc->selectDistrict();
                                        while($row=mysqli_fetch_array($res)){
                                            ?> 
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name_np'];?></option>    
                                         <?php }?>

                                    </select>
                                </p></td>

                        </tr>



                            <tr>
                                <td>&nbsp;</td>
                                <td><p><input type="submit" name="addsec" value=" रेकर्ड सेभ गर्ने " /></p></td>
                            </tr>
                        </table>
                    </form>
                    <br />

                    <form name="searchsection" action="http://localhost/pis-project/cp/dashboard.php?action=eduoffice" method="post">
                        <table width="80%" align="center" border="1" class="table">
                            <tr>
                                <td align="right">
                                    नामको आधारमा खोजी गर्ने : <input type="text" size="30" maxlength="100" name="txtsearch" class="preeti" />
                                    <input type="submit" name="btnsearch" disabled value=" खोजी गर्ने " />


                                </td>

                            </tr>
                        </table>
                    </form>
                    <h2><?php echo isset($message)?$message:'';?></h2>

                    <table width="100%" align="center" border="1" class="table">
                    <tr>
                    <th><span class="preeti">सि. नं.</span></th>
                    <th ><span class="preeti">कार्यालयको नाम</span></th>
                    <th ><span class="preeti">कार्यालयको नाम (अंग्रेजीमा)</span></th>
                    <th ><span class="preeti">विकास क्षेत्र</span></th>
                    <th ><span class="preeti">जिल्ला</span></th>
                    <th ></th>
                    <th ></th>


                </tr>
                        <?php 
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                            <td><span class="siddhi"><?php echo $row["id"];?></span></td>
                            <td ><span class="preeti"><?php echo $row["name_np"];?></span></td>
                            <td ><span class="preeti"><?php echo $row["name_en"];?></span></td>
                            <td ><span class="preeti"><?php echo $row["d_name"];?></span></td>
                            <td ><span class="preeti"><?php echo $row["di_name"];?></span></td>


                            <td align="center" width="10%"><p><input type="button" onclick="window.location.href='dashboard.php?action=editeduoffice&id=<?php echo $row['id'];?>'"  value=" सम्पादन गर्ने "/></p></td>
                            <td align="center" width="10%"><p><input type="button" onclick="return validateForm()"  class="delete" value=" मेट्ने "/></p></td>
                        </tr>
                            <?php } ?>
                        
                    </table>

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