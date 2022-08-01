<?php
// yangi jarayon qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
require "MyFunctions.php";
$bz_ids = GetBizUid($_POST['hodim_uid']);
$MyUID = GetNewMySqlUID();
$sql_str = " insert into hm_jarayonlar (jar_uid, hodim_uid, bz_uid, mahsulot_uid, miqdori, taminot_uid, narx_olish, summa_olish, istemol_uid, narx_sotish, summa_sotish, mashina_uid, shopir_uid, jar_izoh)
             values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
$query = $db->connect()->prepare($sql_str);
$arr = array($MyUID, $_POST['hodim_uid'], $bz_ids[0]['bz_uid'], $_POST['sGoodsUID'], $_POST['sMiqdor'], $_POST['sTaminotchiUID'], $_POST['sKirimNarh'], $_POST['sKirimSumma'], $_POST['sIstemolchiUID'], $_POST['sChiqimNarh'], $_POST['sChiqimSumma'], $_POST['sMashinaUID'], $_POST['sHaydovchiUID'], $_POST['sIzoh']);
$result = $query->execute($arr);
$rowCnt = $query->rowCount();
if ($rowCnt > 0) {
    $chiqim_summa = "-".$_POST['sChiqimSumma'];
    $sql_str1 = "insert into hm_tashqi_kassa (tk_uid, hodim_uid, hodim_id, kim, summa, kirimmi, pulmi, jar_uid, izoh)
 values (UUID(), '{$_POST['hodim_uid']}' ,{$_POST['hodim_id']} , '{$_POST['sTaminotchiUID']}' , {$_POST['sKirimSumma']}, '1', '0', '{$MyUID}', '{$_POST['sIzoh']}') ";
    $query = $db->connect()->prepare($sql_str1);
    $query->execute();
    $sql_str2 = "insert into hm_tashqi_kassa (tk_uid, hodim_uid, hodim_id, kim, summa, kirimmi, pulmi, jar_uid, izoh)
 values (UUID(), '{$_POST['hodim_uid']}' ,{$_POST['hodim_id']} , '{$_POST['sIstemolchiUID']}' , {$chiqim_summa}, '0', '0', '{$MyUID}', '{$_POST['sIzoh']}') ";
    $query = $db->connect()->prepare($sql_str2);
    $query->execute();
    $sql1 = "update hm_moshinalar set shopir_uid = '{$_POST['sHaydovchiUID']}' where hm_moshinalar.mosh_uid = '{$_POST['sMashinaUID']}'";
    $query = $db->connect()->prepare($sql1);
    $result = $query->execute();
    $sql2 = "update hm_taminotchilar set tam_saldo = if(isnull(tam_saldo), ".$_POST['sKirimSumma'].", tam_saldo + ".$_POST['sKirimSumma'].") where tam_uid = '{$_POST['sTaminotchiUID']}'";
    $query = $db->connect()->prepare($sql2);
    $query->execute();
    $sql3 = "update hm_istemolchilar set ist_saldo = if(isnull(ist_saldo), ".$chiqim_summa.", ist_saldo + ".$chiqim_summa.") where ist_uid = '{$_POST['sIstemolchiUID']}'";
    $query = $db->connect()->prepare($sql3);
    $query->execute();
    $response['iAffectedRow'] = $rowCnt;
    $response['msg'] = "CreatedNewAmaliyot";
} else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "RepeatAgain";
}
echo json_encode($response);
