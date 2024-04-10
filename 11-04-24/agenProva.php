<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Annuncio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        textarea, input[type="text"], input[type="file"], input[type="submit"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], button {
            background-color: #8f00ff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #6a0099;
        }

        button {
            border: none;
            border-radius: 4px;
            padding: 8px;
            margin: 0 auto;
            display: block;
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
            display: none;
        }
    </style>
    <script>
        function previewImage() {
            var input = document.getElementById('immagine');
            var preview = document.getElementById('image-preview');

            preview.style.display = 'block';

            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <h2>Aggiungi Annuncio</h2>

        <label for="descrizione">Descrizione:</label>
        <textarea name="descrizione" rows="4" cols="50" required></textarea>

        <label for="titolo">Titolo:</label>
        <input type="text" name="titolo" required>

        <label for="immagine">Immagine:</label>
        <input type="file" name="immagine" id="immagine" accept="image/*" onchange="previewImage()" required>
        <img id="image-preview" alt="Anteprima Immagine">

        <input type="submit" value="Aggiungi Annuncio">
        <button onclick="location.href='debugPage.php'">Torna alla home</button>
    </form>
    
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $descrizione = $_POST["descrizione"];
        $titolo = $_POST["titolo"];

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["immagine"]["name"]);
        move_uploaded_file($_FILES["immagine"]["tmp_name"], $target_file);

        $sql = "INSERT INTO annuncio (descrizione, titolo, immagine) VALUES (:descrizione, :titolo, :immagine)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':descrizione', $descrizione);
        $stmt->bindParam(':titolo', $titolo);
        $stmt->bindParam(':immagine', $target_file);
        $stmt->execute();

        echo "<p>Annuncio aggiunto con successo!</p>";
    }
} catch (PDOException $e) {
    echo "<p>Errore durante l'aggiunta dell'annuncio: " . $e->getMessage() . "</p>";
}

$conn = null;
?>