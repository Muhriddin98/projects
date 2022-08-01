<?php
// ichki kassani ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sFilter = "";
if (!empty($_POST['dan'])) {
    $sFilter = $sFilter." and jar_sana >= '{$_POST['dan']}'";
}
if (!empty($_POST['gacha'])) {
    $sFilter = $sFilter." and jar_sana <= '{$_POST['gacha']}'";
}
if (!empty($_POST['filter'])) {
    $filter = addslashes($_POST['filter']);
    $sFilter = $sFilter." and izoh like '%{$filter}%'";
}
$sql_str = "select * from hm_ichki_kassa where hodim_uid = '{$_POST['hodim_uid']}' and hodim_id = {$_POST['hodim_id']} ".$sFilter;
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);

echo json_encode($result_array);