<?php
    error_reporting(0);
    session_start();
    if (isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $query = "select * from messages left join users on users.unique_id = messages.incoming_id where (outgoing_id = {$outgoing_id} and incoming_id = {$incoming_id}) or (outgoing_id = {$incoming_id} and incoming_id = {$outgoing_id}) order by msg_id";
        $sql = mysqli_query($conn, $query);
        if (mysqli_num_rows($sql) > 0){
            while ($row = mysqli_fetch_assoc($sql)){
                if ($row['outgoing_id'] == $outgoing_id){
                    $output .= '<div class="chat out">
                    <div class="details">
                        <p>'.$row['message'].'<br><span>'.$row['create_dt'].'</span></p>
                    </div>
                </div>';
                }
                else{
                    $output .= '<div class="chat in">
                    <img src="images/'.$row['img'].'" alt="">
                    <div class="details">
                        <p>'.$row['message'].'<br><span>'.$row['create_dt'].'</span></p>
                    </div>
                </div>';
                }
            }
            echo $output;
        }
    }
    else{
        header("location: ../login.php");
    }
