<?php

$activity_id = $_GET['aid'];
$activity_code = $_GET['acode'];
$activity = mysqli_fetch_array($dbc->selectOneActivity($activity_id));


?>


<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">

                <h3 align="center"><span class="preeti" style="font-size:20px; text-align: center">
                     स्थानीय कार्यालयगत
                            प्रतिवेदन

                    </span>
                </h3>

                <h3 class="line">
                    <span class="preeti" style="font-size:23px;">
                    </span>
                </h3>

                <!-- My latest work -->
                <div class="galerie preeti">

                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                        <tr>

                            <td colspan="14" style="text-align: center;">
                                प्रगति प्रतिवेदन
                            </td>
                        </tr>
                        <tr>

                            <td colspan="14" style="text-align: center;">
                                आ.व. &#2408;&#2406;&#2413;&#2409;/&#2413;&#2410;
                            </td>
                        </tr>

                        <tr>
                            <td colspan="14">कार्यक्रम : ३५०८०६ (विद्यालयक्षेत्र विकास कार्यक्रम)</td>
                        </tr>

                        </tbody>
                    </table>
                    <p>&nbsp;क्रियाकलाप : <?php echo $activity['code'] . ' ' . $activity['name_np'] ?></p>
                    <br>


                    <form name="del" action="" method="post">
                        <table width="100%" align="center" border="1" class="table">
                            <tr>
                                <td rowspan="2" align="center"><span class="preeti">सि. न.</span></td>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम/क्रियाकलाप</span></td>
                                <td rowspan="2" align="center"><span class="preeti">एकाई</span></td>
                                <td colspan="4" align="center"><span class="preeti">वार्षिक लक्ष</span></td>
                                <td colspan="4" align="center"><span class="preeti">वार्षिक प्रगति</span></td>
                                <td colspan="3" align="center"><span class="preeti">तेश्रो चौमासिक लक्ष</span></td>
                                <td colspan="4" align="center"><span class="preeti">तेश्रो चौमासिक प्रगति</span></td>


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


                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="center"><span class="preeti">भार</span></td>
                                <td align="center"><span class="preeti">बजेट</span></td>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="center"><span class="preeti">भौतिक प्रगति प्रतिशत</span></td>
                                <td align="center"><span class="preeti">खर्च रकम</span></td>
                                <td align="center"><span class="preeti">खर्च प्रतिशत</span></td>


                            </tr>


                            <?php $sql = $dbc->selectActivityWiseReportLocal($activity_code);
                            $i = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                                ?>

                                <tr>
                                    <?php
                                    $percentageYearlyQty = $row['yearly_alloc_qty'] == 0 || $row['yearly_progress_qty'] == 0 ? 0 : $row['yearly_progress_qty'] / $row['yearly_alloc_qty'] * 100;
                                    $percentageYearlyExpenditure = $row['yearly_alloc_budget'] == 0 || $row['yearly_progress_expenditure'] == 0 ? 0 : $row['yearly_progress_expenditure'] / $row['yearly_alloc_budget'] * 100;
                                    $percentageQThreeQty = $row['q3_alloc_qty'] == 0 || $row['q3_progress_qty'] == 0 ? 0 : $row['q3_progress_qty'] / $row['q3_alloc_qty'] * 100;
                                    $percentageQThreeExpenditure = $row['q3_alloc_budget'] == 0 || $row['q3_progress_expenditure'] == 0 ? 0 : $row['q3_progress_expenditure'] / $row['q3_alloc_budget'] * 100;
                                    ?>

                                    <td><span class="siddhi"><?php echo $i++ ?></span></td>
                                    <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                    <td><span class="siddhi"></span></td>
                                    <td align="right"><span
                                            class="preeti"><?php echo $row['yearly_alloc_cost'] ?></span></td>
                                    <td align="right"><span class="preeti"><?php echo $row['yearly_alloc_qty'] ?></span>
                                    </td>
                                    <td align="right"><span class="preeti"></span></td>
                                    <td align="right"><span
                                            class="preeti"><?php echo $row['yearly_alloc_budget'] ?></span></td>

                                    <td align="right"><span
                                            class="preeti"><?php echo $row['yearly_progress_qty'] ?></span>
                                    <td align="right"><span
                                            class="preeti"><?php echo $percentageYearlyQty ?></span>
                                    </td>


                                    <td align="right"><span
                                            class="preeti"><?php echo $row['yearly_progress_expenditure'] ?></span>
                                    </td>
                                    <td align="right"><span
                                            class="preeti"><?php echo $percentageYearlyExpenditure?></span>
                                    </td>


                                    <td align="right"><span class="preeti"><?php echo $row['q3_alloc_qty'] ?></span>
                                    </td>

                                    <td align="right"><span class="preeti"></span></td>
                                    <td align="right"><span class="preeti"><?php echo $row['q3_alloc_budget'] ?></span>
                                    </td>

                                    <td align="right"><span class="preeti"><?php echo $row['q3_progress_qty'] ?></span>
                                    </td>
                                    <td align="right"><span
                                            class="preeti"><?php echo $percentageQThreeQty ?></span>
                                    </td>

                                    <td align="right"><span
                                            class="preeti"><?php echo $row['q3_progress_expenditure'] ?></span></td>
                                    <td align="right"><span
                                            class="preeti"><?php echo $percentageQThreeExpenditure ?></span>
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


