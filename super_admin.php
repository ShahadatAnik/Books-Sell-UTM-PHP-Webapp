<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin != 'true') {
    header('location:login.php');
} else {
    if($_SESSION['username']!="admin"){
        header('location:login.php');
    }
    $username = $_SESSION['username'];
}
?>
<html>
    <body>
        Hello super admin
        <button class="btn btn-danger fw-bold" onclick="window.location.href='login.php'">Logout</button>
        <br>
        <br>
        <h1>Student List</h1>
                    <?php
                    $dbservername = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "book_sell";
                    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * from users where username!='admin'";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $num = 1;
                        echo "<table border='1' width='100%' class='table table-dark table-hover'>";
                        echo "<tr>";
                        echo "<th>Number</th>";
                        echo "<th>Username</th>";
                        echo "<th>Name</th>";
                        echo "<th>Email</th>";
                        echo "<th>Number</th>";
                        echo "<th>Approve Status</th>";
                        echo "<th>Approve</th>";
                        echo "<th>Unapprove</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>".$num."</td>";
                            echo "<td>".$row["username"]."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<td>".$row["email"]."</td>";
                            echo "<td>".$row["number"]."</td>";
                            echo "<td>".$row["approved"]."</td>";
                            echo "<td><span class='border border-light rounded'><a class='link-light' href='approve_student.php?id=".$row["id"]."'>Approve</a> </span></td>";
                            echo "<td><span class='border border-light rounded'><a class='link-light' href='unapprove_student.php?id=".$row["id"]."'>Unapprove</a> </span></td>";
                            echo "</tr>";
                            $num++;
                        }
                        echo "</table>";
                        
                    } else {
                        echo "0 results";
                    }
                    ?>
    </body>
</html>