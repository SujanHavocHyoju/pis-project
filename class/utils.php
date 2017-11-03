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
                    <i class="fa fa-times-circle"></i>
                        '.$message.'
                    </div>';
        }
        function infoMessage($message){
            return '<div class="isa_info">
            <i class="fa fa-info-circle"></i>
                '.$message.'
            </div>';
        }
    }
    $utils = new Utils();
?>