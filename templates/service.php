<?php 
    $active = 2;
    include("../middleware/header.php");
    html($active);
?>

<main>
    <div class="container mt-5">
        <div class="row px-sm-0 px-4">

            <!-- col-md-8 section -->
            <div class="col-md-8">

                <!-- First Card: How the Website Works -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        How Our Platform Works
                    </div>
                    <div class="card-body">
                        Our platform serves as a revolutionary bridge between skilled professionals and those seeking their expertise. We understand that the modern world thrives on convenience and efficiency, and our platform is designed to epitomize these values. By creating an account, service providers can showcase their skills, list their credentials, and exhibit their portfolio. For clients, the search process has never been easier: simply enter your requirements and be greeted with a list of professionals who fit the bill.
                    </div>
                </div>

                <!-- Second Card: Mission Statement -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        Our Mission
                    </div>
                    <div class="card-body">
                        At the core of our mission lies a desire to reshape the digital landscape of service provision. We envisage a world where high-quality service is not only a guarantee but an expectation. We believe that everyone, regardless of their field, deserves recognition and opportunities. Through our platform, we aim to highlight the talented, the experienced, and the innovative, ensuring they get the opportunities they deserve while clients receive unparalleled service.
                    </div>
                </div>

            </div>

            <!-- col-md-4 section -->
            <div class="col-md-4">

                <!-- Card: Important Aspects -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Why Choose Our Platform
                    </div>
                    <div class="card-body">
                        Our platform isn't just another digital space; it's a community built on trust, reliability, and excellence. We champion transparency, with every professional profile undergoing a thorough verification process. Furthermore, our commitment to innovation is unwavering. Regular updates, feature rollouts, and system optimizations ensure that our platform remains at the forefront of digital service provision, catering to both current needs and anticipating future demands.
                    </div>
                </div>

            </div>

        </div>
    </div>

</main>



<?php include("../middleware/footer.php");?>