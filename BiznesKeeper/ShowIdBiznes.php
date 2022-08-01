<?php
// hujayinga tegishli tanlangan biznesni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_bizneslar where huj_id = {$_POST['huj_id']} and bz_id = {$_POST['bz_id']}";
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
    $response['msg'] = "BusinessNotFound";
}
echo json_encode($response);