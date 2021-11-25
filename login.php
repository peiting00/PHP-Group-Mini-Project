<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="css/login.css">
        <!-- Rotobo Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
     </head>

    <body>
        <div class="top">
            <img src="images/bg_1.jpg"/>
        </div>
        <div class="bottom">
            <div class="alert" id="alert" role="alert">
            </div>
            <div class="container col-md-6">
                <div class="form-block">
                    <h3><strong>Login Page</strong></h3>
                    <form action="login.php" name="login" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Your Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Your Password" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="remember_me"><span>Remember me</span>
                            <input type="checkbox" name="remember_me" id="remember_me"/></label>
                            <span><a href="resetPwd.php" class="forgot-pass">Reset Password</a></span> 
                        </div>
                        <div class="form-group">
                            <span><a href="changePwd.php" class="forgot-pass">Change Password</a></span><br>
                        </div>
                        <div class="form-group">
                            <span>New user?</span>
                            <span><a href="createAcc.php" class="create-acc">Create An Account</a></span> 
                        </div>
                        <input type="submit" name="login" value="Log In" class="btn btn-block">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

    if(isset($_COOKIE['usernamecookie']) and isset($_COOKIE['passwordcookie'])){
        $user = $_COOKIE['usernamecookie'];
        $pass = $_COOKIE['passwordcookie'];
        echo "<script>
            document.getElementById('username').value = '$user';
            document.getElementById('password').value = '$pass';
            </script>";
    }

?>

<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");

        if (status == "fail") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>Invalid username or password.");
        } else {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>Welcome, "+status+".");
        }
    }
</script>

<?php
    ob_start();
    include "dbConnection.php";
    //session_start();

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $loginQuery = mysqli_query($conn, "SELECT password_hash FROM user WHERE username='$username'");
        $password_hash = mysqli_fetch_row($loginQuery);
        
        if($loginQuery) {
            if (password_verify($password, $password_hash[0])) {
                if(isset($_POST["remember_me"])){  
                    setcookie('usernamecookie', $username, time()+86400); //86400 = 1 day
                    setcookie('passwordcookie', $password, time()+86400);
                }
                session_start();
                $_SESSION['login_user'] = $username; 
                echo "<script>show_alert('$username')</script>";
                header("refresh:3;url=home.php"); 
            } 
            else {
                echo "<script>show_alert('fail')</script>";
            }
        }
    }

    mysqli_close($conn);
    ob_end_flush();
?>
