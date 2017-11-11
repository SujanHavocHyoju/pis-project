<?php
session_start();
include('../class/common.php');
require_once "../class/PHPExcel.php";
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type']==0){
        if($_GET['type']=="edu"){
            $sql = $dbc->selectTransactionByGovOffice($_GET['oid']);
            $objPHPExcel = new PHPExcel();
            $office_name = 'कार्यालय अनुसर';
            $fiscal_year = '2074/75';
            ini_set('max_execution_time', 300);
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('C3:C4');
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('D1:I1');
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('J3:K3');
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('L3:M3');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('D2:I2');
    
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D1',$office_name);
            $objPHPExcel->setActiveSheetIndex()->mergeCells('D2:I2');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D2',$fiscal_year);
            $objPHPExcel->setActiveSheetIndex()->mergeCells('A3:A4');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('A3','कार्यक्रम सँकेत न.');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('B3:B4');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('C3:C4');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B3','कार्यक्रम/क्रियाकलाप')
            ->setCellValue('C3','कार्यालय नाम ');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('D3:F3');
    
            $objPHPExcel->setActiveSheetIndex()->setCellValue('E4','वार्षिक लक्ष')
            ->setCellValue('D4','इकाई')
            ->setCellValue('E4', 'भौतिक परिमाण')
            ->setCellValue('F4', 'इकाइ लागत')
            ->setCellValue('G4','बजेट');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('H3:I3');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('H3',"वार्षिक प्रगति")
            ->setCellValue('H4',"भौतिक परिमाण")
            ->setCellValue('I4','खर्च बजेट')
            ->setCellValue('J3','प्रथम चौमासिक लक्ष')
            ->setCellValue('J4','प्रथम चौमासिक लक्ष')
            ->setCellValue('K4','बजेट')
            ->setCellValue('L3','प्रथम चौमासिक प्रगति')
            ->setCellValue('L4','भौतिक परिमाण')
            ->setCellValue('M4','खर्च बजेट');;
    
            $i=4;
            while($row = mysqli_fetch_array($sql)) {
                $i++;
                $objPHPExcel->setActiveSheetIndex()
                ->setCellValue('A'.$i,$row['code'])
                ->setCellValue('B'.$i,$row['name_np'])
                ->setCellValue('C'.$i,$row["edu_name_np"])
                ->setCellValue('D'.$i,"")
                ->setCellValue('E'.$i,$row['yearly_alloc_qty'])
                ->setCellValue('F'.$i,$row['yearly_alloc_cost'])
                ->setCellValue('G'.$i,$row['yearly_alloc_budget'])
                ->setCellValue('H'.$i,$row['yearly_progress_qty'])
                ->setCellValue('I'.$i,$row['yearly_progress_expenditure'])
                ->setCellValue('J'.$i,$row['q1_alloc_qty'])
                ->setCellValue('K'.$i,$row['q1_alloc_budget'])
                ->setCellValue('L'.$i,$row['q1_progress_qty'])
                ->setCellValue('M'.$i,$row['q1_progress_expenditure']);
            }
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="pis-report-for-'.$office_name.'.xls"');
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
        }else if($_GET['type']=="local"){
            $sql = $dbc->selectTransactionLocal($_GET['oid']);
            $objPHPExcel = new PHPExcel();
            $office_name = 'कार्यालय अनुसर';
            $fiscal_year = '2074/75';
            ini_set('max_execution_time', 300);
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('C3:C4');
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('D1:I1');
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('J3:K3');
            $objPHPExcel->setActiveSheetIndex()
            ->mergeCells('L3:M3');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('D2:I2');
    
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D1',$office_name);
            $objPHPExcel->setActiveSheetIndex()->mergeCells('D2:I2');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D2',$fiscal_year);
            $objPHPExcel->setActiveSheetIndex()->mergeCells('A3:A4');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('A3','कार्यक्रम सँकेत न.');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('B3:B4');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('C3:C4');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B3','कार्यक्रम/क्रियाकलाप')
            ->setCellValue('C3','कार्यालय नाम ');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('D3:F3');
    
            $objPHPExcel->setActiveSheetIndex()->setCellValue('E4','वार्षिक लक्ष')
            ->setCellValue('D4','इकाई')
            ->setCellValue('E4', 'भौतिक परिमाण')
            ->setCellValue('F4', 'इकाइ लागत')
            ->setCellValue('G4','बजेट');
            $objPHPExcel->setActiveSheetIndex()->mergeCells('H3:I3');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('H3',"वार्षिक प्रगति")
            ->setCellValue('H4',"भौतिक परिमाण")
            ->setCellValue('I4','खर्च बजेट')
            ->setCellValue('J3','प्रथम चौमासिक लक्ष')
            ->setCellValue('J4','प्रथम चौमासिक लक्ष')
            ->setCellValue('K4','बजेट')
            ->setCellValue('L3','प्रथम चौमासिक प्रगति')
            ->setCellValue('L4','भौतिक परिमाण')
            ->setCellValue('M4','खर्च बजेट');;
    
            $i=4;
            while($row = mysqli_fetch_array($sql)) {
                $i++;
                $objPHPExcel->setActiveSheetIndex()
                ->setCellValue('A'.$i,$row['code'])
                ->setCellValue('B'.$i,$row['name_np'])
                ->setCellValue('C'.$i,$row["edu_name_np"])
                ->setCellValue('D'.$i,"")
                ->setCellValue('E'.$i,$row['yearly_alloc_qty'])
                ->setCellValue('F'.$i,$row['yearly_alloc_cost'])
                ->setCellValue('G'.$i,$row['yearly_alloc_budget'])
                ->setCellValue('H'.$i,$row['yearly_progress_qty'])
                ->setCellValue('I'.$i,$row['yearly_progress_expenditure'])
                ->setCellValue('J'.$i,$row['q1_alloc_qty'])
                ->setCellValue('K'.$i,$row['q1_alloc_budget'])
                ->setCellValue('L'.$i,$row['q1_progress_qty'])
                ->setCellValue('M'.$i,$row['q1_progress_expenditure']);
            }
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="pis-report-for-'.$office_name.'.xls"');
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
    }else{
        echo "<script>location.href='http://localhost/pis-project/cp/dashboard.php?action=home';</script>";
    }
      ?>