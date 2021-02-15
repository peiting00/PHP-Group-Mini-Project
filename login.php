<?php

include "dbConnection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="styles.css">
        <!-- Rotobo Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
    </head>

    <body>
        <div class="top">
            <img src="images/bg_1.jpg"/>
        </div>
        <div class="bottom">
            <div class="container col-md-6">
                <div class="form-block">
                    <h3><strong>Login Page</strong></h3>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Your Username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Your Password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="remember_me"><span>Remember me</span>
                            <input type="checkbox" id="remember_me" checked="checked"/></label>
                            <span><a href="#" class="forgot-pass">Forgot Password</a></span> 
                        </div>

                        <input type="submit" value="Log In" class="btn btn-block">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
