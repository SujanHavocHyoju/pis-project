

<div id="skip-menu"></div>

<!-- Content box -->
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">स्थानीय कार्यालय  </span></h3>
                <h4 class="line"><span class="preeti" style="font-size:23px;">आ.व. <?php echo $_SESSION['fiscal_year'];?> </span></h4>

                <!-- My latest work -->
                <div class="galerie">


                    <table width="100%" align="center" border="1" class="table">
                        <tr>
                            <th width="5%" align="center"><span class="preeti">सि.नं.</span></th>
                            <th  align="center"><span class="preeti">कार्यालयको नाम</span></th>
                            <th align="center"><span class="preeti">कार्यालयको नाम (अंग्रेजीमा)</span></th>
                            <th  width="15%" align="center"><span class="preeti">विकास क्षेत्र</span></th>
                            <th width="15%" align="center"><span class="preeti">जिल्ला</span></th>
                            <th align="center" width="30%"><span class="preeti"></span></th>
                        </tr>
                        <?php
                        $i = 1;
                        $sql = $dbc->selectOffice();
                        while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><span class="siddhi"><?php echo $i++ ?></span></td>
                                <td >

                                    <span class="preeti"><?php echo $row['name_np'] ?></span>
                                    
                                </td>
                                <td ><span class="preeti"><?php echo $row["name_en"];?></span></td>
                                <td ><span class="preeti"><?php echo $row["d_name"];?></span></td>
                                <td><span class="preeti"><?php echo $row["di_name"];?></span></td>
                                <td align="center" width="30%">
                                    <span class="preeti"><a
                                                href="dashboard.php?action=entryLocalTwo&oid=<?php echo $row['id']?>&name=<?php echo $row['name_np'] ?>"
                                                class="edit" name="entry">प्रगति विवरण प्रविष्टि गर्नुहोस</a></span>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>

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

<!-- Content box end -->