<?php
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM chats WHERE (from_id = {$row['id']}
                OR to_id = {$row['id']}) AND (to_id = {$outgoing_id} 
                OR from_id = {$outgoing_id}) ORDER BY time DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['message'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        (($row['chat_status'] == "Offline now") || ($row['chat_status'] == "")) ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="users.php?user_id='. $row['id'] .'">
                    <div class="content">
                    <img src="php/images/default.png" alt="">
                    <div class="details">
                        <span>'. $row['name'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>