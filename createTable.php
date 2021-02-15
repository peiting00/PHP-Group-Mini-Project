<?php

include "dbConnection.php";

// Create table if not exists
$tableSql = "CREATE TABLE IF NOT EXISTS user (
    userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE, 
    password_hash CHAR(40) NOT NULL, 
    phone VARCHAR(10) NOT NULL)";

if (mysqli_query($conn, $tableSql)) {
    header("Location:login.php");
    exit;
} else {
    echo "Failed to create table: ".mysqli_error($conn);
}

mysqli_close($conn);

?>