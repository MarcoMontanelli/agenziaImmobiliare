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

// Rimozione del proprietario
if (isset($_GET['remove_proprietario'])) {
    $proprietario_cf = $_GET['remove_proprietario'];

    // Rimuovi il proprietario
    $sql_remove_proprietario = "DELETE FROM PROPRIETARIO WHERE codiceFiscale = '$proprietario_cf'";
    $conn->query($sql_remove_proprietario);
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

<h2>Proprietari</h2>

<table>
    <tr>
        <th>Codice Fiscale</th>
        <th>Nome</th>
        <th>Numero Telefono</th>
        <th>Email</th>
        <th>Note</th>
        <th>Azione Proprietario</th>
    </tr>

    <?php
    // Mostra i proprietari nella tabella
    while ($row = $result_proprietari->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['codiceFiscale'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['numeroTelefono'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['note'] . "</td>";
        echo "<td><a href='?remove_proprietario=" . $row['codiceFiscale'] . "'>Rimuovi Proprietario</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Bottone Rimuovi Proprietario -->
<button id="rimuoviProprietario">Rimuovi Proprietario Selezionato</button>

</body>
</html>

<?php
// Chiudi la connessione al database
$conn->close();
?>