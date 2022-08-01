<?php
// mahsulotlarni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
if(isset($_POST['filter'])){
    $filter = addslashes($_POST['filter']);
//    $sql_str = "select * from hm_mahsulotlar where hodim_id = '{$_POST['HodimID']}' and hodim_uid = '{$_POST['HodimUID']}' and mah_nomi like '%{$filter}%'";
    $sql_str = "select * from hm_mahsulotlar";
    $query = $db->connect()->prepare($sql_str);
    $status = $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $rowCnt = count($result);
    $result_array = json_decode(json_encode($result), true);
if($rowCnt>0){
        $response = $result_array;
    }
    else{
        $response['iAffectedRow'] = 0;
        $response['msg'] = "MahsulotNotFound";
    }
}
else{
//    $sql_str = "select * from hm_mahsulotlar where hodim_id = '{$_POST['HodimID']}' and hodim_uid = '{$_POST['HodimUID']}'";
    $sql_str = "select * from hm_mahsulotlar";
    $query = $db->connect()->prepare($sql_str);
    $status = $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $rowCnt = count($result);
    $result_array = json_decode(json_encode($result), true);
 if($rowCnt>0){
        $response = $result_array;
    }
    else{
        $response['iAffectedRow'] = 0;
        $response['msg'] = "MahsulotNotFound";
    }
}



echo json_encode($response);