<?php
    error_reporting(0);
    session_start();
    include_once "config.php";
    if (isset($_SESSION['unique_id'])){
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if (!empty($message)){
            $sql = mysqli_query($conn, "insert into messages (outgoing_id, incoming_id, message) values ({$outgoing_id}, {$incoming_id}, '{$message}')") or die();
        }
    }
    else{
        header("location: ../login.php");
    }