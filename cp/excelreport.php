<?php
include('../class/common.php');
require_once "../class/PHPExcel.php";
$objPHPExcel = new PHPExcel();
$office_name = $_GET['o_name'];
$fiscal_year = $_GET['f_year'];
ini_set('max_execution_time', 300);
if(isset($_GET['eid'])){
    $sql = $dbc->selectTransactionLocal($_GET['eid']);
}
if(isset($_GET['lid'])){
    $sql = $dbc->selectTransactionLocalok($_GET['lid']);
}
$objPHPExcel->setActiveSheetIndex()
->mergeCells('C3:C4');
$objPHPExcel->setActiveSheetIndex()
->mergeCells('D1:I1');
$objPHPExcel->setActiveSheetIndex()
->mergeCells('I3:J3');
$objPHPExcel->setActiveSheetIndex()
->mergeCells('K3:L3');
$objPHPExcel->setActiveSheetIndex()->mergeCells('D2:I2');

$objPHPExcel->setActiveSheetIndex()->setCellValue('D1',$office_name);
$objPHPExcel->setActiveSheetIndex()->mergeCells('D2:I2');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D2',$fiscal_year);
$objPHPExcel->setActiveSheetIndex()->mergeCells('A3:A4');
$objPHPExcel->setActiveSheetIndex()->setCellValue('A3','कार्यक्रम सँकेत न.');
$objPHPExcel->setActiveSheetIndex()->mergeCells('B3:B4');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B3','कार्यक्रम/क्रियाकलाप')
->setCellValue('C3','इकाई');
$objPHPExcel->setActiveSheetIndex()->mergeCells('D3:F3');

$objPHPExcel->setActiveSheetIndex()->setCellValue('D3','वार्षिक लक्ष')
->setCellValue('D4', 'भौतिक परिमाण')
->setCellValue('E4', 'इकाइ लागत')
->setCellValue('F4','बजेट');
$objPHPExcel->setActiveSheetIndex()->mergeCells('G3:H3');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G3',"वार्षिक प्रगति")
->setCellValue('G4',"भौतिक परिमाण")
->setCellValue('h4','खर्च बजेट')
->setCellValue('I3','तेश्रो चौमासिक लक्ष')
->setCellValue('I4','तेश्रो चौमासिक लक्ष')
->setCellValue('J4','बजेट')
->setCellValue('K3','तेश्रो चौमासिक प्रगति')
->setCellValue('k4','भौतिक परिमाण')
->setCellValue('L4','खर्च बजेट');;

$i=4;
while($row = mysqli_fetch_array($sql)) {
    $i++;
    $objPHPExcel->setActiveSheetIndex()
    ->setCellValue('A'.$i,$row['code'])
    ->setCellValue('B'.$i,$row['name_np'])
    ->setCellValue('C'.$i,"")
    ->setCellValue('D'.$i,$row['yearly_alloc_qty'])
    ->setCellValue('E'.$i,$row['yearly_alloc_cost'])
    ->setCellValue('F'.$i,$row['yearly_alloc_budget'])
    ->setCellValue('G'.$i,$row['yearly_progress_qty_expenditure'])
    ->setCellValue('H'.$i,$row['yearly_progress_expenditure'])
    ->setCellValue('I'.$i,$row['q3_alloc_qty'])
    ->setCellValue('J'.$i,$row['q3_alloc_budget'])
    ->setCellValue('K'.$i,$row['q3_qty_expenditure'])
    ->setCellValue('L'.$i,$row['q3_expenditure']);
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="pis-report.xls"');
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
?>