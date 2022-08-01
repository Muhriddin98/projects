<?php
//yangi haydovchi qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();

require "MyFunctions.php";
$huj_ids = GetHujUid($_POST['hodim_uid']);
$sql_str = "insert into hm_shopirlar (shop_uid, huj_id, huj_uid, shop_ismi, shop_kontakt, shop_izoh) values (UUID(), ?, ?, ?, ?, ?) ";
$query = $db->connect()->prepare($sql_str);
$result = $query->execute(array($huj_ids[0]['huj_id'], $huj_ids[0]['huj_uid'], $_POST['nomi'], $_POST['kontakt'], $_POST['izoh']));

$rowCnt = $query->rowCount();
if ($rowCnt > 0) {
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = "CreatedNewDriver";
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "RepeatAgain";
}
echo json_encode($response);