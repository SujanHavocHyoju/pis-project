<div id="skip-menu"></div>
<?php
$row = mysqli_fetch_array($dbc->selectOneTransactionGovernment($_GET['oid'], $_GET['tlid']));
$yearlyAllocProgressQty = $row['yearly_progress_qty'];
$yearlyAllocProgressBud = $row['yearly_progress_expenditure'];
$qtrQty = $row['q1_progress_qty'];
$qtrBudget = $row['q1_progress_expenditure'];
if (isset($_POST['btnaddprogress'])) {
    $isSuccess = true;
    $yearlyAllocProgressQty = $_POST['txtpyearqty'];
    $yearlyAllocProgressBud = $_POST['txtpyearbudget'];
    if ($row['yearly_alloc_qty'] < $yearlyAllocProgressQty) {
        $message = $utils->errorMessage("वार्षिक लक्षको भौतिक परिमाण भन्दा प्रगतिको  भौतिक परिमाण रकम बढी हुन गएको छ!!");
        $isSuccess = false;
    } else if ($row['yearly_alloc_budget'] < $yearlyAllocProgressBud) {
        $message = $utils->errorMessage("वार्षिक लक्षको बजेट भन्दा प्रगतिको बजेट रकम बढी हुन गएको छ!!");
        $isSuccess = false;
    } else {
        if (isset($_POST['txtpttqty'])) {
            $qtrQty = $_POST['txtpttqty'];
            $qtrBudget = $_POST['txtpttbudget'];
            if ($row['q1_alloc_qty'] < $qtrQty) {
                $message = $utils->errorMessage("प्रथम चौमासिक लक्ष भौतिक परिमाण भन्दा प्रथम चौमासिक प्रगति भौतिक परिमाण रकम बढी हुन गएको छ!!");
                $isSuccess = false;
            }
            if ($row['q1_alloc_budget'] < $qtrBudget) {
                $message = $utils->errorMessage("प्रथम चौमासिक लक्ष बजेट भन्दा प्रथम चौमासिक प्रगति बजेट रकम बढी हुन गएको छ!!");
                $isSuccess = false;
            }
        }
    }
    if ($isSuccess) {
        $res = $dbc->updateGovernmentTransaction(
            $yearlyAllocProgressQty,
            $yearlyAllocProgressBud,
            $qtrBudget,
            $qtrQty, $_GET['tlid']);
        if ($res) {
            $_SESSION["message"] = " लक्ष तथा प्रगति विवरण परिबर्तन भैसकेको छ!!";
            echo "<script>location.href='dashboard.php?action=entryTwo&oid=" . $_GET['oid'] . "&name=" . $_GET['name'] . "';</script>";
        }
    }

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
                <p><?php echo isset($message) ? $message : ""; ?></p>
                <div class="galerie">
                    <form name="saveEntry" method="post">
                        <table width="120%" align="center" border="1" class="table">
                            <tr>
                                <td align="left" colspan="2"><span class="preeti">कार्यक्रम सँकेत नं.</span></td>
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
                                                                                               type="number"
                                                                                               step="1"
                                                                                               name="txtpyearqty"
                                                                                               value="<?php echo $yearlyAllocProgressQty; ?>"/></span>
                                </td>

                            </tr>

                            <tr>
                                <td align="center"><span class="preeti">खर्च बजेट</span></td>
                                <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi" size="30"
                                                                                               maxlength="50"
                                                                                               type="text"
                                                                                               name="txtpyearbudget"
                                                                                               value="<?php echo $yearlyAllocProgressBud ?>"/></span>
                                </td>
                            </tr>
                            <?php if ($row['q1_alloc_qty'] != 0) { ?>
                                <tr>

                                    <td align="center" rowspan="3"><span class="preeti">प्रथम चौमासिक लक्ष</span></td>

                                </tr>

                                <tr>

                                    <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                    <td><span class="siddhi"><?php echo $row['q1_alloc_qty'] ?></span></td>

                                </tr>
                                <tr>
                                    <td align="center"><span class="preeti">बजेट</span></td>
                                    <td><span class="siddhi"><?php echo $row['q1_alloc_budget'] ?></span></td>

                                </tr>


                                <tr>
                                    <td rowspan="3" align="center"><span class="preeti">प्रथम चौमासिक प्रगति</span></td>

                                </tr>


                                <tr>

                                    <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                    <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi"
                                                                                                   size="30"
                                                                                                   maxlength="50"
                                                                                                   type="number"
                                                                                                   step="1"
                                                                                                   name="txtpttqty"
                                                                                                   value="<?php echo $qtrQty ?>"/></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center"><span class="preeti">बजेट</span></td>
                                    <td align="left" bgcolor="#CCCCCC"><span class="preeti"><input class="siddhi"
                                                                                                   size="30"
                                                                                                   maxlength="50"
                                                                                                   type="text"
                                                                                                   name="txtpttbudget"
                                                                                                   value="<?php echo $qtrBudget ?>"/></span>
                                    </td>
                                </tr>

                            <?php } ?>
                            <tr>
                                <td colspan="3" align="center" rowspan="2"><span class="preeti"><input type="submit"
                                                                                                       name="btnaddprogress"
                                                                                                       value="  सेभ गर्ने  "
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
