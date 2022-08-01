<?php
    include 'config.php';
    include 'libs.php';
    $dbname = $_POST['dbname'];
    $tbname = $_POST['tbname'];
    $count = $_POST['count'];
    $name = [];
    $type = [];
    $length = [];
    $attr = [];
    $null = [];
    $index = [];
    $auto = [];

    $db = connectSql();

    $query = "CREATE TABLE {$dbname}.{$tbname}(";
    for ($i=1; $i<=$count; $i++){
        $name[$i] = $_POST['name'.$i] ?? null;
        $type[$i] = $_POST['type'.$i] ?? null;
        $length[$i] = !empty($_POST['length'.$i]) ? "(".$_POST['length'.$i].")" : null;
        $attr[$i] = $_POST['attr'.$i] ?? null;
        $null[$i] = $_POST['null'.$i] ?? null;
        $index[$i] = $_POST['index'.$i] ?? null;
        $auto[$i] = $_POST['auto'.$i] ?? null;
        $query .= $name[$i].' '.$type[$i].$length[$i].' '.$attr[$i].' '.$null[$i].' '.$auto[$i].' '.$index[$i];
        if ($name[$i]) $query .=',';
    }
    $query = rtrim($query, ',');
    $query .= ")ENGINE=InnoDB DEFAULT CHARSET=utf8";

    if ($db->query($query)){
        echo 'true';
    }
    else{
        echo 'false';
    }
 ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <title>Insert</title>
</head>
<body>


</body>
</html>