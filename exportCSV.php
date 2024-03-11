<?php
// Load the database configuration file
session_start();

$servername = "localhost";
$username = "root";
$password = "CSCD488_490GroupProject";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filename = "members_" . date('Y-m-d') . ".csv";
$delimiter = ",";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('ID', 'Name', 'Email', 'Address');
fputcsv($f, $fields, $delimiter);

// Get records from the database
$result = $conn->query("SELECT * FROM service_members ORDER BY id DESC");
if ($result->num_rows > 0) {
    // Output each row of the data, format line as csv and write to file pointer
    while ($row = $result->fetch_assoc()) {
        $lineData = array($row['id'], $row['name'], $row['email'], $row['address']);
        fputcsv($f, $lineData, $delimiter);
    }
}

// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// Output all remaining data on a file pointer
fpassthru($f);

// Exit from file
exit();