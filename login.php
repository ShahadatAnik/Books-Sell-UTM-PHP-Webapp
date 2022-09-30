<?php

session_start();
$errors = "";

$_SESSION['logedin'] = 'false';
$_SESSION['username'] = '';

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
$username = $_POST['username'];
$password = $_POST['password'];

    $sql = "SELECT id, password from  users where username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            if($row["password"] == hash('sha256', $password)){
                $_SESSION['logedin'] = 'true';
                $_SESSION['username'] = $username;
                $_SESSION['doctorid'] = $row["id"];
                header('location:home.php');
            }
            else{
                $errors = "Password is incorrect";
                //echo "Password is incorrect";
            }
        }
    } else {
        $errors = "No user found";
        //echo "No user found";
    }
    //header('location:login.php');
    

}
mysqli_close($conn);

?>

<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="d-flex justify-content-md-center align-items-center vh-100">
    <div class="col-auto">
<table class="table table-striped table-responsive" style="width:100%; text-align: center;">
    <tr>
        <td class="align-middle"><img src="login.png" class="img-fluid"></td>
        <td class="align-middle">
        <h1 class="display-1">Login</h1>    
        <br>
        <form method="post">
<div class="form-floating mb-3">
<input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username"/>
<label for="floatingInput">Username</label>
</div>
<div class="form-floating mb-3">
<input type="password" name="password" class="form-control" id="floatingPassword"/>
<label for="floatingInput">Password</label>
</div>
<?php
echo $errors ."<br><br>";
?>
<input type="submit" name="submit" value="Login" class="btn btn-outline-success" />
</form>
<p class="lead"> Don't have an account?
<button class="btn btn-outline-dark" onclick="window.location.href='signup.php'">Signup</button>
</p></td>
    </tr>
</table>
</div>
  </div>


    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>