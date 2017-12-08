<?php
/**
 * Created by IntelliJ IDEA.
 * User: bibek
 * Date: 12/7/17
 * Time: 7:33 PM
 */
$row = mysqli_fetch_array($dbc->selectOneTransactionGovernment($_GET['oid'], $_GET['tlid']));
$yearlyAllocQty = $row["yearly_alloc_qty"];
$yearlyAllocCost = $row["yearly_alloc_cost"];
$yearlyAllocBudget = $row["yearly_alloc_budget"];
$yearlyAllocProgressQty = $row['yearly_progress_qty'];
$yearlyAllocProgressBud = $row['yearly_progress_expenditure'];
$q1AllocQty = $row["q1_alloc_qty"];
$q1AllocBudget = $row["q1_alloc_budget"];
$qtrQty = $row['q1_progress_qty'];
$qtrBudget = $row['q1_progress_expenditure'];
if (isset($_POST['btnaddprogress'])) {
    $isSuccess = true;
    $yearlyAllocQty = $_POST["txtallocyearqty"];
    $yearlyAllocCost = $_POST["txtallocyearcost"];
    $yearlyAllocBudget = $_POST["txtallocyearbud"];
    $yearlyAllocProgressQty = $_POST['txtpyearqty'];
    $yearlyAllocProgressBud = $_POST['txtpyearbudget'];
    $q1AllocQty = $_POST["txtq1alocqty"];
    $q1AllocBudget = $_POST["txtq1alocbdg"];
    $qtrQty = $_POST['txtpttqty'];
    $qtrBudget = $_POST['txtpttbudget'];
    $res = $dbc->updateGovernmentAdminTransaction(
        $yearlyAllocQty,
        $yearlyAllocCost,
        $yearlyAllocBudget,
        $yearlyAllocProgressQty,
        $yearlyAllocProgressBud,
        $q1AllocQty,
        $q1AllocBudget,
        $qtrBudget,
        $qtrQty, $_GET['tlid']);
    if ($res) {
        $_SESSION["message"] = " लक्ष्य तथा प्रगति विवरण परिबर्तन भैसकेको छ!!";
        echo "<script>location.href='dashboard.php?action=entryTwo&oid=" . $_GET['oid'] . "&name=" . $_GET['name'] . "';</script>";
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
                                <td rowspan="4" align="center"><span class="preeti">वार्षिक लक्ष्य</span></td>

                            </tr>

                            <tr>
                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td><span class="siddhi">
                                        <input class="siddhi" size="30"
                                               maxlength="50"
                                               type="number"
                                               step="1"
                                               name="txtallocyearqty"
                                               value="<?php echo $yearlyAllocQty; ?>"/></span></td>
                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">इकाइ लागत</span></td>
                                <td><span class="siddhi">
                                        <input class="siddhi" size="30"
                                               maxlength="50"
                                               type="number"
                                               step="1"
                                               name="txtallocyearcost"
                                               value="<?php echo $yearlyAllocCost; ?>"/>

                                        </span></td>
                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">बजेट</span></td>
                                <td><span class="siddhi">
                                     <input class="siddhi" size="30"
                                            maxlength="50"
                                            type="number"
                                            step="1"
                                            name="txtallocyearbud"
                                            value="<?php echo $yearlyAllocBudget; ?>"/>
                                    </span>
                                </td>


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
                            <tr>

                                <td align="center" rowspan="3"><span class="preeti">प्रथम चौमासिक लक्ष्य</span></td>

                            </tr>

                            <tr>

                                <td align="center"><span class="preeti">भौतिक परिमाण</span></td>
                                <td><span class="siddhi">
                                        <input class="siddhi"
                                               size="30"
                                               maxlength="50"
                                               type="number"
                                               step="1"
                                               name="txtq1alocqty"
                                               value="<?php echo $q1AllocQty ?>"/>

                                    </span></td>

                            </tr>
                            <tr>
                                <td align="center"><span class="preeti">बजेट</span></td>
                                <td><span class="siddhi">
                                    <input class="siddhi"
                                           size="30"
                                           maxlength="50"
                                           type="number"
                                           step="1"
                                           name="txtq1alocbdg"
                                           value="<?php echo $q1AllocBudget ?>"/>
                                    </span></td>

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
