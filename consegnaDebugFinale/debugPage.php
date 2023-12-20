<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agenzia debug</title>
    <style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
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
    padding: 10px 20px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.buttons button:hover {
    background-color: #6a0099; 
}

.main {
    text-align: center;
    margin: 20px;
}

.main button {
    background-color: #8f00ff; 
    color: white;
    padding: 15px 30px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.main button:hover {
    background-color: #6a0099; 
}
    </style>
</head>
<body>

<div class="header">
    <h1>PROVA ALCUNE FUNZIONALITA' CRUD DI BASE</h1>
    <div class="buttons">
        <button onclick="location.href='register.php'">Registra Agenzia</button>
        <button onclick="location.href='registerC.php'">Registra Cliente</button>
        <button onclick="location.href='registerA.php'">Registra Admin</button>
        <button onclick="location.href='login.php'">Log In</button>
    </div>
</div>

<div class="main">
    <button onclick="location.href='agenProva.php'">Aggiungi Annuncio</button>
    <button onclick="location.href='debugPage - Copia.php'">Aggiungi Proprietario</button>
    <button onclick="location.href='regProp.php'">Aggiungi Proprietà</button>
    <button onclick="location.href='rimAnnuncio.php'">rimuovi annuncio</button>
    <button onclick="location.href='rimProprietario.php'">rimuovi proprietario</button>
    <button onclick="location.href='rimuoviProprietà.php'">rimuovi proprietà</button>
    <button onclick="location.href='rimAdmin.php'">rimuovi admin</button>
    <button onclick="location.href='rimClienti.php'">rimuovi clienti</button>
    <button onclick="location.href='rimAgenz.php'">rimuovi agenzie</button>
</div>

</body>
</html>