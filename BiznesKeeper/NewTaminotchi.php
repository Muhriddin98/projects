<?php
//yangi taminotchi qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
require "MyFunctions.php";
$bz_ids = GetBizUid($_POST['hodim_uid']);
$sql_str = "insert into hm_taminotchilar (tam_uid, tam_nomi, tam_kontakt, tam_izoh, latitude, longitude, tam_saldo, bz_id, bz_uid, hodim_id, hodim_uid)
 values (UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
$query = $db->connect()->prepare($sql_str);
$result = $query->execute(array($_POST['nomi'], $_POST['kontakt'], $_POST['izoh'], $_POST['lati'], $_POST['longi'], $_POST['saldo'], $bz_ids[0]['bz_id'], $bz_ids[0]['bz_uid'], $_POST['hodim_id'], $_POST['hodim_uid']));
$rowCnt = $query->rowCount();
if ($rowCnt > 0) {
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = "CreatedNewTaminotchi";
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "RepeatAgain";
}
echo json_encode($response);