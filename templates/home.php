<?php 
    $active = 1;
    include("../middleware/header.php");
    html($active);
?>

<main>
    <div class="container text-center py-5">
        <!-- Header Text -->
        <h1 class="display-4">Welcome to Our Platform</h1>
        <p class="lead">Connecting service providers with those in need, ensuring top quality and reliability.</p>

        <!-- Cards -->
        <div class="row px-sm-0 px-4">
            <!-- User Search Service Card 1 -->
            <div class="col-md-3">
                <div class="card mb-sm-0 mb-4">
                    <img src="../images/public/service_1.jpeg" class="card-img-top" alt="Service Image">
                    <div class="card-body">
                        <p>
                            Looking for the perfect service provider? Explore our wide range of professionals suited for your every need. Find the best match with our platform and get your service
                        </p>
                    </div>
                </div>
            </div>

            <!-- User Search Service Card 2 -->
            <div class="col-md-3">
                <div class="card mb-sm-0 mb-4">
                    <img src="../images/public/service_2.jpeg" class="card-img-top" alt="Service Image">
                    <div class="card-body">
                        <p>
                            Dive into a world of opportunities. Whether it's a carpenter, a web designer, or a tutor, we've got you covered. Search and secure services with confidence.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Advertiser Service Card 1 -->
            <div class="col-md-3">
                <div class="card mb-sm-0 mb-4">
                    <img src="../images/public/service_3.jpeg" class="card-img-top" alt="Advertise Image">
                    <div class="card-body">
                        <p>
                            Are you a service provider? Showcase your expertise, build a loyal clientele, and grow your business. Our platform provides the tools to boost your reach and reputation.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Advertiser Service Card 2 -->
            <div class="col-md-3">
                <div class="card mb-sm-0 mb-4">
                    <img src="../images/public/service_4.jpeg" class="card-img-top" alt="Advertise Image">
                    <div class="card-body">
                        <p>
                            Join a community of top-tier professionals. Advertise your services, connect with clients, and expand your portfolio. Register with us and elevate your professional journey.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-center mt-5">
            <a href="services.php" class="btn btn-primary mx-2">Search Services</a>
            <a href="signup.php" class="btn btn-success mx-2">Sign Up</a>
        </div>
    </div>
</main>



<?php include("../middleware/footer.php");?>