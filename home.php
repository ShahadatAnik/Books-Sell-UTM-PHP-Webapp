<?php
                        session_start();
                        $loggedin = $_SESSION['logedin'];
                        if($loggedin == 'true'){
                            echo "<h3>Welcome, </h3> <h3>".$_SESSION['username']. ' </h3><br><br>';
                        }
                        else{
                            header('location:login.php');
                        }
                        
?>
<button class="btn btn-danger" onclick="window.location.href='login.php'">Logout</button>