<?php
error_reporting(0);
    session_start();
    if (isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if (isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($conn, "update users set status = '{$status}' where unique_id = {$logout_id}");
            if ($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }
        else {
            header("location: ../users.php");
        }
    }
    else{
        header("location: ../login.php");
    }
    ?>