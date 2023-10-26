<?php 
    $active = 4;
    include("../middleware/header.php");
    html($active);
?>

<style>
    div.container{
        min-height: 80vh;
    }
    div.row{
        min-height: 80vh;
    }
    div.col-md-6{
        min-height: 80vh;
    }
    .custom-shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25), 0 6px 20px rgba(0, 0, 0, 0.19);
    }
    footer{
        height: 10vh;
    }
</style>

<main>
    <div class="container">
        <div class="row">
            <!-- First column with desktop-only image  -->
            <div class="col-md-6 d-none d-md-block">
                <img src="../images/public/register.jpeg" alt="Desktop Image" class="img-fluid h-75  w-100 mt-5">
            </div>
            <!-- Second column with signup card -->
            <div class="col-md-6 d-flex justify-content-center">
                
                <div class="card w-100 my-3 custom-shadow border-0 px-3 py-4"> <!-- Shadow and no border applied to the card -->
                        <h5>Signup</h5>
                        <p>Already have an account <a href="login.php" class="text-success text-decoration-none">Login</a> <!-- Signup link in green color --></p>
                        <div class="card-body bg-white">
                            <form class="needs-validation" id="register" method="post">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" required id="name" name="name"> <!-- Bigger input field -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" required id="email" name="email"> <!-- Bigger input field -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" required id="phone" name="phone"> <!-- Bigger input field -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" required id="country" name="country"> <!-- Bigger input field -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" required id="occupation" name="occupation"> <!-- Bigger input field -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" required id="password" name="password"> <!-- Bigger input field -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="confirm" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" required id="confirm" name="confirm"> <!-- Bigger input field -->
                                </div>
                                <div class="alert alert-danger mb-3 d-none" id="alertDiv">
                                    <p class="alert_text"></p>
                                </div>
                                <input type="hidden" name="page" value="user">
                                <input type="hidden" name="action" value="signup">
                                <button type="submit" class="btn btn-success">Signup</button>
                            </form>
                        </div>
                </div>
                


            </div>

        
        </div>
    </div>
</main>
<script>
    $(document).ready(function(){
        $("#register").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                url: "../controllers/ajax.php",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    if(data.status){
                        location.href = "login.php";
                    }else{
                        $("#alertDiv").removeClass("d-none");
                        $(".alert_text").text(data.msg);
                    }
                }
            })
        })
    })
</script>



<?php include("../middleware/footer.php");?>