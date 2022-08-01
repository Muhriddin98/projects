<?php
//yangi xodim qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();

$sql_str = "select * from hm_xodimlar where xodim_login = '{$_POST['login']}'";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt==0) {
    $sql_str = "insert into hm_xodimlar (xodim_uid, xodim_ismi, xodim_login, xodim_parol, bz_id, bz_uid, xodim_status)
  values (UUID(), ?, ?, ?, ?, ?, ?)";
    $query = $db->connect()->prepare($sql_str);
//    $result = $query->execute(array( $_POST['ismi'], $_POST['login'], $_POST['parol'], $_POST['tg_id'], $_POST['bz_id'], $_POST['bz_UID'], $_POST['status']) );
    $result = $query->execute(array( $_POST['ismi'], $_POST['login'], $_POST['parol'], $_POST['bz_id'], $_POST['bz_UID'], '2' ) );
    $rowCnt = $query->rowCount();
    if ($rowCnt > 0) {
        $response['iAffectedRow'] = $rowCnt;
        $response['msg'] = "CreatedManagerLogin";
    } else {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "RepeatAgain";
    }
} else if ($rowCnt==1) {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "LoginExists";
}


echo json_encode($response);
?>
