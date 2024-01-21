<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$searchKeys = isset($_GET['keys']) ? $_GET['keys'] : '';
$query = $_GET['query'];

$result = [];

switch ($searchKeys) {
    case 'agenzia':
        echo '<script>';
        echo 'console.log("agenzia");';
        echo '</script>';
        $sql = "SELECT * FROM agenzia_immobiliare WHERE 
                nome LIKE '%$query%' OR 
                partitaIva LIKE '%$query%' OR 
                indirizzo LIKE '%$query%' OR 
                numeroTelefono LIKE '%$query%'";
        break;

    case 'annuncio':
        echo '<script>';
        echo 'console.log("annuncio");';
        echo '</script>';
        $sql = "SELECT * FROM annuncio WHERE titolo LIKE '%$query%'";
        break;

    case 'proprieta':
        echo '<script>';
        echo 'console.log("proprieta");';
        echo '</script>';
        $sql = "SELECT * FROM proprieta WHERE 
                indirizzo LIKE '%$query%' OR 
                codiceCatastale LIKE '%$query%' OR 
                comune LIKE '%$query%' OR 
                indirizzo LIKE '%$query%'";
        break;

    default:
        break;
}

if (isset($sql)) {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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

        .main img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            max-height: 200px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .main img:hover {
            transform: scale(1.1);
        }

        .main table:hover {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .no-results {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #ddd;
            border-radius: 10px;
        }

        .no-results h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .no-results img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>RISULTATI DELLA RICERCA:</h1>
</div>

<div class="buttons">
    <button onclick="location.href='debugPage.php'">torna alla home</button>
</div>

<div class="main">
    <?php
    // Visualizza il testo strutturato sopra la tabella
    echo '<div class="search-info">';
    echo '<p>Hai cercato nella categoria <strong>' . ucfirst($searchKeys) . '</strong> la frase <strong>' . $query . '</strong></p>';
    echo '</div>';

    if (!empty($result)) {
        // Variabili per tenere traccia del titolo e del valore da visualizzare
        $title = '';
        $value = '';

        echo '<table>';
        foreach ($result as $item) {
            // Imposta il titolo e il valore in base alla categoria di ricerca
            switch ($searchKeys) {
                case 'agenzia':
                    $title = 'Agenzia';
                    $value = $item['idAgenzia'];
                    break;

                case 'annuncio':
                    $title = 'Annuncio';
                    $value = $item['idAnnuncio'];
                    break;

                case 'proprieta':
                    $title = 'Proprieta';
                    $value = $item['codiceCatastale'];
                    break;

                default:
                    break;
            }

            // Visualizza il titolo sopra la prima riga dei risultati
            if ($title !== '') {
                echo '<tr>';
                echo '<th colspan="' . count($item) . '">' . $title . ' ' . $value . '</th>';
                echo '</tr>';
                $title = ''; // Resetta il titolo per il prossimo gruppo di risultati
            }

            // Visualizza i dati della riga
            echo '<tr>';
            foreach ($item as $key => $value) {
                if (!in_array($key, ['idAgenzia', 'email', 'emailAg', 'passAg', 'pass', 'codiceCatastale', 'idAnnuncio', 'proprietà_id', 'immagini', 'immagine'])) {
                    echo '<td>' . $value . '</td>';
                }
            }

            // Aggiungi la colonna per l'immagine dell'annuncio solo se presente
            if (array_key_exists('immagine', $item)) {
                echo '<td><img src="' . $item['immagine'] . '" alt="Immagine Annuncio"></td>';
            }

            echo '</tr>';
        }
        echo '</table>';
    } else {
        // Display no results found
        echo '<div class="no-results">';
        echo '<h2>NESSUN RISULTATO TROVATO</h2>';
        echo '<img src="no-results.png" alt="No Results Image">';
        echo '<p>ci dispiace, nessun risultato corrisponde ai tuoi criteri di ricerca</p>';
        echo '</div>';
    }
    ?>
</div>

</body>
</html>