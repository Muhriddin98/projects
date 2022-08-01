<?php
// tashqi kassani ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sFilter = "";
if (!empty($_POST['dan'])) {
    $sFilter = $sFilter." and jar_sana >= '{$_POST['dan']}'";
}
if (!empty($_POST['gacha'])) {
    $sFilter = $sFilter." and jar_sana <= '{$_POST['gacha']}'";
}
if (!empty($_POST['tam'])) {
    $sFilter = $sFilter." and taminot_uid '{$_POST['tam']}'";
}
if (!empty($_POST['ist'])) {
    $sFilter = $sFilter." and istemol_uid = '{$_POST['ist']}'";
}
if (!empty($_POST['filter'])) {
    $filter = addslashes($_POST['filter']);
    $sFilter = $sFilter." and izoh like '%{$filter}%'";
}
$sql_str = "select tk.tk_uid, tk.jar_sana, tk.summa, if(pulmi = '1', 'pul', 'mol') as nima,
if((pulmi = '1' and tk.summa < 0) or (pulmi = '0' and tk.summa > 0), 
    (select tam_nomi from hm_taminotchilar where tam_uid = tk.kim), 
    (select ist_nomi from hm_istemolchilar where ist_uid = tk.kim)) as kim, tk.izoh
from hm_tashqi_kassa tk where hodim_uid = '{$_POST['hodim_uid']}' ".$sFilter;
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
echo json_encode($result_array);