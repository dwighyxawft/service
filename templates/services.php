<?php 
    $active = 0;
    include("../middleware/header.php");
    html($active);
    require("../middleware/objects.php");
    $objects = new Objects;
    $objects->query = "SELECT * FROM users";
    $users = $objects->query_all();
?>
<style>
    @media screen and (max-width: 768px) {
        .card{
            width: 70%;
            margin: auto;
        }
    }
</style>
<main class="container mt-4">

    <!-- User Cards -->
    <div class="row my-4">
        <!-- The loop starts here (this will be repeated 12 times) -->
        <?php 
            $objects->query = "SELECT * FROM users";
            $users = $objects->query_all();
            foreach($users as $user){
        ?>
            <div class="col-md-3 mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img src="../images/users/<?php echo $user["image"]; ?>" alt="User Image" class="rounded-circle mb-2" width="100" height="100">
                        <h5 class="card-title"><?php echo $user["name"]; ?></h5>
                        <p class="card-text"><?php echo $user["email"]; ?></p>
                        <p class="card-text"><b><?php echo $user["occupation"]; ?></b></p>
                        <a href="check_user.php?user_id=<?php echo $user["id"]; ?>" class="btn btn-success">View Profile</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- The loop ends here -->
        
        <!-- ... Repeat the above div block for other 11 user cards ... -->
    </div>
</main>




<?php include("../middleware/footer.php");?>