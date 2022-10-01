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
$seller_id = $_SESSION['studentid'];
$book_name = $_POST['book_name'];
$author_name = $_POST['author_name'];
$book_version = $_POST['book_version'];
$book_publication = $_POST['book_publication'];
$amount = $_POST['amount'];

$sql = "INSERT INTO sell_book (seller_id, book_name, author_name, book_version, book_publication, amount) VALUES ('$seller_id', '$book_name', '$author_name', '$book_version', '$book_publication', '$amount')";
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
<title>Patient</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body {
  background-image: url('bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

td 
{
    text-align: center; 
    vertical-align: middle;
}
</style>
</head>
<body>

    
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
            <input type="number" name="amount" size="20" maxlength="20" class="form-control" id="floatingInput" placeholder="amount"/>
            <label for="floatingInput" class="text-dark">Amount</label>
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


    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>