<?php
require_once("Db.php");


$log = str_replace(array('	', PHP_EOL), '', print_r($_POST, true));
file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);
$log = str_replace(array('	', PHP_EOL), '', print_r($_GET, true));
file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);
$db = new Db();
$_POST = $_GET;
//header('Content-Type: text/csv; charset=utf-8');
//header('Content-Disposition: attachment; filename=amaliyot.csv');
//$query = $db->connect()->prepare("SET NAMES 'utf8'");
//$query->execute();
//$sql_str = "select tk.jar_sana, tk.summa, if(pulmi = '1', 'pul', 'mol') as nima,
//if((pulmi = '1' and tk.summa < 0) or (pulmi = '0' and tk.summa > 0),
//    (select tam_nomi from hm_taminotchilar where tam_uid = tk.kim),
//    (select ist_nomi from hm_istemolchilar where ist_uid = tk.kim)) as kim
//from hm_tashqi_kassa tk";
//$query = $db->connect()->prepare($sql_str);
//$status = $query->execute();
//$result = $query->fetchAll(PDO::FETCH_OBJ);
//$rowCnt = count($result);
//$result_array = json_decode(json_encode($result), true);
//$captions = array('sana', 'summa', 'nima', 'kim');
//array_unshift($result_array, $captions);
//$output = fopen('php://output', 'w');
//foreach ($result_array as $row){
//    fputcsv($output, $row, ",", "|", '""');
//}
//fclose($output);

$response = array();

if(isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'NewOwner':   //yangi hujayin qo'shish uchun
            include "NewOwner.php";
            break;
        case 'NewHodim': //yangi xodim qo'shish uchun
            include "NewHodim.php";
            break;
        case 'NewBiznes' : //yangi biznes qo'shish uchun
            include "NewBiznes.php";
            break;
 case 'NewIstemolchi' : //yangi istemolchi(obyekt) qo'shish uchun
            include "NewIstemolchi.php";
            break;
case 'NewTaminotchi' : //yangi taminotchi qo'shish uchun
            include "NewTaminotchi.php";
            break;
case 'NewHaydovchi' : //yangi haydovchi qo'shish uchun
            include "NewHaydovchi.php";
            break;
case 'NewMoshina' : //yangi mashina qo'shish uchun
            include "NewMashina.php";
            break;
case 'NewAmal1' : //ichki kassaga yangi jarayon qo'shish uchun
            include "NewAmal1.php";
            break;
case 'NewAmaliyot' : // yangi jarayon qo'shish uchun
            include "NewAmaliyot.php";
            break;
        case 'GetAmaliyotList' : // yangi jarayon qo'shish uchun
            include "GetAmaliyot.php";
            break;
        case 'NewAmal2' : //tashqi kassaga yangi jarayon qo'shish uchun
            include "NewAmal2.php";
            break;
        case 'GetAmal2' : //tashqi kassaga yangi jarayon qo'shish uchun
            include "GetAmal2.php";
            break;
        case 'GetAmal1' : //tashqi kassaga yangi jarayon qo'shish uchun
            include "GetAmal1.php";
            break;
        case 'LoginOwner' : //hujayinni tizimga kirishini ta'minlaydi
            include 'LoginOwner.php';
            break;
        case 'LoginManager': //xodimni tizimga kirishini ta'minlaydi
            include 'LoginManager.php';
            break;
        case 'CheckOwnerStatus'://hujayinni faol yoki yuqligini tekshiradi
            include 'CheckOwnerStatus.php';
            break;
        case 'CheckHodimStatus'://hodimni faol yoki yuqligini tekshiradi
            include 'CheckHodimStatus.php';
            break;
        case 'NewMahsulot': // yangi mahsulot qo'shish uchun
            include 'NewMahsulot.php';
            break;
        case 'ShowAllBiznes': // hujayinga tegishli bizneslarni ko'rish uchun
            include 'ShowAllBiznes.php';
            break;
        case 'ShowIdBiznes': // hujayinga tegishli tanlangan biznesni ko'rish uchun
            include 'ShowIdBiznes.php';
            break;
        case 'ShowIdManager': // hujayinga tegishli biznesga masul xodimni ko'rish uchun
            include 'ShowIdManager.php';
            break;
        case 'GetTaminotchiList': // taminotchilarni ko'rish uchun
            include 'GetTaminotchiList.php';
            break;
        case 'GetIstemolchiList': // taminotchilarni ko'rish uchun
            include 'GetIstemolchiList.php';
            break;
        case 'GetHodimList': // hodimlarni ko'rish uchun
            include 'GetHodimList.php';
            break;
        case 'GetMahsulotList': // mahsulotlarni ko'rish uchun
            include 'GetMahsulotList.php';
            break;
        case 'GetMashinaList': // mahsulotlarni ko'rish uchun
            include 'GetMashinaList.php';
            break;
case 'GetHaydovchiList': // mahsulotlarni ko'rish uchun
            include 'GetHaydovchiList.php';
            break;
        case 'GetMashinaModelList': // mashinalarni ko'rish uchun
            include 'GetMashinaModelList.php';
            break;
        default:
            $response['error'] = true;
            $response['message'] = 'Invalid Operation Called';
            echo json_encode($response);
    }
}

?>


     
