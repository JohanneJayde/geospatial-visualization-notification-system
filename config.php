<?php
/*
 * Configuration file for connection to the server
 * Ran on mysql ver. 8.0.30 through Laragon
 * Visit https://github.com/JohanneJayde/geospatial-visualization-notification-system
 * and read the ReadMe for set up instruction
 */
$servername = "localhost";
$username = "root";
$password = "CSCD488_490GroupProject";
$dbname = "testdb";

//Create Connection
$conn = new mysqli($servername, $username, $password);
//Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}