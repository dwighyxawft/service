<?php
$active = 0;
include("../middleware/auth_header.php");
html($active);
$user_id = $_GET["user_id"];
$objects->query = "SELECT * FROM users WHERE id = '$user_id'";
$user = $objects->query_result();
$objects->query = "SELECT * FROM posts WHERE user_id = '$user_id'";
$posts = $objects->query_all();
?>

<style>

        .profile {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .profile .card:hover {
            transform: scale(1.05);
        }

        .profile .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            max-height: 200px;
        }

        .card-title {
            color: #333;
            font-weight: bold;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .profile .card-body {
            background-color: #f9f9f9;
            padding: 20px;
        }

        .profile .card-section {
            padding: 10px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .profile .card-section:last-child {
            border-bottom: none;
        }

        .profile .social-links a {
            margin-right: 10px;
            font-size: 1.5em;
        }

    .posts{
        width: 90%;
        margin: auto
    }

    @media screen and (max-width: 768px) {
        .posts{
            width: 90%;
        }
    }
    /* Images & Videos Container Styles */
        .images img, .videos video {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    /* Card Design */
        .posts .card {
            transition: transform 0.2s;
            border-radius: 10px;
            overflow: hidden;
        }

        .posts .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .posts .card img, .posts .card video {
            width: 100%;
            object-fit: cover;
        }

        .posts .card-body {
            background-color: #f4f4f4;
        }

        .user {
            font-size: 10px;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .user:hover {
            text-decoration: underline;
        }

        .posts .btn {
            margin-right: 5px;
        }

        .posts .btn i {
            margin-right: 3px;
        }

</style>

<main>
    <!-- Profile Details Card -->
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card shadow-lg profile mt-3">
                <center><img src="../images/users/<?php echo $user["image"] ;?>" class="rounded-circle" width="300" height="300" alt="Profile Image"></center>
                <div class="card-body">
                    <div class="card-section">
                        <h4 class="card-title text-center"><?php echo $user["name"] ;?></h4>
                    </div>
                    <div class="card-section">
                        <p class="pb-1"><strong>Occupation:</strong> <?php echo $user["occupation"] ;?></p>
                        <p class="pb-1"><strong>Email:</strong> <?php echo $user["email"] ;?></p>
                        <p class="pb-1"><strong>Phone:</strong> <?php echo $user["phone"] ;?></p>
                    </div>
                    <div class="card-section">
                    <?php if(!empty($user["website"])){ ?>
                        <strong>Website:</strong> <a href="<?php echo $user["website"] ;?>" target="_blank">Website</a>
                        <?php }?>
                    </div>
                    <div class="card-section social-links text-center">
                        <?php if(!empty($user["facebook"])){ ?>
                            <a href="#" target="_blank" class="text-primary pe-4">
                                <i class="fa fa-facebook-f"></i>
                            </a>
                        <?php }?>
                        <?php if(!empty($user["twitter"])){ ?>
                            <a href="#" target="_blank" class="text-info pe-4">
                                <i class="fa fa-twitter"></i>
                            </a>
                        <?php }?>
                        <?php if(!empty($user["instagram"])){ ?>
                            <a href="#" target="_blank" class="text-danger pe-4">
                                <i class="fa fa-instagram"></i>
                            </a>
                        <?php }?>
                        <?php if(!empty($user["whatsapp"])){ ?>
                            <a href="#" target="_blank" class="text-success pe-4">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>            
            <!-- User Posts Container -->
            <div class="posts my-4 text-center">
                <div class="posts">

                    <?php 
                        foreach($posts as $post){
                            $post_user = $post["user_id"];
                            $post_id = $post["id"];
                            $objects->query = "SELECT * FROM users WHERE id = '$post_user'";
                            $post_user_details = $objects->query_result();
                            if(!empty($post["comment"]) && empty($post["image"]) && empty($post["video"])){ ?>
                                <!-- Text Post Card -->
                                <div class="card mb-4 shadow-sm" style="background-color: white;">
                                    <div class="card-body">
                                        <a href="user.php?user_id=<?php echo $post_user_details["id"]; ?>" class="profile"><b><?php echo $post_user_details["name"]; ?></b></a>
                                        <p><?php echo $post["comment"]; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <?php
                                            $objects->query = "SELECT * FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
                                            $liked = $objects->total_rows();
                                            $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                                            $likes = $objects->total_rows();
                                            $objects->query = "SELECT * FROM posts WHERE ref_id = '$post_user' AND post_id = '$post_id'";
                                            $shares = $objects->total_rows();
                                            if($liked > 0){
                                                echo '<button class="btn btn-primary like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }else{
                                                echo '<button class="btn btn-default like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }
                                        ?>
                                    </div>
                                </div>



                    <?php
                            }elseif(empty($post["comment"]) && !empty($post["image"]) && empty($post["video"])){ ?>
                                <!-- Image Post Card -->
                                <div class="card mb-4 shadow-sm" style="background-color: white;">
                                    <div class="card-body">
                                    <a href="user.php?user_id=<?php echo $post_user_details["id"]; ?>" class="profile"><b><?php echo $post_user_details["name"]; ?></b></a>
                                        <img src="../images/posts/<?php echo $post["image"]; ?>" class="img-fluid d-block" alt="Sample Image">
                                    </div>
                                    <div class="card-footer">
                                        <?php
                                            $objects->query = "SELECT * FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
                                            $liked = $objects->total_rows();
                                            $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                                            $likes = $objects->total_rows();
                                            $objects->query = "SELECT * FROM posts WHERE ref_id = '$post_user' AND post_id = '$post_id'";
                                            $shares = $objects->total_rows();
                                            if($liked > 0){
                                                echo '<button class="btn btn-primary like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }else{
                                                echo '<button class="btn btn-default like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }
                                        ?>
                                    </div>
                                </div>
                        
                        
                        
                        
                    <?php
                        }elseif(empty($post["comment"]) && empty($post["image"]) && !empty($post["video"])){ ?>
                            <!-- Video Post Card -->
                            <div class="card mb-4 shadow-sm" style="background-color: white;">
                                <div class="card-body">
                                <a href="user.php?user_id=<?php echo $post_user_details["id"]; ?>" class="profile"><b><?php echo $post_user_details["name"]; ?></b></a>
                                    <video width="100%" controls>
                                        <source src="../videos/posts/<?php echo $post["video"]; ?>" type="video/mp4">
                                    </video>
                                </div>
                                <div class="card-footer">
                                        <?php
                                            $objects->query = "SELECT * FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
                                            $liked = $objects->total_rows();
                                            $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                                            $likes = $objects->total_rows();
                                            $objects->query = "SELECT * FROM posts WHERE ref_id = '$post_user' AND post_id = '$post_id'";
                                            $shares = $objects->total_rows();
                                            if($liked > 0){
                                                echo '<button class="btn btn-primary like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }else{
                                                echo '<button class="btn btn-default like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }
                                        ?>
                                </div>
                            </div>



                    <?php
                        }elseif(!empty($post["comment"]) && !empty($post["image"]) && empty($post["video"])){ ?>

                        <!-- Image and Text Card -->
                        <div class="card mb-4 shadow-sm" style="background-color: white;">
                            <div class="card-body">
                            <a href="user.php?user_id=<?php echo $post_user_details["id"]; ?>" class="profile"><b><?php echo $post_user_details["name"]; ?></b></a>
                                <img src="../images/posts/<?php echo $post["image"]; ?>" class="img-fluid d-block" alt="Sample Image">
                                <p class="mt-3"><?php echo $post["comment"]; ?></p>
                            </div>
                            <div class="card-footer">
                                        <?php
                                            $objects->query = "SELECT * FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
                                            $liked = $objects->total_rows();
                                            $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                                            $likes = $objects->total_rows();
                                            $objects->query = "SELECT * FROM posts WHERE ref_id = '$post_user' AND post_id = '$post_id'";
                                            $shares = $objects->total_rows();
                                            if($liked > 0){
                                                echo '<button class="btn btn-primary like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }else{
                                                echo '<button class="btn btn-default like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }
                                        ?>
                            </div>
                        </div>


                    <?php

                        }elseif(!empty($post["comment"]) && empty($post["image"]) && !empty($post["video"])){ ?>

                            <!-- Video and Text Card -->
                            <div class="card mb-4 shadow-sm" style="background-color: white;">
                                <div class="card-body">
                                <a href="user.php?user_id=<?php echo $post_user_details["id"]; ?>" class="profile"><b><?php echo $post_user_details["name"]; ?></b></a>
                                    <p class="mt-2"><?php echo $post["comment"]; ?></p> <!-- Added example text based on usual bootstrap cards for context -->
                                    <video width="100%" controls>
                                        <source src="../videos/posts/<?php echo $post["video"]; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="card-footer">
                                        <?php
                                            $objects->query = "SELECT * FROM likes WHERE (user_id = '$user_id' AND post_id = '$post_id')";
                                            $liked = $objects->total_rows();
                                            $objects->query = "SELECT * FROM likes WHERE post_id = '$post_id'";
                                            $likes = $objects->total_rows();
                                            $objects->query = "SELECT * FROM posts WHERE ref_id = '$post_user' AND post_id = '$post_id'";
                                            $shares = $objects->total_rows();
                                            if($liked > 0){
                                                echo '<button class="btn btn-primary like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }else{
                                                echo '<button class="btn btn-default like" data-like="'.$post_id.'"><i class="fa fa-thumbs-up"></i> '.$likes.'</button>
                                                <button class="btn btn-secondary share" data-share="'.$post_id.'"><i class="fa fa-share-alt"></i> '.$shares.'</button>';
                                            }
                                        ?>
                                </div>
                            </div>



                    <?php
                        }
                    }
                    ?>


                    </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</main>

<script>
    $(document).ready(function(){
        var likes = document.querySelectorAll(".like");
        likes.forEach(function(like){
            like.addEventListener("click", function(){
                var post_id = like.getAttribute("data-like");
                $.ajax({
                    url: "../controllers/ajax.php",
                    type: "post",
                    data: {post_id: post_id, page: "user", action: "like"},
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            like.classList.remove("btn-default");
                            like.classList.add("btn-primary");
                            like.innerHTML = `<i class="fa fa-thumbs-up"></i> ${data.likes}`;
                        }else{
                            like.classList.remove("btn-primary");
                            like.classList.add("btn-default");
                            like.innerHTML = `<i class="fa fa-thumbs-up"></i> ${data.likes}`;
                        }
                    }
                })
            })
        })
        var shares = document.querySelectorAll(".share");
        shares.forEach(function(share){
            share.addEventListener("click", function(){
                var post_id = share.getAttribute("data-share");
                $.ajax({
                    url: "../controllers/ajax.php",
                    type: "post",
                    data: {post_id: post_id, page: "user", action: "share"},
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            share.innerHTML = `<i class="fa fa-thumbs-up"></i> ${data.shares}`;
                        }else{
                            alert(data.msg);
                        }
                    }
                })
            })
        })
    })
</script>


<?php include("../middleware/footer.php");?>
