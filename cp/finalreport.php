<?php
    if($_GET["project_id"]!=0){
        $result = $dbc->generateFinalReport($_GET['project_id']);
    }
    else if(isset($_GET['project_id'])){
        $result = $dbc->generateLocalFinalReport();
    }
    else{
        echo "<script>window.history.back();</script>";
    }
?>
<div id="skip-menu"></div>
<!-- Content box -->

<div id="content-box-in">

    <!-- Content left -->
    <div id="content-box-in-left">
        <div id="content-box-in-left-in">

                <h3 class="line" align="center"><p class="preeti" style="font-size:16px;">
                     नेपाल सरकार<br/>
                     शिक्षा मन्त्रालय            <br/>
                     शिक्षा विभाग  <br/>

</p></h3>

                <h3 class="line"><p class="preeti" style="font-size:23px;">


</p></h3>

                <!-- My latest work -->
                <div class="galerie preeti">
                <p> <a href="#" id="create_excel">प्रतिवेदन डाउनलोड गर्ने</a></p>
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                        <tr>

                            <td colspan="14" style="text-align: center;">
                                प्रगति प्रतिवेदन
                            </td>
                        </tr>
                        <tr>

                            <td colspan="14" style="text-align: center;">
                                आ.व. <?php echo $_SESSION["fiscal_year"]. " (".$_GET['type'].")";?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="14">कार्यक्रम : <?php echo $_GET['project_id']!=0?$_GET['project_id']:"";?> (विद्यालयक्षेत्र विकास कार्यक्रम)</td>
                        </tr>

                        </tbody>
                    </table>
                    <p>&nbsp;
                    </p>
                    <br>


                    <form name="del" action="" method="post">
                        <table align="center" border="1" class="table">

                            <tr>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम सँकेत नं.</span></td>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम/क्रियाकलाप</span></td>
                                <td rowspan="2" align="center"><span class="preeti">एकाई</span></td>
                                <td colspan="4" align="center"><span class="preeti">वार्षिक लक्ष</span></td>
                                <td colspan="5" align="center"><span class="preeti">वार्षिक प्रगति</span></td>
                                <td colspan="3" align="center"><span class="preeti">प्रथम चौमासिक लक्ष</span></td>
                                <td colspan="5" align="center"><span class="preeti">प्रथम चौमासिक प्रगति</span></td>


                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">इकाइ लागत</span></td>
                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="center"><span class="preeti">भार</span></td>
                                <td align="center"><span class="preeti">बजेट</span></td>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="center"><span class="preeti">भौतिक प्रगति प्रतिशत</span></td>
                                <td align="center"><span class="preeti">खर्च रकम</span></td>
                                <td align="center"><span class="preeti">खर्च प्रतिशत</span></td>
                                <td align="center"><span class="preeti">भारित</span></td>


                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="center"><span class="preeti">भार</span></td>
                                <td align="center"><span class="preeti">बजेट</span></td>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="center"><span class="preeti">भौतिक प्रगति प्रतिशत</span></td>
                                <td align="center"><span class="preeti">खर्च रकम</span></td>
                                <td align="center"><span class="preeti">खर्च प्रतिशत</span></td>
                                <td align="center"><span class="preeti">भारित</span></td>


                            </tr>

                            <?php

                            
                            if ($result) {

                                $sql = $dbc->selectAllFinalReport();
                                
                                while ($row = mysqli_fetch_array($sql)) {
                                   
                                    if ($row['status'] == 0) {
                                        $row['color'] = '#336699';
                                    } elseif ($row['status'] == 1) {
                                        $row['color'] = '#999999';
                                    } elseif ($row['status'] == 4) {
                                        $row['color'] = '#FFFF00';
                                    } else {
                                        $row['color'] = '#FFF';
                                    }

                                    ?>

                                    <tr bgcolor="<?php echo $row['color'] ?>" style="font-weight:bold;">
                                        <td align="left" width="5%"><span class="siddhi"><?php echo $row['activity_number'] ?></span></td>
                                        <td align="left"><span><?php echo $row['name_np'] ?></span></td>
                                        <td align="left"><span ><?php echo $row['unit'] ?></span></td>
                                        <td align="left"><span><?php echo $row['yearly_alloc_cost'] ?></span></td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_alloc_qty'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_weight'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_alloc_budget'] ?></span></td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_progress_qty'] ?></span></td>
                                        <td align="right"><span class="preeti"><?php echo $row['yearly_progress_qty_percentage'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_progress_expenditure'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_progress_expenditure_percentage'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['yearly_progress_weight'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_alloc_qty'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_alloc_weight'] ?></span>
                                        </td>

                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_alloc_budget'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_progress_qty'] ?></span>
                                        </td>

                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_progress_qty_percentage'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_progress_expenditure'] ?></span>
                                        </td>

                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_progress_expenditure_percentage'] ?></span>
                                        </td>
                                        <td align="right"><span
                                                    class="preeti"><?php echo $row['qtr_progress_expenditure_weight'] ?></span>
                                        </td>

                                    </tr>

                                <?php }
                            }
                            ?>
                        </table>
                    </form>
                    <br/>
                    <div class="cleaner">&nbsp;</div>
                </div>
                <!-- My latest work end -->
            </div>
        </div>
        </div>
        <!-- Content left end -->

        <!-- Content right --><!-- Content right end -->
        <div class="cleaner">&nbsp;</div>
        <?php echo '<script>
    $("#create_excel").click(function(){
            var page ="finalreportexcel.php?pid='.$_GET['project_id'].'";
            window.location=page;
    });
</script>';?>