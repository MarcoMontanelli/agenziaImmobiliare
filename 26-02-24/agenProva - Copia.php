<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Annuncio</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #9a4ef2; 
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

form {
    background-color: #b57fff; 
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    box-sizing: border-box;
}

h2 {
    text-align: center;
    color: #ffffff; 
}

label {
    display: block;
    margin-bottom: 8px;
    color: #4a148c; 
}

textarea, input[type="text"], input[type="file"], input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #8f00ff; 
    color: #ffffff; 
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #4a148c; 
}

@media screen and (max-width: 600px) {
    form {
        max-width: 100%;
    }
}

#image-preview {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
    display: block;
}

.image-preview {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
    display: block; 
}
    </style>
    <script>
        function previewImages() {
            var input = document.getElementById('immagini');
            var previewContainer = document.getElementById('images-preview');
            previewContainer.innerHTML = '';

            for (var i = 0; i < input.files.length; i++) {
                var preview = document.createElement('img');
                preview.className = 'image-preview';
                previewContainer.appendChild(preview);

                var reader = new FileReader();
                reader.onload = (function (preview) {
                    return function (e) {
                        preview.src = e.target.result;
                    };
                })(preview);

                reader.readAsDataURL(input.files[i]);
            }
        }
    </script>
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ageziamontanelli";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $descrizione = $_POST["descrizione"];
        $titolo = $_POST["titolo"];

      
        $sql_annuncio = "INSERT INTO annuncio (descrizione, titolo) VALUES (:descrizione, :titolo)";
        $stmt_annuncio = $conn->prepare($sql_annuncio);
        $stmt_annuncio->bindParam(':descrizione', $descrizione);
        $stmt_annuncio->bindParam(':titolo', $titolo);
        $stmt_annuncio->execute();

       
        $lastInsertId = $conn->lastInsertId();

        
        $immagini = $_FILES["immagini"];

        foreach ($immagini["tmp_name"] as $key => $tmp_name) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($immagini["name"][$key]);
            move_uploaded_file($tmp_name, $target_file);

            $sql_immagine = "INSERT INTO immagine (pathImmagine, idAnnuncio) VALUES (:pathImmagine, :idAnnuncio)";
            $stmt_immagine = $conn->prepare($sql_immagine);
            $stmt_immagine->bindParam(':pathImmagine', $target_file);
            $stmt_immagine->bindParam(':idAnnuncio', $lastInsertId);
            $stmt_immagine->execute();
        }

        echo "<p>Annuncio e immagini aggiunti con successo!</p>";
        $conn = null;
    } catch (PDOException $e) {
        echo "<p>Errore durante l'aggiunta dell'annuncio: " . $e->getMessage() . "</p>";
    }
}
?>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <h2>Aggiungi Annuncio</h2>

        <label for="descrizione">Descrizione:</label>
        <textarea name="descrizione" rows="4" cols="50" required></textarea>

        <label for="titolo">Titolo:</label>
        <input type="text" name="titolo" required>

        <label for="immagini">Immagini:</label>
        <input type="file" name="immagini[]" id="immagini" accept="image/*" onchange="previewImages()" multiple required>
        <div id="images-preview"></div>

        <input type="submit" value="Aggiungi Annuncio">
    </form>
</body>

</html>

    
