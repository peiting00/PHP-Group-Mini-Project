<?php
    session_start();
    session_destroy();

    if(isset($_COOKIE['usernamecookie']) and isset($_COOKIE['passwordcookie'])){
        $user = $_COOKIE['usernamecookie'];
        $pass = $_COOKIE['passwordcookie'];
        setcookie('usernamecookie', $user, time()-1); //86400 = 1 day
        setcookie('passwordcookie', $pass, time()-1);
    }
    echo "You Have Successfully Logout!<br>";
    echo "Click here to <a href='login.php'>login again</a>";
?>