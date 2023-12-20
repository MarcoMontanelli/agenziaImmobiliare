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

// Rimozione del cliente
if (isset($_GET['remove_cliente'])) {
    $clienteId = $_GET['remove_cliente'];

    // Rimuovi il cliente
    $sql_remove_cliente = "DELETE FROM CLIENTE WHERE idCliente = '$clienteId'";
    $conn->query($sql_remove_cliente);
}

// Query per ottenere tutti i clienti
$sql_clienti = "SELECT * FROM CLIENTE";
$result_clienti = $conn->query($sql_clienti);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clienti</title>
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

        #rimuoviCliente {
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

        #rimuoviCliente:hover {
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

            var rimuoviClienteButton = document.getElementById('rimuoviCliente');

            rimuoviClienteButton.addEventListener('click', function () {
                // Verifica se è stata selezionata una riga
                if (selectedRow) {
                    // Ottieni l'ID cliente dalla riga selezionata
                    var clienteId = selectedRow.cells[0].textContent;

                    // Utilizza AJAX per aggiornare dinamicamente il database e la tabella
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Aggiorna la tabella con i nuovi dati dal database
                            table.innerHTML = xhr.responseText;
                            selectedRow = null; // Resetta la riga selezionata
                        }
                    };

                    // Invia la richiesta al server PHP per rimuovere il cliente
                    xhr.open('GET', 'pagina.php?remove_cliente=' + clienteId, true);
                    xhr.send();
                } else {
                    alert('Seleziona un cliente prima di rimuoverlo.');
                }
            });
        });
    </script>
</head>
<body>

<h2>Clienti</h2>

<table>
    <tr>
        <th>ID Cliente</th>
        <th>Nome</th>
        <th>Ragione Sociale</th>
        <th>Numero di Telefono</th>
        <th>Email</th>
        <th>Azione Cliente</th>
    </tr>

    <?php
    // Mostra i clienti nella tabella
    while ($row = $result_clienti->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['idCliente'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['ragioneSociale'] . "</td>";
        echo "<td>" . $row['numeroTelefono'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='?remove_cliente=" . $row['idCliente'] . "'>Rimuovi Cliente</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Bottone Rimuovi Cliente -->
<button id="rimuoviCliente">Rimuovi Cliente Selezionato</button>

</body>
</html>