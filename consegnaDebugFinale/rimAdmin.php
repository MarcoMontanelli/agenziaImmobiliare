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

// Rimozione dell'admin
if (isset($_GET['remove_admin'])) {
    $adminId = $_GET['remove_admin'];

    // Rimuovi l'admin
    $sql_remove_admin = "DELETE FROM ADMIN WHERE IdAdmin = '$adminId'";
    $conn->query($sql_remove_admin);
}

// Query per ottenere tutti gli admin
$sql_admins = "SELECT * FROM ADMIN";
$result_admins = $conn->query($sql_admins);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
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

        #rimuoviAdmin {
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

        #rimuoviAdmin:hover {
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

            var rimuoviAdminButton = document.getElementById('rimuoviAdmin');

            rimuoviAdminButton.addEventListener('click', function () {
                // Verifica se è stata selezionata una riga
                if (selectedRow) {
                    // Ottieni l'ID dell'admin dalla riga selezionata
                    var adminId = selectedRow.cells[0].textContent;

                    // Utilizza AJAX per aggiornare dinamicamente il database e la tabella
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Aggiorna la tabella con i nuovi dati dal database
                            table.innerHTML = xhr.responseText;
                            selectedRow = null; // Resetta la riga selezionata
                        }
                    };

                    // Invia la richiesta al server PHP per rimuovere l'admin
                    xhr.open('GET', 'pagina.php?remove_admin=' + adminId, true);
                    xhr.send();
                } else {
                    alert('Seleziona un admin prima di rimuoverlo.');
                }
            });
        });
    </script>
</head>
<body>

<h2>Admins</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Locazione</th>
        <th>Tipo</th>
        <th>Email</th>
        <th>Azione Admin</th>
    </tr>

    <?php
    // Mostra gli admin nella tabella
    while ($row = $result_admins->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['idAdmin'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['località'] . "</td>";
        echo "<td>" . $row['tipo'] . "</td>";
        echo "<td>" . $row['id_agenzia'] . "</td>";
        echo "<td>" . $row['emailA'] . "</td>";
        echo "<td>" . $row['passA'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='?remove_admin=" . $row['idAdmin'] . "'>Rimuovi Admin</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Bottone Rimuovi Admin -->
<button id="rimuoviAdmin">Rimuovi Admin Selezionato</button>

</body>
</html>