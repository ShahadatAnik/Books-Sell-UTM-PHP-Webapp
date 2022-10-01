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
<h1>Book List</h1>
                    <?php
                    $dbservername = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "book_sell";
                    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * from sell_book where seller_id = ".$_SESSION["studentid"]." and sold_status=1";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $num = 1;
                        echo "<table border='1' width='100%' class='table table-dark table-hover'>";
                        echo "<tr>";
                        echo "<th>Number</th>";
                        echo "<th>Book Name</th>";
                        echo "<th>Author Name</th>";
                        echo "<th>Book Version</th>";
                        echo "<th>Book Publication</th>";
                        echo "<th>Amount</th>";
                        echo "<th>Mark as unsold</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>".$num."</td>";
                            echo "<td>".$row["book_name"]."</td>";
                            echo "<td>".$row["author_name"]."</td>";
                            echo "<td>".$row["book_version"]."</td>";
                            echo "<td>".$row["book_publication"]."</td>";
                            echo "<td>".$row["amount"]."</td>";
                            echo "<td><span class='border border-light rounded'><a class='link-light' href='mark_as_unsold.php?id=".$row["id"]."'>Mark as Unsold</a> </span></td>";
                            echo "</tr>";
                            $num++;
                        }
                        echo "</table>";
                        
                    } else {
                        echo "0 results";
                    }


                    $sql2 = "SELECT * from borrow_book where owner_id = ".$_SESSION["studentid"]." and borrow_status=1";
                    $res2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($res2) > 0) {
                        $num = 1;
                        echo "<table border='1' width='100%' class='table table-dark table-hover'>";
                        echo "<tr>";
                        echo "<th>Number</th>";
                        echo "<th>Book Name</th>";
                        echo "<th>Author Name</th>";
                        echo "<th>Book Version</th>";
                        echo "<th>Book Publication</th>";
                        echo "<th>Borrow Time</th>";
                        echo "<th>Mark as unborrowed</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($res2)) {
                            echo "<tr>";
                            echo "<td>".$num."</td>";
                            echo "<td>".$row["book_name"]."</td>";
                            echo "<td>".$row["author_name"]."</td>";
                            echo "<td>".$row["book_version"]."</td>";
                            echo "<td>".$row["book_publication"]."</td>";
                            echo "<td>".$row["borrow_time"]."</td>";
                            echo "<td><span class='border border-light rounded'><a class='link-light' href='mark_as_unborrowed.php?id=".$row["id"]."'>Mark as Unborrowed</a> </span></td>";
                            echo "</tr>";
                            $num++;
                        }
                        echo "</table>";
                        
                    } else {
                        echo "0 results";
                    }

                    $sql3 = "SELECT * from donate_book where owner_id = ".$_SESSION["studentid"]." and donate_status=1";
                    $res3 = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($res3) > 0) {
                        $num = 1;
                        echo "<table border='1' width='100%' class='table table-dark table-hover'>";
                        echo "<tr>";
                        echo "<th>Number</th>";
                        echo "<th>Book Name</th>";
                        echo "<th>Author Name</th>";
                        echo "<th>Book Version</th>";
                        echo "<th>Book Publication</th>";
                        echo "<th>Mark as undonated</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_assoc($res3)) {
                            echo "<tr>";
                            echo "<td>".$num."</td>";
                            echo "<td>".$row["book_name"]."</td>";
                            echo "<td>".$row["author_name"]."</td>";
                            echo "<td>".$row["book_version"]."</td>";
                            echo "<td>".$row["book_publication"]."</td>";
                            echo "<td><span class='border border-light rounded'><a class='link-light' href='mark_as_undonated.php?id=".$row["id"]."'>Mark as Undonated</a> </span></td>";
                            echo "</tr>";
                            $num++;
                        }
                        echo "</table>";
                        
                    } else {
                        echo "0 results";
                    }
?>