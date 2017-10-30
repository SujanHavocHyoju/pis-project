<?php

/*Declaring the constant keyword */
define('DB_SERVER','127.0.0.1');
define('DB_USER','root');
define('DB_PASS' ,'admin');
define('DB_NAME', 'db_pis');

class DB_dbc
{

    protected $dbc;

    function __construct()
    {
        $this->dbc = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die('Could not connect to the database server'.mysqli_connect_error());
        mysqli_query($this->dbc,"set character_set_client='utf8'");
        mysqli_query ($this->dbc,"set character_set_results='utf8'");
        mysqli_query ($this->dbc,"set collation_connection='utf8_general_ci'");
        mysqli_select_db($this->dbc, 'db_pis');
    }

    function selectProgram(){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_programs");
        return $res;
    }
    function selectOneProgram($id){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_programs WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function selectOffice(){
        $res = mysqli_query($this->dbc, "SELECT lo.id,lo.code,lo.name_np,d.name_np as 'd_name' FROM tbl_local_offices as lo LEFT JOIN tbl_developement_regions AS d ON lo.development_region_id = d.id");
        return $res;
    }
    function selectEduOffice(){
        $res = mysqli_query($this->dbc, "SELECT eo.id,eo.name_np,d.name_np as 'd_name' FROM tbl_edu_offices as eo LEFT JOIN tbl_developement_regions AS d ON eo.development_region_id = d.id");
        return $res;
    }
    function selectOneEduOffice($id){
        $res = mysqli_query($this->dbc, "SELECT * from tbl_edu_offices WHERE id=".$id);
        return $res;
    }
    function updateEduOffice($sn,$office_name_np,$office_name_ep,$region){
        $query = sprintf("UPDATE `db_pis`.`tbl_edu_offices` SET name_np='%s',name_en='%s',development_region_id='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc,$office_name_np),
            mysqli_real_escape_string($this->dbc,$office_name_ep),
            mysqli_real_escape_string($this->dbc,$region),
            mysqli_real_escape_string($this->dbc,$sn));
        echo $query;
        $res = mysqli_Query($this->dbc,$query);
        return $res;
    }
    function insertEduOffice($sn,$office_name_np,$office_name_ep,$region){
        $query = sprintf("INSERT INTO `db_pis`.`tbl_edu_offices` (`id`, `name_np`, `name_en`, `province_id`, `development_region_id`) VALUES ('%s', '%s', '%s', '%s', '%s');",
            mysqli_real_escape_string($this->dbc,$sn),
            mysqli_real_escape_string($this->dbc,$office_name_np),
            mysqli_real_escape_string($this->dbc,$office_name_ep),
            mysqli_real_escape_string($this->dbc,'0'),
            mysqli_real_escape_string($this->dbc,$region));
        $res = mysqli_Query($this->dbc,$query);
        return $res;
    }
    function insertProgram($exp_head_code,$program){
        $query =sprintf("INSERT INTO `db_pis`.`tbl_programs` (`name_np`, `exp_head_code`) VALUES ('%s','%s')",
            mysqli_real_escape_string($this->dbc,$program),
            mysqli_real_escape_string($this->dbc,$exp_head_code)
        );
        $res = mysqli_Query($this->dbc,$query);
        return $query;
    }
    function updateProgram($id,$exp_head_code,$program_name){
        $query =sprintf("UPDATE  `db_pis`.`tbl_programs` set exp_head_code='%s', name_np='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc,$exp_head_code),
            mysqli_real_escape_string($this->dbc,$program_name),
            mysqli_real_escape_string($this->dbc,$id)
        );
        echo $query;
        $res = mysqli_Query($this->dbc,$query);
        return $query;
    }

    function selectLocalOffice(){
        $result  = mysqli_query($this->dbc,"SELECT * FROM tbl_local_offices");
        return $result;
    }
    function selectMainActivity($pid){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activities WHERE program_id = '$pid'");
        return $res;
    }

    function selectSubActivity($mid){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activities WHERE main_activity_id = '$mid'");
        return $res;
    }

    function selectActivity($sid){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_activities WHERE sub_activity_id = '$sid'");
        return $res;
    }

    function selectOneMainActivity($id){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function selectOneSubActivity($id){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function insertMainActivity($id,$name,$program_id){
        $query= sprintf("INSERT INTO `db_pis`.`tbl_main_activities` (`name_np`, `code`, `program_id`) VALUES         
        ('%s','%s','%s')",
            mysqli_real_escape_string($this->dbc,$name),
            mysqli_real_escape_string($this->dbc,$id),
            mysqli_real_escape_string($this->dbc,$program_id));
        $result= mysqli_query($this->dbc, $query);
        return $result;
    }
    function updateMainActivity($id,$main_activity_code,$main_activity_name){
        $query= sprintf("UPDATE `db_pis`.`tbl_main_activities` set name_np='%s',code='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc,$main_activity_name),
            mysqli_real_escape_string($this->dbc,$main_activity_code),
            mysqli_real_escape_string($this->dbc,$id));
        echo $query;
        $result= mysqli_query($this->dbc, $query);
        return $result;
    }
    function deleteMainActivity($main_activity_code){
        $query= sprintf("DELETE FROM `db_pis`.`tbl_main_activities` where id='%s'",
            mysqli_real_escape_string($this->dbc,$main_activity_code));
        $result= mysqli_query($this->dbc, $query);
        echo $query;
        return $result;
    }
    function insertSubActivity($code,$name,$main_id){
        $query= sprintf("INSERT INTO `db_pis`.`tbl_sub_activities` (`code`, `name_np`, `main_activity_id`) VALUES        
        ('%s','%s','%s')",
            mysqli_real_escape_string($this->dbc,$code),
            mysqli_real_escape_string($this->dbc,$name),
            mysqli_real_escape_string($this->dbc,$main_id));
        $result= mysqli_query($this->dbc, $query);
        return $result;
    }
    function updateSubActivity($id,$sub_activity_code,$sub_activity_name){
        $query= sprintf("UPDATE `db_pis`.`tbl_sub_activities` set name_np='%s',code='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc,$sub_activity_name),
            mysqli_real_escape_string($this->dbc,$sub_activity_code),
            mysqli_real_escape_string($this->dbc,$id));
        $result= mysqli_query($this->dbc, $query);
        echo $result;
        echo $query;
        return $result;

    }
    function insertActivity($activity_code,$activity_name,$unit,$sub_id){
        $query= sprintf("INSERT INTO `db_pis`.`tbl_activities` (`name_np`, `code`, `sub_activity_id`, `unit`) VALUES        
        ('%s','%s','%s','%s')",
            mysqli_real_escape_string($this->dbc,$activity_name),
            mysqli_real_escape_string($this->dbc,$activity_code),
            mysqli_real_escape_string($this->dbc,$sub_id),
            mysqli_real_escape_string($this->dbc,$unit));
        $result= mysqli_query($this->dbc, $query);
        echo $query;
        return $result;
    }
    function updateActivity($id,$activity_code,$activity_name,$unit){
        $query= sprintf("UPDATE `db_pis`.`tbl_activities` set name_np='%s',unit='%s',code='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc,$activity_name),
            mysqli_real_escape_string($this->dbc,$unit),
            mysqli_real_escape_string($this->dbc,$activity_code),
            mysqli_real_escape_string($this->dbc,$id));
        $result= mysqli_query($this->dbc, $query);
        echo $query;
        return $result;
    }



    function selectTransactionGovernment($oid){
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.id = tl.activity_id WHERE tl.edu_office_id = '$oid'");
        return $res;
    }
    function selectTransactionLocal($oid){
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_local_offices AS tl ON a.id = tl.activity_id WHERE tl.local_office_id = '$oid'");
        return $res;
    }

    function selectOneTransactionGovernment($oid, $tlid){
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.id = tl.activity_id WHERE tl.edu_office_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }

    function selectOneTransactionLocal($oid, $tlid){
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_local_offices AS tl ON a.id = tl.activity_id WHERE tl.local_office_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }
    function selectUsers(){
        $res = mysqli_query($this->dbc, "SELECT u.username, u.password, CONCAT(u.firstname, ' ', u.lastname) AS fullname, o.name_np FROM tbl_users AS u INNER JOIN tbl_local_offices AS o ON a.office_id = o.id");
        return $res;
    }

    function selectLocalOfficeForTransaction(){
        $res = mysqli_query($this->dbc, "SELECT o.name FROM tbl_local_offices AS o 
                JOIN tbl_transaction_edu_offices AS tl ON o.id = tl.edu_office_id;
");
    }

    function updateGovernmentTransaction($txtpyearqty, $txtpyearbudget, $txtpttbudget, $txtpttqty, $tlid){
        $sql = sprintf("UPDATE `db_pis` .`tbl_transaction_edu_offices` set yearly_progress_qty_expenditure = '%s',yearly_progress_expenditure='%s',q3_expenditure='%s',q3_qty_expenditure='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc,$txtpyearqty),
            mysqli_real_escape_string($this->dbc,$txtpyearbudget),
            mysqli_real_escape_string($this->dbc,$txtpttbudget),
            mysqli_real_escape_string($this->dbc,$txtpttqty),
            mysqli_real_escape_string($this->dbc,$tlid));
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function updateLocalTransaction($txtpyearqty, $txtpyearbudget, $txtpttbudget, $txtpttqty, $tlid){
        $sql = sprintf("UPDATE `db_pis`.`tbl_transaction_local_offices` set yearly_progress_qty_expenditure = '%s',yearly_progress_expenditure='%s',q3_expenditure='%s',q3_qty_expenditure='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc,$txtpyearqty),
            mysqli_real_escape_string($this->dbc,$txtpyearbudget),
            mysqli_real_escape_string($this->dbc,$txtpttbudget),
            mysqli_real_escape_string($this->dbc,$txtpttqty),
            mysqli_real_escape_string($this->dbc,$tlid));
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }
}


/*Creating the object to retrieve the data*/
$dbc = new DB_dbc();

?>