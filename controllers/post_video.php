<?php
require("../middleware/objects.php");
$objects = new Objects;

$user_id = $_SESSION["user_id"];
$video = $_FILES["videoFile"]["name"];
$tmp_name = $_FILES["videoFile"]["tmp_name"];
$ext = pathinfo($video, PATHINFO_EXTENSION);
$arr = ["mkv", "avi", "mp4", "MKV", "AVI", "MP4"];

if(in_array($ext, $arr)){
    if(move_uploaded_file($tmp_name, "../videos/posts/$video")){
        $objects->query = "INSERT INTO posts (user_id, video) VALUES ('$user_id', '$video')";
        if($objects->execute_query()){
            echo '<script> alert("You have uploaded a video")</script>';
            echo $objects->redirect("templates/dashboard.php");
        }
    }
}

?>