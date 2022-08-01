<?php
// hujayinga tegishli biznesga masul xodimni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_xodimlar where bz_id = {$_POST['bz_id']}";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt > 0) {
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = $result_array;
}
else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "ManagerNotFound";
}
echo json_encode($response);