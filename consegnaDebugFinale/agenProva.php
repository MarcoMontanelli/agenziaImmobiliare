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

        textarea, input[type="text"], input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
       //css base per la pagina, in modo che sia formattata correttamente
       //funzione per vedere la preview dell'immagine dell'annuncio 
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
<?php
// Gestione del modulo di invio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Modifica le informazioni di connessione al database
    $servername = "localhost";
    $username = "root"; // Inserisci il tuo nome utente di MySQL
    $password = "";     // Inserisci la tua password di MySQL
    $dbname = "ageziamontanelli";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recupera i dati dal modulo
        $descrizione = $_POST["descrizione"];
        $titolo = $_POST["titolo"];

        // Esempio di upload di un'immagine (assumi che sia stata caricata)
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["immagine"]["name"]);
        move_uploaded_file($_FILES["immagine"]["tmp_name"], $target_file);

        // Assicurati di effettuare la validazione dei dati e la gestione degli errori

        // Esempio di inserimento dei dati nel database
        $sql = "INSERT INTO annuncio (descrizione, titolo, immagine) VALUES (:descrizione, :titolo, :immagine)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':descrizione', $descrizione);
        $stmt->bindParam(':titolo', $titolo);
        $stmt->bindParam(':immagine', $target_file);
        $stmt->execute();

        echo "<p>Annuncio aggiunto con successo!</p>";

        // Chiudi la connessione al database
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

        <label for="immagine">Immagine:</label>
        <input type="file" name="immagine" id="immagine" accept="image/*" onchange="previewImage()" required>
        <img id="image-preview" alt="Anteprima Immagine">

        <input type="submit" value="Aggiungi Annuncio">
    </form>
</body>
</html>