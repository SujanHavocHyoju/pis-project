<?php
/**
 * Created by IntelliJ IDEA.
 * User: bibek
 * Date: 12/4/17
 * Time: 3:28 AM
 */
$sql = $dbc->selectUserLogToday();
$resCount = mysqli_fetch_array($dbc->selectCountUserLogToday());
?>
<p>User today : <?php echo $resCount[0]; ?></p>
<table width="80%" align="center" border="1" class="table">
    <tr>
        <th><span class="preeti">username</span></th>
        <th ><span class="preeti">office_name</span></th>
        <th ><span class="preeti">user_type</span></th>
        <th ><span class="preeti">ip_address</span></th>
        <th ><span class="preeti">device</span></th>
        <th >login_status</th>
        <th >last_access_date</th>
        <th >Stay</th>

    </tr>
    <?php
    while($row = mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td><span class="siddhi"><?php echo $row["username"];?></span></td>
            <td ><span class="preeti"><?php echo $row["office_name"];?></span></td>
            <td ><span class="preeti"><?php echo $row["user_type"]==0?"SUPER ADMIN":$row['user_type']==1?"Educational Officer":"Local officer";?></span></td>
            <td ><span class="preeti"><?php echo $row["ip_address"];?></span></td>
            <td ><span class="preeti"><?php echo $row["login_status"];?></span></td>

            <td align="center" ><p><?php echo $row["device"];?></p></td>
            <td align="center" ><p><?php echo $row["last_access_date"];?></p></td>
            <td align="center"><p><?php echo $row["reason"];?></p></td>
        </tr>
    <?php } ?>

</table>
