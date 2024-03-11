<?php
// Load the database configuration file
session_start();

$servername = "localhost";
$username = "root";
$password = "CSCD488_490GroupProject";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['importSubmit'])){

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $id = $line[0];
                $name   = $line[1];
                $email  = $line[2];
                $address  = $line[3];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM service_members WHERE email = '".$line[1]."'";
                $prevResult = $conn->query($prevQuery);

                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE service_members SET name = '" . $name . "', address = '" . $address . "', email = '". $email ."' WHERE 
                    id = '" . $id . "'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO service_members (name, email, address) VALUES ('"
                        . $name . "', '" . $email . "', '" . $address . "')");
                }
            }

            // Close opened CSV file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: CSV.php".$qstring);