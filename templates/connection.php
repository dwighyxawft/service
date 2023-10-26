<?php
$active = 2;
include("../middleware/auth_header.php");
html($active);
?>

<style>
    .card-content {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-content img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .card-buttons {
        display: flex;
        gap: 10px;
    }
    .profile {
        text-decoration: none;
        color: black;
        font-size: 12px;
    }
</style>

<main class="container mt-4">

    <!-- Friend Requests To You Section -->
    <section class="mb-5">
        <h4 class="mb-4">Connection Requests To You</h4>
        <div class="row">
            <!-- Sample User Card -->
            <?php
                $objects->query = "SELECT * FROM connection WHERE (friend_id = '$user_id' AND status = 'pending')";
                $friend_row = $objects->total_rows();
                $friends = $objects->query_all();
                if($friend_row > 0){
                    foreach($friends as $friend){
                        $friend_id = $friend["user_id"];
                        $objects->query = "SELECT * FROM users WHERE id = '$friend_id'";
                        $friend_details = $objects->query_result();
            ?>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <a href="user.php?user_id=<?php echo $friend_details["id"];?>" class="profile">
                                <img src="../images/users/<?php echo $friend_details["image"];?>" alt="User Name">
                                <?php echo $friend_details["name"];?>
                            </a>
                            <div class="card-buttons">
                                <button class="btn btn-success btn-sm accept" data-id="<?php echo $friend_details["id"];?>">Accept</button>
                                <button class="btn btn-danger btn-sm decline" data-id="<?php echo $friend_details["id"];?>">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>


            <?php
                    }
                }else{
            ?>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <h6 class="text-center text-secondary">You have no connection requests</h6>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
   

    <!-- Pending Requests Section -->
    <section class="mb-5">
        <h4 class="mb-4">Pending Connections</h4>
        <div class="row">
        <?php
                $objects->query = "SELECT * FROM connection WHERE (user_id = '$user_id' AND status = 'pending')";
                $friends = $objects->query_all();
                $friend_row = $objects->total_rows();
                if($friend_row > 0){
                foreach($friends as $friend){
                    $friend_id = $friend["friend_id"];
                    $objects->query = "SELECT * FROM users WHERE id = '$friend_id'";
                    $friend_details = $objects->query_result();
            ?>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <a href="user.php?user_id=<?php echo $friend_details["id"];?>" class="profile">
                                <img src="../images/users/<?php echo $friend_details["image"];?>" alt="User Name">
                                <?php echo $friend_details["name"];?>
                            </a>
                            <button class="btn btn-secondary btn-sm cancel" data-id="<?php echo $friend_details["id"];?>">Cancel Request</button>
                        </div>
                    </div>
                </div>


            <?php
                }
            }else{
            ?>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <h6 class="text-center text-secondary">You have no pending requests</h6>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
    
    <!-- New Friends Section -->
    <section class="mb-5">
        <h4 class="mb-4">Make New Connections</h4>
        <div class="row">
        <?php
                $objects->query = "SELECT * FROM users WHERE id != '$user_id'";
                $friends = $objects->query_all();
                foreach($friends as $friend){
                    $friend_id = $friend["id"];
                    $friend_image = $friend["image"];
                    $friend_name = $friend["name"];
                    $objects->query = "SELECT * FROM connection WHERE ((user_id = '$user_id' AND friend_id='$friend_id') OR (user_id = '$friend_id' AND friend_id='$user_id'))";
                    if($objects->total_rows() < 1){
            ?>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <a href="user.php?user_id=<?php echo $friend_id;?>" class="profile">
                                <img src="../images/users/<?php echo $friend_image;?>" alt="User Name">
                                <?php echo $friend_name;?>
                            </a>
                            <button class="btn btn-primary btn-sm connect" data-id="<?php echo $friend_id;?>">New Connection</button>
                        </div>
                    </div>
                </div>


            <?php
                    }
                }
            ?>
        </div>
    </section>
</main>

<script>
    $(document).ready(function(){
        var accepts = document.querySelectorAll(".accept");
        accepts.forEach(function(accept){
            accept.addEventListener("click", function(){
                var friend_id = accept.getAttribute("data-id");
                $.ajax({
                    url: "../controllers/ajax.php",
                    type: "post",
                    data: {friend_id: friend_id, page: "user", action: "accept_friend"},
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            accept.parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
                        }
                    }
                })
            })
        })

        var declines = document.querySelectorAll(".decline");
        declines.forEach(function(decline){
            decline.addEventListener("click", function(){
                var friend_id = decline.getAttribute("data-id");
                $.ajax({
                    url: "../controllers/ajax.php",
                    type: "post",
                    data: {friend_id: friend_id, page: "user", action: "decline_friend"},
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            decline.parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
                        }
                    }
                })
            })
        })

        var cancels = document.querySelectorAll(".cancel");
        cancels.forEach(function(cancel){
            cancel.addEventListener("click", function(){
                var friend_id = cancel.getAttribute("data-id");
                $.ajax({
                    url: "../controllers/ajax.php",
                    type: "post",
                    data: {friend_id: friend_id, page: "user", action: "cancel_request"},
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            cancel.parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
                        }
                    }
                })
            })
        })

        var connects = document.querySelectorAll(".connect");
        connects.forEach(function(connect){
            connect.addEventListener("click", function(){
                var friend_id = connect.getAttribute("data-id");
                $.ajax({
                    url: "../controllers/ajax.php",
                    type: "post",
                    data: {friend_id: friend_id, page: "user", action: "add_friend"},
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            connect.parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
                        }
                    }
                })
            })
        })
    })
</script>

<?php include("../middleware/footer.php");?>
