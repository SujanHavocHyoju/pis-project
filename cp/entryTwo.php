<?php
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    $message = $utils->infoMessage($_SESSION['message']);
    unset($_SESSION['message']);
}
if(isset($_GET['type'] )){
    if ($_GET['type'] == "central") {
        $sql = $dbc->selectTransactionGovernmentWithProjectId($_GET['oid'], 360140);
    }
    if ($_GET['type'] == "district") {
        $sql = $dbc->selectTransactionGovernmentWithProjectId($_GET['oid'], 350806);
    }
    else{
        $sql = $dbc->selectTransactionGovernment($_GET['oid']);
    }
}
else {
    $sql = $dbc->selectTransactionGovernment($_GET['oid']);

}
$sumOfSelectSumSql = $dbc->selectSumOfTransactionGovernment($_GET['oid']);
$resultOfSum = mysqli_fetch_array($sumOfSelectSumSql);
?>

    <div id="content-box">
        <div id="content-box-in">

            <!-- Content left -->
            <div id="content-box-in-left">
                <div id="content-box-in-left-in">
                    <h3 class="line"><span class="preeti" style="font-size:23px;">
                        लक्ष तथा प्रगति विवरण
                    </span></h3>

                    <!-- My latest work -->
                    <div class="galerie preeti">
                        कार्यालय : <?php echo $_GET['name'] ?><br>आ.व. : <?php echo $_SESSION['fiscal_year']; ?><br>
                        <p align="right"><a href="dashboard.php?action=entry">अघिल्लो पेजमा जाने</a> || <a href="#"
                                                                                                           id="create_excel">प्रतिवेदन
                                डाउनलोड गर्ने</a></p>
                        <select id="projectType">
                            <option value="all">All</option>
                            <option value="central">Central</option>
                            <option value="district">District</option>
                        </select>
                        <p><?php echo isset($message) ? $message : ""; ?></p>
                        <form name="del" action="" method="post">

                            <table width="100%" align="center" border="1" class="table">
                                <tr>
                                    <td rowspan="2" align="center"><span class="preeti">कार्यक्रम सँकेत नं.</span></td>
                                    <td rowspan="2" align="center"><span class="preeti">कार्यक्रम/क्रियाकलाप</span></td>
                                    <td rowspan="2" align="center"><span class="preeti">इकाई</span></td>
                                    <td colspan="3" align="center"><span class="preeti">वार्षिक लक्ष</span></td>

                                    <td colspan="2" align="center"><span class="preeti">वार्षिक प्रगति</span></td>
                                    <td colspan="2" align="center"><span class="preeti">प्रथम चौमासिक लक्ष</span></td>
                                    <td colspan="2" align="center"><span class="preeti">प्रथम चौमासिक प्रगति</span></td>
                                    <td align="center" rowspan="2"><span class="preeti"></span></td>

                                </tr>
                                <tr>
                                    <td align="center"><span class="preeti" style="width:0.4em;">भौतिक परिमाण</span>
                                    </td>
                                    <td align="center"><span class="preeti">इकाइ लागत</span></td>

                                    <td align="center"><span class="preeti">बजेट</span></td>

                                    <td align="center"><span class="preeti" style="width:0.6em;">भौतिक परिमाण</span>
                                    </td>

                                    <td align="center"><span class="preeti">खर्च बजेट</span></td>

                                    <td align="center"><span class="preeti" style="width:0.6em;">भौतिक परीमाण</span>
                                    </td>
                                    <td align="center"><span class="preeti">बजेट</span></td>

                                    <td align="center"><span class="preeti" style="width:0.6em;">भौतिक परिमाण</span>
                                    </td>
                                    <td align="center"><span class="preeti">खर्च बजेट</span></td>
                                </tr>
                                <?php if (mysqli_num_rows($sql) == 0) { ?>
                                    <tr>
                                        <td colspan="11" align="center">NO DATA AVAILABLE</td>
                                    </tr>
                                    <?php
                                } else {

                                    while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td><span class="siddhi"><?php echo $row['code'] ?></span></td>
                                            <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                            <td><span class="siddhi"></span></td>
                                            <td align="right" style="width:0.4em;"><span
                                                        class="preeti"><?php echo $row['yearly_alloc_qty'] ?></span>
                                            </td>
                                            <td align="right"><span
                                                        class="preeti"><?php echo $row['yearly_alloc_cost'] ?></span>
                                            </td>

                                            <td align="right"><span
                                                        class="preeti"><?php echo $row['yearly_alloc_budget'] ?></span>
                                            </td>

                                            <td align="right" bgcolor="#CCCCCC" style="width:0.6em;"><span
                                                        class="preeti"><?php echo $row['yearly_progress_qty'] ?></span>
                                            </td>
                                            <td align="right" bgcolor="#CCCCCC"><span
                                                        class="preeti"><?php echo $row['yearly_progress_expenditure'] ?></span>
                                            </td>


                                            <td align="right"><span class="preeti"
                                                                    style="width:0.6em;"><?php echo $row['q1_alloc_qty'] ?></span>
                                            </td>
                                            <td align="right"><span
                                                        class="preeti"><?php echo $row['q1_alloc_budget'] ?></span></td>
                                            <td align="right" bgcolor="#CCCCCC" style="width:0.6em;"><span
                                                        class="preeti"><?php echo $row['q1_progress_qty'] ?></span></td>
                                            <td align="right" bgcolor="#CCCCCC"><span
                                                        class="preeti"><?php echo $row['q1_progress_expenditure'] ?></span>
                                            </td>
                                            <td align="center"><p><input type="button"
                                                                         onclick="window.location.href='dashboard.php?action=<?php echo $_SESSION['user_type']==0? "entryAdminThree":"entryThree";?>&oid=<?php echo $_GET['oid'] ?>&tlid=<?php echo $row['id'] ?>&name=<?php echo $row['name_np']; ?>'"
                                                                         class="delete" value=' प्रगति थप गर्ने '></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr bgcolor='#FFFF00'>
                                        <td><span class="siddhi"></span></td>
                                        <td><span class="siddhi">कूल जम्मा</span></td>
                                        <td><span class="siddhi"></span></td>
                                        <td align="right" style="width:0.4em;"><span
                                                    class="preeti"><?php echo $resultOfSum['yaq']; ?></span></td>
                                        <td align="right"><span class="preeti"><?php echo $resultOfSum['yac'] ?></span>
                                        </td>
                                        <td align="right"><span class="preeti"><?php echo $resultOfSum['yab'] ?></span>
                                        </td>
                                        <td align="right" style="width:0.6em;"><span
                                                    class="preeti"><?php echo $resultOfSum['ypq'] ?></span></td>
                                        <td align="right"><span class="preeti"><?php echo $resultOfSum['ype'] ?></span>
                                        </td>
                                        <td align="right"><span class="preeti"><?php echo $resultOfSum['ype'] ?></span>
                                        </td>
                                        <td align="right"><span class="preeti"
                                                                style="width:0.6em;"><?php echo $resultOfSum['qaq'] ?></span>
                                        </td>
                                        <td align="right"><span class="preeti"><?php echo $resultOfSum['qab'] ?></span>
                                        </td>
                                        <td align="right" style="width:0.6em;"><span
                                                    class="preeti"><?php echo $resultOfSum['qpq'] ?></span></td>
                                        <td align="right"><span class="preeti"><?php echo $resultOfSum['qpe'] ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </form>
                        <br/>
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
<?php echo '<script>
    $("#projectType").val("' . $_GET['type'] . '");
    $("#projectType").change(function() {
      var page = "dashboard.php?action=entryTwo&oid=' . $_GET['oid'] . '&name=' . $_GET['name'] . '&type="+$("#projectType").val();
      window.location=page;
    });
    $("#create_excel").click(function(){
            var page ="finalreportexcel.php?oid=' . $_GET['oid'] . '&o_name=' . $_GET['name'] . '";
            console.log(page);
            window.location=page;
    });
</script>'; ?>