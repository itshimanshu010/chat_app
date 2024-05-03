<?php
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM chats WHERE (from_id = {$row['id']}
                OR to_id = {$row['id']}) AND (to_id = {$outgoing_id} 
                OR from_id = {$outgoing_id}) ORDER BY chat_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['message'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['from_id'])){
            ($outgoing_id == $row2['from_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        (($row['chat_status'] == "Offline now") || ($row['chat_status'] == "")) ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";
        $img_path = getUserImagePath($row);
        if(isset($_REQUEST['incoming_id'])){
            $active_chat = ($_REQUEST['incoming_id'] == $row['id']) ? 'active_chat_list' : '';
        }else{
            $active_chat = "";
        }
        

        $output .= '<a class="chat_list '.$active_chat.'" href="users.php?user_id='. $row['id'] .'">
                    <div class="content">
                    <img src="'.$img_path.'" alt="">
                    <div class="details">
                        <span>'. $row['name'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>