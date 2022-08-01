<?php
//yangi mashina qo'shish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select * from hm_moshinalar where mosh_drb = '{$_POST['DRB']}'";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
if ($rowCnt==0) {
    $sql_str = "insert into hm_moshinalar (mosh_uid, mosh_model, mosh_drb, mosh_izoh) values (UUID(), '{$_POST['model']}', '{$_POST['DRB']}', '{$_POST['izoh']}') ";
    $query = $db->connect()->prepare($sql_str);
    $result = $query->execute();
    $rowCnt = $query->rowCount();
    if ($rowCnt > 0) {
        $response['iAffectedRow'] = $rowCnt;
        $response['msg'] = "CreatedNewCar";
    } else {
        $response['iAffectedRow'] = 0;
        $response['msg'] = "RepeatAgain";
    }
}
else {
    $response['iAffectedRow'] = 0;
    $response['msg'] = "DRBExists";
}

echo json_encode($response);