<?php

// mashinalarni ko'rish uchun
$query = $db->connect()->prepare("SET NAMES 'utf8'");
$query->execute();
$sql_str = "select *, (select shop_ismi from hm_shopirlar where shop_uid=hm_moshinalar.shopir_uid) as shop_ismi 
                    , (select shop_kontakt from hm_shopirlar where shop_uid=hm_moshinalar.shopir_uid) as shop_kontakt
                    , (select shop_izoh from hm_shopirlar where shop_uid=hm_moshinalar.shopir_uid) as shop_izoh from hm_moshinalar";
$query = $db->connect()->prepare($sql_str);
$status = $query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$rowCnt = count($result);
$result_array = json_decode(json_encode($result), true);
$response = $result_array;
echo json_encode($response);