<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM chats LEFT JOIN kn_users ON kn_users.id = chats.from_id
                WHERE (from_id = {$outgoing_id} AND to_id = {$incoming_id})
                OR (from_id = {$incoming_id} AND to_id = {$outgoing_id}) ORDER BY chats.chat_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                
                if($row['from_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p class="orange_background">'. $row['message'] .'</p>
                                </div>
                                </div>';
                }else{
                    $img_path = getUserImagePath($row);
                    $output .= '<div class="chat incoming">
                                <img src="'.$img_path.'" alt="">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>