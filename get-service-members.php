<?php
 // Database Credientatials

    $servername = "localhost";
    $username = "root";
    $password = "CSCD488_490GroupProject";
    $dbname = "testdb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM service_members";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

        $name = $row["name"];
        $email = $row["email"];
        $ID = $row["ID"];
        $address = array("street"=>$row["street"],"city"=>$row["city"],"county"=>$row["county"],"state"=>$row["state"],"country"=>$row["country"],"postalcode"=>$row["postalcode"]);

        $rows[] = array("id"=>$ID,"name"=>$name,"email"=>$email,"address"=>$address);
      }
    } else {
      echo "0 results";
    }
    echo json_encode($rows);

    
    $conn->close();

