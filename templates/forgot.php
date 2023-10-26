<?php 
    $active = 0;
    include("../middleware/header.php");
    html($active);
?>
<style>
    div.container{
        height: 80vh;
    }
    div.row{
        height: 80vh;
    }
    div.col-md-6{
        height: 80vh;
    }
    .custom-shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25), 0 6px 20px rgba(0, 0, 0, 0.19);
    }

</style>
<main>
    <div class="container">
        <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <div class="card mt-5 custom-shadow border-0 px-3 py-4"> <!-- Shadow and no border applied to the card -->
                        <h5 class="card-title text-center">Forgot Password</h5>
                        <p class="card-text text-center">Enter your email address below and we'll send you instructions to reset your password.</p>
                        <div class="card-body bg-white">
                            <form>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control form-control-lg" id="email" aria-describedby="emailHelp"> <!-- Bigger input field -->
                                </div>
                                <button type="submit" class="btn btn-success">Send Instructions</button>
                            </form>
                        </div>
                </div>
                </div>
                <div class="col-md-4"></div>
        </div>
    </div>

</main>



<?php include("../middleware/footer.php");?>