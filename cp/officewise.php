
<!-- Content box -->
<div id="content-box">
		<div id="content-box-in">
		
			<!-- Content left -->
			<div id="content-box-in-left">
				<div id="content-box-in-left-in">
					<h3 class="line"><span class="preeti" style="font-size:23px;">शैक्षिक कार्यालय  </span></h3>
                    <h4 class="line"><span class="preeti" style="font-size:23px;">आ.व. <?php echo $_SESSION['fiscal_year'];?> </span></h4>
						
						<!-- My latest work -->
						<div class="galerie">
			  				<table width="100%" align="center" border="1" class="table">
								<tr>
                                	<th width="10%" align="center"><span class="preeti">सि. नं.</span></th>
                                    <th align="center"><span class="preeti">कार्यालयको नाम</span></th>
                                    <th align="center"><span class="preeti"></span></th>
                                   <th align="center" width="15%"><span class="preeti"></span></th>

                                    
                                   
                                    
                                </tr>
                                <?php $sql =$dbc->selectEduOffice();
                                    while($row = mysqli_fetch_array($sql)){
										$activityResult = mysqli_fetch_array($dbc->countActivities($row['id']));
										$undoneResult = mysqli_fetch_array($dbc->countActiviesWhichIsUnDone($row['id']));
										?>
                                        <tr>
                                    	<td><span class="siddhi">
										
										
										<?php echo $row['id']?></span></td>
                                        <td width="30%"><span class="preeti"><?php echo $row['name_np'];?></span></td>
                                        
                                        <td width="30%"><span class="preeti">
                                        <?php echo $activityResult[0]. " क्रियकलाप मध्ये ".$undoneResult[0]. " क्रियाकलापको रेकर्ड अपुरो भेटिएको";?>
										                                        
                                        </span></td>
                                        
                                        
                                        <td align="center"  width="12%"  bgcolor="#999999"><span class="preeti">
											
                                            <a href="dashboard.php?action=officewisereport&oid=<?php echo $row['id'];?>&type=edu&o_name=<?php echo $row['name_np']?>" class="edit">प्रगति विवरण प्रतिवेदन</a>
                                            
                                                
                                                </span></td>
                                                
                                                
                                            
                                            
                                                
                                                </span></td>
                                               
                                               
                                                
                                            
                                       
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                                                	
                                                        
                     
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
<!-- Content box end -->