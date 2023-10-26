<?php
require("../middleware/objects.php");
$objects = new Objects;

$user_id = $_SESSION["user_id"];
$image = $_FILES["imageFile"]["name"];
$tmp_name = $_FILES["imageFile"]["tmp_name"];
$ext = pathinfo($image, PATHINFO_EXTENSION);
$arr = ["jpg", "jpeg", "png", "JPEG", "JPG", "PNG"];

if(in_array($ext, $arr)){
    if(move_uploaded_file($tmp_name, "../images/posts/$image")){
        $objects->query = "INSERT INTO posts (user_id, image) VALUES ('$user_id', '$image')";
        if($objects->execute_query()){
            echo '<script> alert("You have uploaded an image")</script>';
            echo $objects->redirect("templates/dashboard.php");
        }
    }
}

?>