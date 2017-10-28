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
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_program");
        return $res;
    }

    function selectOneProgram($id){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_program WHERE id = '$id' LIMIT 1");
        return $res;
    }
    function selectLocalOffice(){
        $result  = mysqli_query($this->dbc,"SELECT * FROM tbl_local_offices");
        return $result;
    }
	function selectMainActivity($pid){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activity WHERE program_id = '$pid'");
        return $res;
    }

    function selectSubActivity($mid){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activity WHERE main_activity_id = '$mid'");
        return $res;
    }

    function selectActivity($sid){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_activity WHERE sub_activity_id = '$sid'");
        return $res;
    }

    function selectOneMainActivity($id){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activity WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function selectOneSubActivity($id){
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activity WHERE id = '$id' LIMIT 1");
        return $res;
    }
    function insertMainActivity($id,$name,$program_id){
        $query= sprintf("INSERT INTO `db_pis`.`tbl_main_activity` (`id`, `name_np`, `code`, `program_id`) VALUES         
        ('%s','%s','%s','%s')",
         mysqli_real_escape_string($this->dbc,$id),
         mysqli_real_escape_string($this->dbc,$name),
         mysqli_real_escape_string($this->dbc,$id),
         mysqli_real_escape_string($this->dbc,$program_id));
        $result= mysqli_query($this->dbc, $query);
        return $result;
    }
    function selectTransactionLocal($oid){
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activity AS a INNER JOIN tbl_transaction_local AS tl ON a.id = tl.activity_id WHERE tl.local_offices_id = '$oid'");
        return $res;
    }

    function selectOneTransactionLocal($oid, $tlid){
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activity AS a INNER JOIN tbl_transaction_local AS tl ON a.id = tl.activity_id WHERE tl.local_offices_id = '$oid' AND tl.id= '$tlid'");
        return $res;
    }
//    function select

    /*function selectOneMainActivity($id){
	    $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activity WHERE id = '$id'  LIMIT 1");
	    return $res;
    }*/

}


/*Creating the object to retrieve the data*/
$dbc = new DB_dbc();

?>
