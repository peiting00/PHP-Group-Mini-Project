<?php
    include('session.php');
    echo "Hello ". $_SESSION['username'].'<br>';
    echo "<a href='logout.php'>logout</a>";
?>