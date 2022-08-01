<?php
error_reporting(0);
    session_start();
    include_once "config.php";
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "select * from users where not unique_id = {$outgoing_id} and (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
    if(mysqli_num_rows($sql)>0){
        while ($row = mysqli_fetch_assoc($sql)){
            $query2 = "select * from messages where (incoming_id = {$row['unique_id']} or outgoing_id = {$row['unique_id']}) and (incoming_id = {$outgoing_id} or outgoing_id = {$outgoing_id}) order by msg_id desc limit 1";
            $sql2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($sql2);
            if (mysqli_num_rows($sql2) > 0){
                $result = $row2['message'];
            }
            else{
                $result = "No message available";
            }
            (strlen($result) > 28) ? $msg = substr($result, 0, 28): $msg = $result;
            ($outgoing_id == $row2['outgoing_id']) ? $you = "You: ": $you = "";
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                    <div class="content">
                        <img src="images/'. $row['img'].'" alt="">
                        <div class="details">
                            <span>'.$row['fname']." ".$row['lname'].'</span>
                            <p>'.$you.$msg.'</p>
                        </div>
                    </div>
                    <div class="status-dot '.$offline.'">
                        <i class="fas fa-circle"></i>
                    </div>
                </a>';
        }
    }
    else{
        $output .= "No user found related to your search term";
    }
    echo $output;
?>