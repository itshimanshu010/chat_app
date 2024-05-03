<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $appoint_data = mysqli_query($conn,"select user_id from appoint_lawyer where lawyer_id = {$outgoing_id}");
    $ids_array = [];
    while($array = mysqli_fetch_assoc($appoint_data)){
        array_push($ids_array,$array['user_id']);
    }

    $ids = implode(',',$ids_array);
    $sql = "SELECT * FROM kn_users WHERE NOT id = {$outgoing_id} AND id IN ($ids) AND user_type <> '2' AND (name LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>