<?php
// Connessione al database (da personalizzare con i tuoi dati)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Gestione del submit del form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST["titolo"];
    $descrizione = $_POST["descrizione"];
    $immagini = []; // Array per gestire il percorso delle immagini caricate
    $proprietà_id = null;

    if (isset($_POST["proprietà_esistente"])) {
        $proprietà_id = $_POST["proprietà_esistente"];
    } else {
        // Inserimento della nuova proprietà nel database
        $codiceCatastale = $_POST["codiceCatastale"];
        $dimensioni = $_POST["dimensioni"];
        $note = $_POST["note"];
        $indirizzo = $_POST["indirizzo"];
        $comune = $_POST["comune"];
        $prezzo = $_POST["prezzo"];
        $tipo = $_POST["tipo"];

        $query = "INSERT INTO PROPRIETA (codiceCatastale, dimensioni, note, indirizzo, comune, prezzo, tipo) VALUES ('$codiceCatastale', '$dimensioni', '$note', '$indirizzo', '$comune', '$prezzo', '$tipo')";
        $result = $conn->query($query);

        if ($result) {
            $proprietà_id = $conn->insert_id;
        } else {
            echo "Errore durante l'inserimento della proprietà nel database: " . $conn->error;
        }
    }

    // Handle file uploads
    $targetFolder = "uploads/";

    foreach ($_FILES["immagini"]["tmp_name"] as $key => $tmp_name) {
        $targetFile = $targetFolder . basename($_FILES["immagini"]["name"][$key]);

        if (move_uploaded_file($tmp_name, $targetFile)) {
            $immagini[] = $targetFile;
        } else {
            echo "Failed to upload file.";
        }
    }

    // Inserimento dell'annuncio nel database
    $immaginiJson = json_encode($immagini); // Convert the array to JSON to store in the database
    $query = "INSERT INTO ANNUNCIO (titolo, descrizione, immagini, proprietà_id) VALUES ('$titolo', '$descrizione', '$immaginiJson', '$proprietà_id')";
    $result = $conn->query($query);

    if ($result) {
        echo "Annuncio inserito con successo!";
    } else {
        echo "Errore durante l'inserimento dell'annuncio nel database: " . $conn->error;
    }
}

// Chiusura della connessione al database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Annuncio</title>
</head>
<body>

<h2>Aggiungi Annuncio</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <label for="titolo">Titolo:</label>
    <input type="text" name="titolo" required><br>

    <label for="descrizione">Descrizione:</label>
    <textarea name="descrizione" required></textarea><br>

    <input type="radio" name="proprietà_esistente" value="1"> Seleziona Proprietà Esistente<br>
    <input type="radio" name="proprietà_esistente" value="0"> Crea Nuova Proprietà<br>

    <!-- Campi per la nuova proprietà -->
    <div id="nuova_proprietà" style="display: none;">
        <!-- Aggiungi campi per la nuova proprietà (codiceCatastale, dimensioni, note, indirizzo, comune, prezzo, tipo) -->
    </div>

    <label for="immagini">Carica Immagini:</label>
    <input type="file" name="immagini[]" multiple accept="image/*"><br>

    <input type="submit" value="Aggiungi Annuncio">
</form>

<script>
    // Mostra/nascondi campi per la nuova proprietà in base alla scelta dell'utente
    document.querySelectorAll('input[name="proprietà_esistente"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.getElementById('nuova_proprietà').style.display = (this.value === '0') ? 'block' : 'none';
        });
    });
</script>

</body>
</html>