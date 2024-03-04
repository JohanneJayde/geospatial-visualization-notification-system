<?php

include "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$conn = new mysqli($servername, $username, $password, $dbname);

for ($i = 0; $i < count($data); $i++) {
    for ($j = 0; $j < count($data[$i]["distances"]); $j++){
        $query = "INSERT INTO affected (user_id, fire_id, distance)
        VALUES ({$data[$i]["distances"][$j]["id"]}, '{$data[$i]["wildfireIrwinID"]}', {$data[$i]["distances"][$j]["distance"]})";
        echo $query;
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "didnt' work";
        }
        else{
            echo "Did work";
        }
    };

$conn->close();

}