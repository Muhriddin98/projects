<?php
//tashqi kassaga yangi jarayon qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
//$log = "12";
//file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);
$sql_str = "insert into hm_tashqi_kassa (tk_uid, hodim_uid, hodim_id, kim, summa, kirimmi, pulmi, izoh)
 values (UUID(), ?, ?, ?, ?, ?, ?) ";
$query = $db->connect()->prepare($sql_str);
$arr = array($_POST['hodim_uid'], $_POST['hodim_id'], $_POST['sKim'], $_POST['sSumma'], $_POST['bKirim'], '1', $_POST['sIzoh']);
$result = $query->execute($arr);
//$log = str_replace(array('	', PHP_EOL), '', print_r($arr, true));
//file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);
$rowCnt = $query->rowCount();
if ($rowCnt > 0) {
    $saldo = $_POST['sSumma'];
    if($_POST['bKirim'] != '1'){
        $sql = "update hm_taminotchilar set tam_saldo = if(isnull(tam_saldo), ".$saldo.", tam_saldo + ".$saldo.") where tam_uid = '{$_POST['sKim']}'";
        $query = $db->connect()->prepare($sql);
        $query->execute();
    }
    else{
        $sql = "update hm_istemolchilar set ist_saldo = if(isnull(ist_saldo), ".$saldo.", ist_saldo + ".$saldo.") where ist_uid = '{$_POST['sKim']}'";
        $query = $db->connect()->prepare($sql);
        $query->execute();
    }
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = "CreatedNewAmal1";
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "RepeatAgain";
}
echo json_encode($response);