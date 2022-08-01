<?php
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$nomi = addslashes($_POST['nomi']);
$izoh = addslashes($_POST['izoh']);
$ulchov = addslashes($_POST['ulchov']);
$sql_str = "insert into hm_mahsulotlar (mah_uid, mah_nomi, mah_ulchov, mah_izoh, hodim_id, hodim_uid) 
values (UUID(), '{$nomi}', '{$ulchov}', '{$izoh}', {$_POST['hodim_id']}, '{$_POST['hodim_uid']}' )";
$query = $db->connect()->prepare($sql_str);
$result = $query->execute();
$rowCnt = $query->rowCount();
if ($rowCnt > 0) {
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = "CreatedNewMahsulot";
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "RepeatAgain";
}
echo json_encode($response);