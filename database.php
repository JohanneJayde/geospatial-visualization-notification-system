<?php
/*
 * File for database creation
 */
$servername = "localhost";
$username = "root";
$password = "CSCD488_490GroupProject";

//Create the connection
$conn = new mysqli($servername, $username, $password);
//Check the connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Create the database
$sql = "CREATE DATABASE IF NOT EXISTS testdb";
if($conn->query($sql)){
    echo "Database created successfully\n";
} else{
    echo "Error creating database: " . $conn->error;
}
$conn->close();

//Re-create the connection, this time connecting to the database as well
$dbname = "testdb";
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Create user table
$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `passwrd` VARCHAR(50) NOT NULL,
    `user_role` ENUM('service_member', 'admin') NOT NULL DEFAULT 'service_member',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if($conn->query($sql) == TRUE){
    echo "Table `users` created successfully\n";
} else{
    echo "Error creating table: " . $conn->error;
}

//Create admin table
$sql = "CREATE TABLE IF NOT EXISTS `admin`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) 
)";
if($conn->query($sql) == TRUE){
    echo "Table `admin` created successfully\n";
} else{
    echo "Error creating table: " . $conn->error;
}

//Create fire table
$sql = "CREATE TABLE IF NOT EXISTS `fires`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `location` VARCHAR(255) NOT NULL
)";
if($conn->query($sql) == TRUE){
    echo "Table `fires` created successfully\n";
} else{
    echo "Error creating table: " . $conn->error;
}

//Create affected table
//This table will store those service members who are within an affected are of the fire
$sql = "CREATE TABLE IF NOT EXISTS `affected`(
     `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     `user_id` INT UNSIGNED NOT NULL,
     `fire_id` INT UNSIGNED NOT NULL,
     FOREIGN KEY (user_id) REFERENCES users(id),
     FOREIGN KEY (fire_id) REFERENCES fires(id)
 )";
if($conn->query($sql) == TRUE){
    echo "Table `affected` created successfully\n";
} else{
    echo "Error creating table: " . $conn->error;
}