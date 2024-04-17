<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
   
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

        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        tr.selected {
            background-color: #cce5ff;
        }
    </style>

 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            function createAndPopulateTable(data) {
                var tableHtml = '<table id="adminTable">';
                tableHtml += '<tr>';
                tableHtml += '<th>Nome</th>';
                tableHtml += '<th>Località</th>';
                tableHtml += '<th>Tipo</th>';
                tableHtml += '<th>ID Agenzia</th>';
                tableHtml += '<th>Email Agenzia</th>';
                tableHtml += '<th>Password Agenzia</th>';
                tableHtml += '<th>Email</th>';
                tableHtml += '<th>Password</th>';
                tableHtml += '<th>Azione Admin</th>';
                tableHtml += '</tr>';

                data.data.forEach(function (row) {
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + row.nome + '</td>';
                    tableHtml += '<td>' + row.località + '</td>';
                    tableHtml += '<td>' + row.tipo + '</td>';
                    tableHtml += '<td>' + row.id_agenzia + '</td>';
                    tableHtml += '<td>' + row.emailA + '</td>';
                    tableHtml += '<td>' + row.passA + '</td>';
                    tableHtml += '<td>' + row.email + '</td>';
                    tableHtml += '<td>' + row.pass + '</td>';
                    tableHtml += '<td><button class="remove-button" data-admin-id="' + row.idAdmin + '">Rimuovi Admin</button></td>';
                    tableHtml += '</tr>';
                });

                tableHtml += '</table>';

               
                var mainContent = document.querySelector('.main');
                mainContent.innerHTML = tableHtml;

                
                var table = document.getElementById('adminTable');
                if (table) {
                    table.addEventListener('click', function (e) {
                        var target = e.target;

                        if (target && target.classList.contains('remove-button')) {
                            var adminId = target.getAttribute('data-admin-id');

                            
                            var isConfirmed = confirm('Sei sicuro di voler rimuovere questo admin?');
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

                                
                                xhr.open('GET', 'rimAdmin.php?remove_admin=' + adminId, true);
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

               
                xhrInitial.open('GET', 'rimAdmin.php', true);
                xhrInitial.send();
            }

           
            getInitialData();
        });
    </script>
</head>
<body>

<div class="header">
    <h1>ADMIN</h1>
</div>

<div class="main"></div>

<div class="buttons">
    <button onclick="location.href='adminPaginaH.php'">Torna alla Home</button>
</div>

</body>
</html>