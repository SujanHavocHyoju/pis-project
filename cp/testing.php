<?php


function generateEduOfficeWiseReport()
{
    $sqlEduOffice = $this->selectEduOffice();
    $result = array();
    while ($row = mysqli_fetch_array($sqlEduOffice)) {
        $activityResult = mysqli_fetch_array($this->countActivities($row['id']));
        $undoneResult = mysqli_fetch_array($this->countActiviesWhichIsUnDone($row['id']));
        $result['id'] = $row['id'];
        $result['name_np'] = $row['name_np'];
        if ($activityResult[0] != 0) {
            echo $undoneResult[0];
            $result['desc'] = $activityResult[0] . " क्रियकलाप मध्ये " . $undoneResult[0] . " क्रियाकलापको रेकर्ड अपुरो भेटिएको";
        }
    }
    return $result;
}


?>


