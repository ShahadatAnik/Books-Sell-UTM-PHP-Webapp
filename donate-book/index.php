<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin != 'true') {
    header('location:../login.php');
} else {
    if($_SESSION['username']=="admin"){
        header('location:../super_admin.php');
    }
    if($_SESSION['approved']!=1 && $_SESSION['username']!="admin"){
        header('location:../not_confirmed.php');
    }
    $username = $_SESSION['username'];
}

?>
<html>

<head>
    <title>Donate books</title>
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
        <!-- grid -->
        
        <a href="list_for_donation.php" class="btn btn-primary">List a book for donation</a>
        <form method="post">
<h1>Search</h1>
    <table class="table table-dark table-hover">
        <tr>
            <td>
            <div class="form-floating">
            <input type="text" name="book_name" size="20" maxlength="20" class="form-control" id="floatingInput" placeholder="book_name"/>
            <label for="floatingInput" class="text-dark">Enter Book Name</label>
            </div>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Search" class="btn btn-outline-light"/>
            </td>
        </tr>
    </table>
</form>
        <h1> Get Donated Book</h1>
                    <?php
                    $dbservername = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "book_sell";
                    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    if(isset($_POST['submit'])){
                        $book_name = $_POST['book_name'];
                        $sql = "SELECT * FROM donate_book WHERE donate_status=0 and book_name LIKE '%$book_name%'";
                    }
                    else{
                        $sql = "SELECT * from donate_book where donate_status=0";
                    }
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $num = 1;
                        echo "<table border='1' width='100%' class='table table-dark table-hover'>";
                        echo "<tr>";
                        echo "<th>Sr No.</th>";
                        echo "<th>Book name</th>";
                        echo "<th>Author Name</th>";
                        echo "<th>Book Version</th>";
                        echo "<th>Book Publication</th>";
                        echo "<th>Get</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>".$num."</td>";
                            echo "<td>".$row["book_name"]."</td>";
                            echo "<td>".$row["author_name"]."</td>";
                            echo "<td>".$row["book_version"]."</td>";
                            echo "<td>".$row["book_publication"]."</td>";
                            if($_SESSION['studentid']==$row['owner_id']){
                                echo "<td><a href='mark_as_donated.php?book_id=".$row['id']."'>Mark as Donated</a></td>";
                            }
                            else{
                                echo "<td><a href='get_book.php?seller_id=".$row['owner_id']."'>Get the Book</a></td>";
                            }
                            echo "</tr>";
                            $num++;
                        }
                        echo "</table>";
                        
                    } else {
                        echo "0 results";
                    }
?>
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