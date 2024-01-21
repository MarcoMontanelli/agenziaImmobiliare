<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_proprieta'])) {
    $proprietacodice_catastale = $_GET['remove_proprieta'];

    $sql_remove_proprieta = "DELETE FROM PROPRIETA WHERE codiceCatastale = '$proprietacodice_catastale'";
    $conn->query($sql_remove_proprieta);
}

$sql_proprieta = "SELECT * FROM PROPRIETA";
$result_proprieta = $conn->query($sql_proprieta);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proprietà</title>
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

            var rimuoviProprietaButton = document.getElementById('rimuoviProprieta');

            rimuoviProprietaButton.addEventListener('click', function () {
                if (selectedRow) {
                    var proprietaCodiceCatastale = selectedRow.cells[0].textContent;

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            table.innerHTML = xhr.responseText;
                            selectedRow = null;
                        }
                    };

                    xhr.open('GET', 'pagina.php?remove_proprieta=' + proprietaCodiceCatastale, true);
                    xhr.send();
                } else {
                    alert('Seleziona una proprietà prima di rimuoverla.');
                }
            });
        });
    </script>
</head>
<body>

<div class="header">
    <h1>PROPRIETÀ</h1>
</div>



<div class="main">
    <?php
    if (!empty($result_proprieta)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Codice Catastale</th>';
        echo '<th>Dimensioni</th>';
        echo '<th>Note</th>';
        echo '<th>Indirizzo</th>';
        echo '<th>Comune</th>';
        echo '<th>Prezzo</th>';
        echo '<th>Descrizione</th>';
        echo '<th>Tipo</th>';
        echo '<th>Azione Proprietà</th>';
        echo '</tr>';

        while ($row = $result_proprieta->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $row['codiceCatastale'] . "</td>";
            echo "<td>" . $row['dimensioni'] . "</td>";
            echo "<td>" . $row['note'] . "</td>";
            echo "<td>" . $row['indirizzo'] . "</td>";
            echo "<td>" . $row['comune'] . "</td>";
            echo "<td>" . $row['prezzo'] . "</td>";
            echo "<td>" . $row['descrizione'] . "</td>";
            echo "<td>" . $row['tipo'] . "</td>";
            echo "<td><a href='?remove_proprieta=" . $row['codiceCatastale'] . "'>Rimuovi Proprietà</a></td>";
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<div class="no-results">';
        echo '<h2>NESSUNA PROPRIETÀ TROVATA</h2>';
        echo '<p>Nessuna proprietà presente nel database.</p>';
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