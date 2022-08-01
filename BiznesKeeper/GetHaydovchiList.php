<?php
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
require "MyFunctions.php";
$huj_ids = GetHujUid($_POST['hodim_uid']);
$sql_str = "select * from hm_shopirlar where huj_id = {$huj_ids[0]['huj_id']} and huj_uid = '{$huj_ids[0]['huj_uid']}'";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
$response = $result_array;
echo json_encode($response);