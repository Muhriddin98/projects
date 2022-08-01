<?php

//
function GetBizUid($input){
    global $db;
    $query = $db->connect()->prepare("SET NAMES 'utf8'");
    $query->execute();
    $sql_str = "select bz_id, bz_uid from hm_xodimlar where xodim_uid = '{$input}' ";
    $query = $db->connect()->prepare($sql_str);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $result_array = json_decode(json_encode($result), true);
    return $result_array;
}
function GetHujUid($input){
    global $db;
    $query = $db->connect()->prepare("SET NAMES 'utf8'");
    $query->execute();
    $sql_str = "select huj_id, huj_uid from hm_bizneslar where bz_uid  = (select bz_uid from hm_xodimlar where xodim_uid  = '{$input}' ) ";
    $query = $db->connect()->prepare($sql_str);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $result_array = json_decode(json_encode($result), true);
    return $result_array;
}
function GetNewMySqlUID(){
    global $db;
    $sql_str = "select UUID() as uuid";
    $query = $db->connect()->prepare($sql_str);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $result_array = json_decode(json_encode($result), true);
    return $result_array[0]['uuid'];
}
