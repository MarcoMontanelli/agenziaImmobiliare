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
        .search-bar {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f2f2f2;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .search-bar select, .search-bar input, .search-bar button {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-bar select {
            width: 120px;
            background-color: #8f00ff;
            color: white;
        }

        .search-bar button {
            background-color: #8f00ff; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #6a0099; 
        }

        .annuncio-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .annuncio-list h2 {
            width: 100%;
            text-align: center;
        }

        .annuncio-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            max-width: 300px;
            text-align: center;
            border-radius: 10px;
        }

        .annuncio-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
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
<div class="search-bar">
    <select id="searchCategory">
        <option value="proprieta">proprieta</option>
        <option value="agenzia">agenzia</option>
        <option value="annuncio">annuncio</option>
        <!-- Add more options based on your schema -->
    </select>
    <input type="text" id="searchInput" placeholder="Search...">
    <button onclick="search()">Search</button>
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

<div class="annuncio-list">
    <h2>Gli Ultimi Annunci</h2>
    <?php
    // Connessione al database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ageziamontanelli";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    // Query per recuperare tutti gli annunci
    $sql = "SELECT * FROM annuncio";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="annuncio-card">';
            echo '<h3>' . $row['titolo'] . '</h3>';
            echo '<p>' . $row['descrizione'] . '</p>';
            
            // Aggiungi l'immagine sotto il titolo e la descrizione
            echo '<img src="' . $row['immagine'] . '" alt="Immagine Annuncio">';

            // Aggiungi altri campi che desideri visualizzare
            echo '</div>';
        }
    } else {
        echo 'Nessun annuncio trovato.';
    }

    $conn->close();
    ?>
</div>
<script>
function search() {
    var searchCategory = document.getElementById('searchCategory').value;
    var searchInput = document.getElementById('searchInput').value;

    // Redirect to the search page with the search parameters
    window.location.href = `searchPage.php?keys=${searchCategory}&query=${encodeURIComponent(searchInput)}`;
}
</script>

</body>
</html>
