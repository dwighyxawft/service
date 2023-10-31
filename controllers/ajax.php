<?php
require("../middleware/objects.php");
$objects = new Objects;

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : false;

if(isset($_POST["page"])){
    if($_POST["page"] == "user"){

        // Registeration controller
        if($_POST["action"] == "signup"){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $gender = $_POST["gender"];
            $country = $_POST["country"];
            $password = $_POST["password"];
            $confirm = $_POST["confirm"];
            $occupation = $_POST["occupation"];
            $image = $gender == "male" ? "male.jpg" : "female.jpg";
            $created_at = date("Y-m-d H:i:s");

            $objects->query = "SELECT * FROM users WHERE email = '$email'";
            if($objects->total_rows() < 1){
                if($password === $confirm){
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $objects->query = "INSERT INTO users (name, email, phone, gender, image, occupation, country, password, created_at) VALUES ('$name', '$email', '$phone', '$gender', '$image', '$occupation', '$country', '$hash', '$created_at')";
                    if($objects->execute_query()){
                        $output = ["status"=>true];
                    }else{
                        $output = ["status"=> false, "msg"=> "Error Saving User Details"];
                    }
                }else{
                    $output = ["status"=> false, "msg"=> "Passwords are not matching."];
                }
            }else{
                $output = ["status"=> false, "msg"=> "This user already exists, Please signup with another email or login"];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "login"){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $objects->query = "SELECT * FROM users WHERE email = '$email'";
            if($objects->total_rows() > 0){
                $account = $objects->query_result();
                if(password_verify($password, $account["password"])){
                    $_SESSION["user_id"] = $account["id"];
                    $objects->query = "UPDATE users SET status = 'online' WHERE id = '$user_id'";
                    if($objects->execute_query()){
                        $output = ["status"=>true];
                    }
                }else{
                    $output = ["status"=>false, "msg"=>"Password is incorrect"];
                }
            }else{
                $output = ["status"=>false, "msg"=>"User does not exist"];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "settings"){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $country = $_POST["country"];
            $occupation = $_POST["occupation"];
            $state = $_POST["state"];
            $address = $_POST["address"];
            $website = $_POST["website"];
            $instagram = $_POST["instagram"];
            $facebook = $_POST["facebook"];
            $whatsapp = $_POST["whatsapp"];
            $twitter = $_POST["twitter"];
            $objects->query = "SELECT * FROM users WHERE id = '$user_id'";
            $user = $objects->query_result();

            if($user["email"] == $email){
                $objects->query = "UPDATE users SET name = '$name', email = '$email', phone='$phone', occupation='$occupation', state='$state', local_address='$address', website='$website', facebook='$facebook', whatsapp='$whatsapp', twitter='$twitter', instagram='$instagram' WHERE id = '$user_id'";
                if($objects->execute_query()){
                    $output = ["status"=>true];
                }else{
                    $output = ["status"=>false, "msg"=>"Error saving user details"];
                }
            }else{
                $objects->query = "SELECT * FROM users WHERE email = '$email'";
                if($objects->total_rows() == 0){
                    $objects->query = "UPDATE users SET name = '$name', email = '$email', phone='$phone', occupation='$occupation', state='$state', local_address='$address', website='$website', facebook='$facebook', whatsapp='$whatsapp', twitter='$twitter', instagram='$instagram' WHERE id = '$user_id'";
                    if($objects->execute_query()){
                        $output = ["status"=>true];
                    }else{
                        $output = ["status"=>false, "msg"=>"Error saving user details"];
                    }
                }else{
                    $output = ["status"=>false, "msg"=>"A user already exists with this email"];
                }
    
            }

           echo json_encode($output);
        }

        if($_POST["action"] == "password"){
            $objects->query = "SELECT * FROM users WHERE id = '$user_id'";
            if($objects->total_rows() > 0){
                $account = $objects->query_result();
                $old_pass = $_POST["old_pass"];
                $new_pass = $_POST["new_pass"];
                $con_pass = $_POST["con_pass"];
                if(password_verify($old_pass, $account["password"])){
                    if($new_pass == $con_pass){
                        $hash = password_hash($new_pass, PASSWORD_DEFAULT);
                        $objects->query = "UPDATE users SET password = '$hash' WHERE id = '$user_id'";
                        if($objects->execute_query()){
                            $output = ["status"=>true];
                        }
                    }else{
                        $output = ["status"=>false, "msg"=>"Passwords are not matching"];
                    }
                }else{
                    $output = ["status"=>false, "msg"=>"Password is incorrect"];
                }
            }else{
                $output = ["status"=>false, "msg"=>"User does not exist"];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "post"){
            $post = $_POST["textCaption"];
            $objects->query = "INSERT INTO posts (user_id, comment) VALUES ('$user_id', '$post')";
            if($objects->execute_query()){
                $output = ["status"=>true];
            }else{
                $output = ["status"=>false, "msg"=>"Your post was not uploaded successful"];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "like"){
            $post_id = $_POST["post_id"];
            $objects->query = "SELECT * FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
            if($objects->total_rows() < 1){
                $objects->query = "INSERT INTO likes (user_id, post_id) VALUES ('$user_id', '$post_id')";
                if($objects->execute_query()){
                    $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                    $likes = $objects->total_rows();
                    $output = ["status"=>true, "likes"=>$likes];
                }
            }else{
                $objects->query = "DELETE FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
                if($objects->execute_query()){
                    $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                    $likes = $objects->total_rows();
                    $output = ["status"=>false, "likes"=>$likes];
                }
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "share"){
            $post_id = $_POST["post_id"];
            $objects->query = "SELECT * FROM posts WHERE id = '$post_id'";
            $post = $objects->query_result();
            if($user_id != $post["user_id"]){
                $comment = $post["comment"];
                $image = $post["image"];
                $video = $post["video"];
                $ref_id = $post["user_id"];
                $objects->query = "SELECT * FROM posts WHERE post_id = '$post_id' AND (user_id = '$user_id' AND ref_id = '$ref_id')";
                if($objects->total_rows() < 1){
                    $objects->query = "INSERT INTO posts (post_id, user_id, ref_id, comment, video, image) VALUES ('$post_id' ,'$user_id', '$ref_id', '$comment', '$video', '$image')";
                    if($objects->execute_query()){
                        $objects->query = "SELECT * FROM posts WHERE ref_id = '$ref_id' AND post_id='$post_id'";
                        $total_shares = $objects->total_rows();
                        $output = ["status"=>true, "shares"=>$total_shares];
                    }
                }else{
                    $output = ["status"=>false, "msg"=>"You have shared this post"];
                }
            }else{
                $output = ["status"=>false, "msg"=>"You cannot share your posts"];
            }

            echo json_encode($output);
        }

        if($_POST["action"] == "accept_friend"){
            $friend_id = $_POST["friend_id"];
            $objects->query = "UPDATE connection SET status = 'accepted' WHERE (user_id = '$friend_id' AND friend_id = '$user_id')";
            if($objects->execute_query()){
                $output = ["status"=>true];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "decline_friend"){
            $friend_id = $_POST["friend_id"];
            $objects->query = "DELETE FROM connection WHERE (user_id = '$friend_id' AND friend_id = '$user_id')";
            if($objects->execute_query()){
                $output = ["status"=>true];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "cancel_request"){
            $friend_id = $_POST["friend_id"];
            $objects->query = "DELETE FROM connection WHERE (user_id = '$user_id' AND friend_id = '$friend_id') AND status = 'pending'";
            if($objects->execute_query()){
                $output = ["status"=>true];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "add_friend"){
            $friend_id = $_POST["friend_id"];
            $objects->query = "INSERT INTO connection (user_id, friend_id, status) VALUES ('$user_id', '$friend_id', 'pending')";
            if($objects->execute_query()){
                $output = ["status"=>true];
            }
            echo json_encode($output);
        }

        if($_POST["action"] == "message"){
            $content = $_POST["content"];
            $friend = $_POST["friend"];
            $objects->query = "INSERT INTO messages (sender_id, receiver_id, content) VALUES ('$user_id', '$friend', '$content')";
            if($objects->execute_query()){
                $output = ["status"=>true];
            }
            echo json_encode($output);
        }
    }
}








?>