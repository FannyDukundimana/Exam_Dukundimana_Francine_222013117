<?php
    // Connection details
    $hostname = "localhost";
    $users = "FRANCINE";
    $pass = "DUKUNDIMANA$09.";
    $database = "customerrelationshipmanagementsystem";


    // Creating connection
    $connection = new mysqli($hostname, $users, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>