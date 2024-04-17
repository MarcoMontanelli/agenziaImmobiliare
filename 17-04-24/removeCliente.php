<!DOCTYPE html>
<html lang="en">
<head>
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
            var tableHtml = '<table id="clientiTable">';
            tableHtml += '<tr>';
            tableHtml += '<th>ID Cliente</th>';
            tableHtml += '<th>Nome</th>';
            tableHtml += '<th>Ragione Sociale</th>';
            tableHtml += '<th>Numero Telefono</th>';
            tableHtml += '<th>Email</th>';
            tableHtml += '<th>Preferiti</th>';
            tableHtml += '<th>Email Cliente</th>';
            tableHtml += '<th>Azione Cliente</th>';
            tableHtml += '</tr>';

            data.data.forEach(function (row) {
                tableHtml += '<tr>';
                tableHtml += '<td>' + row.idCliente + '</td>';
                tableHtml += '<td>' + row.nome + '</td>';
                tableHtml += '<td>' + row.ragioneSociale + '</td>';
                tableHtml += '<td>' + row.numeroTelefono + '</td>';
                tableHtml += '<td>' + row.email + '</td>';
                tableHtml += '<td>' + row.preferiti + '</td>';
                tableHtml += '<td>' + row.emailC + '</td>';
                tableHtml += '<td><button class="remove-button" data-cliente-id="' + row.idCliente + '">Rimuovi Cliente</button></td>';
                tableHtml += '</tr>';
            });

            tableHtml += '</table>';

            var mainContent = document.querySelector('.main');
            mainContent.innerHTML = tableHtml;

            var table = document.getElementById('clientiTable');
            if (table) {
                table.addEventListener('click', function (e) {
                    var target = e.target;

                    if (target && target.classList.contains('remove-button')) {
                        var clienteId = target.getAttribute('data-cliente-id');

                        var isConfirmed = confirm('Sei sicuro di voler rimuovere questo cliente?');
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

                            xhr.open('GET', 'rimCliente.php?remove_cliente=' + clienteId, true);
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

            xhrInitial.open('GET', 'rimCliente.php', true);
            xhrInitial.send();
        }

        getInitialData();
    });
    </script>
</head>
<body>

<div class="header">
    <h1>CLIENTI</h1>
</div>

<div class="main"></div>

<div class="buttons">
    <button onclick="location.href='adminPaginaH.php'">Torna alla Home</button>
</div>

</body>
</html>