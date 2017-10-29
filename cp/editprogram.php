<?php 
    $id = $_GET["id"];
    $program_name = $_GET["program_name"];
    $exp_head_code = $_GET["exp_code"];
    if(isset($_POST["btnaddmainsubhead"])){
        $exp_head_code = $_POST["txtmainsubheadcode"];
        $program_name =$_POST["txtmainsubhead"];
        $result = $dbc->updateProgram($id,$exp_head_code,$program_name);
        echo $result;
        if($result){
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=program';</script>";            
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
                    
                    <!-- My latest work -->
                    <div class="galerie">
                <form name="editProgram" action="http://localhost/pis-project/cp/dashboard.php?action=editprogram&id=<?php echo $id;?>&exp_code=<?php echo $exp_head_code;?>&program_name=<?php echo $program_name;?>" method="post">
                    <table width="100%" align="center" border="0" class="table">
                            <tr>
                                <td  align="right"><span class="preeti">बजेट उपशीर्षक नम्बर</span></td>
                                <td  align="left"><p><input class="siddhi" value="<?php echo $exp_head_code;?>" size="20" maxlength="50" type="text" name="txtmainsubheadcode" required autofocus /></p></td>
                           
                                <td align="right"><span class="preeti">कार्यक्रम विवरण</span></td>
                                <td align="left"><p><input type="text" class="preeti" size="40" maxlength="350" name="txtmainsubhead" required value="<?php echo $program_name;?>" /></p></td>

                            </tr>
                           
                            <tr>
                                
                                <td align="center" colspan="4"><p><input type="submit" name="btnaddmainsubhead" value="  अपडेट गर्ने  " /> </p></td>
                            </tr>
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

<!-- Footer -->	
<div id="footer">
    
<div id="footer-in">
        <p class="footer-left">&copy; <a href="#">शिक्षा विभाग</a>, <span class="siddhi">2073/74. </span> </p>
         
        
        <p class="footer-right"> <a href="http://www.himalayanit.com.np/"> User Logged In : admin</a></p>
    </div>
        </div>
<!-- Footer end -->

</body>
</html>