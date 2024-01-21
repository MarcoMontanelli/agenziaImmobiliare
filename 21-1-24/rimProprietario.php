<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_proprietario'])) {
    $proprietario_cf = $_GET['remove_proprietario'];

    // Rimuovi il proprietario
    $sql_remove_proprietario = "DELETE FROM PROPRIETARIO WHERE codiceFiscale = '$proprietario_cf'";
    
    if ($conn->query($sql_remove_proprietario) === TRUE) {
        echo "Proprietario rimosso con successo.";
    } else {
        echo "Errore nella rimozione del proprietario: " . $conn->error;
    }
}

// Query per ottenere tutti i proprietari
$sql_proprietari = "SELECT * FROM PROPRIETARIO";
$result_proprietari = $conn->query($sql_proprietari);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proprietari</title>
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
            transition: background-color 0.3s;
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

        /* Additional styling for the table */
        table {
            width: 80%;
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        tr.selected {
            background-color: #cce5ff;
        }

        #rimuoviProprietario {
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

        #rimuoviProprietario:hover {
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

            var rimuoviProprietarioButton = document.getElementById('rimuoviProprietario');

            rimuoviProprietarioButton.addEventListener('click', function () {
                // Verifica se è stata selezionata una riga
                if (selectedRow) {
                    // Ottieni il CF del proprietario dalla riga selezionata
                    var proprietarioCF = selectedRow.cells[0].textContent;

                    // Utilizza AJAX per aggiornare dinamicamente il database e la tabella
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Aggiorna la tabella con i nuovi dati dal database
                            table.innerHTML = xhr.responseText;
                            selectedRow = null; // Resetta la riga selezionata
                        }
                    };

                    // Invia la richiesta al server PHP per rimuovere il proprietario
                    xhr.open('GET', 'pagina.php?remove_proprietario=' + proprietarioCF, true);
                    xhr.send();
                } else {
                    alert('Seleziona un proprietario prima di rimuoverlo.');
                }
            });
        });
    </script>
</head>
<body>

<div class="header">
    <h1>PROPRIETARI</h1>
</div>


<div class="main">
    <?php
    if (!empty($result_proprietari)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Codice Fiscale</th>';
        echo '<th>Nome</th>';
        echo '<th>Numero Telefono</th>';
        echo '<th>Email</th>';
        echo '<th>Note</th>';
        echo '<th>Azione Proprietario</th>';
        echo '</tr>';

        while ($row = $result_proprietari->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $row['codiceFiscale'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['numeroTelefono'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['note'] . "</td>";
            echo "<td><a href='?remove_proprietario=" . $row['codiceFiscale'] . "'>Rimuovi Proprietario</a></td>";
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<div class="no-results">';
        echo '<h2>NESSUN PROPRIETARIO TROVATO</h2>';
        echo '<img src="no-results.png" alt="No Results Image">';
        echo '<p>Nessun proprietario presente nel database.</p>';
        echo '</div>';
    }
    ?>
</div>

<div class="buttons">
    <button onclick="location.href='debugPage.php'">Torna alla Home</button>
</div>


</body>
</html>

<?php
$conn->close();
?>