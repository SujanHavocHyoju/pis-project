<?php
/**
 * Created by IntelliJ IDEA.
 * User: bibek
 * Date: 11/29/17
 * Time: 7:37 PM
 */
require_once "./common.php";
class ReportRepositroy
{
    function sumOfIndiLocalActivity()
    {
        $query = "SELECT 
        act.desc_np as act_name_np,
        act.local_activity3_code as act_code,
        SUM(tl.yearly_alloc_qty) as syaq,
        SUM(tl.yearly_alloc_budget) as syab,
        SUM(tl.yearly_progress_qty) as sypq,
        SUM(tl.yearly_progress_expenditure) as sype,
        SUM(tl.q1_alloc_qty) as sqaq,
        SUM(tl.q1_alloc_budget) as sqab,
        SUM(tl.q1_progress_qty) as sqpq, 
        SUM(tl.q1_progress_expenditure) as sqpe
        from tbl_local_bodies_activities4 as act
            left join tbl_transaction_local_bodies as tl on tl.local_body_activity4_id=act.id
            where tl.local_body_id='$oid'
            GROUP BY
            act.id
            ORDER BY act.id ASC;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }
    function sumOfIndiLocalTotal($oid)
    {
        $query = "SELECT 
            SUM(syaq) as agr_syag, 
            SUM(syab) as agr_syab, 
            SUM(sypq) as agr_sypq, 
            SUM(sype) as agr_sype, 
            SUM(sqaq) as agr_sqaq, 
            SUM(sqab) as agr_sqab, 
            SUM(sqpq) as agr_sqpq, 
            SUM(sqpe) as agr_sqpe 
            FROM 
                (SELECT 
        act.desc_np as act_name_np,
        act.local_activity3_code as act_code,
        SUM(tl.yearly_alloc_qty) as syaq,
        SUM(tl.yearly_alloc_budget) as syab,
        SUM(tl.yearly_progress_qty) as sypq,
        SUM(tl.yearly_progress_expenditure) as sype,
        SUM(tl.q1_alloc_qty) as sqaq,
        SUM(tl.q1_alloc_budget) as sqab,
        SUM(tl.q1_progress_qty) as sqpq, 
        SUM(tl.q1_progress_expenditure) as sqpe
        from tbl_local_bodies_activities4 as act
            left join tbl_transaction_local_bodies as tl on tl.local_body_activity4_id=act.id
            where tl.local_body_id='$oid'
            GROUP BY
            act.id
            ORDER BY act.id ASC) as T_AGR ;
        ";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }
    function generateIndividualLocalReport($oid){
        //set_time_limit(3000);
        $resultFinal = mysqli_fetch_array($this->sumOfIndiLocalTotal($oid));
        $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_local_reports`;";
        $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
        if ($resultForTruncate > 0) {
            $resultFromSubQueries = $this->sumOfIndiLocalActivity($oid);
            while ($raa = mysqli_fetch_array($resultFromSubQueries)) {
                $yearlyWeight = ($raa['syab'] / $resultFinal['agr_syab']) * 100;
                if ($raa['syaq'] != 0) {
                    $yearlyProgressQtyPer = ($raa['sypq'] / $raa['syaq']) * 100;
                } else {
                    $yearlyProgressQtyPer = 0;
                }
                if ($raa['syab'] != 0) {
                    $yearlyExpProPer = ($raa['sype'] / $raa['syab']) / 100;
                } else {
                    $yearlyExpProPer = 0;
                }
                if ($resultFinal['agr_sqaq'] != 0) {
                    $qtrAllocWeight = ($raa['sqaq'] / $resultFinal['agr_sqaq']) * 100;
                } else {
                    $qtrAllocWeight = 0;
                }

                if ($raa['sqaq'] != 0) {
                    $qtrProgressQtyPer = ($raa['sqpq'] / $raa['sqaq']) * 100;
                } else {
                    $qtrProgressQtyPer = 0;
                }
                if ($raa['sqab'] != 0) {
                    $qtrExpProPer = ($raa['sqpe'] / $raa['sqab']) / 100;
                } else {
                    $qtrExpProPer = 0;
                }

                $queryToInsertAct = sprintf(
                    "INSERT INTO 
                `pisdoego_db_pis`.`tbl_local_reports` 
                (`activity_number`, 
                `yearly_alloc_qty`, 
                `yearly_weight`, 
                `yearly_alloc_budget`, 
                `yearly_progress_qty`, 
                `yearly_progress_qty_percentage`, 
                `yearly_progress_expenditure`, 
                `yearly_progress_expenditure_percentage`, 
                `yearly_progress_weight`, 
                `qtr_alloc_qty`, 
                `qtr_alloc_weight`, 
                `qtr_alloc_budget`, 
                `qtr_progress_qty`, 
                `qtr_progress_qty_percentage`, 
                `qtr_progress_expenditure`, 
                `qtr_progress_expenditure_percentage`, 
                `qtr_progress_expenditure_weight`, 
                `name_np`,
                `status`) 
                VALUES (
                '%s', 
                '%s',
                '%s', 
                '%s',  
                '%s', 
                '%s', 
                '%s', 
                '%s', 
                '%s', 
                '%s', 
                '%s', 
                '%s', 
                '%s',  
                '%s', 
                '%s',  
                '%s', 
                '%s', 
                '%s',
                '2')",
                    mysqli_real_escape_string($this->dbc, $raa['act_code']),
                    mysqli_real_escape_string($this->dbc, $raa['syaq']),
                    mysqli_real_escape_string($this->dbc, $yearlyWeight),
                    mysqli_real_escape_string($this->dbc, $raa['syab']),
                    mysqli_real_escape_string($this->dbc, $raa['sypq']),
                    mysqli_real_escape_string($this->dbc, $yearlyProgressQtyPer),
                    mysqli_real_escape_string($this->dbc, $raa['sype']),
                    mysqli_real_escape_string($this->dbc, $yearlyExpProPer),
                    mysqli_real_escape_string($this->dbc, ($yearlyProgressQtyPer / 100) * $yearlyWeight),
                    mysqli_real_escape_string($this->dbc, $raa['sqaq']),
                    mysqli_real_escape_string($this->dbc, $qtrAllocWeight),
                    mysqli_real_escape_string($this->dbc, $raa['sqab']),
                    mysqli_real_escape_string($this->dbc, $raa['sqpq']),
                    mysqli_real_escape_string($this->dbc, $qtrProgressQtyPer),
                    mysqli_real_escape_string($this->dbc, $raa['sqpe']),
                    mysqli_real_escape_string($this->dbc, $qtrExpProPer),
                    mysqli_real_escape_string($this->dbc, ($qtrProgressQtyPer / 100) * $qtrAllocWeight),
                    mysqli_real_escape_string($this->dbc, $raa['act_name_np'])
                );
                $resultFrom = mysqli_query($this->dbc, $queryToInsertAct);
                if ($resultFrom < 0) {
                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_local_reports`;";
                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                    return false;
                }
            }
            $queryToFinal = sprintf("INSERT INTO 
            `pisdoego_db_pis`.`tbl_local_reports` 
            (`activity_number`, 
            `yearly_weight`, 
            `yearly_alloc_budget`, 
            `yearly_progress_expenditure`, 
            `yearly_progress_expenditure_percentage`, 
            `qtr_alloc_weight`, 
            `qtr_alloc_budget`, 
            `qtr_progress_expenditure`, 
            `qtr_progress_expenditure_percentage`, 
            `name_np`,
            `status`) VALUES 
            ('', 
            '0', 
            '%s', 
            '%s', 
            '0', 
            '0', 
            '%s', 
            '%s',
            '0', 
            'कूल जम्मा',
            '4')",
                mysqli_real_escape_string($this->dbc, $resultFinal['agr_syab']),
                mysqli_real_escape_string($this->dbc, $resultFinal['agr_sype']),
                mysqli_real_escape_string($this->dbc, $resultFinal['agr_sqab']),
                mysqli_real_escape_string($this->dbc, $resultFinal['agr_sqpe']));
            $resultToFinale = mysqli_query($this->dbc, $queryToFinal);
            return true;
        } else {
            return false;
        }
    }

}

?>