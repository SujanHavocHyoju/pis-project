<?php
    
    if(isset($_POST['message'])){
        $message = $utils->infoMessage($_POST['message'].' डेटाबेस जगेडा हुन्न सफल वयेको छ!!');
    }
    if(!isset($_SESSION['fullname'])){
        echo "<script>window.location='login.php';</script>";
    }    
?>
<div id="content-box">
    <div id="content-box-in">

        <!-- Content left -->
        <div id="content-box-in-left">
            <div id="content-box-in-left-in">
                <h3 class="line"><span>स्वागतम
                    (
                    <?php echo empty($_SESSION['office_name'])?$_SESSION['fullname']:$_SESSION['office_name'];?> 
                    )
                    </span></h3>
                    <p><?php echo isset($message)?$message:"";?></p>
                <!-- My latest work -->
                <div class="galerie">


                    <div class="cleaner">&nbsp;</div>
                </div>
                <!-- My latest work end -->


                <center>
                    <img src="../public/img/LOGO.png" alt=""/>
					<br /><br />
                    <hr/>
                </center>


                <u><h1 style="color:#F00">प्रयोगकर्तालाई निर्देशन</h1><br/></u>
                त्यस कार्यालयको आ.व. २०७४/७५ को वार्षिक तथा प्रथम चौमासिक प्रगति प्रविष्टिको लागि निम्न अनुसार काम
                गर्नुहोस । <br/>
                <ul>
                    <li> १. माथिको <b><u> प्रगति प्रवष्टि </u></b>मेनुमा क्लिक गर्नुहोस ।</li>
                    <li> २. आफ्नो कार्यालयको <b><u> प्रगति विवरण प्रविष्टि गर्नुहोस </u></b> लिङ्कमा क्लिक गर्नुहोस ।
                    </li>
                    <li> ३. त्यस कार्यालयको यस आ.व.का सबै क्रियाकलापहरु तथा लक्ष को लिष्ट देखिनेछ । जुन क्रियाकलापको
                        प्रगति प्रविष्टि गर्नुछ त्यसको अन्त्यमा रहेको <b><u> प्रगति थप गर्ने </u></b> लिङ्कमा क्लिक
                        गर्नुहोस ।
                    </li>
                    <li> ४. उक्त क्रियाकलापको वार्षिक तथा प्रथम चौमासिकको प्रगति खर्च बजेट तथा परिमाण टाइप गरी <b><u>
                                रेकर्ड सेभ गर्ने </u></b> मा क्लिक गर्नुहोस ।
                    </li>
                    <li> ५. बुँदा नं. ४ मा गरे जस्तै एक पछि अर्को गर्दै सबै क्रियाकलापहरुको प्रगति प्रविष्टि गर्नुहोस
                        ।
                    </li>
                    <li> ६. यदी लक्षको बजेट भन्दा प्रगतिको खर्च रकम बढी हुन गएमा सफ्टवेयरले उक्त क्रियाकलापमा <img
                            src="../public/img/cross.png"/> चिन्ह देखाउनेछ । यस्तो <img src="../public/img/cross.png"/> चिन्ह देखिएमा उक्त
                        क्रियाकलापको प्रगति पुन: चेक गरी आवस्यकता अनुसार सच्याउनुहोस ।
                    </li>
                    <li> ७. रकम टाइप गर्दा रु. हजारमा टाइप गर्नुहोस । अन्यथा पर्न गएमा सम्बन्धित कार्यालय नै जवाफदेही
                        हुनुपर्नेछ ।
                    </li>
                    <li> ८. सबै क्रियाकलापहरुको प्रगति टाइप गरिसकेपछि पुन: चेक गर्नुहोस । कुनै क्रियाकलापको प्रगति विवरण
                        गल्ति भेटिएमा उक्त क्रियाबलापको <b><u> प्रगति थप गर्ने  </u></b> लिङ्कमा क्लिक गरी सच्याउनुहोस ।
                    </li>
                    <li> ९. काम सकिएपछि आफ्नो कार्यालयको प्रगति प्रतिवेदन हेर्नका लागि त्यही पेजको माथि राखिएको <b><u>
                                प्रतिवेदन डाउनलोड गर्ने </u></b> लिङ्कमा क्लिक गर्नुहोस । यसपछि तपाइको कार्यालयको प्रगति
                        प्रतिवेदन माइक्रोसफ्ट एक्सेल (Microsoft Excel) को फाइल डाउनलोड गरी आफुसँग राख्न सक्नुहुनेछ ।
                    </li>
                </ul>


                <br/>
                <div class="cleaner">&nbsp;</div>
            </div>
            <!-- My other work end -->
        </div>
    </div>
    <!-- Content left end -->

    <!-- Content right --><!-- Content right end -->
    <div class="cleaner">&nbsp;</div>
</div>
</div>