<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password Form</title>
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
                    <h3><strong>Reset Password Form</strong></h3>
                    <form action="resetPwd.php" name="reset" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Your Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Your Phone Number" name="phone" id="phone" required>
                        </div>
                        <input type="reset" name="clear" value="Clear Input" class="btn btn-block">
                        <input type="submit" name="reset" value="Reset Password" class="btn btn-block">
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
            $(alertDiv).append("Your username and phone number combination does not exist. Your password reset is unsuccessful."); 
        } else if (status == "update-success") {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("Your password reset is successful."); 
        }
        else {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append(" Your new password is "+status+".");
        }
    }
</script>

<?php
    include "dbConnection.php";
    session_start();

    if (isset($_POST["reset"])) {
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        

        $resetQuery = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND phone='$phone'");
        $user = mysqli_fetch_assoc($resetQuery);
        if($resetQuery) {
            if ($user['userID'] == "") {
                echo "<script>show_alert('fail_msg')</script>";
            }
            if(($user['username'] == $username) && ($user['phone'] == $phone)) { 
                $str = "ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                $str = str_shuffle($str);
                $str = substr($str,0,12);
                $hashed_password = password_hash($str, PASSWORD_DEFAULT);
                $password = mysqli_real_escape_string($db,$hashed_password);
                $update = "UPDATE user SET password_hash='$password' WHERE username='$username' AND phone='$phone'";
                $updateQuery = mysqli_query($db,$update);
                if($updateQuery) {
                    echo "<script>show_alert('$str')</script>";
                    echo "<script>show_alert('update-success')</script>";
                }
            } 
        }
    }
    mysqli_close($conn);
?>
