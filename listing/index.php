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
<!-- <button class="btn btn-danger" onclick="window.location.href='login.php'">Logout</button> -->
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
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
                            <a class="nav-link" href="../donate-book">Donate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active border border-dark border-1 rounded fw-bold" aria-current="page" href="">History</a>
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
        <!-- Sold Book List -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded" style="background-color: #e3e154;">Sold Book List</h1>
            </div>
            <div class="col-md-2"></div>
        </div>
        <?php
        $count = 1;
        $dbservername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "book_sell";
        $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from sell_book where seller_id = " . $_SESSION["studentid"] . " and sold_status=1";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 table-responsive-sm">
                        <table class="table table-lg  table-striped  align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center border"><strong>S.No</strong></th>
                                    <th class="text-center border"><strong>Book Name</strong></th>
                                    <th class="text-center border"><strong>Author</strong></th>
                                    <th class="text-center border"><strong>Version</strong></th>
                                    <th class="text-center border"><strong>Publication</strong></th>
                                    <th class="text-center border"><strong>Amount(MYR)</strong></th>
                                    <th class="text-center border" colspan="2"><strong>Action</strong></th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["book_name"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["author_name"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["book_version"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["book_publication"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["amount"]; ?>
                                    </td>
                                    <td>

                                        <?php

                                        echo "<a href='mark_as_unsold.php?id=" . $row["id"] . "' class='btn btn-danger'>Mark as Unsold</a>";

                                        ?>

                                    </td>
                                </tr>
                        <?php
                        $count++;
                    }
                } else {
                    echo "<h6 class='text-center'>No Books Sold</h6>";
                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Borrow Book List  -->
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded" style="background-color: #e3e154;">Borrow Book List</h1>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <?php
                $count = 1;
                $sql2 = "SELECT * from borrow_book where owner_id = " . $_SESSION["studentid"] . " and borrow_status=1";
                $res2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($res2) > 0) {
                    while ($row = mysqli_fetch_assoc($res2)) {
                ?>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 table-responsive-sm">
                                <table class="table table-lg  table-striped  align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center border"><strong>S.No</strong></th>
                                            <th class="text-center border"><strong>Book Name</strong></th>
                                            <th class="text-center border"><strong>Author</strong></th>
                                            <th class="text-center border"><strong>Version</strong></th>
                                            <th class="text-center border"><strong>Publication</strong></th>
                                            <th class="text-center border"><strong>Borrow Days</strong></th>
                                            <th class="text-center border" colspan="2"><strong>Action</strong></th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">

                                        <tr>
                                            <td>
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["book_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["author_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["book_version"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["book_publication"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["borrow_time"]; ?>
                                            </td>
                                            <td>

                                                <?php

                                                echo "<a href='mark_as_unborrowed.php?id=" . $row["id"] . "' class='btn btn-danger'>Mark as Unborrowed</a>";

                                                ?>

                                            </td>
                                        </tr>
                                <?php
                                $count++;
                            }
                        } else {
                            echo "<h6 class='text-center'>No Books Borrowed</h6>";
                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Donate Book List  -->
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded" style="background-color: #e3e154;">Donate Book List</h1>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <?php
                        $count = 1;
                        $sql3 = "SELECT * from donate_book where owner_id = " . $_SESSION["studentid"] . " and donate_status=1";
                        $res3 = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($res3) > 0) {
                            while ($row = mysqli_fetch_assoc($res3)) {
                        ?>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 table-responsive-sm">
                                        <table class="table table-lg  table-striped  align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center border"><strong>S.No</strong></th>
                                                    <th class="text-center border"><strong>Book Name</strong></th>
                                                    <th class="text-center border"><strong>Author</strong></th>
                                                    <th class="text-center border"><strong>Version</strong></th>
                                                    <th class="text-center border"><strong>Publication</strong></th>
                                                    <th class="text-center border" colspan="2"><strong>Action</strong></th>

                                                </tr>
                                            </thead>
                                            <tbody class="text-center">

                                                <tr>
                                                    <td>
                                                        <?php echo $count; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["book_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["author_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["book_version"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["book_publication"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo "<a href='mark_as_undonated.php?id=" . $row["id"] . "' class='btn btn-danger'>Mark as Undonated</a>";
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php
                                        $count++;
                                    }
                                } else {
                                    echo "<h6 class='text-center'>No Books Donated</h6>";
                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
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