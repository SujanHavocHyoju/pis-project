<?php
session_start();
include('../class/common.php');
require_once "../class/PHPExcel.php";
if(isset($_SESSION['user_type'])&&isset($_SESSION['username'])){
    if($_SESSION['user_type']==0){
        $objPHPExcel = new PHPExcel();
        ini_set('max_execution_time', 300);
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('D1:G1');
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('D2:G2');
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('D3:G3');
        if(isset($_GET['o_name'])){
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D1',"प्रगति प्रतिवेदन (".$_GET['o_name'].")");
        }else{
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D1',"प्रगति प्रतिवेदन ");
        }
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D2',"आ.व. २०७३/७४ (जिल्लास्तर) ");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D3',"कार्यक्रम : ३५०८०६ (विद्यालयक्षेत्र विकास कार्यक्रम)");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('A4:A5');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('A4',"कार्यक्रम सँकेत न.");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('B4:B5');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"कार्यक्रम/क्रियाकलाप");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('C4:C5');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"एकाई");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('D4:G4');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"वार्षिक लक्ष");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D5',"इकाइ लागत");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E5',"भौतिक परिमाण");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F5',"भार");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G5',"बजेट");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('H4:L4');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"वार्षिक प्रगति");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H5',"भौतिक परिमाण");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I5',"भौतिक प्रगति प्रतिशत");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J5',"खर्च रकम");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('K5',"खर्च प्रतिशत");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L5',"भारित");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('M4:O4');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('M4',"तेश्रो चौमासिक लक्ष");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('M5',"भौतिक परिमाण");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('N5',"भार");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L5',"बजेट");
        $objPHPExcel->setActiveSheetIndex()
        ->mergeCells('P4:T4');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P4',"तेश्रो चौमासिक प्रगति");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P5',"भौतिक परिमाण");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Q5',"भौतिक प्रगति प्रतिशत");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('R5',"खर्च रकम");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('S5',"खर्च प्रतिशत");
        $objPHPExcel->setActiveSheetIndex()->setCellValue('T5',"भारित");
        $i=5;
        $sql =$dbc->selectAllFinalReport();
        while($row = mysqli_fetch_array($sql)) {
            $i++;
            $objPHPExcel->setActiveSheetIndex()
            ->setCellValue('A'.$i,$row['activity_number'])
            ->setCellValue('B'.$i,$row['name_np'])
            ->setCellValue('C'.$i,$row['unit'])
            ->setCellValue('D'.$i,$row['yearly_alloc_cost'])
            ->setCellValue('E'.$i,$row['yearly_alloc_qty'])
            ->setCellValue('F'.$i,$row['yearly_weight'])
            ->setCellValue('G'.$i,$row['yearly_alloc_budget'])
            ->setCellValue('H'.$i,$row['yearly_progress_qty'])
            ->setCellValue('I'.$i,$row['yearly_progress_qty_percent'])
            ->setCellValue('J'.$i,$row['yearly_progress_expenditure'])
            ->setCellValue('K'.$i,$row['yearly_progress_expenditure_percent'])
            ->setCellValue('L'.$i,$row['yearly_progress_weighted'])
            ->setCellValue('M'.$i,$row['qtr_alloc_qty'])
            ->setCellValue('N'.$i,$row['qtr_alloc_weight'])
            ->setCellValue('O'.$i,$row['qtr_alloc_budget'])
            ->setCellValue('P'.$i,$row['qtr_progress_qty'])
            ->setCellValue('Q'.$i,$row['qtr_progress_qty_percent'])
            ->setCellValue('R'.$i,$row['qtr_progress_expenditure'])
            ->setCellValue('S'.$i,$row['qtr_progress_expenditure_percent'])
            ->setCellValue('T'.$i,$row['qtr_progress_expenditure_weighted']);
        }
        header('Content-Type: application/vnd.ms-excel');
       if(isset($_GET['o_name'])){
        header('Content-Disposition: attachment;filename="pis-report-final-for-'.$_GET['o_name'].'.xls"');
       }else{
        header('Content-Disposition: attachment;filename="pis-report-final.xls"');
       }
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }else{
        echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home';</script>";
    }
}
else{
    echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home';</script>";
}

?>