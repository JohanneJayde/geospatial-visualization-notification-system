<?php

include "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$conn = new mysqli($servername, $username, $password, $dbname);

$query = "DELETE FROM affected";

$conn->query($query);


for ($i = 0; $i < count($data); $i++) {
    for ($j = 0; $j < count($data[$i]["distances"]); $j++){
        $query = "INSERT INTO affected (user_id, fire_id, distance)
        VALUES ({$data[$i]["distances"][$j]["id"]}, '{$data[$i]["wildfireIrwinID"]}', {$data[$i]["distances"][$j]["distance"]})";
        $result = $conn->query($query);

    };

$conn->close();

}