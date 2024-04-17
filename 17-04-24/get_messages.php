<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ageziamontanelli"; 

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}


 $result = mysqli_query($conn, "SELECT * FROM MESSAGGIO ORDER BY dataM DESC LIMIT 10");


 while ($row = mysqli_fetch_assoc($result)) {
     echo "<p><strong>{$row['nome']}</strong>: {$row['contenuto']}</p>";
 }


$conn->close();
?>