<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenzie Immobiliari</title>

    
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
            width: 80%;
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

        .remove-button {
            display: block;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .remove-button:hover {
            background-color: #c82333;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function createAndPopulateTable(data) {
            var tableHtml = '<table id="agenzieTable">';
            tableHtml += '<tr>';
            tableHtml += '<th>ID Agenzia</th>';
            tableHtml += '<th>Nome Agenzia</th>';
            tableHtml += '<th>Partita IVA</th>';
            tableHtml += '<th>Indirizzo</th>';
            tableHtml += '<th>Numero Telefono</th>';
            tableHtml += '<th>Email Agenzia</th>';
            tableHtml += '<th>Nome Proprietario</th>';
            tableHtml += '<th>Località</th>';
            tableHtml += '<th>Email Agente</th>';
            tableHtml += '<th>Azione Agenzia</th>';
            tableHtml += '</tr>';

            data.data.forEach(function (row) {
                tableHtml += '<tr>';
                tableHtml += '<td>' + row.idAgenzia + '</td>';
                tableHtml += '<td>' + row.nome + '</td>';
                tableHtml += '<td>' + row.partitaIva + '</td>';
                tableHtml += '<td>' + row.indirizzo + '</td>';
                tableHtml += '<td>' + row.numeroTelefono + '</td>';
                tableHtml += '<td>' + row.email + '</td>';
                tableHtml += '<td>' + row.nomeProprietario + '</td>';
                tableHtml += '<td>' + row.localita + '</td>';
                tableHtml += '<td>' + row.emailAg + '</td>';
                tableHtml += '<td><button class="remove-button" data-agenzia-id="' + row.idAgenzia + '">Rimuovi Agenzia</button></td>';
                tableHtml += '</tr>';
            });

            tableHtml += '</table>';

            var mainContent = document.querySelector('.main');
            mainContent.innerHTML = tableHtml;

            var table = document.getElementById('agenzieTable');
            if (table) {
                table.addEventListener('click', function (e) {
                    var target = e.target;

                    if (target && target.classList.contains('remove-button')) {
                        var agenziaId = target.getAttribute('data-agenzia-id');

                        var isConfirmed = confirm('Sei sicuro di voler rimuovere questa agenzia?');
                        if (isConfirmed) {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    var response = JSON.parse(xhr.responseText);

                                    if (response.success) {
                                        createAndPopulateTable(response);
                                    } else {
                                        console.error(response.message);
                                    }
                                }
                            };
                            console.log(agenziaId);
                            xhr.open('GET', 'rimAgenz.php?remove_agenzia=' + agenziaId, true);
                            xhr.send();
                        }
                    }
                });
            } else {
                console.error('Table element not found');
            }
        }

        function getInitialData() {
            var xhrInitial = new XMLHttpRequest();
            xhrInitial.onreadystatechange = function () {
                if (xhrInitial.readyState === 4 && xhrInitial.status === 200) {
                    var response = JSON.parse(xhrInitial.responseText);

                    if (response.success) {
                        createAndPopulateTable(response);
                    } else {
                        console.error(response.message);
                    }
                }
            };

            xhrInitial.open('GET', 'rimAgenz.php', true);
            xhrInitial.send();
        }

        getInitialData();
    });
    </script>
</head>
<body>

<div class="header">
    <h1>AGENZIE IMMOBILIARI</h1>
</div>

<div class="main"></div>

<div class="buttons">
    <button onclick="location.href='adminPaginaH.php'">Torna alla Home</button>
</div>

</body>
</html>
