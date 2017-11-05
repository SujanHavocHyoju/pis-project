<?php 
    if(isset($_GET['type'])){
        $id = $_GET['id'];
        $ut= $_GET['ut'];
        if($ut!=0){
            $result = $dbc->deleteUser($id);
            $message = $utils->successMessage("प्रयोगकर्ता खाता हतैईको छ!");
        }
    }
    if(isset($_GET['message'])){
        $message = $utils->infoMessage($_GET['message']);
    }
    if(isset($_GET['error'])){
        $message = $utils->errorMessage($_GET['error']);
    }
    if(isset($_POST['adduser'])){
        $username = $_POST['txtuname'];
        $password = $_POST['txtupass'];
        $full_name = $_POST['txtname'];
        if(!isset($_POST['txtofficecode'])){
            $message = "Select office name";
        }else{
            $user_type = $_POST['user_type'];
            $office_id = $_POST['txtofficecode'];
            $result = $dbc->insertUser($username,$password,$full_name,$user_type,$office_id);
            if($result>0){
                $message = $utils->successMessage($full_name." दर्ता भैसाकेको छ!");
            }
            else if($result == -1){
                $message =$utils->infoMessage($utils->alreadyExists("",$full_name));
            }
            else{
                $message = $utils->errorMessage($utils->error("",$full_name));
            }
        }
    }
?>
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span style="font-size:23px;">प्रयोगकर्ता खाता नियन्त्रण</span></h3>

                <!-- My latest work -->
                <div class="galerie">

                    <p><?php echo  isset($message)?$message:"";?></p>
                    <form action="http://localhost/pis-project/cp/dashboard.php?action=users" method="post">

                        <table width="80%" align="center" border="1" class="table">
                            <tr>

                                <th>प्रयोगकर्ता नाम</th>
                                <th>पासवर्ड</th>
                                <th>नाम</th>
                                <th>कार्यालय नाम</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                            
                            <tr>

                                <th><input size="20" maxlength="50" type="text" 
                                style="height:20px; width:150px;"
                                name="txtuname"  style="height:30px;"/>
                                </th>
                                <th><input type="password" 
                                style="height:20px; width:150px;"
                                size="20" maxlength="50" name="txtupass"
                                           style="height:30px;"/></th>
                                <th><input size="20" maxlength="50" 
                                style="height:20px; width:150px;"
                                type="text" name="txtname" style="height:30px;"/>
                                </th>
                                <th>
                                <select name="user_type" style="height:30px; width:250px;" id='office_type'>
                                    <option selected disabled>कार्यालय नाम छान्नुहोस्</option>
                                    <option value="1">Education Office</option>
                                    <option value="2">Local Office</option>
                                </select>
                                     
                                    <select name="txtofficecode" style="height:30px; width:250px;" id="txtofficecode">
                                           
                                    </select>
                                </th>
                                <th colspan="3"><input type="submit" name="adduser" value=" Add "
                                                       style="height:30px; width:100px;"/></th>


                            </tr>
                            <?php $sql = $dbc->selectUser();
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <tr>

                                <td><?php echo $row['username'];?></td>
                                <td>***********</td>
                                <td><?php echo $row['fullname']?></td>

                                <td>
                                <?php
                                    $sqlForOfficeName = $dbc->selectOfficeNameFromIdAndUserType($row['user_type'],$row['office_id']);
                                    $rowForOfficeName = mysqli_fetch_array($sqlForOfficeName);
                                    echo $rowForOfficeName['name_np'];
                                 ?>
                                </td>

                                <td align="center"><p><a href="dashboard.php?action=edituser&id=<?php echo $row['id'];?>" class="edit">Edit</a></p></td>
                                <td align="center"><p><a href="dashboard.php?action=changepassword&id=<?php echo $row['id'];?>" class="edit">ChangePass</a></p>
                                </td>
                                <td align="center"><p><a onclick="return validateForm()" href="dashboard.php?action=users&type=del&id=<?php echo $row['id'];?>&ut=<?php echo $row['user_type'];?>"
                                                         class="delete">Delete</a></p></td>

                            </tr>
                            <?php }?>
                        </table>
                    </form>
                    <br/>
                    <div class="cleaner">&nbsp;</div>
                </div>
                <!-- My latest work end -->
            </div>
<script>
    $("#office_type").change(function(){
        var office_type = $("#office_type").val();
        $("#officetypestore").val(office_type);
        console.log(office_type);
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
