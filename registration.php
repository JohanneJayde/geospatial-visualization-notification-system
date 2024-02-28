<?php
/*
 * File for user registration
 * Will be used in registration.html
 */
$servername = "localhost";
$username = "root";
$password = "CSCD488_490GroupProject";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Ensure user entered their details
//isset() function will check if data exists
if(!isset($_POST['email'], $_POST['password'])) {
    //Could not get data that should have been sent
    exit('Please complete the registration form');
}

//Make sure submitted registration values are not empty
if(empty($_POST['email'] || empty($_POST['password']))) {
    exit('Please complete the registration form');
}

//Validate that email was entered into the form
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email is not valid');
}

//Password character length check
if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Password must be between 5 and 20 characters');
}

//Check if email already exists
if($stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0) {
        echo 'Email already exists';
    } else {
        //Insert new account if email does not already exist
        if($stmt = $conn->prepare('INSERT INTO users (email, password) VALUES (?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $_POST['email'], $password);
            $stmt->execute();
            echo 'You have successfully registered! You may now log in.';
        } else {
            //SQL error
            echo 'Could not prepare statement';
        }
    }
    $stmt->close();
} else {
    //SQL error
    echo 'Could not prepare statement';
}
$conn->close();