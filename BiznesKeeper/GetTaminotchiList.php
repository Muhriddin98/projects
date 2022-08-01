<?php
// taminotchilarni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$filter = "";
//if ($_POST['filter'] != "") {
if (!empty($_POST['filter'])) {
    $filter = addslashes($_POST['filter']);
    $filter = " and tam_nomi like '%{$filter}%'";
}
require "MyFunctions.php";
$bz_ids = GetBizUid($_POST['hodim_uid']);
$sql_str = "select * from hm_taminotchilar where hodim_uid = '{$_POST['hodim_uid']}' and bz_uid = '{$bz_ids[0]['bz_uid']}' ".$filter;
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
$response = $result_array;
echo json_encode($response);
