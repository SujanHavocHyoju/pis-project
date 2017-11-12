<?php
include('report.php');
/*Declaring the constant keyword */
define('DB_SERVER', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'db_pis');

class DB_dbc
{

    protected $dbc;

    function __construct()
    {
        $this->dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die('Could not connect to the database server' . mysqli_connect_error());
        mysqli_query($this->dbc, "set character_set_client='utf8'");
        mysqli_query($this->dbc, "set character_set_results='utf8'");
        mysqli_query($this->dbc, "set collation_connection='utf8_general_ci'");
        mysqli_select_db($this->dbc, 'db_pis');
    }

    function selectUserLogin($username, $password)
    {
        $query = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function selectProgram()
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_programs");
        return $res;
    }

    function selectDistrict()
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_districts");
        return $res;
    }

    function searchProgram($program_name)
    {
        $query = "SELECT *  FROM tbl_programs where name_np like '%$program_name%'";
        return mysqli_query($this->dbc, $query);
    }

    function selectOneProgram($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_programs WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function selectOffice()
    {
        $res = mysqli_query($this->dbc, "SELECT lo.id,lo.code,lo.name_np,lo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_local_offices as lo LEFT JOIN tbl_districts AS di ON lo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id");
        return $res;
    }

    function selectEduOffice()
    {
        $res = mysqli_query($this->dbc, "SELECT eo.id,eo.code,eo.name_np,eo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_edu_offices as eo LEFT JOIN tbl_districts AS di ON eo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id");
        return $res;
    }

    function selectOneEduOffice($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * from tbl_edu_offices WHERE id=" . $id);
        return $res;
    }

    function updateEduOffice($sn, $office_name_np, $office_name_ep, $region)
    {
        $query = sprintf("UPDATE `db_pis`.`tbl_edu_offices` SET name_np='%s',name_en='%s',district_id='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc, $office_name_np),
            mysqli_real_escape_string($this->dbc, $office_name_ep),
            mysqli_real_escape_string($this->dbc, $region),
            mysqli_real_escape_string($this->dbc, $sn));
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function isEduOfficeExists($sn)
    {
        if (isset($sn)) {
            $query = "Select COUNT(*) FROM tbl_edu_offices WHERE id='$sn'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }

    }

    function isLocalOfficeExists($sn)
    {
        if (isset($sn)) {
            $query = "Select COUNT(*) FROM tbl_local_offices WHERE id='$sn'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }
    }

    function insertLocalOffice($sn, $name_np, $name_en, $district_id)
    {
        if ($this->isLocalOfficeExists($sn)) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_local_offices` (`name_np`, `name_en`, `district_id`) VALUES ('%s', '%s', '%s');",
                mysqli_real_escape_string($this->dbc, $name_np),
                mysqli_real_escape_string($this->dbc, $name_en),
                mysqli_real_escape_string($this->dbc, $district_id));
            $res = mysqli_query($this->dbc, $query);
            return $res;
        }
    }

    function updateLocalOffice($sn, $name_np, $name_en, $district_id)
    {
        $query = sprintf("UPDATE `db_pis`.`tbl_local_offices` SET name_np='%s',name_en='%s',district_id='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc, $name_np),
            mysqli_real_escape_string($this->dbc, $name_en),
            mysqli_real_escape_string($this->dbc, $district_id),
            mysqli_real_escape_string($this->dbc, $sn));
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function insertEduOffice($sn, $office_name_np, $office_name_ep, $region)
    {
        if ($this->isEduOfficeExists($sn)) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_edu_offices` (`name_np`, `name_en`, `province_id`, `district_id`) VALUES ('%s', '%s', '%s', '%s');",
                mysqli_real_escape_string($this->dbc, $office_name_np),
                mysqli_real_escape_string($this->dbc, $office_name_ep),
                mysqli_real_escape_string($this->dbc, '0'),
                mysqli_real_escape_string($this->dbc, $region));
            $res = mysqli_query($this->dbc, $query);
            return $res;
        }
    }

    function searchOffice($office_name)
    {
        $query = "SELECT eo.id,eo.name_np,eo.name_en,d.name_np as 'd_name' FROM tbl_edu_offices as eo LEFT JOIN tbl_developement_regions AS d ON eo.development_region_id = d.id where eo.name_np LIKE '%$office_name%'";
        return mysqli_query($this->dbc, $query);
    }

    function searchLocalOffice($office_name)
    {
        $query = "SELECT lo.id,lo.code,lo.name_np,lo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_local_offices as lo LEFT JOIN tbl_districts AS di ON lo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id where lo.name_np LIKE '%$office_name%'";
        return mysqli_query($this->dbc, $query);
    }

    function isProgramExist($exp_code)
    {
        if (isset($exp_code)) {
            $query = "Select COUNT(*) FROM tbl_programs WHERE exp_head_code='$exp_code'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }
    }

    function insertProgram($exp_head_code, $program, $program_en)
    {
        if ($this->isProgramExist($exp_head_code)) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_programs` (`name_np`, `exp_head_code`,`name_en`) VALUES ('%s','%s','%s')",
                mysqli_real_escape_string($this->dbc, $program),
                mysqli_real_escape_string($this->dbc, $exp_head_code),
                mysqli_real_escape_string($this->dbc, $program_en)
            );
            $res = mysqli_query($this->dbc, $query);
            return $res;
        }
    }

    function updateProgram($id, $exp_head_code, $program_name, $program_en)
    {
        $query = sprintf("UPDATE  `db_pis`.`tbl_programs` set exp_head_code='%s', name_np='%s',name_en='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc, $exp_head_code),
            mysqli_real_escape_string($this->dbc, $program_name),
            mysqli_real_escape_string($this->dbc, $program_en),
            mysqli_real_escape_string($this->dbc, $id)
        );
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }

    function isUserExists($username)
    {
        if (isset($username)) {
            $query = "Select COUNT(*) FROM tbl_users WHERE username='$username'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);

            return $result[0] > 0 ? true : false;
        }
    }

    function insertUser($username, $password, $full_name, $user_type, $office_id)
    {
        $is_user = $this->isUserExists($username);
        if ($is_user) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_users` (`username`, `password`, `fullname`, `user_type`, `office_id`) VALUES ('%s', '%s', '%s', '%s', '%s');",
                mysqli_real_escape_string($this->dbc, $username),
                mysqli_real_escape_string($this->dbc, crypt($password, 'st')),
                mysqli_real_escape_string($this->dbc, $full_name),
                mysqli_real_escape_string($this->dbc, $user_type),
                mysqli_real_escape_string($this->dbc, $office_id)
            );
            $res = mysqli_query($this->dbc, $query);
            return $res;
        }
    }

    function selectOneUser($id)
    {
        $res = mysqli_query(
            $this->dbc, 'SELECT * FROM db_pis.tbl_users where id=' . $id . ';'
        );
        return $res;
    }

    function changePassword($id)
    {
        $length = 8;
        $randomletter = trim(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length));
        $query = sprintf(
            "UPDATE `db_pis`.`tbl_users` SET `password`='%s' WHERE `id`='%s';",
            mysqli_real_escape_string($this->dbc, crypt($randomletter, 'st')),
            mysqli_real_escape_string($this->dbc, $id)
        );
        $res = mysqli_query(
            $this->dbc, $query
        );
        if ($res > 0) {
            return $randomletter;
        }
    }

    function updateUser($id, $username, $fullname, $user_type, $office_id)
    {

        $query = sprintf(
            "UPDATE `db_pis`.`tbl_users` SET `username`='%s', `fullname`='%s', `user_type`='%s', `office_id`='%s' WHERE `id`='%s';",
            mysqli_real_escape_string($this->dbc, $username),
            mysqli_real_escape_string($this->dbc, $fullname),
            mysqli_real_escape_string($this->dbc, $user_type),
            mysqli_real_escape_string($this->dbc, $office_id),
            mysqli_real_escape_string($this->dbc, $id)
        );
        $res = mysqli_query(
            $this->dbc, $query
        );
        return $res;


    }

    function selectOneLocalOffice($id)
    {
        $result = mysqli_query($this->dbc, "SELECT * FROM tbl_local_offices where id = '$id'");
        return $result;
    }

    function selectMainActivity($pid)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activities WHERE program_id = '$pid'");
        return $res;
    }

    function selectSubActivity($mid)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activities WHERE main_activity_id = '$mid'");
        return $res;
    }

    function selectActivity($sid)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_activities WHERE sub_activity_id = '$sid'");
        return $res;
    }

    function selectOneMainActivity($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function selectOneSubActivity($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function isMainActivityExists($code)
    {
        if (isset($code)) {
            $query = "Select COUNT(*) FROM tbl_main_activities WHERE code='$code'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }
    }

    function insertMainActivity($id, $name, $name_en, $program_id)
    {
        if ($this->isMainActivityExists($id)) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_main_activities` (`name_np`,`name_en`, `code`, `program_id`) VALUES         
            ('%s','%s','%s','%s')",
                mysqli_real_escape_string($this->dbc, $name),
                mysqli_real_escape_string($this->dbc, $name_en),
                mysqli_real_escape_string($this->dbc, $id),
                mysqli_real_escape_string($this->dbc, $program_id));
            $result = mysqli_query($this->dbc, $query);
            return $result;
        }
    }

    function updateMainActivity($id, $main_activity_code, $main_activity_name, $name_en)
    {
        $query = sprintf("UPDATE `db_pis`.`tbl_main_activities` set name_np='%s',code='%s',name_en='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc, $main_activity_name),
            mysqli_real_escape_string($this->dbc, $main_activity_code),
            mysqli_real_escape_string($this->dbc, $name_en),
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function deleteMainActivity($main_activity_code)
    {
        $query = sprintf("DELETE FROM `db_pis`.`tbl_main_activities` where id='%s'",
            mysqli_real_escape_string($this->dbc, $main_activity_code));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function isSubActivityExists($code)
    {
        if (isset($code)) {
            $query = "Select COUNT(*) FROM tbl_sub_activities WHERE code='$code'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }
    }

    function insertSubActivity($code, $name, $main_id, $name_en)
    {
        if ($this->isSubActivityExists($code)) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_sub_activities` (`code`, `name_np`, `main_activity_id`,`name_en`) VALUES        
        ('%s','%s','%s','%s')",
                mysqli_real_escape_string($this->dbc, $code),
                mysqli_real_escape_string($this->dbc, $name),
                mysqli_real_escape_string($this->dbc, $main_id),
                mysqli_real_escape_string($this->dbc, $name_en));
            $result = mysqli_query($this->dbc, $query);
            return $result;
        }
    }

    function updateSubActivity($id, $sub_activity_code, $sub_activity_name, $name_en)
    {
        $query = sprintf("UPDATE `db_pis`.`tbl_sub_activities` set name_np='%s',code='%s',name_en='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc, $sub_activity_name),
            mysqli_real_escape_string($this->dbc, $sub_activity_code),
            mysqli_real_escape_string($this->dbc, $name_en),
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function isActivityExist($code)
    {
        if (isset($code)) {
            $query = "Select COUNT(*) FROM tbl_activities WHERE code='$code'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }
    }

    function insertActivity($activity_code, $activity_name, $unit, $sub_id, $name_en)
    {
        if ($this->isActivityExist($activity_code)) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_activities` (`name_np`, `code`, `sub_activity_id`, `unit`,`name_en`) VALUES        
            ('%s','%s','%s','%s','%s')",
                mysqli_real_escape_string($this->dbc, $activity_name),
                mysqli_real_escape_string($this->dbc, $activity_code),
                mysqli_real_escape_string($this->dbc, $sub_id),
                mysqli_real_escape_string($this->dbc, $unit),
                mysqli_real_escape_string($this->dbc, $name_en));
            $result = mysqli_query($this->dbc, $query);
            return $result;
        }
    }

    function updateActivity($id, $activity_code, $activity_name, $unit, $name_en)
    {
        $query = sprintf("UPDATE `db_pis`.`tbl_activities` set name_np='%s',unit='%s',code='%s',name_en='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc, $activity_name),
            mysqli_real_escape_string($this->dbc, $unit),
            mysqli_real_escape_string($this->dbc, $activity_code),
            mysqli_real_escape_string($this->dbc, $name_en),
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        echo $query;
        return $result;
    }


    function selectTransactionGovernment($oid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_id WHERE tl.edu_office_id = '$oid'");
        return $res;
    }

    function selectTransactionLocal($oid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_local_offices AS tl ON a.code = tl.activity_id WHERE tl.local_office_id = '$oid'");
        return $res;
    }

    function selectTransactionByActivity()
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_id");
        return $res;
    }

    function selectTransactionByGovOffice($oid)
    {
        $res = mysqli_query($this->dbc, "
        SELECT a.name_np, a.code,a.id, tl.*,edu.name_np as edu_name_np FROM tbl_activities AS a 
        INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_id 
        INNER JOIN tbl_edu_offices AS edu on edu.id=tl.edu_office_id;");
        return $res;
    }

    function selectOneTransactionGovernment($oid, $tlid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_id WHERE tl.edu_office_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }

    function selectOneTransactionLocal($oid, $tlid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_local_offices AS tl ON a.code = tl.activity_id WHERE tl.local_office_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }

    function selectUsers()
    {
        $res = mysqli_query($this->dbc, "SELECT u.username, u.password, CONCAT(u.firstname, ' ', u.lastname) AS fullname, o.name_np FROM tbl_users AS u INNER JOIN tbl_local_offices AS o ON a.office_id = o.id");
        return $res;
    }

    function selectUser()
    {
        $res = mysqli_query($this->dbc, "SELECT id,username,fullname,user_type,office_id FROM db_pis.tbl_users where not user_type = '0';");
        return $res;
    }

    function selectOfficeNameFromIdAndUserType($user_type, $office_id)
    {
        if ($user_type == 1) {
            $res = mysqli_query(
                $this->dbc, 'SELECT name_np FROM db_pis.tbl_edu_offices where id=' . $office_id . ';'
            );
            return $res;
        } else {
            $res = mysqli_query(
                $this->dbc, 'SELECT name_np FROM db_pis.tbl_local_offices where id=' . $office_id . ';'
            );
            return $res;
        }
    }

    function selectLocalOfficeForTransaction()
    {
        $res = mysqli_query($this->dbc, "SELECT o.name FROM tbl_local_offices AS o 
                JOIN tbl_transaction_edu_offices AS tl ON o.id = tl.edu_office_id;
");
    }

    function updateGovernmentTransaction($txtpyearqty, $txtpyearbudget, $txtpttbudget, $txtpttqty, $tlid)
    {
        $sql = sprintf("UPDATE `db_pis` .`tbl_transaction_edu_offices` set yearly_progress_qty = '%s',yearly_progress_expenditure='%s',q3_progress_expenditure='%s',q3_progress_qty='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc, $txtpyearqty),
            mysqli_real_escape_string($this->dbc, $txtpyearbudget),
            mysqli_real_escape_string($this->dbc, $txtpttbudget),
            mysqli_real_escape_string($this->dbc, $txtpttqty),
            mysqli_real_escape_string($this->dbc, $tlid));
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function updateLocalTransaction($txtpyearqty, $txtpyearbudget, $txtpttbudget, $txtpttqty, $tlid)
    {
        $sql = sprintf("UPDATE `db_pis`.`tbl_transaction_local_offices` set yearly_progress_qty_expenditure = '%s',yearly_progress_expenditure='%s',q3_expenditure='%s',q3_qty_expenditure='%s' where id = '%s'",
            mysqli_real_escape_string($this->dbc, $txtpyearqty),
            mysqli_real_escape_string($this->dbc, $txtpyearbudget),
            mysqli_real_escape_string($this->dbc, $txtpttbudget),
            mysqli_real_escape_string($this->dbc, $txtpttqty),
            mysqli_real_escape_string($this->dbc, $tlid));
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function selectFiscalYear()
    {
        $query = "SELECT * FROM db_pis.tbl_fiscal_year;";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function isFiscalAlreadyExists($fiscal_year)
    {
        if (isset($fiscal_year)) {
            $query = "Select COUNT(*) FROM tbl_fiscal_year WHERE fiscal_year='$fiscal_year'";
            $res = mysqli_query($this->dbc, $query);
            $result = mysqli_fetch_array($res);
            return $result[0] > 0 ? true : false;
        }
    }

    function insertFiscalYear($fiscal_year)
    {
        $result = $this->isFiscalAlreadyExists($fiscal_year);
        if ($result) {
            return -1;
        } else {
            $query = sprintf("INSERT INTO `db_pis`.`tbl_fiscal_year` (`fiscal_year`) VALUES ('%s');",
                mysqli_real_escape_string($this->dbc, $fiscal_year));
            $res = mysqli_query($this->dbc, $query);
            return $res;
        }
    }

    function selectFiscalYearByStatus()
    {
        $query = "SELECT * from tbl_fiscal_year where status = 0";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function deleteUser($id)
    {
        $query = sprintf("DELETE FROM `db_pis`.`tbl_users` where id='%s'",
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function EXPORT_TABLES($host, $user, $pass, $name, $tables = false, $backup_name = false)
    {
        set_time_limit(3000);
        $mysqli = new mysqli($host, $user, $pass, $name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");
        $queryTables = $mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $name . "`\r\n--\r\n\r\n\r\n";
        foreach ($target_tables as $table) {
            if (empty($table)) {
                continue;
            }
            $result = $mysqli->query('SELECT * FROM `' . $table . '`');
            $fields_amount = $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
            $content .= "\n\n" . $TableMLine[1] . ";\n\n";
            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        }
                        if ($j < ($fields_amount - 1)) {
                            $content .= ',';
                        }
                    }
                    $content .= ")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }
                    $st_counter = $st_counter + 1;
                }
            }
            $content .= "\n\n\n";
        }
        $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
        $backup_name = $backup_name ? $backup_name : $name . "___(" . date('H-i-s') . "_" . date('d-m-Y') . ")__rand" . rand(1, 11111111) . ".sql";
        ob_get_clean();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
        echo $content;
        if (isset($content)) {
            return true;
        }
    }

    function generateOfficeUsers()
    {
        $fiscal_year = $this->selectFiscalYearByStatus();
        $fyr = mysqli_fetch_array($fiscal_year);
        $fis = str_replace("/", "", $fyr["fiscal_year"]);
        $sql = $this->selectOffice();
        while ($row = mysqli_fetch_array($sql)) {
            $name = "local_admin_" . $row["id"];
            $password = "pis_" . $fis . '_' . $row["id"];
            $this->insertUser($name, $password, $row["name_np"], '2', $row["id"]);
        }
    }

    function generateEduOfficeUsers()
    {
        $fiscal_year = $this->selectFiscalYearByStatus();
        $fyr = mysqli_fetch_array($fiscal_year);
        $fis = str_replace("/", "", $fyr["fiscal_year"]);
        $sql = $this->selectEduOffice();
        while ($row = mysqli_fetch_array($sql)) {
            $name = "edu_admin_" . $row["id"];
            $password = "pis_" . $fis . '_' . $row["id"];
            $this->insertUser($name, $password, $row["name_np"], '1', $row["id"]);
        }

    }

    function selectUserByUserType($user_type)
    {
        return mysqli_query($this->dbc, "SELECT id,username,fullname,user_type,office_id FROM db_pis.tbl_users where user_type = '$user_type';");
    }

    function countActivities($office_id)
    {
        $query = "SELECT count(*) FROM db_pis.tbl_transaction_edu_offices where edu_office_id='$office_id';";
        return mysqli_query($this->dbc, $query);
    }

    function countActiviesWhichIsUnDone($office_id)
    {
        $query = "SELECT count(*) FROM db_pis.tbl_transaction_edu_offices where edu_office_id='$office_id' and q1_progress_qty='0' and q1_progress_expenditure='0.00';";
        return mysqli_query($this->dbc, $query);
    }

    function selectSubActivityByMainActivityCode($m_code)
    {
        $query = "SELECT * FROM db_pis.tbl_sub_activities where main_activity_id='$m_code';";
        return mysqli_query($this->dbc, $query);
    }

    function selectSumTransactionFromActivity($a_code)
    {
        $query = "SELECT SUM(yearly_alloc_qty) as syaq,SUM(yearly_alloc_budget) as syab,
        SUM(yearly_progress_qty) as sypq,SUM(yearly_progress_expenditure) as sype,
        SUM(q1_alloc_qty) as sqaq,SUM(q1_alloc_budget) as sqab,
        SUM(q1_progress_qty) as sqpq, SUM(q1_progress_expenditure) as sqpe
         FROM db_pis.tbl_transaction_edu_offices where activity_id='$a_code';";
        return mysqli_query($this->dbc, $query);
    }

    function selectAllMainActivity()
    {
        $query = "SELECT * FROM db_pis.tbl_main_activities;";
        return mysqli_query($this->dbc, $query);
    }

    function generateEduOfficeReportByMainId($id)
    {
        $query = "SELECT act.id as act_id, act.name_np as act_name_np,
        act.code as act_code,
        SUM(tl.yearly_alloc_qty) as syaq,SUM(tl.yearly_alloc_budget) as syab,
        SUM(tl.yearly_progress_qty) as sypq,SUM(tl.yearly_progress_expenditure) as sype,
        SUM(tl.q1_alloc_qty) as sqaq,SUM(tl.q1_alloc_budget) as sqab,
        SUM(tl.q1_progress_qty) as sqpq, SUM(tl.q1_progress_expenditure) as sqpe
         from tbl_activities as act
         left join tbl_sub_activities as sub on sub.id=act.sub_activity_id
         left join tbl_main_activities as main on main.id= sub.main_activity_id
         left join tbl_transaction_edu_offices as tl on tl.activity_id=act.code
         where main.id='$id' and
        sub.main_activity_id='$id'
         GROUP BY
         act.id;";
        $result = mysqli_query($this->dbc, $query);
        return $result;

    }

    function eduOfficeFinalReport()
    {
        $query = "SELECT act.id as act_id, act.name_np as act_name_np,
        act.code as act_code, main.id as main_id,main.name_np as main_name_np,
        sub.id as sub_id, sub.name_np as sub_name_np,
        SUM(tl.yearly_alloc_qty) as syaq,SUM(tl.yearly_alloc_budget) as syab,
        SUM(tl.yearly_progress_qty) as sypq,SUM(tl.yearly_progress_expenditure) as sype,
        SUM(tl.q1_alloc_qty) as sqaq,SUM(tl.q1_alloc_budget) as sqab,
        SUM(tl.q1_progress_qty) as sqpq, SUM(tl.q1_progress_expenditure) as sqpe
         from tbl_activities as act
         left join tbl_sub_activities as sub on sub.id=act.sub_activity_id
         left join tbl_main_activities as main on main.id= sub.main_activity_id
         left join tbl_transaction_edu_offices as tl on tl.activity_id=act.code
         GROUP BY
         act.id;";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function selectActivityWiseReportEdu($activity_id)
    {
        $query = "SELECT 
    eo.name_np,
    teo.yearly_alloc_cost,
    teo.yearly_alloc_qty,
    teo.yearly_alloc_budget,
    teo.yearly_progress_qty,
    teo.yearly_progress_expenditure,
    teo.q3_alloc_qty,
    teo.q3_alloc_budget,
    teo.q3_progress_qty,
    teo.q3_progress_expenditure
FROM
    `tbl_transaction_edu_offices` AS teo
INNER JOIN
tbl_edu_offices AS eo
ON 
eo.id = teo.edu_office_id
GROUP BY edu_office_id , activity_id
HAVING `activity_id` = '$activity_id'";
        $result = mysqli_query($this->dbc, $query);
        return $result;
//        return $query;

    }

    function selectActivityWiseReportLocal($activity_id)
    {
        $query = "SELECT 
    lo.name_np,
    teo.yearly_alloc_cost,
    teo.yearly_alloc_qty,
    teo.yearly_alloc_budget,
    teo.yearly_progress_qty,
    teo.yearly_progress_expenditure,
    teo.q3_alloc_qty,
    teo.q3_alloc_budget,
    teo.q3_progress_qty,
    teo.q3_progress_expenditure
FROM
    `tbl_transaction_local_offices` AS teo
INNER JOIN
tbl_local_offices AS lo
ON 
lo.id = teo.local_office_id
GROUP BY local_office_id , activity_id
HAVING `activity_id` = '$activity_id'";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function selectActivityCode($activityid)
    {
        $query = "SELECT code FROM tbl_activities WHERE id = '$activityid'  LIMIT 1";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function sumOfMainActivity()
    {
        $sql = "
        SELECT 
        main_id, 
        main_name_np,
               SUM(Sub_syag) as Main_syag, 
               SUM(Sub_syab) as Main_syab, 
               SUM(Sub_sypq) as Main_sypq, 
               SUM(Sub_sype) as Main_sype, 
               SUM(Sub_sqaq) as Main_sqaq, 
               SUM(Sub_sqab) as Main_sqab, 
               SUM(Sub_sqpq) as Main_sqpq, 
               SUM(Sub_sqpe) as Main_sqpe 
               FROM
                    (
                        SELECT 
                        main_id, 
                        main_name_np,
                        SUM(syaq) as Sub_syag, 
                        SUM(syab) as Sub_syab, 
                        SUM(sypq) as Sub_sypq, 
                        SUM(sype) as Sub_sype, 
                        SUM(sqaq) as Sub_sqaq, 
                        SUM(sqab) as Sub_sqab, 
                        SUM(sqpq) as Sub_sqpq, 
                        SUM(sqpe) as Sub_sqpe 
                        FROM 
                            (
                            SELECT 
                            main.id as main_id, 
                            main.name_np as main_name_np,
                            SUM(tl.yearly_alloc_qty) as syaq,
                            SUM(tl.yearly_alloc_budget) as syab,
                            SUM(tl.yearly_progress_qty) as sypq,
                            SUM(tl.yearly_progress_expenditure) as sype,
                            SUM(tl.q1_alloc_qty) as sqaq,
                            SUM(tl.q1_alloc_budget) as sqab,
                            SUM(tl.q1_progress_qty) as sqpq, 
                            SUM(tl.q1_progress_expenditure) as sqpe
                                from tbl_activities as act
                                left join tbl_sub_activities as sub on sub.id=act.sub_activity_id
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_id=act.code
                                    where main.id=sub.main_activity_id
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id;";
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfSubActivity($id)
    {
        $sql = "SELECT 
            sub_code, 
            sub_name_np,
            SUM(syaq) as sub_syag, 
            SUM(syab) as sub_syab, 
            SUM(sypq) as sub_sypq, 
            SUM(sype) as sub_sype, 
            SUM(sqaq) as sub_sqaq, 
            SUM(sqab) as sub_sqab, 
            SUM(sqpq) as sub_sqpq, 
            SUM(sqpe) as sub_sqpe 
            FROM 
                (SELECT 
                    sub.code as sub_code, 
                    sub.name_np as sub_name_np,
                    SUM(tl.yearly_alloc_qty) as syaq,SUM(tl.yearly_alloc_budget) as syab,
                    SUM(tl.yearly_progress_qty) as sypq,
                    SUM(tl.yearly_progress_expenditure) as sype,
                    SUM(tl.q1_alloc_qty) as sqaq,
                    SUM(tl.q1_alloc_budget) as sqab,
                    SUM(tl.q1_progress_qty) as sqpq, 
                    SUM(tl.q1_progress_expenditure) as sqpe
                        from tbl_activities as act
                        left join tbl_sub_activities as sub on sub.id=act.sub_activity_id
                        left join tbl_main_activities as main on main.id= sub.main_activity_id
                        left join tbl_transaction_edu_offices as tl on tl.activity_id=act.code
                                where main.id='1' and
                                sub.id=act.sub_activity_id
                                GROUP BY sub.id
                                ORDER BY sub.id ASC) as T_SUB GROUP BY sub_code;";

        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;

    }

    function sumofActivity($main_activity, $sub_activity)
    {
        $query = "SELECT 
        act.name_np as act_name_np,
        act.code as act_code,
        SUM(tl.yearly_alloc_qty) as syaq,
        SUM(tl.yearly_alloc_budget) as syab,
        SUM(tl.yearly_progress_qty) as sypq,
        SUM(tl.yearly_progress_expenditure) as sype,
        SUM(tl.q1_alloc_qty) as sqaq,
        SUM(tl.q1_alloc_budget) as sqab,
        SUM(tl.q1_progress_qty) as sqpq, 
        SUM(tl.q1_progress_expenditure) as sqpe
        from tbl_activities as act
            left join tbl_sub_activities as sub on sub.id=act.sub_activity_id
            left join tbl_main_activities as main on main.id= sub.main_activity_id
            left join tbl_transaction_edu_offices as tl on tl.activity_id=act.code
            where main.id='$main_activity' and
            sub.code='$sub_activity'
            GROUP BY
            act.id
            ORDER BY act.id ASC;";
        //mysqli_query($this->dbc,"SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }

    function generateFinalReport()
    {
        $queryForTruncate = "truncate `db_pis`.`tbl_current_reports`;";
        $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
        if ($resultForTruncate > 0) {
            $queryForMainActivity = $this->sumOfMainActivity();
            while ($rma = mysqli_fetch_array($queryForMainActivity)) {
                $queryToInsertForMain = sprintf("INSERT INTO 
                `db_pis`.`tbl_current_reports` 
                (`activity_number`, 
                `yearly_weight`, 
                `yearly_alloc_budget`, 
                `yearly_progress_expenditure`, 
                `yearly_progress_expenditure_percent`, 
                `qtr_alloc_weight`, 
                `qtr_alloc_budget`, 
                `qtr_progress_expenditure`, 
                `qtr_progress_expenditure_percent`, 
                `name_np`,
                `status`) VALUES 
                ('%s', 
                '0', 
                '%s', 
                '%s', 
                '0', 
                '0', 
                '%s', 
                '%s',
                '0', 
                '%s',
                '0')",
                    mysqli_real_escape_string($this->dbc, $rma['main_id']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_syab']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sype']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sqab']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sqpe']),
                    mysqli_real_escape_string($this->dbc, $rma['main_name_np']));
                $resultFromMain = mysqli_query($this->dbc, $queryToInsertForMain);
                if ($resultFromMain > 0) {
                    $resultForQuery = $this->sumOfSubActivity($rma['main_id']);
                    while ($rsa = mysqli_fetch_array($resultForQuery)) {
                        $queryToInsertForSub = sprintf("INSERT INTO 
                        `db_pis`.`tbl_current_reports` 
                        (`activity_number`, 
                        `yearly_weight`, 
                        `yearly_alloc_budget`,                                
                        `yearly_progress_expenditure`, 
                        `yearly_progress_expenditure_percent`, 
                        `qtr_alloc_weight`, 
                        `qtr_alloc_budget`, 
                        `qtr_progress_expenditure`, 
                        `qtr_progress_expenditure_percent`, 
                        `name_np`,
                        `status`) VALUES 
                        ('%s', 
                        '0', 
                        '%s', 
                        '%s', 
                        '0', 
                        '0', 
                        '%s', 
                        '%s',
                        '0', 
                        '%s',
                        '1')",
                            mysqli_real_escape_string($this->dbc, $rsa['sub_code']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_syab']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sype']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sqab']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sqpe']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_name_np']));
                        $resultFromSub = mysqli_query($this->dbc, $queryToInsertForSub);
                        if ($resultFromSub > 0) {
                            $resultFromSubQueries = $this->sumofActivity($rma['main_id'], $rsa['sub_code']);
                            while ($raa = mysqli_fetch_array($resultFromSubQueries)) {
                                $queryToInsertAct = sprintf(
                                    "INSERT INTO 
                                `db_pis`.`tbl_current_reports` 
                                (`activity_number`, 
                                `yearly_alloc_qty`, 
                                `yearly_weight`, 
                                `yearly_alloc_budget`, 
                                `yearly_progress_qty`, 
                                `yearly_progress_qty_percent`, 
                                `yearly_progress_expenditure`, 
                                `yearly_progress_expenditure_percent`, 
                                `yearly_progress_weighted`, 
                                `qtr_alloc_qty`, 
                                `qtr_alloc_weight`, 
                                `qtr_alloc_budget`, 
                                `qtr_progress_qty`, 
                                `qtr_progress_qty_percent`, 
                                `qtr_progress_expenditure`, 
                                `qtr_progress_expenditure_percent`, 
                                `qtr_progress_expenditure_weighted`, 
                                `name_np`,
                                `status`) 
                                VALUES (
                                '%s', 
                                '%s',
                                '0', 
                                '%s',  
                                '%s', 
                                '0', 
                                '%s', 
                                '0', 
                                '0', 
                                '%s', 
                                '0', 
                                '%s', 
                                '%s',  
                                '0', 
                                '%s',  
                                '0', 
                                '0', 
                                '%s',
                                '2')",
                                    mysqli_real_escape_string($this->dbc, $raa['act_code']),
                                    mysqli_real_escape_string($this->dbc, $raa['syaq']),
                                    mysqli_real_escape_string($this->dbc, $raa['syab']),
                                    mysqli_real_escape_string($this->dbc, $raa['sypq']),
                                    mysqli_real_escape_string($this->dbc, $raa['sype']),
                                    mysqli_real_escape_string($this->dbc, $raa['sqaq']),
                                    mysqli_real_escape_string($this->dbc, $raa['sqab']),
                                    mysqli_real_escape_string($this->dbc, $raa['sqpq']),
                                    mysqli_real_escape_string($this->dbc, $raa['sqpe']),
                                    mysqli_real_escape_string($this->dbc, $raa['act_name_np'])
                                );
                                $resultFrom = mysqli_query($this->dbc, $queryToInsertAct);
                                if($resultFrom<0){
                                    $queryForTruncate = "truncate `db_pis`.`tbl_current_reports`;";
                                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                                    return false;
                                }
                            }
                        }else{
                            $queryForTruncate = "truncate `db_pis`.`tbl_current_reports`;";
                            $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                            return false; 
                        }
                    }
                }else{
                    $queryForTruncate = "truncate `db_pis`.`tbl_current_reports`;";
                                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                                    return false;
                }

            }
        }
    }

    function selectAllFinalReport(){
        $res = mysqli_query($this->dbc, "SELECT * FROM db_pis.tbl_current_reports;");
        return $res;
    }
    function selectAllActivities()
    {
        $res = mysqli_query($this->dbc, "SELECT id, code, name_np FROM tbl_activities WHERE sub_activity_id IS NOT NULL");
        return $res;
    }

    function selectOneActivity($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }
}


/*Creating the object to retrieve the data*/
$dbc = new DB_dbc();

?>