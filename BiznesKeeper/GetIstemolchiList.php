<?php
// istemolchilarni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$filter = "";
//if ($_POST['filter'] != "") {
if (!empty($_POST['filter'])) {
    $filter = addslashes($_POST['filter']);
    $filter = " and ist_nomi like '%{$filter}%'";
}
require "MyFunctions.php";
$bz_ids = GetBizUid($_POST['hodim_uid']);
$sql_str = "select * from hm_istemolchilar where hodim_uid = '{$_POST['hodim_uid']}' and bz_uid = '{$bz_ids[0]['bz_uid']}' ".$filter;

$log = $sql_str;
file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);

$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
$response = $result_array;


$log = str_replace(array('	', PHP_EOL), '', print_r($result_array, true));
file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);

echo json_encode($response);
