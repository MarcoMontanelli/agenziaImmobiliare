<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proprietari</title>
    
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
        var tableHtml = '<table id="proprietariTable">';
        tableHtml += '<tr>';
        tableHtml += '<th>Codice Fiscale</th>';
        tableHtml += '<th>Nome</th>';
        tableHtml += '<th>Numero Telefono</th>';
        tableHtml += '<th>Email</th>';
        tableHtml += '<th>Note</th>';
        tableHtml += '<th>Azione Proprietario</th>';
        tableHtml += '</tr>';

        data.data.forEach(function (row) {
            tableHtml += '<tr>';
            tableHtml += '<td>' + row.codiceFiscale + '</td>';
            tableHtml += '<td>' + row.nome + '</td>';
            tableHtml += '<td>' + row.numeroTelefono + '</td>';
            tableHtml += '<td>' + row.email + '</td>';
            tableHtml += '<td>' + row.note + '</td>';
            tableHtml += '<td><button class="remove-button" data-proprietario-cf="' + row.codiceFiscale + '">Rimuovi Proprietario</button></td>';
            tableHtml += '</tr>';
        });

        tableHtml += '</table>';

        
        var mainContent = document.querySelector('.main');
        mainContent.innerHTML = tableHtml;

        
        var table = document.getElementById('proprietariTable');
        if (table) {
            table.addEventListener('click', function (e) {
                var target = e.target;

                if (target && target.classList.contains('remove-button')) {
                    var proprietarioCF = target.getAttribute('data-proprietario-cf');

                    
                    var isConfirmed = confirm('Sei sicuro di voler rimuovere questo proprietario?');
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

                        
                        xhr.open('GET', 'rimProprietario.php?remove_proprietario=' + proprietarioCF, true);
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

        
        xhrInitial.open('GET', 'rimProprietario.php', true);
        xhrInitial.send();
    }

   
    getInitialData();
});
    </script>
</head>
<body>

<div class="header">
    <h1>PROPRIETARI</h1>
</div>

<div class="main"></div>

<div class="buttons">
    <button onclick="location.href='debugPage.php'">Torna alla Home</button>
</div>

</body>
</html>
