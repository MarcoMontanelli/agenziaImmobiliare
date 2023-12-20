
<?php
// Connessione al database (da completare con i dati del tuo database)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Rimozione dell'annuncio
if (isset($_GET['remove_annuncio'])) {
    $annuncio_id = $_GET['remove_annuncio'];

    // Rimuovi le immagini associate all'annuncio
    $sql_remove_immagini = "DELETE FROM IMMAGINE WHERE annuncio_id = $annuncio_id";
    $conn->query($sql_remove_immagini);

    // Ora puoi eliminare l'annuncio
    $sql_remove_annuncio = "DELETE FROM ANNUNCIO WHERE idAnnuncio = $annuncio_id";
    $conn->query($sql_remove_annuncio);
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
         <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        tr.selected {
            background-color: #cce5ff;
        }

        #rimuoviAnnuncio {
            display: block;
            margin: 20px auto;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        #rimuoviAnnuncio:hover {
            background-color: #c82333;
        }
    </style>

    <!-- Script JavaScript con AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var table = document.querySelector('table');
            var selectedRow;

            table.addEventListener('click', function (e) {
                var target = e.target;

                // Se il clic è su una cella della riga della tabella
                if (target.tagName === 'TD') {
                    var row = target.parentElement;

                    // Rimuovi la classe "selected" da tutte le righe
                    var rows = table.getElementsByTagName('tr');
                    for (var i = 0; i < rows.length; i++) {
                        rows[i].classList.remove('selected');
                    }

                    // Aggiungi la classe "selected" alla riga cliccata
                    row.classList.add('selected');

                    // Memorizza la riga selezionata
                    selectedRow = row;
                }
            });

            var rimuoviAnnuncioButton = document.getElementById('rimuoviAnnuncio');

            rimuoviAnnuncioButton.addEventListener('click', function () {
                // Verifica se è stata selezionata una riga
                if (selectedRow) {
                    // Ottieni l'ID dell'annuncio dalla riga selezionata
                    var annuncioId = selectedRow.cells[0].textContent;

                    // Utilizza AJAX per aggiornare dinamicamente il database e la tabella
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Aggiorna la tabella con i nuovi dati dal database
                            table.innerHTML = xhr.responseText;
                            selectedRow = null; // Resetta la riga selezionata
                        }
                    };

                    // Invia la richiesta al server PHP per rimuovere l'annuncio
                    xhr.open('GET', 'pagina.php?remove_annuncio=' + annuncioId, true);
                    xhr.send();
                } else {
                    alert('Seleziona un annuncio prima di rimuoverlo.');
                }
            });
        });
    </script>
</head>
<body>

<h2>Annunci Immobiliari</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Descrizione</th>
        <th>Immagine</th>
        <th>Titolo</th>
        <th>Azione</th>
    </tr>

    <?php
    // Mostra gli annunci nella tabella
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

<!-- Bottone Rimuovi Annuncio -->
<button id="rimuoviAnnuncio">Rimuovi Annuncio Selezionato</button>

</body>
</html>

<?php
// Chiudi la connessione al database
$conn->close();
?>