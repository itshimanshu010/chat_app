<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";

        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        
        $qry = "Select chat_id, conversion_id from chats where (from_id = '$outgoing_id' and to_id = '$incoming_id') or (from_id = '$incoming_id' and to_id = '$outgoing_id') order by chat_id desc limit 1 ";
        $query = mysqli_query($conn, $qry);
        $countRows = mysqli_num_rows($query);

        if($countRows > 0){
            $chat_data = mysqli_fetch_assoc($query);
            $conversion_id = $chat_data['conversion_id'];
        }else{
            $conversion_id = time().rand(0,100000);
        }

        $time = time();

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO chats (conversion_id,to_id, from_id, message,time)
                                        VALUES ({$conversion_id},{$incoming_id}, {$outgoing_id}, '{$message}','{$time}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>