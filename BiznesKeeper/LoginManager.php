<?php
//xodimni tizimga kirishini ta'minlaydi
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_xodimlar where xodim_login = '{$_POST['login']}' and xodim_parol = '{$_POST['parol']}'";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt > 0) {
    if ($result_array[0]['xodim_status'] == '1') {
        $sql = "update hm_xodimlar set oxirgi_faolligi = current_timestamp where xodim_uid = {$result_array[0]['xodim_uid']} ";
        $query = $db->connect()->prepare($sql);
        $status = $query->execute();
        $response['iAffectedRow'] = $rowCnt;
        $response['msg'] = "LoginSuccessfully";
        $response['login_uid'] = $result_array[0]['xodim_UID'];
        $response['login_id'] = $result_array[0]['xodim_id'];
        $response['xodim_ismi'] = $result_array[0]['xodim_ismi'];
    } else {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "AccountNoActive";
    }
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "LoginFailed";
}

echo json_encode($response);