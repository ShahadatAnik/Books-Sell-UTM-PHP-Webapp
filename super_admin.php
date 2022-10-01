<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin != 'true') {
    header('location:login.php');
} else {
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
                            <a class="nav-link  text-decoration-none" href="#">Link</a>
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
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded">View
                    News</h1>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 table-responsive-sm">
                <table class="table table-lg  table-striped  align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center border"><strong>S.No</strong></th>
                            <th class="text-center border"><strong>Username</strong></th>
                            <th class="text-center border"><strong>Name</strong></th>
                            <th class="text-center border"><strong>Email</strong></th>
                            <th class="text-center border"><strong>Number</strong></th>
                            <th class="text-center border"><strong>Status</strong></th>
                            <th class="text-center border" colspan="2"><strong>Action</strong></th>

                        </tr>
                    </thead>
                    <tbody class="text-center">
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
                        $sql = "SELECT * from users where username !='admin'";
                        $res = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td>
                                    <?php echo $row["username"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["name"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["email"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["number"]; ?>
                                </td>
                                <td class="fw-bold">
                                    <?php
                                    if ($row["approved"] == 1) {
                                        echo "Approved";
                                    } else {
                                        echo "Not Approved";
                                    }
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    if ($row["approved"] == 1) {
                                        echo "<a href='unapprove_student.php?id=".$row["id"]."' class='btn btn-danger'>Disapprove</a>";
                                    } else {
                                        echo "<a href='approve_student.php?id=".$row["id"]."' class='btn btn-success'>Approve</a>";
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php
                            $count++;
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
    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>