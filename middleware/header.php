<?php function html($active){ ?>
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../css/bootstrap.min.css">
                    <link rel="stylesheet" href="../css/pkgs/font-awesome-4.7.0/css/font-awesome.min.css">
                    <link rel="stylesheet" href="../css/style.css">
                    <script src="../js/jquery-3.5.1.min.js"></script>
                    <script src="../js/popper2.js"></script>
                    <script src="../js/bootstrap.min.js"></script>
                    <title>Gram</title>
                </head>
                <body>
                <style>
                    .navbar-custom .navbar-nav > li > a.active {
                        color: lightgreen; /* Change the color to whatever you prefer */
                        font-weight: bold;
                    }
                </style>
                <nav class="navbar navbar-expand-sm navbar-custom bg-success">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">SYSFOLIO</a>
                        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end me-sm-4 me-3" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" data-active="1" href="home.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" data-active="2" href="service.php">About</a></li>
                                <li class="nav-item"><a class="nav-link" data-active="3" href="login.php">Login</a></li>
                                <li class="nav-item"><a class="nav-link" data-active="4" href="signup.php">Signup</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <script>
                    <?php if($active){ ?>
                        const active = Number("<?php echo $active; ?>");
                        var links = document.querySelectorAll(".nav-link");
                        links.forEach(function(link){
                            link.classList.remove("active");
                            if(link.getAttribute("data-active") == active){
                                link.classList.add("active");
                            }
                        })
                    <?php } ?>
                </script>
<?php } ?>