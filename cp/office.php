
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span class="preeti" style="font-size:23px;">कार्यालय विवरण </span></h3>

                <!-- My latest work -->
                <div class="galerie">




                    <form action="" method="post">
                        <table width="80%" align="center" border="0" class="table">
                            <tr>
                                <td width="35%" align="right"><span class="preeti">सि नं</span></td>
                                <td width="65%" align="left"><p><input class="siddhi"  size="40" maxlength="50" type="text" name="txtofficecode" " /></p></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">कार्यालयको नाम </span></td>
                                <td align="left"><p><input type="text" class="preeti" size="40" maxlength="500" name="txtofficename" required autofocus /></p></td>

                            </tr>
                            <tr>
                                <td align="right"><span class="preeti">विकास क्षेत्र </span></td>
                                <td align="left"><p>
                                        <select name="txtregion"  class="preeti" style="width:232px; ">

                                            <option value="1">पुर्वान्चल</option>
                                            <option value="2">मध्यमान्चल</option>
                                            <option value="3">पश्चिमान्चल</option>
                                            <option value="4">मध्य पश्चिमान्चल</option>
                                            <option value="5">सुदुर पश्चिमान्चल</option>


                                        </select>
                                    </p></td>

                            </tr>




                            <tr>
                                <td>&nbsp;</td>
                                <td><p><input type="submit" name="addsec" value=" सेभ गर्ने " /></p></td>
                            </tr>
                        </table>
                    </form>
                    <br />

                    <form name="searchsection" action="" method="post">
                        <table width="80%" align="center" border="1" class="table">
                            <tr>
                                <td align="right">
                                    नामको आधारमा खोजी गर्ने : <input type="text" size="30" maxlength="100" name="txtsearch" class="preeti" />
                                    <input type="submit" name="btnsearch" value="खोजी गर्ने" />


                                </td>

                            </tr>
                        </table>
                    </form>


                    <table width="80%" align="center" border="1" class="table">
                        <tr>
                            <th width="15%"><span class="preeti">सि.नं.</span></th>
                            <th ><span class="preeti">कार्यालयको नाम</span></th>
                            <th ><span class="preeti">विकास क्षेत्र</span></th>
                            <th ></th>
                            <th ></th>


                        </tr>
                        <?php $sql = $dbc->selectOffice();
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                            <td><span class="siddhi"><?php echo $row["id"];?></span></td>
                            <td width="55%"><span class="preeti"><?php echo $row["name_np"];?></span></td>
                            <td width="55%"><span class="preeti"><?php echo $row["d_name"];?></span></td>


                            <td align="center" width="10%"><p><a href="editoffice.php?id=1" class="edit">Edit</a></p></td>
                            <td align="center" width="10%"><p><a onclick="return validateForm()" href="deloffice.php?id=1" class="delete">Delete</a></p></td>
                        </tr>
                            <?php } ?>
                        
                    </table>

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