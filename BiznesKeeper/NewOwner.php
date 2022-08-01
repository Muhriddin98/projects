<?php
//yangi hujayin qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_hujayinlar where huj_tg_id = '{$_POST['tg_id']}'";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt==0) {
    $sql_str = "select * from hm_hujayinlar where huj_login = '{$_POST['login']}'";
    $query = $db->connect()->prepare($sql_str);
    $status = $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $rowCnt = count($result);
    $result_array = json_decode(json_encode($result), true);
    if ($rowCnt==0) {
        $sql_str = "insert into hm_hujayinlar (huj_uid, huj_ismi, huj_login, huj_parol, huj_kontakt, huj_tg_id) values (UUID(), ?, ?, ?, ?, ?) ";
        $query = $db->connect()->prepare($sql_str);
        $result = $query->execute(array($_POST['ismi'], $_POST['login'], $_POST['parol'], $_POST['kontakt'], $_POST['tg_id']));
        $rowCnt = $query->rowCount();
        if ($rowCnt > 0) {
            $response['iAffectedRow'] = $rowCnt;
            $response['msg'] = "CreatedOwnerLogin";
        } else {
            $response['iAffectedRow'] = 0;
            $response['msg'] = "RepeatAgain";
        }
    } else if ($rowCnt==1) {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "LoginExists";
    }
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "TelegramIdExists";
}

echo json_encode($response);

