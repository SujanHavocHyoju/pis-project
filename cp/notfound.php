
	<!-- Content box -->
	<div id="content-box">
		<div id="content-box-in">
		
			<!-- Content left -->
			<div id="content-box-in-left">
				<div id="content-box-in-left-in">
					<h3 class="line" ><span>स्वागतम
                    (
                    <?php echo isset($_SESSION['office_name'])?$_SESSION['office_name']:"प्रयोगकर्ता";?> 
                    )
                    </span></h3>
					<div class="galerie">
					
					
										<div class="cleaner">&nbsp;</div>
									</div>
									<!-- My latest work end -->
					
					
									<center>
										<img src="../public/img/LOGO.png" alt=""/>
										<br /><br />
										<hr/>
									</center>	
			<?php if(isset($_GET["action"])){?>
				<h2 class="hide" style="font-size:50px;color:#F00;text-align:center;margin:6px 0 0 0px;"><b />४०४ </h2>
				<h2 class="hide" style="font-size:25px;color:#F00;text-align:center;margin:6px 0 0 0px;"><b />यस पृष्ठ फेला नपरेको  सूचना !</h2><br /><br /><br /><br />
				
				<h2 class="hide" style="font-size:20px;color:#F00;text-align:center;margin:6px 0 0 0px;">माफ गर्नु होला !  तपाईंले यो पृष्ठ देख्दै हुनुहुन्छ किनभने हामी तपाईंको पृष्ठ खोज्न असफल रहेका छौं ।</h2>
				<h2 class="hide" style="font-size:20px;color:#F00;text-align:center;margin:6px 0 0 0px;"><b />धन्यवाद!</h2>
            <?php }else{?>
			
				<h2 class="hide" style="font-size:25px;color:#F00;text-align:center;margin:6px 0 0 0px;"><b /> माफ गर्नुहोला !</h2><br /><br /><br /><br />
				
				<h2 class="hide" style="font-size:20px;color:#F00;text-align:center;margin:6px 0 0 0px;">सर्भर अध्यावधिक भैरहेको छ ।केहि समय पछि पुन प्रयास गर्नु होला।</h2>
				<h2 class="hide" style="font-size:20px;color:#F00;text-align:center;margin:6px 0 0 0px;"><b />धन्यवाद!</h2>
            <?php }?>
            
			
			
						<!-- My other work end -->
				</div>
			</div>
			<!-- Content left end -->
				
			<!-- Content right --><!-- Content right end -->
		  <div class="cleaner">&nbsp;</div>
		</div>
	</div>
	<!-- Content box end -->
