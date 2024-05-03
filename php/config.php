<?php

  define('USER_IMG_ROOT','https://' . $_SERVER["HTTP_HOST"] .'/advocate_app/api/upload/');

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "advocate";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }

  function getUserImagePath($row){
      if(!empty($row['user_pic'])){
        $img_path = USER_IMG_ROOT.$row['user_pic'];
      }else{
        if(isset($row['fb_image']) && $row['fb_image'] != "" && $row['fb_image'] != null){
           $img_path = $row['fb_image'];
        }else{
            $img_path = "php/images/default.png";
        }
      }

      return $img_path;
  }
?>
