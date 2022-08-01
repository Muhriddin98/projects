<?php
// amaliyotlarni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
require "MyFunctions.php";
$bz_ids = GetBizUid($_POST['hodim_uid']);
$sFilter = "";
if (!empty($_POST['mah'])) {
    $sFilter = $sFilter." and mahsulot_uid = '{$_POST['mah']}'";
}
if (!empty($_POST['tam'])) {
    $sFilter = $sFilter." and taminot_uid '{$_POST['tam']}'";
}
if (!empty($_POST['ist'])) {
    $sFilter = $sFilter." and istemol_uid = '{$_POST['ist']}'";
}
if (!empty($_POST['mash'])) {
    $sFilter = $sFilter." and mashina_uid = '{$_POST['mash']}'";
}
if (!empty($_POST['hayd'])) {
    $sFilter = $sFilter." and shopir_uid '{$_POST['hayd']}'";
}
if (!empty($_POST['dan'])) {
    $sFilter = $sFilter." and jar_sana >= '{$_POST['dan']}'";
}
if (!empty($_POST['gacha'])) {
    $sFilter = $sFilter." and jar_sana <= '{$_POST['gacha']}'";
}
if (!empty($_POST['filter'])) {
    $filter = addslashes($_POST['filter']);
    $sFilter = $sFilter." and jar_izoh like '%{$filter}%'";
}
$sql_str = "select hm_jarayonlar.jar_uid, hm_jarayonlar.jar_sana, hm_mahsulotlar.mah_nomi, hm_jarayonlar.miqdori, 
       hm_taminotchilar.tam_nomi, hm_jarayonlar.summa_olish, hm_istemolchilar.ist_nomi, hm_jarayonlar.summa_sotish,
       hm_moshinalar.mosh_drb, hm_shopirlar.shop_ismi,hm_shopirlar.shop_kontakt, hm_jarayonlar.jar_izoh 
from hm_jarayonlar join hm_mahsulotlar on hm_jarayonlar.mahsulot_uid = hm_mahsulotlar.mah_uid join hm_taminotchilar on hm_jarayonlar.taminot_uid = hm_taminotchilar.tam_uid 
join hm_istemolchilar on hm_jarayonlar.istemol_uid = hm_istemolchilar.ist_uid join hm_moshinalar on hm_jarayonlar.mashina_uid = hm_moshinalar.mosh_uid
join hm_shopirlar on hm_jarayonlar.shopir_uid = hm_shopirlar.shop_uid where hm_jarayonlar.hodim_uid = '{$_POST['hodim_uid']}' and hm_jarayonlar.bz_uid = '{$bz_ids[0]['bz_uid']}' ".$sFilter;
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if($rowCnt>0){
    $response = $result_array;
}
else{
    $response = "RepeatAgain";
}
echo json_encode($response);