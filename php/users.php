<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    
    $sql = "SELECT DISTINCT kn_users.id, kn_users.name,kn_users.user_pic,kn_users.fb_image, kn_users.chat_status 
        FROM kn_users
        INNER JOIN (
            SELECT IF(chats.from_id = {$outgoing_id}, chats.to_id, chats.from_id) AS user_id
            FROM chats
            WHERE chats.from_id = {$outgoing_id} OR chats.to_id = {$outgoing_id}
        ) AS chat_users ON kn_users.id = chat_users.user_id
        WHERE kn_users.id <> {$outgoing_id} AND kn_users.user_type <> '2'
        ORDER BY kn_users.name";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>