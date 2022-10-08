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

// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$status = "";
$statusMsg = "";

if (isset($_POST['submit'])) {
    $owner_id = $_SESSION['studentid'];
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $book_version = $_POST['book_version'];
    $book_publication = $_POST['book_publication'];
    $borrow_time = $_POST['borrow_time'];

    $sql = "INSERT INTO borrow_book (owner_id, book_name, author_name, book_version, book_publication, borrow_time) VALUES ('$owner_id', '$book_name', '$author_name', '$book_version', '$book_publication', '$borrow_time')";
    if (mysqli_query($conn, $sql)) {
        $status = "<div class='alert alert-success text-center' role='alert'>
				New Record Inserted Successfully. <a href='../home.php' class='alert-link'>Click to view record.</a>
						</div>";
    } else {
        $statusMsg = "<div class='alert alert-danger text-center' role='alert'>
						Please select an image file to upload.
					</div>";
    }
}


mysqli_close($conn);
?>

<html>

<head>
    <title>Sign Up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand text-decoration-none border border-dark border-3 rounded px-2" href="../home.php"><b>BOOKS@UTM</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link"  href="../home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../sell-book">Sell</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../buy-book">Buy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active border border-dark border-1 rounded fw-bold" aria-current="page" href="index.php">Borrow</a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../donate-book">Donate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../listing">History</a>
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
        <!-- grid -->

        <div class="text-center shadow p-3 mt-2 mb-2 rounded" style="background-color: #e3e154;">
            <h1 class="display-4">Insert Borrow Book Information</h1>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"></div>
            <div class="col-md-8 shadow-lg bg-body rounded">
                <form class="row g-3 m-2 border-dark border-3 rounded px-2" name="form" method="post" action="" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Book Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="book_name" placeholder="Enter Book Name" required>
                    </div>
                    <div class="col-md-12">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Author</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="author_name" placeholder="Enter Author Name" required>
                    </div>
                    <div class="col-md-12 ">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Book Version</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">V</span>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="book_version" placeholder="Enter Book Version" required>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Publication</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="book_publication" placeholder="Enter Book Publication" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Borrow Time</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="borrow_time" placeholder="Enter Days" required>
                            <span class="input-group-text" id="basic-addon1">Days</span>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button id="liveAlertBtn" name="submit" type="submit" value="Submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
                <?php if ($status != "") {
                    echo $status;
                    $status = "";
                }
                if ($statusMsg != "") {
                    echo $statusMsg;
                    $statusMsg = "";
                }
                ?>
            </div>
            <div class="col-md-2"></div>
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