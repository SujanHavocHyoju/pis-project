<?php
    if(isset($_GET['id'])){
        $sql = $dbc->selectOneEduOffice($_GET['id']);
        $row = mysqli_fetch_array($sql);

        $sn =$row['id'];
        $office_name_np=$row['name_np'];
        $office_name_ep=$row['name_en'];
        $region_id = $row['development_region_id'];
             
        echo '
        <script>
          $(document).ready(function(){
              $("#regions option[value='.$region_id.']").attr("selected","selected");
          });
        </script>'; 
    
        // $result = $dbc->insertEduOffice($sn,$office_name_np,$office_name_ep,$region);
        // if($result>0){
        //     $message = $office_name_np." has been added";
        // }
    }
    if(isset($_POST['addsec'])){
        $office_name_np=$_POST['txtofficename'];
        $office_name_ep=$_POST['txtEofficename'];
        $region = $_POST['txtregion'];
        $result = $dbc->updateEduOffice($sn,$office_name_np,$office_name_ep,$region);
        echo $result;
        if($result>0){
            $message = $office_name_np." has been added";
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=eduoffice';</script>";
        }
    }
?>
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">कार्यालय विवरण </span></h3>

                <!-- My latest work -->
                <div class="galerie">




                    <form action="http://localhost/pis-project/cp/dashboard.php?action=editeduoffice&id=<?php echo $sn;?>" method="post">
                        <table width="80%" align="center" border="0" class="table">
                            <tr>
                                <td width="35%" align="right"><span class="preeti">सि नं</span></td>
                                <td width="65%" align="left"><p><input class="siddhi" disabled size="40" maxlength="50" type="text" name="txtofficecode" value="<?php echo $sn;?>"/></p></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">कार्यालयको नाम </span></td>
                                <td align="left"><p><input type="text" 
                                value="<?php echo $office_name_np;?>"
                                class="preeti" size="40" maxlength="500" name="txtofficename" required autofocus /></p></td>

                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">Office Name </span></td>
                                <td align="left"><p><input
                                value="<?php echo $office_name_ep;?>"
                                 type="text" class="preeti" size="40" maxlength="500" name="txtEofficename" required autofocus /></p></td>

                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">विकास क्षेत्र </span></td>
                                <td align="left"><p>
                                        <select name="txtregion" id="regions"  class="preeti" style="width:232px; ">

                                            <option value="1">पुर्वान्चल</option>
                                            <option value="2">मध्यमान्चल</option>
                                            <option value="3">पश्चिमान्चल</option>
                                            <option value="4">मध्य पश्चिमान्चल</option>
                                            <option value="5">सुदुर पश्चिमान्चल</option>


                                        </select>
                                    </p></td>

                            </tr>




                            <tr>
                                <td>&nbsp;</td>
                                <td><p><input type="submit" name="addsec" value=" सेभ गर्ने " /></p></td>
                            </tr>
                        </table>
                    </form>
                    <br />
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