<div id="skip-menu"></div>
<?php $row = mysqli_fetch_array($dbc->selectOneTransactionGovernment($_GET['oid'], $_GET['tlid']));
if (isset($_POST['btnaddprogress'])) {


    /*    $edit = "update tbl_transaction_local set
    yearly_progress_qty_expenditure ='" . $_POST['txtpyearqty'] . "',
    yearly_progress_expenditure='" . $_POST['txtpyearbudget'] . "',
    q3_expenditure='" . $_POST['txtpttbudget'] . "',
    q3_qty_expenditure='" . $_POST['txtpttqty'] . "' where id=" . $_GET['tlid'];
        echo $edit;



        var_dump($dbc);
       $res= mysqli_query($dbc, $edit);
        echo $res;*/

    $res = $dbc->updateGovernmentTransaction($_POST['txtpyearqty'], $_POST['txtpyearbudget'], $_POST['txtpttbudget'], $_POST['txtpttqty'], $_GET['tlid']);

    echo "<script>
             window.history.go(-2);
     </script>";
}
?>

<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">प्रगति विवरण प्रविष्टि</span></h3>
                <!-- My latest work -->
                <div class="galerie">
                    <form name="saveEntry" method="post">
                        <table width="120%" align="center" border="1" class="table">
                            <tr>
                                <td align="left" colspan="2"><span class="preeti">कार्यक्रम सँकेत न.</span></td>
                                <td><span class="siddhi"><?php echo $row['code'] ?></span></td>

                            </tr>
                            <tr>
                                <td align="left" colspan="2"><span class="preeti">कार्यक्रम/क्रियाकलाप</span></td>
                                <td><span class="siddhi"><?php echo $row['name_np'] ?></span></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2"><span class="preeti">इकाई</span></td>
                                <td><span class="siddhi"></span></td>
                            </tr>
                            <tr>
                                <td rowspan="4" align="center"><span class="preeti">वार्षिक लक्ष</span></td>

                            </tr>

                            <tr>
                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td><span class="siddhi"><?php echo $row['yearly_alloc_qty'] ?></span></td>
                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">इकाइ लागत</span></td>
                                <td><span class="siddhi"><?php echo $row['yearly_alloc_cost'] ?></span></td>
                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">बजेट</span></td>
                                <td><span class="siddhi"><?php echo $row['yearly_alloc_budget'] ?></span></td>


                            <tr>
                            </tr>
                            <tr>
                            <tr>
                                <td rowspan="3" align="center"><span class="preeti">वार्षिक प्रगति</span></td>

                            </tr>

                            </tr>
                            <tr>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi" size="30"
                                                                                               maxlength="50"
                                                                                               type="text"
                                                                                               name="txtpyearqty"
                                                                                               value="<?php echo $row['yearly_progress_qty'] ?>"/></span>
                                </td>

                            </tr>

                            <tr>
                                <td align="center"><span class="preeti">खर्च बजेट</span></td>
                                <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi" size="30"
                                                                                               maxlength="50"
                                                                                               type="text"
                                                                                               name="txtpyearbudget"
                                                                                               value="<?php echo $row['yearly_progress_expenditure'] ?>"/></span>
                                </td>
                            </tr>
                            <tr>

                                <td align="center" rowspan="3"><span class="preeti">तेश्रो चौमासिक लक्ष</span></td>

                            </tr>

                            <tr>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td><span class="siddhi"><?php echo $row['q3_alloc_qty'] ?></span></td>

                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">बजेट</span></td>
                                <td><span class="siddhi"><?php echo $row['q3_alloc_budget'] ?></span></td>

                            </tr>


                            <tr>
                                <td rowspan="3" align="center"><span class="preeti">तेश्रो चौमासिक प्रगति</span></td>

                            </tr>



                            <tr>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi" size="30"
                                                                                               maxlength="50"
                                                                                               type="text"
                                                                                               name="txtpttqty"
                                                                                               value="<?php echo $row['q3_progress_qty'] ?>"/></span>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">बजेट</span></td>
                                <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi" size="30"
                                                                                               maxlength="50"
                                                                                               type="text"
                                                                                               name="txtpttbudget"
                                                                                               value="<?php echo $row['q3_progress_expenditure'] ?>"/></span>
                                </td>
                            </tr>


                            <tr>
                                <td colspan="3" align="center" rowspan="2"><span class="preeti"><input type="submit"
                                                                                                       name="btnaddprogress"
                                                                                                       value="  Save Record  "
                                                                                                       style="width:150px;height:30px;"/></span>
                                </td>

                            </tr>


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
