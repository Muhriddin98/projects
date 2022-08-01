<?php
    function connectSql(){
        global $config;
        $db = new mysqli($config['db']['host'], $config['db']['username'], $config['db']['password']) or  die($db->error);
        $db->query("SET NAMES utf8");
        return $db;
    }

    function createDB($dbname){
        $db = connectSql();
        $sql = $db->query("
                CREATE DATABASE {$dbname}
            ");
        if ($sql)
            return true;
        return false;
    }

    function connectDB($dbname){
        global $config;
        $db = new mysqli($config['db']['host'], $config['db']['username'], $config['db']['password'], $dbname) or  die($db->error);
        $db->query("SET NAMES utf8");
        return $db;
    }

    function dropDB($dbname){
        $db = connectSql();
        $sql = $db->query("
            DROP DATABASE {$dbname}
        ");
        if ($sql)
            return true;
        return false;
    }

?>