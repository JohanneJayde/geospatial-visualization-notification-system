<?php
/*
 * File for user login
 * Will be used in index.html
 */
session_start();

include ('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Check if the data from the login form was submitted
if(!isset($_POST['email'], $_POST['password'])) {
    exit('Please enter username and/or password');
}

//Prepare SQL statement
if($stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    //Store results so we can check if the account exists in the database
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        //Account exists
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        //Verify password
        if(password_verify($_POST['password'], $password)) {
            //Password verification success
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['email'];
            $_SESSION['id'] = $id;
            header('Location: ../dashboard.html');
        } else {
            //Incorrect password
            echo 'Incorrect password';
        }
    } else {
        //Incorrect username
        echo 'Incorrect username ';
    }

    $stmt->close();
}
