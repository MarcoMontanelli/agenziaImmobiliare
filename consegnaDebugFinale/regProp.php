<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codiceCatastale = $_POST["codiceCatastale"];
    $dimensioni = $_POST["dimensioni"];
    $note = $_POST["note"];
    $indirizzo = $_POST["indirizzo"];
    $comune = $_POST["comune"];
    $prezzo = $_POST["prezzo"];
    $descrizione = $_POST["descrizione"];
    $tipo = $_POST["tipo"];

    $conn = mysqli_connect("localhost", "root", "", "ageziamontanelli");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO PROPRIETA (codiceCatastale, dimensioni, note, indirizzo, comune, prezzo, descrizione, tipo) 
            VALUES ('$codiceCatastale', '$dimensioni', '$note', '$indirizzo', '$comune', '$prezzo', '$descrizione', '$tipo') 
            ON DUPLICATE KEY UPDATE dimensioni = '$dimensioni', note = '$note', indirizzo = '$indirizzo', 
                                      comune = '$comune', prezzo = '$prezzo', descrizione = '$descrizione', tipo = '$tipo'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "registrato";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    header("Location: propShow.php?codiceCatastale=$codiceCatastale");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registra proprietà</title>
    <style>
 body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
}

input,
textarea {
    padding: 10px;
    margin-bottom: 15px;
}

button {
    background-color: #8f00ff; 
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #6a0099; 
}
    </style>
</head>
<body>
    <div class="container">
        <h2>registra proprietà</h2>
        <form action="regProp.php" method="post">
            <label for="codiceCatastale">Codice Catastale:</label>
            <input type="text" id="codiceCatastale" name="codiceCatastale" required>

            <label for="dimensioni">Dimensioni:</label>
            <input type="text" id="dimensioni" name="dimensioni" required>

            <label for="note">Note:</label>
            <textarea id="note" name="note" rows="4"></textarea>

            <label for="indirizzo">Indirizzo:</label>
            <input type="text" id="indirizzo" name="indirizzo" required>

            <label for="comune">Comune:</label>
            <input type="text" id="comune" name="comune" required>

            <label for="prezzo">Prezzo:</label>
            <input type="text" id="prezzo" name="prezzo" required>

            <label for="descrizione">Descrizione:</label>
            <textarea id="descrizione" name="descrizione" rows="4" required></textarea>

            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required>


            <button type="submit">registra</button>
        </form>
    </div>
</body>
</html>