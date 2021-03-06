<?php

include "dbConnection.php";

// Create table user if not exists
$userSql = "CREATE TABLE IF NOT EXISTS user (
    userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE, 
    password_hash CHAR(40) NOT NULL, 
    phone VARCHAR(10) NOT NULL)";

// Create table profile if not exists
$profileSql= "CREATE TABLE IF NOT EXISTS profile(
    profileNum INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    age INT(3) NOT NULL,
    birthdate DATE NOT NULL,
    fav_food VARCHAR(20) NULL,
    gender VARCHAR(10) NOT NULL,
    eye_color VARCHAR(10) NOT NULL,
    bio VARCHAR(200) NOT NULL,
    file VARCHAR(200) NULL,
    url VARCHAR(200) NULL,
    color VARCHAR(10) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES user(userID))";

if (mysqli_query($conn, $userSql) && mysqli_query($conn, $profileSql)) {
    header("Location:login.php");
    exit;
} else {
    echo "Failed to create table: ".mysqli_error($conn);
}

mysqli_close($conn);

?>