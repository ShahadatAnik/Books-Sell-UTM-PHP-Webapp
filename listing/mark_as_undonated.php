<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin != 'true') {
    header('location:../login.php');
} else {
    if($_SESSION['username']!="admin"){
        header('location:../login.php');
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

$id = $_GET['id'];
$sql = "UPDATE donate_book SET donate_status = 0 WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    header('location:listing.php');
    } 
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>