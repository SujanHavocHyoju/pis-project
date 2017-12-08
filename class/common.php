<?php
/*Declaring the constant keyword */
define('DB_SERVER', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin');
define('DB_NAME', 'pisdoego_db_pis');
/*Declaring the constant keyword */
//define('DB_SERVER', '127.0.0.1');
//define('DB_USER', 'pisdoego_db_pis');
//define('DB_PASS', 'P1Sd0eG0_db_P1S');
//define('DB_NAME', 'pisdoego_db_pis');
class DB_dbc
{

    protected $dbc;

    function __construct()
    {
        $this->dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die('Could not connect to the database server' . mysqli_connect_error());
        mysqli_query($this->dbc, "set character_set_client='utf8'");
        mysqli_query($this->dbc, "set character_set_results='utf8'");
        mysqli_query($this->dbc, "set collation_connection='utf8_general_ci'");
        mysqli_select_db($this->dbc, 'pisdoego_db_pis');
    }

    function selectUserLogToday()
    {
        $query = "SELECT * 
                FROM user_ip  
                WHERE DATE(last_access_date) = CURDATE()
        ";
        return mysqli_query($this->dbc, $query);
    }

    function selectCountUserLogToday()
    {
        $query = "SELECT count(*) 
                FROM user_ip  
                WHERE DATE(last_access_date) = CURDATE()
        ";
        return mysqli_query($this->dbc, $query);
    }

    function insertOrUpdateUserLog($username, $office_name, $user_type, $ip, $device, $status)
    {
        $resultRo = $this->selectUserByUserName($username);
        if ($resultRo == 0) {
            $query = "INSERT INTO `pisdoego_db_pis`.`user_ip` 
            (`username`, `office_name`, `user_type`, `ip_address`, `device`, `login_status`, `last_access_date`) 
            VALUES ('$username', '$office_name', '$user_type', '$ip', '$device', '$status', NOW());";
            $result = mysqli_query($this->dbc, $query);
            return $result;
        } else {
            $queryUpdate = "UPDATE `pisdoego_db_pis`.`user_ip` 
              SET `office_name`='$office_name', `user_type`='$user_type', 
              `ip_address`='$ip', 
              `device`='$device', 
              `login_status`='$status', 
              `last_access_date`=NOW()
                WHERE `username`='$username';";
            $resultUpdate = mysqli_query($this->dbc, $queryUpdate);
            return $resultUpdate;
        }
    }

    function updateUserLog($username, $reason)
    {
        $query = "UPDATE `pisdoego_db_pis`.`user_ip` SET `reason`='$reason' WHERE `username`='$username';";
        $result = mysqli_query($this->dbc, $query);
        return $result;
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
        $res = mysqli_query($this->dbc, "SELECT lo.id,lo.code,lo.name_np,lo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_local_bodies as lo LEFT JOIN tbl_districts AS di ON lo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id");
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
        $query = sprintf("UPDATE `pisdoego_db_pis`.`tbl_edu_offices` SET name_np='%s',name_en='%s',district_id='%s' where id = '%s'",
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
            $query = "Select COUNT(*) FROM tbl_local_bodies WHERE id='$sn'";
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_local_bodies` (`name_np`, `name_en`, `district_id`) VALUES ('%s', '%s', '%s');",
                mysqli_real_escape_string($this->dbc, $name_np),
                mysqli_real_escape_string($this->dbc, $name_en),
                mysqli_real_escape_string($this->dbc, $district_id));
            $res = mysqli_query($this->dbc, $query);
            return $res;
        }
    }

    function updateLocalOffice($sn, $name_np, $name_en, $district_id)
    {
        $query = sprintf("UPDATE `pisdoego_db_pis`.`tbl_local_bodies` SET name_np='%s',name_en='%s',district_id='%s' where id = '%s'",
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_edu_offices` (`name_np`, `name_en`, `province_id`, `district_id`) VALUES ('%s', '%s', '%s', '%s');",
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
        $query = "SELECT lo.id,lo.code,lo.name_np,lo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_local_bodies as lo LEFT JOIN tbl_districts AS di ON lo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id where lo.name_np LIKE '%$office_name%'";
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_programs` (`name_np`, `exp_head_code`,`name_en`) VALUES ('%s','%s','%s')",
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
        $query = sprintf("UPDATE  `pisdoego_db_pis`.`tbl_programs` set exp_head_code='%s', name_np='%s',name_en='%s' where id='%s'",
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_users` (`username`, `password`, `fullname`, `user_type`, `office_id`) VALUES ('%s', '%s', '%s', '%s', '%s');",
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
            $this->dbc, 'SELECT * FROM pisdoego_db_pis.tbl_users where id=' . $id . ';'
        );
        return $res;
    }

    function changePassword($id, $password)
    {
        //$length = 8;
        //$randomletter = trim(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length));
        $query = sprintf(
            "UPDATE `pisdoego_db_pis`.`tbl_users` SET `password`='%s' WHERE `id`='%s';",
            mysqli_real_escape_string($this->dbc, crypt($password, 'st')),
            mysqli_real_escape_string($this->dbc, $id)
        );
        $res = mysqli_query(
            $this->dbc, $query
        );
        return $res;
    }

    function updateUser($id, $username, $fullname, $user_type, $office_id)
    {

        $query = sprintf(
            "UPDATE `pisdoego_db_pis`.`tbl_users` SET `username`='%s', `fullname`='%s', `user_type`='%s', `office_id`='%s' WHERE `id`='%s';",
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
        $result = mysqli_query($this->dbc, "SELECT * FROM tbl_local_bodies where id = '$id'");
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
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_activities WHERE sub_activity_code = '$sid'");
        return $res;
    }

    function selectOneMainActivity($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_main_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }

    function selectOneSubActivity($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_sub_activities WHERE code = '$id' LIMIT 1");
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_main_activities` (`name_np`,`name_en`, `code`, `program_id`) VALUES         
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
        $query = sprintf("UPDATE `pisdoego_db_pis`.`tbl_main_activities` set name_np='%s',code='%s',name_en='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc, $main_activity_name),
            mysqli_real_escape_string($this->dbc, $main_activity_code),
            mysqli_real_escape_string($this->dbc, $name_en),
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function deleteMainActivity($main_activity_code)
    {
        $query = sprintf("DELETE FROM `pisdoego_db_pis`.`tbl_main_activities` where id='%s'",
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_sub_activities` (`code`, `name_np`, `main_activity_id`,`name_en`) VALUES        
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
        $query = sprintf("UPDATE `pisdoego_db_pis`.`tbl_sub_activities` set name_np='%s',code='%s',name_en='%s' where id='%s'",
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_activities` (`name_np`, `code`, `sub_activity_code`, `unit`,`name_en`) VALUES        
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
        $query = sprintf("UPDATE `pisdoego_db_pis`.`tbl_activities` set name_np='%s',unit='%s',code='%s',name_en='%s' where id='%s'",
            mysqli_real_escape_string($this->dbc, $activity_name),
            mysqli_real_escape_string($this->dbc, $unit),
            mysqli_real_escape_string($this->dbc, $activity_code),
            mysqli_real_escape_string($this->dbc, $name_en),
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function selectSumOfTransactionGovernment($office_id)
    {
        $query = "SELECT SUM(tl.yearly_alloc_qty) as yaq,
            SUM(tl.yearly_alloc_cost) as yac,
            SUM(tl.yearly_alloc_budget) as yab,
            SUM(tl.yearly_progress_qty) as ypq,
            SUM(tl.yearly_progress_expenditure) as ype,
            SUM(tl.q1_alloc_qty) as qaq,
            SUM(tl.q1_alloc_budget) as qab,
            SUM(tl.q1_progress_qty) as qpq,
            SUM(tl.q1_progress_expenditure) as qpe
              FROM tbl_activities AS a 
              INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_code 
              WHERE tl.edu_office_id = '$office_id'
              and tl.q2_alloc_bugdet='0' and tl.q3_alloc_budget='0'
              ";
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function selectTransactionGovernment($oid)
    {
        $query = "SELECT a.name_np, a.code,a.id, tl.* 
              FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_code
              WHERE tl.edu_office_id = '$oid' 
              and tl.q1_alloc_budget!='0';";
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function selectTransactionGovernmentWithProjectId($oid, $projectId)
    {
        $query = "SELECT a.name_np, a.code,a.id, tl.* 
              FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_code
              WHERE tl.edu_office_id = '$oid' 
             and tl.q1_alloc_budget!='0' 
              and tl.project_id='$projectId'
              ";
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function selectTransactionLocal($oid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_local_offices AS tl ON a.code = tl.activity_code WHERE tl.local_office_id = '$oid'");
        return $res;
    }

    function selectSumOfTransactionLocal($oid)
    {
        $query = "SELECT 
                    SUM(tl.yearly_alloc_qty) as yaq,
                    SUM(tl.yearly_alloc_cost) as yac,
                    SUM(tl.yearly_alloc_budget) as yab,
                    SUM(tl.yearly_progress_qty) as ypq,
                    SUM(tl.yearly_progress_expenditure) as ype,
                    SUM(tl.q1_alloc_qty) as qaq,
                    SUM(tl.q1_alloc_budget) as qab,
                    SUM(tl.q1_progress_qty) as qpq,
                    SUM(tl.q1_progress_expenditure) as qpe 
                    FROM tbl_local_bodies_activities4 AS a INNER JOIN tbl_transaction_local_bodies AS tl ON a.id = tl.local_body_activity4_id 
                    WHERE tl.local_body_id = '$oid'";
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function selectTransactionByActivity()
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_code");
        return $res;
    }

    function selectTransactionByGovOffice($oid)
    {
        $res = mysqli_query($this->dbc, "
        SELECT a.name_np, a.code,a.id, tl.*,edu.name_np as edu_name_np FROM tbl_activities AS a 
        INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_code 
        INNER JOIN tbl_edu_offices AS edu on edu.id=tl.edu_office_id;");
        return $res;
    }

    function selectOneTransactionGovernment($oid, $tlid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_edu_offices AS tl ON a.code = tl.activity_code WHERE tl.edu_office_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }

    function selectOneTransactionLocal($oid, $tlid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.name_np, a.code,a.id, tl.* FROM tbl_activities AS a INNER JOIN tbl_transaction_local_offices AS tl ON a.code = tl.activity_code WHERE tl.local_office_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }

    function selectUserByFullName($name)
    {
        $res = mysqli_query($this->dbc, "select id,username,fullname,user_type,office_id  from tbl_users where fullname LIKE '%" . trim($name) . "%' and not user_type = '0';");

        return $res;
    }

    function selectUsers()
    {
        $res = mysqli_query($this->dbc, "SELECT u.username, u.password, CONCAT(u.firstname, ' ', u.lastname) AS fullname, o.name_np FROM tbl_users AS u INNER JOIN tbl_local_bodies AS o ON a.office_id = o.id");
        return $res;
    }

    function selectUser()
    {
        $res = mysqli_query($this->dbc, "SELECT id,username,fullname,user_type,office_id FROM pisdoego_db_pis.tbl_users where not user_type = '0';");
        return $res;
    }

    function selectOfficeNameFromIdAndUserType($user_type, $office_id)
    {
        if ($user_type == 1) {
            $res = mysqli_query(
                $this->dbc, 'SELECT name_np FROM pisdoego_db_pis.tbl_edu_offices where id=' . $office_id . ';'
            );
            return $res;
        } else {
            $res = mysqli_query(
                $this->dbc, 'SELECT name_np FROM pisdoego_db_pis.tbl_local_bodies where id=' . $office_id . ';'
            );
            return $res;
        }
    }

    function updateGovernmentAdminTransaction(
        $yearlyAllocCost,
        $yearlyAllocQty,
        $yearAllocBudget,
        $txtpyearqty,
        $txtpyearbudget,
        $q1AllocQty,
        $q1AllocBudget,
        $txtpttbudget,
        $txtpttqty,
        $tlid)
    {
        $sql = sprintf("UPDATE `pisdoego_db_pis` .`tbl_transaction_edu_offices` 
                set yearly_alloc_cost = '%s',
                 yearly_alloc_qty = '%s',
                 yearly_alloc_budget = '%s',
                 yearly_progress_qty = '%s',
                 yearly_progress_expenditure='%s',
                q1_alloc_qty='%s',
                q1_alloc_budget='%s',
                 q1_progress_expenditure='%s',
                q1_progress_qty='%s' 
                where id = '%s'",
            mysqli_real_escape_string($this->dbc, $yearlyAllocCost),
            mysqli_real_escape_string($this->dbc, $yearlyAllocQty),
            mysqli_real_escape_string($this->dbc, $yearAllocBudget),
            mysqli_real_escape_string($this->dbc, $txtpyearqty),
            mysqli_real_escape_string($this->dbc, $txtpyearbudget),
            mysqli_real_escape_string($this->dbc, $q1AllocQty),
            mysqli_real_escape_string($this->dbc, $q1AllocBudget),
            mysqli_real_escape_string($this->dbc, $txtpttbudget),
            mysqli_real_escape_string($this->dbc, $txtpttqty),
            mysqli_real_escape_string($this->dbc, $tlid));
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function updateGovernmentTransaction($txtpyearqty, $txtpyearbudget, $txtpttbudget, $txtpttqty, $tlid)
    {
        $sql = sprintf("UPDATE `pisdoego_db_pis` .`tbl_transaction_edu_offices` set yearly_progress_qty = '%s',yearly_progress_expenditure='%s',q1_progress_expenditure='%s',q1_progress_qty='%s' where id = '%s'",
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
        $sql = sprintf("UPDATE `pisdoego_db_pis`.`tbl_transaction_local_offices` set yearly_progress_qty_expenditure = '%s',yearly_progress_expenditure='%s',q1_expenditure='%s',q1_qty_expenditure='%s' where id = '%s'",
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
        $query = "SELECT * FROM pisdoego_db_pis.tbl_fiscal_year;";
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
            $query = sprintf("INSERT INTO `pisdoego_db_pis`.`tbl_fiscal_year` (`fiscal_year`) VALUES ('%s');",
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
        $query = sprintf("DELETE FROM `pisdoego_db_pis`.`tbl_users` where id='%s'",
            mysqli_real_escape_string($this->dbc, $id));
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function EXPORT_TABLES($host, $user, $pass, $name, $tables = false, $backup_name = false)
    {
        //set_time_limit(3000);
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
        return mysqli_query($this->dbc, "SELECT id,username,fullname,user_type,office_id FROM pisdoego_db_pis.tbl_users where user_type = '$user_type';");
    }

    function countActivities($office_id)
    {
        $query = "SELECT count(*) 
              FROM pisdoego_db_pis.tbl_transaction_edu_offices 
              where edu_office_id='$office_id';";
        return mysqli_query($this->dbc, $query);
    }


    function countActiviesWhichIsUnDone($office_id)
    {
        $query = "SELECT count(*) 
        FROM pisdoego_db_pis.tbl_transaction_edu_offices 
        where edu_office_id='$office_id' and q1_progress_qty='0' 
        and q1_progress_expenditure='0.00';";
        return mysqli_query($this->dbc, $query);
    }

    function countLocalActivities($office_id)
    {
        $query = "SELECT count(*) 
              FROM pisdoego_db_pis.tbl_transaction_local_bodies 
              where local_body_id='$office_id';";
        return mysqli_query($this->dbc, $query);
    }


    function countLocalActiviesWhichIsUnDone($office_id)
    {
        $query = "SELECT count(*) 
        FROM pisdoego_db_pis.tbl_transaction_local_bodies 
        where local_body_id='$office_id' and q1_progress_qty='0' 
        and q1_progress_expenditure='0.00';";
        return mysqli_query($this->dbc, $query);
    }

    function selectSubActivityByMainActivityCode($m_code)
    {
        $query = "SELECT * FROM pisdoego_db_pis.tbl_sub_activities where main_activity_id='$m_code';";
        return mysqli_query($this->dbc, $query);
    }

    function selectSumTransactionFromActivity($a_code)
    {
        $query = "SELECT SUM(yearly_alloc_qty) as syaq,SUM(yearly_alloc_budget) as syab,
        SUM(yearly_progress_qty) as sypq,SUM(yearly_progress_expenditure) as sype,
        SUM(q1_alloc_qty) as sqaq,SUM(q1_alloc_budget) as sqab,
        SUM(q1_progress_qty) as sqpq, SUM(q1_progress_expenditure) as sqpe
         FROM pisdoego_db_pis.tbl_transaction_edu_offices where activity_id='$a_code';";
        return mysqli_query($this->dbc, $query);
    }

    function selectAllMainActivity()
    {
        $query = "SELECT * FROM pisdoego_db_pis.tbl_main_activities;";
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
         left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
         left join tbl_main_activities as main on main.id= sub.main_activity_id
         left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
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
         left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
         left join tbl_main_activities as main on main.id= sub.main_activity_id
         left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
         GROUP BY
         act.id;";
        $result = mysqli_query($this->dbc, $query);
        return $result;
    }

    function selectActivityWiseReportEdu($activity_id)
    {
        $query = "SELECT eo.name_np, 
teo.yearly_alloc_cost, 
teo.yearly_alloc_qty, 
teo.yearly_alloc_budget, 
teo.yearly_progress_qty, 
teo.yearly_progress_expenditure, 
teo.q1_alloc_qty, 
teo.q1_alloc_budget, 
teo.q1_progress_qty, 
teo.q1_progress_expenditure 
FROM `tbl_transaction_edu_offices` AS teo INNER JOIN tbl_edu_offices AS eo ON eo.id = teo.edu_office_id where teo.`activity_code` = '$activity_id';";
        $result = mysqli_query($this->dbc, $query);
        return $result;
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
    teo.q1_alloc_qty,
    teo.q1_alloc_budget,
    teo.q1_progress_qty,
    teo.q1_progress_expenditure
FROM
    `tbl_transaction_local_offices` AS teo
INNER JOIN
tbl_local_bodies AS lo
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

    function sumOfTotal($pid)
    {
        $sql = "SELECT
               SUM(Main_syag) as agr_syag, 
               SUM(Main_syab) as agr_syab, 
               SUM(Main_sypq) as agr_sypq, 
               SUM(Main_sype) as agr_sype, 
               SUM(Main_sqaq) as agr_sqaq, 
               SUM(Main_sqab) as agr_sqab, 
               SUM(Main_sqpq) as agr_sqpq, 
               SUM(Main_sqpe) as agr_sqpe 
               FROM
                (SELECT 
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
                                left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                    where main.id=sub.main_activity_id
                                        and tl.project_id='$pid'
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id) as T_AGR ;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfMainActivity($pid)
    {
        $sql = "SELECT 
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
                                left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                    where main.id=sub.main_activity_id
                                        and tl.project_id='$pid'
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfSubActivity($id, $pid)
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
                        left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                        left join tbl_main_activities as main on main.id= sub.main_activity_id
                        left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                where main.id='$id' and
                                sub.code=act.sub_activity_code
                                and tl.project_id='$pid'
                                GROUP BY sub.id
                                ORDER BY sub.id ASC) as T_SUB GROUP BY sub_code;";
        //echo $sql;
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;

    }

    function sumofActivity($main_activity, $sub_activity, $pid)
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
            left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
            left join tbl_main_activities as main on main.id= sub.main_activity_id
            left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
            where main.id='$main_activity' and
            sub.code='$sub_activity'
            and tl.project_id='$pid'
            GROUP BY
            act.id
            ORDER BY act.id ASC;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }

    function sumOfLocalTotal()
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
            GROUP BY
            act.id
            ORDER BY act.id ASC) as T_AGR ;
        ";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }

    function sumOfLocalActivity()
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
            GROUP BY
            act.id
            ORDER BY act.id ASC;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }

    function generateLocalFinalReport()
    {
        //set_time_limit(3000);
        $resultFinal = mysqli_fetch_array($this->sumOfLocalTotal());
        $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
        $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
        if ($resultForTruncate > 0) {
            $resultFromSubQueries = $this->sumOfLocalActivity();
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
                `pisdoego_db_pis`.`tbl_current_reports` 
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
                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                    return false;
                }
            }
            $queryToFinal = sprintf("INSERT INTO 
            `pisdoego_db_pis`.`tbl_current_reports` 
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

    function generateFinalReport($pid)
    {
        //set_time_limit(3000);
        $resultFinal = mysqli_fetch_array($this->sumOfTotal($pid));
        $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
        $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
        if ($resultForTruncate > 0) {
            $queryForMainActivity = $this->sumOfMainActivity($pid);
            while ($rma = mysqli_fetch_array($queryForMainActivity)) {
                $yearlyMainWeight = ($rma['Main_syab'] / $resultFinal['agr_syab']) * 100;
                $yearlyExpProPerMain = ($rma['Main_sype'] / $rma['Main_syab']) / 100;
                $qtrAllocWeighMain = ($rma['Main_sqaq'] / $resultFinal['agr_sqaq']) * 100;
                if ($rma['Main_sqab'] != 0) {
                    $qtrExpProPerMain = ($rma['Main_sqpe'] / $rma['Main_sqab']) / 100;
                } else {
                    $qtrExpProPerMain = 0;
                }
                $queryToInsertForMain = sprintf("INSERT INTO 
                `pisdoego_db_pis`.`tbl_current_reports` 
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
                (
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
                '0')",
                    mysqli_real_escape_string($this->dbc, $rma['main_id']),
                    mysqli_real_escape_string($this->dbc, $yearlyMainWeight),
                    mysqli_real_escape_string($this->dbc, $rma['Main_syab']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sype']),
                    mysqli_real_escape_string($this->dbc, $yearlyExpProPerMain),
                    mysqli_real_escape_string($this->dbc, $qtrAllocWeighMain),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sqab']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sqpe']),
                    mysqli_real_escape_string($this->dbc, $qtrExpProPerMain),
                    mysqli_real_escape_string($this->dbc, $rma['main_name_np']));
                $resultFromMain = mysqli_query($this->dbc, $queryToInsertForMain);

                if ($resultFromMain > 0) {
                    $resultForQuery = $this->sumOfSubActivity($rma['main_id'], $pid);
                    while ($rsa = mysqli_fetch_array($resultForQuery)) {
                        $yearlySubWeight = ($rsa['sub_syab'] / $resultFinal['agr_syab']) * 100;
                        $yearlyExpProPerSub = ($rsa['sub_sype'] / $rsa['sub_syab']) / 100;
                        $qtrAllocWeighSUB = ($rsa['sub_sqaq'] / $resultFinal['agr_sqaq']) * 100;
                        if ($rsa['sub_sqab'] != 0) {
                            $qtrExpProPerSub = ($rsa['sub_sqpe'] / $rsa['sub_sqab']) / 100;
                        } else {
                            $qtrExpProPerSub = 0;
                        }
                        $queryToInsertForSub = sprintf("INSERT INTO 
                        `pisdoego_db_pis`.`tbl_current_reports` 
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
                        ('%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s',
                        '%s', 
                        '%s',
                        '1')",
                            mysqli_real_escape_string($this->dbc, $rsa['sub_code']),
                            mysqli_real_escape_string($this->dbc, $yearlySubWeight),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_syab']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sype']),
                            mysqli_real_escape_string($this->dbc, $yearlyExpProPerSub),
                            mysqli_real_escape_string($this->dbc, $qtrAllocWeighSUB),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sqab']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sqpe']),
                            mysqli_real_escape_string($this->dbc, $qtrExpProPerSub),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_name_np']));
                        $resultFromSub = mysqli_query($this->dbc, $queryToInsertForSub);


                        if ($resultFromSub > 0) {
                            $resultFromSubQueries = $this->sumofActivity($rma['main_id'], $rsa['sub_code'], $pid);
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
                                `pisdoego_db_pis`.`tbl_current_reports` 
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
                                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                                    return false;
                                }
                            }
                        } else {
                            $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                            $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                            return false;
                        }
                    }
                } else {
                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                    return false;
                }

            }

            $queryToFinal = sprintf("INSERT INTO 
            `pisdoego_db_pis`.`tbl_current_reports` 
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
            if ($resultToFinale > 0) {

                return true;
            } else {
                $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                return false;
            }
        }


    }

    function selectAllFinalReport()
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM pisdoego_db_pis.tbl_current_reports;");
        return $res;
    }

    function sumOfEOTotal($id)
    {
        $sql = "SELECT
               SUM(Main_syag) as agr_syag, 
               SUM(Main_syab) as agr_syab, 
               SUM(Main_sypq) as agr_sypq, 
               SUM(Main_sype) as agr_sype, 
               SUM(Main_sqaq) as agr_sqaq, 
               SUM(Main_sqab) as agr_sqab, 
               SUM(Main_sqpq) as agr_sqpq, 
               SUM(Main_sqpe) as agr_sqpe 
               FROM
                (SELECT 
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
                                left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                    where main.id=sub.main_activity_id and edu_office_id='$id'
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id) as T_AGR ;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfEOMainActivity($id)
    {
        $sql = "SELECT 
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
                                left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                    where main.id=sub.main_activity_id and edu_office_id='$id'
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfEOSubActivity($id, $office_id)
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
                        left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                        left join tbl_main_activities as main on main.id= sub.main_activity_id
                        left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                where main.id='$id' and
                                sub.code=act.sub_activity_code and edu_office_id='$office_id'
                                GROUP BY sub.id
                                ORDER BY sub.id ASC) as T_SUB GROUP BY sub_code;";

        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;

    }

    function sumofEOActivity($main_activity, $sub_activity, $office_id)
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
            left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
            left join tbl_main_activities as main on main.id= sub.main_activity_id
            left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
            where main.id='$main_activity' and
            sub.code='$sub_activity' and edu_office_id='$office_id'
            GROUP BY
            act.id
            ORDER BY act.id ASC;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;

    }

    function generateEOFinalReport($id)
    {

        $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
        $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
        if ($resultForTruncate > 0) {
            $queryForMainActivity = $this->sumOfEOMainActivity($id);
            while ($rma = mysqli_fetch_array($queryForMainActivity)) {
                $queryToInsertForMain = sprintf("INSERT INTO 
                `pisdoego_db_pis`.`tbl_current_reports` 
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
                    $resultForQuery = $this->sumOfEOSubActivity($rma['main_id'], $id);
                    while ($rsa = mysqli_fetch_array($resultForQuery)) {

                        $queryToInsertForSub = sprintf("INSERT INTO 
                        `pisdoego_db_pis`.`tbl_current_reports` 
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
                            $resultFromSubQueries = $this->sumofEOActivity($rma['main_id'], $rsa['sub_code'], $id);
                            while ($raa = mysqli_fetch_array($resultFromSubQueries)) {
                                $queryToInsertAct = sprintf(
                                    "INSERT INTO 
                                `pisdoego_db_pis`.`tbl_current_reports` 
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
                                if ($resultFrom < 0) {
                                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                                    return false;
                                }
                            }
                        } else {
                            $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                            $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                            return false;
                        }
                    }
                } else {
                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                    return false;
                }

            }
            $resultFinal = mysqli_fetch_array($this->sumOfEOTotal($id));
            $queryToFinal = sprintf("INSERT INTO 
            `pisdoego_db_pis`.`tbl_current_reports` 
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
            if ($resultToFinale > 0) {

                return true;
            } else {
                $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_current_reports`;";
                $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                return false;
            }
        }


    }

    function selectAllActivities()
    {
        $res = mysqli_query($this->dbc, "SELECT id, code, name_np FROM tbl_activities WHERE sub_activity_code IS NOT NULL");
        return $res;
    }

    function selectOneActivity($id)
    {
        $res = mysqli_query($this->dbc, "SELECT * FROM tbl_activities WHERE id = '$id' LIMIT 1");
        return $res;
    }

    /* New functions to be sent */

    function selectLocalOffice()
    {
        $res = mysqli_query($this->dbc, "SELECT lo.id,lo.code,lo.name_np,lo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_local_bodies as lo LEFT JOIN tbl_districts AS di ON lo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id");
        return $res;
    }

    function selectLocalOfficeWithDistrictId($district_id)
    {
        $res = mysqli_query($this->dbc, "SELECT lo.id,lo.code,lo.name_np,lo.name_en,d.name_np as 'd_name', di.name_np as di_name FROM tbl_local_bodies as lo LEFT JOIN tbl_districts AS di ON lo.district_id = di.id LEFT JOIN tbl_developement_regions as d on d.id = di.development_region_id where lo.district_id='$district_id'");
        return $res;
    }

    function selectLocalOfficeTransaction($oid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.desc_np, a.local_activity3_code, a.local_activity3_desc_np, a.id, tl.* FROM tbl_local_bodies_activities4 AS a INNER JOIN tbl_transaction_local_bodies AS tl ON a.id = tl.local_body_activity4_id WHERE tl.local_body_id = '$oid'");
        return $res;
    }

    function selectOneTransactionForLocal($oid, $tlid)
    {
        $res = mysqli_query($this->dbc, "SELECT a.desc_np, a.local_activity3_code, a.local_activity3_desc_np,a.id, tl.* FROM tbl_local_bodies_activities4 AS a INNER JOIN tbl_transaction_local_bodies AS tl ON a.id = tl.local_body_activity4_id WHERE tl.local_body_id = '$oid' AND tl.id= '$tlid' LIMIT 1");
        return $res;
    }

    function updateOneLocalTransaction($txtpyearqty,
                                       $txtpyearbudget,
                                       $txtpttbudget,
                                       $txtpttqty,
                                       $tlid,
                                       $yearlyAllocQty,
                                       $quaterAllocWty,
                                       $qtrTargetBudget)
    {
        $sql = sprintf("UPDATE 
                  `pisdoego_db_pis`.`tbl_transaction_local_bodies` 
                  set yearly_progress_qty = '%s',
                  yearly_progress_expenditure='%s',
                  q1_progress_expenditure='%s',
                  q1_progress_qty='%s',
                  yearly_alloc_qty='%s',
                  q1_alloc_qty='%s', 
                  q1_alloc_budget='%s'
                  where id = '%s'",
            mysqli_real_escape_string($this->dbc, $txtpyearqty),
            mysqli_real_escape_string($this->dbc, $txtpyearbudget),
            mysqli_real_escape_string($this->dbc, $txtpttbudget),
            mysqli_real_escape_string($this->dbc, $txtpttqty),
            mysqli_real_escape_string($this->dbc, $yearlyAllocQty),
            mysqli_real_escape_string($this->dbc, $quaterAllocWty),
            mysqli_real_escape_string($this->dbc, $qtrTargetBudget),
            mysqli_real_escape_string($this->dbc, $tlid));
        $res = mysqli_query($this->dbc, $sql);
        echo $sql;
        return $res;
    }

    function updatePassword()
    {
        $sql = "SELECT * FROM pisdoego_db_pis.tbl_users where user_type=1;";
        $result = mysqli_query($this->dbc, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $sqlu = sprintf("UPDATE pisdoego_db_pis.tbl_users set password = '%s' where id = '%s';",
                mysqli_real_escape_string($this->dbc, crypt(trim($row['password']), 'st')),
                mysqli_real_escape_string($this->dbc, $row['id'])
            );
            $res = mysqli_query($this->dbc, $sqlu);
        }
    }

    function sumOfIndividualEduTotal($oid)
    {
        $sql = "SELECT
               SUM(Main_syag) as agr_syag, 
               SUM(Main_syab) as agr_syab, 
               SUM(Main_sypq) as agr_sypq, 
               SUM(Main_sype) as agr_sype, 
               SUM(Main_sqaq) as agr_sqaq, 
               SUM(Main_sqab) as agr_sqab, 
               SUM(Main_sqpq) as agr_sqpq, 
               SUM(Main_sqpe) as agr_sqpe 
               FROM
                (SELECT 
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
                                left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                    where main.id=sub.main_activity_id
                                        and tl.edu_office_id = '$oid'
                                        and tl.q1_alloc_budget!='0'
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id) as T_AGR ;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfIndividualMainActivity($oid)
    {
        $sql = "SELECT 
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
                                left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                                left join tbl_main_activities as main on main.id= sub.main_activity_id
                                left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                    where main.id=sub.main_activity_id
                                        and tl.edu_office_id = '$oid'
                                        and tl.q1_alloc_budget!='0'
                                        GROUP BY
                                        act.id
                                        ORDER BY sub.id ASC) as T_SUB GROUP BY main_id) as T_Main_Sub Group BY main_id;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumOfIndiSubActivity($id, $oid)
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
                        left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
                        left join tbl_main_activities as main on main.id= sub.main_activity_id
                        left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
                                where main.id='$id' and
                                sub.code=act.sub_activity_code
                                and tl.edu_office_id = '$oid'
                                and tl.q1_alloc_budget!='0'
                                GROUP BY sub.id
                                ORDER BY sub.id ASC) as T_SUB GROUP BY sub_code;";
        //echo $sql;
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $sql);
        return $res;
    }

    function sumofIndiActivity($main_activity, $sub_activity, $oid)
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
            left join tbl_sub_activities as sub on sub.code=act.sub_activity_code
            left join tbl_main_activities as main on main.id= sub.main_activity_id
            left join tbl_transaction_edu_offices as tl on tl.activity_code=act.code
            where main.id='$main_activity' and
            sub.code='$sub_activity'
            and tl.edu_office_id = '$oid'
            and tl.q1_alloc_budget!='0'
            GROUP BY
            act.id
            ORDER BY act.id ASC;";
        mysqli_query($this->dbc, "SET sql_mode = '';");
        $res = mysqli_query($this->dbc, $query);
        return $res;
    }

    function generateEducationalIndividualReport($oid)
    {
        //set_time_limit(3000);
        $resultFinal = mysqli_fetch_array($this->sumOfIndividualEduTotal($oid));
        $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_edu_reports`;";
        $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
        if ($resultForTruncate > 0) {
            $queryForMainActivity = $this->sumOfIndividualMainActivity($oid);
            while ($rma = mysqli_fetch_array($queryForMainActivity)) {
                $yearlyMainWeight = ($rma['Main_syab'] / $resultFinal['agr_syab']) * 100;
                $yearlyExpProPerMain = ($rma['Main_sype'] / $rma['Main_syab']) / 100;
                $qtrAllocWeighMain = ($rma['Main_sqaq'] / $resultFinal['agr_sqaq']) * 100;
                if ($rma['Main_sqab'] != 0) {
                    $qtrExpProPerMain = ($rma['Main_sqpe'] / $rma['Main_sqab']) / 100;
                } else {
                    $qtrExpProPerMain = 0;
                }
                $queryToInsertForMain = sprintf("INSERT INTO 
                `pisdoego_db_pis`.`tbl_edu_reports` 
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
                (
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
                '0')",
                    mysqli_real_escape_string($this->dbc, $rma['main_id']),
                    mysqli_real_escape_string($this->dbc, $yearlyMainWeight),
                    mysqli_real_escape_string($this->dbc, $rma['Main_syab']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sype']),
                    mysqli_real_escape_string($this->dbc, $yearlyExpProPerMain),
                    mysqli_real_escape_string($this->dbc, $qtrAllocWeighMain),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sqab']),
                    mysqli_real_escape_string($this->dbc, $rma['Main_sqpe']),
                    mysqli_real_escape_string($this->dbc, $qtrExpProPerMain),
                    mysqli_real_escape_string($this->dbc, $rma['main_name_np']));
                $resultFromMain = mysqli_query($this->dbc, $queryToInsertForMain);

                if ($resultFromMain > 0) {
                    $resultForQuery = $this->sumOfIndiSubActivity($rma['main_id'], $oid);
                    while ($rsa = mysqli_fetch_array($resultForQuery)) {
                        $yearlySubWeight = ($rsa['sub_syab'] / $resultFinal['agr_syab']) * 100;
                        $yearlyExpProPerSub = ($rsa['sub_sype'] / $rsa['sub_syab']) / 100;
                        $qtrAllocWeighSUB = ($rsa['sub_sqaq'] / $resultFinal['agr_sqaq']) * 100;
                        if ($rsa['sub_sqab'] != 0) {
                            $qtrExpProPerSub = ($rsa['sub_sqpe'] / $rsa['sub_sqab']) / 100;
                        } else {
                            $qtrExpProPerSub = 0;
                        }
                        $queryToInsertForSub = sprintf("INSERT INTO 
                        `pisdoego_db_pis`.`tbl_edu_reports` 
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
                        ('%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s', 
                        '%s',
                        '%s', 
                        '%s',
                        '1')",
                            mysqli_real_escape_string($this->dbc, $rsa['sub_code']),
                            mysqli_real_escape_string($this->dbc, $yearlySubWeight),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_syab']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sype']),
                            mysqli_real_escape_string($this->dbc, $yearlyExpProPerSub),
                            mysqli_real_escape_string($this->dbc, $qtrAllocWeighSUB),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sqab']),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_sqpe']),
                            mysqli_real_escape_string($this->dbc, $qtrExpProPerSub),
                            mysqli_real_escape_string($this->dbc, $rsa['sub_name_np']));
                        $resultFromSub = mysqli_query($this->dbc, $queryToInsertForSub);


                        if ($resultFromSub > 0) {
                            $resultFromSubQueries = $this->sumofIndiActivity($rma['main_id'], $rsa['sub_code'], $oid);
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
                                `pisdoego_db_pis`.`tbl_edu_reports` 
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
                                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_edu_reports`;";
                                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                                    return false;
                                }
                            }
                        } else {
                            $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_edu_reports`;";
                            $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                            return false;
                        }
                    }
                } else {
                    $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_edu_reports`;";
                    $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                    return false;
                }

            }

            $queryToFinal = sprintf("INSERT INTO 
            `pisdoego_db_pis`.`tbl_edu_reports` 
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
            if ($resultToFinale > 0) {

                return true;
            } else {
                $queryForTruncate = "truncate `pisdoego_db_pis`.`tbl_edu_reports`;";
                $resultForTruncate = mysqli_query($this->dbc, $queryForTruncate);
                return false;
            }
        }


    }

    function selectIndividualEduReport()
    {
        $query = "SELECT * FROM pisdoego_db_pis.tbl_edu_reports;";
        return mysqli_query($this->dbc, $query);
    }

    function sumOfIndiLocalActivity($oid)
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

    function generateIndividualLocalReport($oid)
    {
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

    function selectIndividualLocalReport()
    {
        $query = "SELECT * FROM pisdoego_db_pis.tbl_local_reports;";
        return mysqli_query($this->dbc, $query);
    }

    private function selectUserByUserName($username)
    {
        $queRY = "select count(username) from user_ip WHERE  username='$username'";

        $result = mysqli_query($this->dbc, $queRY);
        $row = mysqli_fetch_array($result);

        return $row[0];
    }
}


/*Creating the object to retrieve the data*/
$dbc = new DB_dbc();

?>