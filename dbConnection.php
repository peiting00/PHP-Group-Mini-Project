<?php

$servername = "localhost";
$username = "root";
$password = "";

// Establish connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die ("Connection failed: ".mysqli_connect_error());
}

// Select database
$dbSelect = mysqli_select_db($conn, 'projectDB');

// If database not exist
if (!$dbSelect) {
    // Create database
    $dbSql = "CREATE DATABASE projectDB";
    if (mysqli_query($conn, $dbSql)) {
        echo "Database created successfully";
    } else {
        echo "Failed to create database: ".mysqli_error($conn);
    }
}
?>