<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_cliente'])) {
    $clienteId = $_GET['remove_cliente'];

    $sql_remove_cliente = "DELETE FROM CLIENTE WHERE idCliente = '$clienteId'";
    $conn->query($sql_remove_cliente);
}

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
            text-align: center;
        }

        .buttons button {
            background-color: #8f00ff;
            color: white;
            padding: 15px 30px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
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

                if (target.tagName === 'TD') {
                    var row = target.parentElement;

                    var rows = table.getElementsByTagName('tr');
                    for (var i = 0; i < rows.length; i++) {
                        rows[i].classList.remove('selected');
                    }

                    row.classList.add('selected');
                    selectedRow = row;
                }
            });

            var rimuoviClienteButton = document.getElementById('rimuoviCliente');

            rimuoviClienteButton.addEventListener('click', function () {
                if (selectedRow) {
                    var clienteId = selectedRow.cells[0].textContent;

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            table.innerHTML = xhr.responseText;
                            selectedRow = null;
                        }
                    };

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

<div class="header">
    <h1>CLIENTI</h1>
</div>



<div class="main">
    <?php
    if (!empty($result_clienti)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID Cliente</th>';
        echo '<th>Nome</th>';
        echo '<th>Ragione Sociale</th>';
        echo '<th>Numero di Telefono</th>';
        echo '<th>Email</th>';
        echo '<th>Azione Cliente</th>';
        echo '</tr>';

        while ($row = $result_clienti->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $row['idCliente'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['ragioneSociale'] . "</td>";
            echo "<td>" . $row['numeroTelefono'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><a href='?remove_cliente=" . $row['idCliente'] . "'>Rimuovi Cliente</a></td>";
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<div class="no-results">';
        echo '<h2>NESSUN CLIENTE TROVATO</h2>';
        echo '<p>Nessun cliente presente nel database.</p>';
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