<?php 
    class Utils{
        function successMessage($message){
            return '<div class="isa_success">
            <i class="fa fa-check"></i>
            '.$message.'
                </div>';
        } 
        function errorMessage($message){
            return '<div class="isa_error">
                    <i class="fa fa-times-circle fa"></i>
                        '.$message.'
                    </div>';
        }
        function infoMessage($message){
            return '<div class="isa_info">
            <i class="fa fa-info-circle"></i>
                '.$message.'
            </div>';
        }
        function backPage(){
           echo "<script>window.history.back();</script>";
        }
        function alreadyExists($type,$data){
            return $type.$data." पहिलै दर्ता भैसाकेको छ!! पुन प्रयाश गर्र्नु होला!!";
        }
        function error($type,$data){
            return $type.$data." दर्ता हुन्न सकेना!  ्पुन प्रयाश गर्र्नु होला!";
        }
        function success($type,$data){
            return $type.$data."  दर्ता भैसाकेको छ!!";
        }
        function successOnEdit($type,$data){
            return $type.$data." परिबर्तन भैसकेको छ!!";
        }
        function errorOnEdit($type,$data){
            return $type.$data." परिबर्तन हुन्न सकेन!!";
        }
    }
    $utils = new Utils();
?>