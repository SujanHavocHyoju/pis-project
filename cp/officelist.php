<?php
    include('../class/common.php');
    if(isset($_POST["data"])){
        $office_type = $_POST["data"];
        if($office_type==1){
            $sql = $dbc->selectEduOffice();
        }else{
            $sql = $dbc->selectOffice();    
        }
        
    }
?>
<select name="txtofficecode" style="height:30px; width:250px;" id="txtofficecode">
    <?php while($row=mysqli_fetch_array($sql)){
           ?> 
           <option value="<?php echo $row['id'];?>"><?php echo $row['name_np'];?></option>    
        <?php }?>
                                 
</select>