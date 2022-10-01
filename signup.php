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


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    if ($username != "" && $password != "") {
        if ($password == $repassword) {
            $encpt_password = hash('sha256', $password);
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$encpt_password')";
            if (mysqli_query($conn, $sql)) {
                echo "User Created Successfully";
                header('location:login.php');
            } else {
                $errors = "User already exists";
                //echo "User already exists";
            }
        } else {
            $errors = "Both Password must be same";
            //echo "Both Password must be same";
        }
    } else {
        $errors = "Username and Password must be filled";
        //echo "Username and Password must be filled";
    }
}


mysqli_close($conn);
?>

<html>

<head>
    <title>Sign Up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="
                min-height: 100vh;
                background-size: cover;
                background-image: url(img/book1.jpg);
            ">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center d-flex-row text-center h-100">
                <div class="col-12 col-md-4 col-lg-3 h-50">
                    <div class="card shadow">
                        <div class="card-body mx-auto">
                            <h2 class="card-title mt-3 mb-4 text-center">
                                BOOKS@UTM
                            </h2>
                            <form>
                                <div class="form-group input-group flex-nowrap mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" required />
                                </div>
                                <div class="form-group input-group flex-nowrap mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" required />
                                </div>
                                <div class="form-group input-group flex-nowrap mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="number" name="phone" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="addon-wrapping" required />
                                </div>
                                <div class="form-group input-group flex-nowrap mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" required />
                                </div>
                                <div class="form-group input-group flex-nowrap mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" name="repassword" class="form-control" placeholder="Re-Password" aria-label="Re-Password" aria-describedby="addon-wrapping" required />
                                </div>
                                <div class="form-group mb-5">
                                    <button type="submit" class="btn btn-warning btn-block fw-bold">
                                        Create Account
                                    </button>
                                </div>
                                <p class="text-center">
                                    Have an account?
                                    <a class="btn btn-primary btn-sm fw-bold" href="login.php">Login</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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