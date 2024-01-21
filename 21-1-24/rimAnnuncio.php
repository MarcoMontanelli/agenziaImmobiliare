<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_annuncio'])) {
    $annuncio_id = $_GET['remove_annuncio'];

    // Rimuovi le immagini associate all'annuncio
    $sql_remove_immagini = "DELETE FROM IMMAGINE WHERE idAnnuncio = $annuncio_id";
    
    if ($conn->query($sql_remove_immagini) === TRUE) {
        // Dopo aver rimosso le immagini, elimina l'annuncio
        $sql_remove_annuncio = "DELETE FROM ANNUNCIO WHERE idAnnuncio = $annuncio_id";
        
        if ($conn->query($sql_remove_annuncio) === TRUE) {
            echo "Annuncio rimosso con successo.";
        } else {
            echo "Errore nella rimozione dell'annuncio: " . $conn->error;
        }
    } else {
        echo "Errore nella rimozione delle immagini: " . $conn->error;
    }
}

// Query per ottenere tutti gli annunci
$sql_annunci = "SELECT * FROM ANNUNCIO";
$result_annunci = $conn->query($sql_annunci);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annunci Immobiliari</title>
    <!-- Stili CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }

        .header h1 {
            margin: 0;
        }

        .buttons {
            margin-top: 10px;
        }

        .buttons button {
            background-color: #8f00ff;
            color: white;
            padding: 15px 30px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .buttons button:hover {
            background-color: #6a0099;
        }

        .main {
            text-align: center;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
            border-radius: 10px 0 0 0;
        }

        td {
            border-radius: 0 10px 0 0;
        }

        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        tr.selected {
            background-color: #cce5ff;
        }

        .home-button {
            background-color: #8f00ff;
            color: white;
            padding: 15px 30px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .home-button:hover {
            background-color: #6a0099;
        }

        /* Stile per le immagini con bordi stondati */
        table img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            max-height: 200px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        table img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Annunci Immobiliari</h1>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Descrizione</th>
        <th>Immagine</th>
        <th>Titolo</th>
        <th>Azione</th>
    </tr>

    <?php
    while ($row = $result_annunci->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['idAnnuncio'] . "</td>";
        echo "<td>" . $row['descrizione'] . "</td>";
        echo "<td><img src='" . $row['immagine'] . "' alt='Immagine'></td>";
        echo "<td>" . $row['titolo'] . "</td>";
        echo "<td><a href='?remove_annuncio=" . $row['idAnnuncio'] . "'>Rimuovi</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Bottone Torna alla Home -->
<button class="home-button" onclick="location.href='debugPage.php'">Torna alla Home</button>

</body>
</html>

<?php
$conn->close();
?>