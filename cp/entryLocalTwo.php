<?php 
    if(isset($_SESSION['message'])&&!empty($_SESSION['message'])){
        $message = $utils->successMessage($_SESSION['message']);
        unset($_SESSION['message']);
    }

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
                <div class="galerie preeti" >
                स्थानीय निकाय : <?php echo $_GET['name'] ?><br>आ.व. : <?php echo $_SESSION['fiscal_year'];?><br>
                    <p align="right"><a href="dashboard.php?action=entryLocal">अघिल्लो पेजमा जाने</a> || <a href="#" id="create_excel">प्रतिवेदन डाउनलोड गर्ने</a></p>
                    <p><?php echo isset($message)?$message:"";?></p>
                    <form name="del" action="" method="post">
                        <table width="100%" align="center" border="1" class="table">
                            <tr>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम सँकेत नं.</span></td>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम</span></td>
                                <td rowspan="2" align="center"><span class="preeti">क्रियाकलाप</span></td>
                                <td rowspan="2" align="center"><span class="preeti">इकाई</span></td>
                                <td  colspan="3" align="center"><span class="preeti">वार्षिक लक्ष</span></td>

                                <td  colspan="2" align="center"><span class="preeti">वार्षिक प्रगति</span></td>
                                <td  colspan="2" align="center"><span class="preeti">प्रथम चौमासिक लक्ष</span></td>
                                <td  colspan="2" align="center"><span class="preeti">प्रथम चौमासिक प्रगति</span></td>

                            </tr>
                            <tr>
                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td  align="center"><span class="preeti">इकाइ लागत</span></td>

                                <td  align="center"><span class="preeti">बजेट</span></td>

                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>

                                <td  align="center"><span class="preeti">खर्च बजेट</span></td>

                                <td  align="center"><span class="preeti">भौतिक परीमाण</span></td>
                                <td  align="center"><span class="preeti">बजेट</span></td>

                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td  align="center"><span class="preeti">खर्च बजेट</span></td>
                            </tr>
                            <?php $sql = $dbc->selectLocalOfficeTransaction($_GET['oid']);
                            while($row = mysqli_fetch_array($sql)) {
//                                var_dump($row);
                                ?>
                                <tr>
                                    <td><span class="siddhi"><?php echo $row['local_activity3_code'] ?></span></td>
                                    <td><span class="siddhi"><?php echo $row['local_activity3_desc_np'] ?></span></td>
                                    <td><span class="siddhi"><?php echo $row['desc_np'] ?></span></td>
                                    <td><span class="siddhi"></span></td>
                                    <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_qty'] ?></span></td>
                                    <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_cost'] ?></span></td>

                                    <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_budget'] ?></span></td>

                                    <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['yearly_progress_qty'] ?></span></td>
                                    <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['yearly_progress_expenditure'] ?></span></td>


                                    <td align="right"><span class="preeti"><?php echo $row['q1_alloc_qty'] ?></span></td>
                                    <td align="right"><span class="preeti"><?php echo $row['q1_alloc_budget'] ?></span></td>
                                    <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['q1_progress_expenditure'] ?></span></td>
                                    <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['q1_progress_expenditure'] ?></span></td>
                                    <td align="center" style="width: 80px"><p><input type="button" onclick="window.location.href='dashboard.php?action=entryLocalThree&oid=<?php echo $_GET['oid'] ?>&tlid=<?php echo $row['id'] ?>'" class="delete" value=" प्रगति थप गर्ने "></p></td>
<!--                                    <td align="center" style="width: 80px; pointer-events: none;"><p><a href="#" class="delete">प्रगति थप गर्ने</a></p></td>-->
                                </tr>
                            <?php } ?>
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

<?php echo '<script>
    $("#create_excel").click(function(){
        var agree = confirm("== कृपया माफ गर्नु होला । मंसिर १० गते पछि मात्र प्रतिबेदन डाउनलोड गर्नुहोला ====");
        if (agree)
            return true;
        else
            return false;
            // var page ="excelreport.php?lid='.$_GET["oid"].'&o_name='.$_GET['name'].'&f_year=आ.व. : 2073/74";
            // console.log(page);
            // window.location=page;
    });
</script>';?>