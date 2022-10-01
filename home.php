<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin != 'true') {
    header('location:login.php');
} else {
    if ($_SESSION['username'] == "admin") {
        header('location:super_admin.php');
    }
    if ($_SESSION['approved'] != 1 && $_SESSION['username'] != "admin") {
        header('location:not_confirmed.php');
    }
    $username = $_SESSION['username'];
}

?>
<!-- <button class="btn btn-danger" onclick="window.location.href='login.php'">Logout</button> -->
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .card {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .card:hover {
            box-shadow: 10px 12px 12px 4px #e9ecef;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand text-decoration-none border border-dark border-3 rounded px-2" href="home.php"><b>BOOKS@UTM</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-decoration-none" href="listing/listing.php">Your Listings</a>
                        </li>
                    </ul>
                    <div class="d-flex ">
                        <span class="navbar-text fw-bold fs-5 mx-2">
                            <i class="fa fa-user " aria-hidden="true"></i>
                            <?php echo $username; ?>
                        </span>
                        <button class="btn btn-danger fw-bold" onclick="window.location.href='login.php'">Logout</button>
                    </div>
                </div>
            </div>
        </nav>
        <!-- grid -->
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 ">
            <div class="col d-flex justify-content-center mt-4">
                <div class="card shadow bg-body rounded" style="width: 350px;">
                    <a href="buy-book" class="text-decoration-none text-dark">
                        <img src="img/book1.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <p class="card-text fw-bold fs-3">Buy Book</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col d-flex justify-content-center mt-4">
                <div class="card shadow bg-body rounded" style="width: 350px;">
                    <a href="sell-book" class="text-decoration-none text-dark">
                        <img src="img/book1.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <p class="card-text fw-bold fs-3">Sell Book</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col d-flex justify-content-center mt-4">
                <div class="card shadow bg-body rounded" style="width: 350px;">
                    <a href="borrow-book" class="text-decoration-none text-dark">
                        <img src="img/book1.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <p class="card-text fw-bold fs-3">Borrow Book</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col d-flex justify-content-center mt-4">
                <div class="card shadow bg-body rounded" style="width: 350px;">
                    <a href="donate-book" class="text-decoration-none text-dark">
                        <img src="img/book1.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <p class="card-text fw-bold fs-3">Donate Book</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>