<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin != 'true') {
    header('location:../login.php');
} else {
    if ($_SESSION['username'] == "admin") {
        header('location:../super_admin.php');
    }
    if ($_SESSION['approved'] != 1 && $_SESSION['username'] != "admin") {
        header('location:../not_confirmed.php');
    }
    $username = $_SESSION['username'];
}
?>
<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "book_sell";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$seller_id = $_GET['id'];
$sql = "SELECT * from users where id = '$seller_id'";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<html>

<head>
    <title>Borrow Books</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>


<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-decoration-none border border-dark border-3 rounded px-2" href="../home.php"><b>BOOKS@UTM</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-decoration-none" href="#">Link</a>
                    </li>
                </ul>
                <div class="d-flex ">
                    <span class="navbar-text fw-bold fs-5 mx-2">
                        <i class="fa fa-user " aria-hidden="true"></i>
                        <?php echo $username; ?>
                    </span>
                    <button class="btn btn-danger fw-bold" onclick="window.location.href='../login.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="text-center shadow p-3 mt-2 mb-4 rounded" style="background-color: #e3e154;">
            <h1 class="display-4">Owner Information</h1>
            <p class="text-danger fw-bold">Contact the owner to borrow the book</p>
        </div>
        <div class="row justify-content-center align-items-center d-flex-row">
            <div class="col-12 col-md-4 col-lg-4 ">
                <div class="card shadow-lg ">
                    <div class="card-body mx-auto">
                        <span class="fw-bold fs-2">
                            <i class="fa fa-user " aria-hidden="true"></i>
                            <?= $row['name'] ?>
                        </span>
                        <br>
                        <span class="fs-4">
                            <i class="fa fa-envelope " aria-hidden="true"></i>
                            <?= $row['email'] ?>
                        </span>
                        <br>
                        <span class="fs-4">
                            <i class="fa fa-phone-square " aria-hidden="true"></i>
                            <?= $row['number'] ?>
                        </span>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="index.php" class="btn btn-primary">Go back</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>