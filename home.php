<?php
    include('session.php');
    echo "Hello ". $_SESSION['login_user'].'<br>';
    echo "<a href='logout.php'>logout</a>";
?>
