<?php
$errors = "";
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
$repassword = $_POST['repassword'];
if($username != "" && $password != ""){
    if($password == $repassword){
        $encpt_password = hash('sha256', $password);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$encpt_password')";
        if (mysqli_query($conn, $sql)) {
            echo "User Created Successfully";
            header('location:login.php');
        } else {
            $errors = "User already exists";
            //echo "User already exists";
        }
    }
    else{
        $errors = "Both Password must be same";
        //echo "Both Password must be same";
    }
}
else{
    $errors = "Username and Password must be filled";
    //echo "Username and Password must be filled";
}
}


mysqli_close($conn);
?>

<html>
<head>
<title>Sign Up</title>
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
        <h1 class="display-1">Signup</h1>    
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
<div class="form-floating mb-3">
<input type="password" name="repassword" class="form-control" id="floatingPassword"/>
<label for="floatingInput">Re-password</label>
</div>
<?php
echo $errors ."<br><br>";
?>
<input type="submit" name="submit" value="Signup" class="btn btn-outline-success" />
</form>
<p class="lead"> Already have an account?
<button class="btn btn-outline-dark" onclick="window.location.href='login.php'">Login</button>
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