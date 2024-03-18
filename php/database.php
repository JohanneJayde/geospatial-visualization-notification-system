<?php

    include "config.php";

    //Create the connection
    $conn = new mysqli($servername, $username, $password);
    //Check the connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //Create the database
    $sql = "CREATE DATABASE IF NOT EXISTS testdb";
    if($conn->query($sql)){
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
        `password` VARCHAR(255) UNIQUE NOT NULL,
        `user_role` ENUM('service_member', 'admin') NOT NULL DEFAULT 'service_member',
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if($conn->query($sql) == TRUE){
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
    } else{
        echo "Error creating table: " . $conn->error;
    }

    //Create fire table
    $sql = "CREATE TABLE IF NOT EXISTS `fires`(
        `id`  VARCHAR(255) PRIMARY KEY,
        `location` VARCHAR(255) NOT NULL
    )";
    if($conn->query($sql) == TRUE){
    } else{
        echo "Error creating table: " . $conn->error;
    }

    //Create affected table
    //This table will store those service members who are within an affected are of the fire
    $sql = "CREATE TABLE IF NOT EXISTS `affected`(
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT UNSIGNED NOT NULL,
        `fire_id` VARCHAR(255) NOT NULL,        
        `distance` DECIMAL(8,4) UNSIGNED NOT NULL
    )";
    if($conn->query($sql) == TRUE){
    } else{
        echo "Error creating table: " . $conn->error;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `service_members` (
        ID INT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        street VARCHAR(255),
        city VARCHAR(255),
        county VARCHAR(255),
        state VARCHAR(255),
        country VARCHAR(255),
        postalcode VARCHAR(10)
    )";

    if($conn->query($sql) == TRUE){
    } else{
    echo "Error creating table: " . $conn->error;
    }
