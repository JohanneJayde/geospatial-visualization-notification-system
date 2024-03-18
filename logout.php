<?php
/*
 * PHP file for logout functionality
 * Creates a session, unsets it, then destroys it and
 * redirects the user to the login page (index.html)
 */
session_start();

$servername = "localhost";
$username = "root";
$password = "CSCD488_490GroupProject";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

session_unset();
session_destroy();

header("location: index.html");
exit;
