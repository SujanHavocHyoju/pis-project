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
        $sql = $dbc->selectUserByFullName($_POST['search']);
    }else{
        $sql = $dbc->selectUser();
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
                    <form action="dashboard.php?action=users" method="post">
                    
                        <table width="100%" align="center" border="1" class="table">
                            <tr>
                                <td width="100%"> <div class="search-box">
                                <input type="text" name="search" id="search_text" autocomplete="off" placeholder="नेपाली भाषामा खोज्नुहोस् ..." class="form-control" />  
                                <div class="result" id="result"></div>    
                            </div></td>
                            <td>
                            <input type="submit" name="adduser" value="  खोजी गर्ने  " style="height:30px; width:120px;" />
                            </td>
                        </tr>
                        </table>
                        <table width="100%" align="center" border="1" class="table">
                            <tr>

                                <th align="center">युजरनेम (Username)</th>
                                <th align="center">पासवर्ड</th>
                                <th align="center">पुरा नाम (Full Name)</th>
                                <th align="center">कार्यालयको नाम</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                           
                            <?php 
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

                                <td align="center"><p><input type="button" onclick="window.location.href='dashboard.php?action=edituser&id=<?php echo $row['id'];?>'" class="edit" value=" सम्पादन गर्ने "/></p></td>
                                <td align="center"><p><input type="button" onclick="window.location.href='dashboard.php?action=changepassword&id=<?php echo $row['id'];?>'" class="edit" value=" पासवर्ड परिवर्तन गर्ने "/></p>
                                </td>
                                <td align="center"><p><input type="button" onclick="return validateForm()" href="#"
                                                         class="delete" value=" मेट्ने " disabled/></p></td>

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
    // $("#office_type").change(function(){
    //     var office_type = $("#office_type").val();
    //     $("#officetypestore").val(office_type);
    //     console.log(office_type);
    //     $.ajax({
    //         url:"officelist.php",
    //         type : 'POST',
    //         data :"data="+office_type,
    //         success: function(response){
    //                     $('#txtofficecode').html(response);
                
    //         }
    //     });
    // });

    $(document).ready(function(){  
		$('#search_text').keyup(function(){  
			var txt = $(this).val();  
			if(txt != '')  
			{  
                console.log(txt);
                $.ajax({  
                     url:"fetch.php",  
                     method:"post",  
                     data:{search:txt},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('.result').html(data);  
                     }  
                });  
			}  
			else  
			{  
                $('.result').html('');                 
			}  
		});
        $("body").click(function(e){
            console.log(e.target.tagName);
           if(e.target.tagName != "P"){
                $('.result').html(''); 
           }
        
        });
		$(document).on("click", ".result p", function(){
			$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			$(this).parent(".result").empty();
		});		
	});
</script>
