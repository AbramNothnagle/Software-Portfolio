<?php
    // Set the server name
    $dbServername = "localhost";
    // Set the username
    $dbUsername = "root";
    // Set the password
    $dbPassword = "root";
    // Get the database name
    $dbName = "loginsystem";
    //$conn = mysqli_connect($dbServername,$dbUsername,$dbName);
    $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);