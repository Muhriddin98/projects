<?php
//hodimni faol yoki yuqligini tekshiradi
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_xodimlar where xodim_login = '{$_POST['HodimLogin']}' and xodim_parol = '{$_POST['HodimParol']}' ";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);

//$log = str_replace(array('	', PHP_EOL), '', print_r($result_array, true));
//file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);

if ($rowCnt > 0) {
    if ($result_array[0]['xodim_status'] != '0') {
        $sql = "update hm_xodimlar set oxirgi_faolligi = current_timestamp where xodim_uid = '{$result_array[0]['xodim_uid']}' ";
        $query = $db->connect()->prepare($sql);
        $query->execute();
        $response['iAffectedRow'] = $rowCnt;
        $response['hodim_uid'] = $result_array[0]['xodim_uid'];
        $response['hodim_id'] = $result_array[0]['xodim_id'];
        $response['hodim_ismi'] = $result_array[0]['xodim_ismi'];
        $response['bizUID'] = $result_array[0]['bz_uid'];
        $response['bizID'] = $result_array[0]['bz_id'];
        $response['hodim_status'] = $result_array[0]['xodim_status'];
    } else {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "AccountNoActive";
    }
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "LoginOrPasswordIncorrect";
}
echo json_encode($response);