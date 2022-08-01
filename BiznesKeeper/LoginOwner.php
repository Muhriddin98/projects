<?php
//hujayinni tizimga kirishini ta'minlaydi
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_hujayinlar where huj_login = '{$_POST['login']}' and huj_parol = '{$_POST['parol']}'";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt > 0) {
    if ($result_array[0]['huj_status'] == '1') {
        $sql = "update hm_hujayinlar set oxirgi_faolligi = current_timestamp where huj_id = {$result_array[0]['huj_id']} ";
        $query = $db->connect()->prepare($sql);
        $status = $query->execute();
        $response['iAffectedRow'] = $rowCnt;
        $response['msg'] = "LoginSuccessfully";
        $response['login_uid'] = $result_array[0]['huj_UID'];
        $response['login_id'] = $result_array[0]['huj_id'];
        $response['hujayin_ismi'] = $result_array[0]['huj_ismi'];
    } else {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "AccountNoActive";
    }
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "LoginFailed";
}

echo json_encode($response);