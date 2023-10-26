<?php
require("../middleware/objects.php");
$objects = new Objects;

$user_id = $_SESSION["user_id"];
$file = $_FILES["postFile"]["name"];
$tmp_name = $_FILES["postFile"]["tmp_name"];
$caption = $_POST["postCaption"];
$ext = pathinfo($file, PATHINFO_EXTENSION);
$arr_img = ["jpg", "jpeg", "png", "jfif", "JFIF", "JPEG", "JPG", "PNG"];
$arr_vid = ["mkv", "avi", "mp4", "MKV", "AVI", "MP4"];

if(in_array($ext, $arr_img)){
    if(move_uploaded_file($tmp_name, "../images/posts/$file")){
        $objects->query = "INSERT INTO posts (user_id, comment, image) VALUES ('$user_id', '$caption', '$file')";
        if($objects->execute_query()){
            echo '<script> alert("Your post was uploaded successfully")</script>';
            echo $objects->redirect("templates/dashboard.php");
        }
    }
}elseif(in_array($ext, $arr_vid)){
    if(move_uploaded_file($tmp_name, "../videos/posts/$file")){
        $objects->query = "INSERT INTO posts (user_id, comment, video) VALUES ('$user_id', '$caption', '$file')";
        if($objects->execute_query()){
            echo '<script> alert("Your post was uploaded successfully")</script>';
            echo $objects->redirect("templates/dashboard.php");
        }
    }
}

?>