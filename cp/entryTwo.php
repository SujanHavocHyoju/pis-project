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
                    कार्यालय : <?php echo $_GET['name'] ?><br>आ.व. : 2073/74<br>
                    <p align="right"><a href="dashboard.php?action=entry">अघिल्लो पेजमा जाने</a> || <a href="excelreport.php">प्रतिवेदन डाउनलोड गर्ने</a></p>

                    <form name="del" action="" method="post">
                        <table width="120%" align="center" border="1" class="table">
                            <tr>
                                <td rowspan="2" align="center"><span class="preeti"></span></td>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम सँकेत न.</span></td>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम/क्रियाकलाप</span></td>
                                <td rowspan="2" align="center"><span class="preeti">इकाई</span></td>
                                <td  colspan="3" align="center"><span class="preeti">वार्षिक लक्ष</span></td>

                                <td  colspan="2" align="center"><span class="preeti">वार्षिक प्रगति</span></td>
                                <td  colspan="2" align="center"><span class="preeti">तेश्रो चौमासिक लक्ष</span></td>
                                <td  colspan="2" align="center"><span class="preeti">तेश्रो चौमासिक प्रगति</span></td>
                                <td  align="center"  rowspan="2"><span class="preeti"></span></td>

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
                            <?php $sql = $dbc->selectTransactionLocal($_GET['oid']);
                                while($row = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><span class="siddhi"></span></td>
                                <td><span class="siddhi"><?php echo $row['code'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                <td><span class="siddhi"></span></td>
                                <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_qty'] ?></span></td>
                                <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_cost'] ?></span></td>

                                <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_budget'] ?></span></td>

                                <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['yearly_progress_qty_expenditure'] ?></span></td>
                                <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['yearly_progress_expenditure'] ?></span></td>


                                <td align="right"><span class="preeti"><?php echo $row['q3_alloc_qty'] ?></span></td>
                                <td align="right"><span class="preeti"><?php echo $row['q3_alloc_budget'] ?></span></td>
                                <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['q3_qty_expenditure'] ?></span></td>
                                <td align="right" bgcolor="#CCCCCC"><span class="preeti"><?php echo $row['q3_expenditure'] ?></span></td>
                                <td align="center" ><p><a href="dashboard.php?action=entryThree&oid=<?php echo $_GET['oid'] ?>&name=<?php echo $_GET['name'] ?>&tlid=<?php echo $row['id'] ?>" class="delete">Add Progress</a></p></td>
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
