<?php
// hodimlarni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_xodimlar where bz_id = {$_POST['biz_id']} and bz_uid = '{$_POST['biz_uid']}' ";


$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);


echo json_encode($result_array);