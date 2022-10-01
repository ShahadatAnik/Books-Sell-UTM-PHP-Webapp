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


if(isset($_POST['submit'])){
$owner_id = $_SESSION['studentid'];
$book_name = $_POST['book_name'];
$author_name = $_POST['author_name'];
$book_version = $_POST['book_version'];
$book_publication = $_POST['book_publication'];
$borrow_time = $_POST['borrow_time'];

$sql = "INSERT INTO borrow_book (owner_id, book_name, author_name, book_version, book_publication, borrow_time) VALUES ('$owner_id', '$book_name', '$author_name', '$book_version', '$book_publication', '$borrow_time')";
if (mysqli_query($conn, $sql)) {
    echo "Book Listed Successfully";
    header('location:index.php');
    } 
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
        <div class="position-absolute top-50 start-50 translate-middle">
<div class="p-3 mb-2 bg-dark text-white rounded">
<form method="post">
<h1>Sell books</h1>
    <table class="table table-dark table-hover">
        <tr>
            <td>
            <div class="form-floating">
            <input type="text" name="book_name" size="20" maxlength="20" class="form-control" id="floatingInput" placeholder="book_name"/>
            <label for="floatingInput" class="text-dark">Book Name</label>
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="form-floating">
            <input type="text" name="author_name" size="20" maxlength="20" class="form-control" id="floatingInput" placeholder="author_name"/>
            <label for="floatingInput" class="text-dark">Author Name</label>
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="form-floating">
            <input type="text" name="book_version" size="20" maxlength="20" class="form-control" id="floatingInput" placeholder="book_version"/>
            <label for="floatingInput" class="text-dark">Book Version</label>
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div class="form-floating">
            <input type="text" name="book_publication" size="20" maxlength="100" class="form-control" id="floatingInput" placeholder="book_publication"/>
            <label for="floatingInput" class="text-dark">Book Publication</label>
            </div>    
        </td>
        </tr>
        <tr>
            <td>
            <div class="form-floating">
            <input type="number" name="borrow_time" size="20" maxlength="20" class="form-control" id="floatingInput" placeholder="borrow_time"/>
            <label for="floatingInput" class="text-dark">Borrow time in days</label>
            </div>    
        </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Submit" class="btn btn-outline-light"/>
            </td>
        </tr>
    </table>
</form>
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