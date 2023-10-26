<?php
$active = 1;
include("../middleware/auth_header.php");
$user_id = $_SESSION["user_id"];
html($active);
$objects->query = "SELECT * FROM posts";
$posts = $objects->query_all();
?>
<style>
    /* To make the content inside the "posts" div scrollable */
    .col-md-8 {
        height: 80vh;
        overflow-y: scroll;
        scrollbar-width: none;  /* For Firefox */
        -ms-overflow-style: none;  /* For Internet Explorer and Edge */
    }

    .posts{
        width: 60%;
    }

    .col-md-8::-webkit-scrollbar {
        display: none; /* For Chrome, Safari and Opera */
    }

    .btn.d-block {
        width: 100%;
    }
    .profile{
        text-decoration: none;
        font-size: 10px;
    }

    @media screen and (max-width: 768px) {
        .posts{
            width: 90%;
        }
        .desktop-cards{
            display: none;
        }
    }
</style>
<main>

<!-- Main Content -->
<div class="container">
    <div class="row">

        <!-- Left Sidebar - col-md-4 -->
        <div class="col-md-4">

            <!-- Create Post & Uploads Card -->
            <div class="card mb-3 desktop-cards">
                <div class="card-body">
                    <!-- Buttons triggering modals -->
                    <button type="button" class="btn btn-primary d-block mb-2" data-bs-toggle="modal" data-bs-target="#createPostModal">Create Post</button>
                    <button type="button" class="btn btn-secondary d-block mb-2" data-bs-toggle="modal" data-bs-target="#uploadImageModal">Upload Image</button>
                    <button type="button" class="btn btn-success d-block mb-2" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">Upload Video</button>
                    <button type="button" class="btn btn-warning d-block" data-bs-toggle="modal" data-bs-target="#uploadTextModal">Text Post</button>
                </div>
            </div>

            <!-- Additional Information Card -->
            <div class="card desktop-cards">
                <div class="card-header">
                    About Our Platform
                </div>
                <div class="card-body">
                    <p>Here you can create posts, share images, videos, and connect with your community.</p>
                </div>
                <div class="card-footer">
                    Stay connected, stay informed!
                </div>
            </div>
            <!-- Responsive Buttons for Mobile View -->
            <div class="d-md-none d-flex justify-content-between my-4 mx-4">
                <!-- Create Post Button -->
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createPostModal">
                    <i class="fa fa-plus"></i>
                </button>
                <!-- Text Post Button -->
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadTextModal">
                    <i class="fa fa-pencil-square-o"></i>
                </button>
                <!-- Upload Image Button -->
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                    <i class="fa fa-picture-o"></i>
                </button>
                <!-- Upload Video Button -->
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">
                    <i class="fa fa-video-camera"></i>
                </button>
            </div>

        </div>

        <!-- Main Content - col-md-8 -->
        <div class="col-md-8 d-flex justify-content-center py-4">
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
</div>


<div class="modals">
    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: rgba(135, 211, 124, 0.7);">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="path-to-brand-image.jpg" alt="Brand Image" width="30" height="30" class="d-inline-block align-top">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <h5 class="modal-title text-center text-success py-2" id="createPostModalLabel">Create Post</h5>
                    <form class="needs-validation" method="post" enctype="multipart/form-data" action="../controllers/create_post.php">
                        <div class="form-group mb-3">
                            <label for="postFile">File</label><br>
                            <input type="file" class="form-control" name="postFile" id="postFile">
                        </div>
                        <div class="form-group mb-3">
                            <label for="postCaption">Caption</label>
                            <textarea class="form-control" id="postCaption" name="postCaption" rows="3"></textarea>
                        </div>
                        <center><button type="submit" class="btn btn-success btn-sm">Submit</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Image Modal -->
    <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: rgba(135, 211, 124, 0.7);">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="path-to-brand-image.jpg" alt="Brand Image" width="30" height="30" class="d-inline-block align-top">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/post_image.php" method="post" enctype="multipart/form-data">
                        <h5 class="text-center text-success">Post Image</h5>
                        <div class="input-group">
                            <input type="file" class="form-control" name="imageFile" id="imageFile" accept="image/*">
                            <button type="submit" class="btn btn-success">Upload</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Video Modal -->
    <div class="modal fade" id="uploadVideoModal" tabindex="-1" role="dialog" aria-labelledby="uploadVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: rgba(135, 211, 124, 0.7);">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="path-to-brand-image.jpg" alt="Brand Image" width="30" height="30" class="d-inline-block align-top">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center text-success">Post Video</h5>
                    <form action="../controllers/post_video.php" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="file" class="form-control" name="videoFile" id="videoFile" accept="video/*">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Text Post Modal -->
    <div class="modal fade" id="uploadTextModal" tabindex="-1" role="dialog" aria-labelledby="uploadTextModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: rgba(135, 211, 124, 0.7);">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="path-to-brand-image.jpg" alt="Brand Image" width="30" height="30" class="d-inline-block align-top">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center text-success">Post your thoughts</h5>
                    <form class="needs-validation" method="post" id="post_text">
                        <div class="form-group">
                            <label for="textCaption">Caption</label>
                            <textarea class="form-control" id="textCaption" name="textCaption" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="page" value="user">
                        <input type="hidden" name="action" value="post">
                        <center><button type="submit" class="btn btn-success mt-3">Post</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Modals (Create Post, Upload Image, Upload Video, Text Post) would be added here -->

</main>

<script>
    $(document).ready(function(){
        $("#post_text").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                url: "../controllers/ajax.php",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    if(data.status){
                        alert("You have uploaded a text post");
                    }else{
                       alert(data.msg);
                    }
                }
            })
        })
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