<html>
    <body>
        Contact the owner to borrow the book. <br>
        <h1>Owner Details</h1>
        <?php
        session_start();
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "book_sell";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$seller_id = $_GET['seller_id'];
$sql = "SELECT * from users where id = '$seller_id'";
$res = mysqli_query($conn, $sql);
echo "<table class='table table-dark table-hover'>";
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>Name:</td>";
        echo "<td>".$row["name"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Email:</td>";
        echo "<td>".$row["email"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Phone:</td>";
        echo "<td>".$row["number"]."</td>";
        echo "</tr>";
    }
}

echo "</table>";

mysqli_close($conn);
?>
<a href="index.php" class="btn btn-primary">Go back</a>
    </body>
</html>