<?php 
include("../middleware/objects.php");
$objects = new Objects;
$objects->user_session_public();

$user_id = $_SESSION["user_id"];

$objects->query = "SELECT * FROM users WHERE id = '$user_id'";
$user = $objects->query_result();

function html($active){ ?>
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
    <title>Gram || User</title>
    <style>
        .bg-lightgreen {
            background-color: #90EE90; /* This is a light green color */
        }

        .center-nav {
            justify-content: center;
        }

        .end-nav {
            justify-content: flex-end;
        }
        .offcanvas a{
            color: white;
        }
        .offcanvas a.active{
            color: green;
            font-weight: bolder;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-success">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="#">
                <img src="path-to-your-brand-logo.png" alt="Brand Logo" width="30" height="24">
            </a>
            <!-- Toggler for offcanvas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main Navbar links (centered) -->
            <div class="collapse navbar-collapse center-nav" id="navbarNavCentered">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-active="1" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-active="2" href="connection.php">Connections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-active="3" href="messages.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-active="4" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-active="5" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>

            <!-- Logout link (right side) -->
            <div class="collapse navbar-collapse end-nav me-3" id="navbarNavEnd">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../controllers/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start bg-lightgreen" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <img src="path-to-your-brand-logo.png" alt="Brand Logo" width="30" height="24">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav ps-4">
                <li class="nav-item">
                    <a class="nav-link" data-active="1" href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-active="2" href="connection.php"><i class="fa fa-users"></i> Connections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-active="3" href="messages.php"><i class="fa fa-envelope"></i> Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-active="4" href="profile.php"><i class="fa fa-user-circle"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-active="5" href="settings.php"><i class="fa fa-cogs"></i> Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </li>

                
            </ul>
        </div>
    </div>
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