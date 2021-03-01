<!DOCTYPE html>
<html>
    <head>
        <title>Change Password Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="styles.css">
        <!-- Rotobo Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                    <h3><strong>Change Password Form</strong></h3>
                    <form action="changePwd.php" name="reset" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Your Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Current Password</label>
                            <input type="password" class="form-control" placeholder="Your Current Password" name="c_pwd" id="c_pwd" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" placeholder="Your New Password" name="n_pwd" id="n_pwd" required>
                        </div>
                        <input type="reset" name="clear" value="Clear Input" class="btn btn-block">
                        <input type="submit" name="change_pwd" value="Change Password" class="btn btn-block">
                        <input type="submit" name="back" value="Back" class="btn btn-block" onclick="document.location.href='login.php';">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");

        if (status == "fail_msg") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("Username and password combination does not exist. Your password remain unchanged."); 
        } else if (status == "same_pwd") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("Your current and new password is the same."); 
        } else if (status == "update-success") {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("Your password has been changed successfully."); 
        }
        else {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("Your new password "+status+" has been saved.");
        }
    }
</script>

<?php
    include "dbConnection.php";
    session_start();

    if (isset($_POST["change_pwd"])) {
        $username = $_POST["username"];
        $c_pwd = $_POST["c_pwd"];
        $n_pwd = $_POST["n_pwd"];
        $hashed_password = password_hash($c_pwd, PASSWORD_DEFAULT);
        $changeQuery = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
        $user = mysqli_fetch_assoc($changeQuery);
        if($c_pwd != $n_pwd){
            if($changeQuery) {
                if(password_verify($c_pwd,$user['password_hash'])) { 
                    $hashed = password_hash($n_pwd, PASSWORD_DEFAULT);
                    $password = mysqli_real_escape_string($db,$hashed);
                    $update = "UPDATE user SET password_hash='$password' WHERE username='$username'";
                    $updateQuery = mysqli_query($db,$update);
                    if($updateQuery) {
                        echo "<script>show_alert('$n_pwd')</script>";
                        echo "<script>show_alert('update-success')</script>";
                    }
                } 
                else {
                    echo "<script>show_alert('fail_msg')</script>";
                }
            }
        }
        else {
            echo "<script>show_alert('same_pwd')</script>";
        }
    }

    mysqli_close($conn);
?>
