<?php
$active = 5;
include("../middleware/auth_header.php");
html($active);
?>

<style>
        .settings-container {
            max-width: 800px;
            margin: auto;
        }

        label {
            font-weight: bold;
        }

        .input-group-text {
            width: 150px;
        }
    </style>

<main class="mt-4">
   <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="settings-container">
                <h5 class="mt-3">Edit and Update Personal Information</h5>
                <form class="needs-validation" id="information" method="post">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="<?php echo $user["name"]; ?>">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="<?php echo $user["email"]; ?>">
                    </div>

                    <!-- assuming you meant phone and not "hone" -->
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" value="<?php echo $user["phone"]; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="occupation">Occupation</label>
                        <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Enter your occupation" value="<?php echo $user["occupation"]; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" id="country" placeholder="Enter your country" value="<?php echo $user["country"]; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" name="state" id="state" placeholder="Enter your state" value="<?php echo $user["state"]; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="localAddress">Local Address</label>
                        <textarea class="form-control" id="localAddress" name="address" rows="2" placeholder="Enter your local address"><?php echo $user["local_address"]; ?></textarea>
                    </div>

                    <!-- Link Inputs with Icons (can be adjusted for each) -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Website</span>
                        </div>
                        <input type="url" name="website" class="form-control" placeholder="https://example.com" value="<?php echo $user["website"]; ?>">
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Instagram</span>
                        </div>
                        <input type="url" name="instagram" class="form-control" placeholder="https://instagram.com/username" value="<?php echo $user["instagram"]; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Facebook</span>
                        </div>
                        <input type="url" name="facebook" class="form-control" placeholder="https://facebook.com/username" value="<?php echo $user["facebook"]; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Twitter</span>
                        </div>
                        <input type="url" name="twitter" class="form-control" placeholder="https://twitter.com/username" value="<?php echo $user["twitter"]; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Whatsapp</span>
                        </div>
                        <input type="url" name="whatsapp" class="form-control" placeholder="https://wa.me/phone" value="<?php echo $user["whatsapp"]; ?>">
                    </div>
                    <div class="alert alert-success mb-3 d-none" id="information-success"></div>
                    <div class="alert alert-danger mb-3 d-none" id="information-danger"></div>
                    <input type="hidden" name="page" value="user">
                    <input type="hidden" name="action" value="settings">

                    <center><button type="submit" class="btn btn-success btn-block mb-4">Save Changes</button></center>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="settings-container px-3">
                <form action="../controllers/image.php" method="post" enctype="multipart/form-data">
                    <h5 class="mt-3">Change Profile Picture</h5>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="profileImage" id="profileImage" accept="image/*">
                        <button type="submit" class="btn btn-success">Change Profile</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card my-4 px-5 pt-3">
            <form id="password" class="needs-validation" method="post">
                <h5>Change Password</h5>
                <div class="form-group mb-3">
                    <label for="old_pass">Old Password</label>
                    <input type="password" class="form-control" name="old_pass">
                </div>
                <div class="form-group mb-3">
                    <label for="new_pass">New Password</label>
                    <input type="password" class="form-control" name="new_pass">
                </div>
                <div class="form-group mb-3">
                    <label for="con_pass">Confirm Password</label>
                    <input type="password" class="form-control" name="con_pass">
                </div>
                <div class="alert alert-success mb-3 d-none" id="password-success"></div>
                <div class="alert alert-danger mb-3 d-none" id="password-danger"></div>
                <input type="hidden" name="page" value="user">
                <input type="hidden" name="action" value="password">
                <center><button type="submit" class="btn btn-success mb-3">Send</button></center>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
   </div>
</main>
<script>
    $(document).ready(function(){
        $("#information").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                url: "../controllers/ajax.php",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    if(data.status){
                        $("#information-danger").addClass("d-none");
                        $("#information-success").removeClass("d-none");
                        $("#information-success").text("Update Successful");
                    }else{
                        $("#information-success").addClass("d-none");
                        $("#information-danger").removeClass("d-none");
                        $("#information-danger").text(data.msg);
                    }
                    console.log(data);
                }
            })
        })
        $("#password").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                url: "../controllers/ajax.php",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    if(data.status){
                        $("#password-danger").addClass("d-none");
                        $("#password-success").removeClass("d-none");
                        $("#password-success").text("Update Successful");
                    }else{
                        $("#password-success").addClass("d-none");
                        $("#password-danger").removeClass("d-none");
                        $("#password-danger").text(data.msg);
                    }
                }
            })
        })
    })
</script>



<?php include("../middleware/footer.php");?>
