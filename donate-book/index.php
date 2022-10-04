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
<html>

<head>
    <title>Borrow Books</title>
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
                            <a class="nav-link" href="../home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../sell-book">Sell</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../buy-book">Buy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../borrow-book">Borrow</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="donate-book">Donate</a>
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
        <div class="text-center shadow p-3 mt-2  rounded" style="background-color: #e3e154;">
            <h1 class="display-4">Donate Books</h1>
            <form class="form-inline" method="POST">
                <div class="input-group col-md-6">
                    <input type="text" name="book_name" class="form-control" placeholder="Search Books Here..." required />
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="submit"> Search <i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
            <a href="list_for_donation.php" class="btn btn-primary">List a book for donation</a>
        </div>

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-4 mt-2">
            <?php
            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "book_sell";
            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if (isset($_POST['submit'])) {
                $book_name = $_POST['book_name'];
                $sql = "SELECT * FROM donate_book WHERE donate_status=0 and book_name LIKE '%$book_name%'";
            } else {
                $sql = "SELECT * from donate_book where donate_status=0";
            }
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
            ?>
                    <div class="col d-flex justify-content-center mt-2">
                        <div class="card w-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["book_name"]; ?></h5>
                                <footer class="blockquote-footer mt-1 text-capitalize"><?= $row["author_name"]; ?> <cite class="fw-bold">v<?= $row["book_version"]; ?></cite></footer>
                                <p class="card-text"><?= $row["book_publication"]; ?></p>
                                <?php
                                if ($_SESSION['studentid'] == $row['owner_id']) {
                                    echo "<a class='btn btn-danger' href='mark_as_donated.php?book_id=" . $row['id'] . "'>Mark as Donated</a>";
                                } else {
                                    echo "<a class='btn btn-primary' href='details.php?id=" . $row['owner_id'] . "'>Get The Book</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

            <?php }
            } else {
                echo "
                <div class='d-flex '>
                    <div class='flex-grow-1 alert alert-danger text-center' role='alert'>
                        No Books Found
                    </div>
                </div>
                ";
            }
            ?>
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