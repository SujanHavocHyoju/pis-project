<?php

    $result = $dbc->generateFinalReport();
    var_dump($result);


?>

<div id="skip-menu"></div>
<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">

                <h3 class="line" align="center"><span class="preeti" style="font-size:16px;">
                     नेपाल सरकार<br />
                     शिक्षा मन्त्रालय            <br />
                     शिक्षा विभाग  <br />

                    </span></h3>

                <h3 class="line"><span class="preeti" style="font-size:23px;">


                    </span></h3>

                <!-- My latest work -->
                <div class="galerie preeti" >

                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                        <tr>

                            <td colspan="14" style="text-align: center;">
                                प्रगति प्रतिवेदन</td>
                        </tr>
                        <tr>

                            <td colspan="14" style="text-align: center;">
                                आ.व. &#2408;&#2406;&#2413;&#2409;/&#2413;&#2410; (जिल्लास्तर)</td>
                        </tr>

                        <tr>
                            <td colspan="14">कार्यक्रम : ३५०८०६ (विद्यालयक्षेत्र विकास कार्यक्रम)</td>
                        </tr>

                        </tbody>
                    </table>
                    <p>&nbsp;
                    </p>
                    <br>












                    <form name="del" action="" method="post">
                        <table width="100%" align="center" border="1" class="table">

                            <tr>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम सँकेत न.</span></td>
                                <td rowspan="2" align="center"><span class="preeti">कार्यक्रम/क्रियाकलाप</span></td>
                                <td rowspan="2" align="center"><span class="preeti">एकाई</span></td>
                                <td  colspan="4" align="center"><span class="preeti">वार्षिक लक्ष</span></td>
                                <td  colspan="5" align="center"><span class="preeti">वार्षिक प्रगति</span></td>
                                <td  colspan="3" align="center"><span class="preeti">तेश्रो चौमासिक लक्ष</span></td>
                                <td  colspan="5" align="center"><span class="preeti">तेश्रो चौमासिक प्रगति</span></td>



                            </tr>
                            <tr>
                                <td  align="center"><span class="preeti">इकाइ लागत</span></td>
                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td  align="center"><span class="preeti">भार</span></td>
                                <td  align="center"><span class="preeti">बजेट</span></td>

                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td  align="center"><span class="preeti">भौतिक प्रगति प्रतिशत</span></td>
                                <td  align="center"><span class="preeti">खर्च रकम</span></td>
                                <td  align="center"><span class="preeti">खर्च प्रतिशत</span></td>
                                <td  align="center"><span class="preeti">भारित</span></td>


                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td  align="center"><span class="preeti">भार</span></td>
                                <td  align="center"><span class="preeti">बजेट</span></td>

                                <td  align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td  align="center"><span class="preeti">भौतिक प्रगति प्रतिशत</span></td>
                                <td  align="center"><span class="preeti">खर्च रकम</span></td>
                                <td  align="center"><span class="preeti">खर्च प्रतिशत</span></td>
                                <td  align="center"><span class="preeti">भारित</span></td>




                            </tr>

                            <?php


                            $sql = $dbc->selectAllFinalReport();
                            while ($row = mysqli_fetch_array($sql)) {
//                                var_dump($row);
                                if($row['status'] == 0){
                                    $row['color'] = '#999999';
                                }elseif ($row['status'] == 1){
                                    $row['color'] = '#336699';
                                }elseif($row['status'] == 4){
                                    $row['color'] = '#F00';
                                }else{
                                    $row['color'] = '#FFF';
                                }
                                ?>

                            <tr bgcolor="<?php echo $row['color'] ?>" style="font-weight:bold;">
                                <td><span class="siddhi"><?php echo $row['activity_number'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['unit'] ?></span></td>
                                <td><span class="siddhi"><?php echo $row['yearly_alloc_cost'] ?></span></td>
                                <td  align="right"><span class="preeti"><?php echo $row['yearly_alloc_qty'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['yearly_weight'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['yearly_alloc_budget'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['yearly_progress_qty'] ?></span></td>
                                <td  align="right"><span class="preeti"><?php echo $row['yearly_progress_qty_percent'] ?></span></td>
                                <td  align="right"><span class="preeti"><?php echo $row['yearly_progress_expenditure'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['yearly_progress_expenditure_percent'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['yearly_progress_weighted'] ?></span></td>
                                <td  align="right"><span class="preeti"><?php echo $row['qtr_alloc_qty'] ?></span></td>
                                <td  align="right"><span class="preeti"><?php echo $row['qtr_alloc_weight'] ?></span></td>

                                <td align="right" ><span class="preeti"><?php echo $row['qtr_alloc_budget'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['qtr_progress_qty'] ?></span></td>

                                <td  align="right"><span class="preeti"><?php echo $row['qtr_progress_qty_percent'] ?></span></td>
                                <td  align="right"><span class="preeti"><?php echo $row['qtr_progress_expenditure'] ?></span></td>

                                <td align="right" ><span class="preeti"><?php echo $row['qtr_progress_expenditure_percent'] ?></span></td>
                                <td align="right" ><span class="preeti"><?php echo $row['qtr_progress_expenditure_weighted'] ?></span></td>

                            </tr>

                            <?php }
                            ?>



                            <tr bgcolor="#FF0000" style="font-weight:bold;">

                                <td colspan="2" align="center">कूल जम्मा</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right" ><span class="preeti">100.00</span></td>
                                <td align="right" ><span class="preeti">27,881,193.00</span></td>
                                <td></td>
                                <td></td>
                                <td align="right" ><span class="preeti">25,352,661.78</span></td>
                                <td align="right" ><span class="preeti">90.93</span></td>
                                <td align="right"></td>
                                <td align="right"></td>
                                <td align="right" ><span class="preeti">100.00</span></td>
                                <td align="right" ><span class="preeti">8,482,215.60</span></td>

                                <td align="right"></td>
                                <td align="right"></td>

                                <td align="right" ><span class="preeti">26,301,384.52</span></td>
                                <td align="right" ><span class="preeti">100.00</span></td>
                                <td align="right"></td>
                            </tr>
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


