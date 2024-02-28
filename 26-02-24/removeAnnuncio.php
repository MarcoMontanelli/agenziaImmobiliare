<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annunci</title>
    
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
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-collapse: collapse;
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
                var tableHtml = '<table id="annunciTable">';
                tableHtml += '<tr>';
                tableHtml += '<th>ID Annuncio</th>';
                tableHtml += '<th>Descrizione</th>';
                tableHtml += '<th>Immagine</th>';
                tableHtml += '<th>Titolo</th>';
                tableHtml += '<th>Immagini</th>';
                tableHtml += '<th>Azione Annuncio</th>';
                tableHtml += '</tr>';

                data.data.forEach(function (row) {
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + row.idAnnuncio + '</td>';
                    tableHtml += '<td>' + row.descrizione + '</td>';
                    tableHtml += '<td><img src="' + row.immagine + '" alt="Immagine annuncio" style="max-width: 100px; max-height: 100px;"></td>';
                    tableHtml += '<td>' + row.titolo + '</td>';
                    tableHtml += '<td>' + row.immagini + '</td>';
                    tableHtml += '<td><button class="remove-button" data-annuncio-id="' + row.idAnnuncio + '">Rimuovi Annuncio</button></td>';
                    tableHtml += '</tr>';
                });

                tableHtml += '</table>';

                
                var mainContent = document.querySelector('.main');
                mainContent.innerHTML = tableHtml;

                
                var table = document.getElementById('annunciTable');
                if (table) {
                    table.addEventListener('click', function (e) {
                        var target = e.target;

                        if (target && target.classList.contains('remove-button')) {
                            var annuncioId = target.getAttribute('data-annuncio-id');

                            
                            var isConfirmed = confirm('Sei sicuro di voler rimuovere questo annuncio?');
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

                                
                                xhr.open('GET', 'rimAnnuncio.php?remove_annuncio=' + annuncioId, true);
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

                
                xhrInitial.open('GET', 'rimAnnuncio.php', true);
                xhrInitial.send();
            }

         
            getInitialData();
        });
    </script>
</head>
<body>

<div class="header">
    <h1>ANNUNCI</h1>
</div>

<div class="main"></div>

<div class="buttons">
    <button onclick="location.href='debugPage.php'">Torna alla Home</button>
</div>

</body>
</html>
