<?php
//ichki kassaga yangi jarayon qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "insert into hm_ichki_kassa (ik_uid, hodim_uid, hodim_id, kim, summa, kirimmi, izoh)
 values (UUID(), ?, ?, ?, ?, ?, ?) ";
$query = $db->connect()->prepare($sql_str);
$arr = array($_POST['hodim_uid'], $_POST['hodim_id'], $_POST['sKim'], $_POST['sSumma'], $_POST['bKirim'], $_POST['sIzoh']);
$result = $query->execute($arr);
$rowCnt = $query->rowCount();
if ($rowCnt > 0) {
    $saldo = $_POST['sSumma'];
    $sql_str = "update hm_xodimlar set xodim_saldo = xodim_saldo + ".$saldo." where xodim_uid = '{$_POST['hodim_uid']}' ";
    $query = $db->connect()->prepare($sql_str);
    $query->execute();
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = "CreatedNewAmal1";
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "RepeatAgain";
}
echo json_encode($response);