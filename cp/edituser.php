<?php
    if(isset($_GET['id'])){
        $sql = $dbc->selectOneUser($_GET['id']);
        $row = mysqli_fetch_array($sql);
        $id = $_GET['id'];
        $username=$row['username'];
        $fullname=$row['fullname'];
        $user_type=$row['user_type'];
        $office_id = $row['office_id'];
             
        echo '
        <script>
          $(document).ready(function(){
              $("#office_type option[value='.$user_type.']").attr("selected","selected");
              $.ajax({
                url:"officelist.php",
                type : "POST",
                data :"data="+'.$user_type.',
                success: function(response){
                            $("#txtofficecode").html(response);
                            $("#txtofficecode option[value='.$office_id.']").attr("selected","selected");
                    
                }
                }); 
                
          });
        </script>'; 
    
        // $result = $dbc->insertEduOffice($sn,$office_name_np,$office_name_ep,$region);
        // if($result>0){
        //     $message = $office_name_np." has been added";
        // }
    }
    else{
        $utils->backPage();
    }
    if(isset($_POST['addsec'])){
        $username=$_POST['txtuname'];
        $fullname=$_POST['txtname'];
        $user_type = $_POST['user_type'];
        $office_id = $_POST['txtofficecode'];
        $result = $dbc->updateUser($id,$username,$fullname,$user_type,$office_id);
        if($result>0){
            $message = $utils->successOnEdit("",$username);
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=users&message=".$message."';</script>";
        }else{
            $message = $utils->errorOnEdit("",$username);
            echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=users&error=".$message."';</script>";
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




                    <form action="http://localhost/pis-project/cp/dashboard.php?action=edituser&id=<?php echo $id;?>" method="post">
                        <table width="80%" align="center" border="0" class="table">
                            <tr>
                                <td width="35%" align="right"><span class="preeti">Username</span></td>
                                <td width="65%" align="left"><p><input size="20" maxlength="50" type="text" 
                                style="height:20px; width:150px;"
                                name="txtuname"  style="height:30px;"
                                value="<?php echo $username;?>"
                                /></p></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">Full Name</span></td>
                                <td align="left"><p><input size="20" maxlength="50" 
                                style="height:20px; width:150px;"
                                type="text" name="txtname" style="height:30px;"
                                value="<?php echo $fullname;?>"
                                /></p></td>

                            </tr>
                            
                            <tr>
                                <td align="right"><span class="preeti">Office Name </span></td>
                                <td align="left"><p>
                                        <select name="user_type" style="height:30px; width:250px;" id='office_type'>
                                    <option selected disabled>Select Office</option>
                                    <option value="1">Education Office</option>
                                    <option value="2">Local Office</option>
                                </select>
                                     
                                    <select name="txtofficecode" style="height:30px; width:250px;" id="txtofficecode">
                                           
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

<script>
    $("#office_type").change(function(){
        var office_type = $("#office_type").val();
        $.ajax({
            url:"officelist.php",
            type : 'POST',
            data :"data="+office_type,
            success: function(response){
                        $('#txtofficecode').html(response);
                
            }
        });
    });
</script>