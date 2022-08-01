<?php
//hujayinni faol yoki yuqligini tekshiradi
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select huj_status from hm_hujayinlar where huj_id = {$_POST['owner_id']}";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt > 0) {
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = $result_array;
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "IdIncorrect";
}

echo json_encode($response);