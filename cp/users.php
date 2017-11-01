<?php 
    if(isset($_POST['adduser'])){
        $username = $_POST['txtuname'];
        $password = $_POST['txtupass'];
        $full_name = $_POST['txtname'];
        if(!isset($_POST['txtofficecode'])){
            $message = "Select office name";
        }else{
            $user_type = $_POST['user_type'];
            $office_id = $_POST['txtofficecode'];
            $result = $dbc->insertLocalUser($username,$password,$full_name,$user_type,$office_id);
            echo $result;
            if($result>0){
                $message = $full_name." has been saved";
            }
        }
    }
?>
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span style="font-size:23px;">User Management</span></h3>

                <!-- My latest work -->
                <div class="galerie">

                    <p><?php echo  isset($message)?$message:"";?></p>
                    <form action="http://localhost/pis-project/cp/dashboard.php?action=users" method="post">

                        <table width="80%" align="center" border="1" class="table">
                            <tr>

                                <th>Username</th>
                                <th>Password</th>
                                <th>Full Name</th>
                                <th>Office Name</th>
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
                                    <option selected disabled>Select Office</option>
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

                                <td align="center"><p><a href="edituser.php?id=80" class="edit">Edit</a></p></td>
                                <td align="center"><p><a href="changepassword.php?id=80" class="edit">ChangePass</a></p>
                                </td>
                                <td align="center"><p><a onclick="return validateForm()" href="deluser.php?id=80"
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
        })
    });
</script>