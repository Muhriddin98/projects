<?php
//yangi biznes qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
if (isset($_POST['huj_id'])) {
    $sql_str = "insert into hm_bizneslar (bz_uid, huj_id, huj_UID, bz_turi, bz_nomi) values (UUID(), ?, ?, ?, ?) ";
    $query = $db->connect()->prepare($sql_str);
    $result = $query->execute(array($_POST['huj_id'], $_POST['huj_uid'],  $_POST['turi'], $_POST['nomi']));
    $rowCnt = $query->rowCount();
    if ($rowCnt > 0) {
        $response['iAffectedRow'] = $rowCnt;
        $response['msg'] = "CreatedNewBiznes";
    } else {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "RepeatAgain";
    }
}
 else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "OwnerIdFailed";
}
echo json_encode($response);