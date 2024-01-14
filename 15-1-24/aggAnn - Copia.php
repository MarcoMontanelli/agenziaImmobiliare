<?php
// Connessione al database (da personalizzare con i tuoi dati)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if (!function_exists('aggiungiAnnuncio')) {
    // Funzione per aggiungere un annuncio
    function aggiungiAnnuncio($descrizione, $immagini, $titolo, $proprietàId, $nuovaProprietà, $nuovaProprietàNome) {
        global $conn;

        // Converti l'array di immagini in una stringa separata da virgole
        $immaginiString = implode(',', $immagini);

        // Se è stata selezionata una proprietà esistente, copia le sue caratteristiche nella descrizione
        if ($nuovaProprietà == "false") {
            $sqlProprietà = "SELECT descrizione FROM PROPRIETA' WHERE codiceCatastale = $proprietàId";
            $resultProprietà = $conn->query($sqlProprietà);
            if ($resultProprietà->num_rows > 0) {
                $rowProprietà = $resultProprietà->fetch_assoc();
                $descrizione .= "\n\nCaratteristiche della proprietà: " . $rowProprietà["descrizione"];
            }
        }

        // Esempio di inserimento nell'annuncio (assumendo che l'ID venga generato automaticamente)
        $sqlAnnuncio = "INSERT INTO ANNUNCIO (descrizione, titolo, immagini) VALUES ('$descrizione', '$titolo', '$immaginiString')";

        if ($conn->query($sqlAnnuncio) === TRUE) {
            $lastAnnuncioId = $conn->insert_id;

            // Se è stata selezionata una proprietà esistente, collega l'annuncio
            if ($nuovaProprietà == "false") {
                $sqlCollegamento = "INSERT INTO PUBBLICA (agenzia_id, annuncio_id) VALUES ($proprietàId, $lastAnnuncioId)";
                $conn->query($sqlCollegamento);
            } else {
                // Se è stata selezionata una nuova proprietà, inseriscila nel database
                $sqlNuovaProprietà = "INSERT INTO PROPRIETA' (codiceCatastale, nome) VALUES (NULL, '$nuovaProprietàNome')";
                $conn->query($sqlNuovaProprietà);
            }

            echo "Annuncio aggiunto con successo";
        } else {
            echo "Errore durante l'aggiunta dell'annuncio: " . $conn->error;
        }
    }
}

// Verifica se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni i dati dal modulo
    $descrizione = $_POST["descrizione"];
    $titolo = $_POST["titolo"];
    $proprietàId = $_POST["proprietà_id"];
    $nuovaProprietà = $_POST["nuova_proprietà"];
    $nuovaProprietàNome = $_POST["nuova_proprietà_nome"];

    // Gestione delle immagini
    $immagini = array();
    foreach ($_FILES["immagini"]["name"] as $key => $name) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["immagini"]["name"][$key]);
        move_uploaded_file($_FILES["immagini"]["tmp_name"][$key], $target_file);
        $immagini[] = $target_file;
    }

    // Chiamata alla funzione per aggiungere l'annuncio
    aggiungiAnnuncio($descrizione, $immagini, $titolo, $proprietàId, $nuovaProprietà, $nuovaProprietàNome);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aggiungi Annuncio</title>
    <style>
       
    </style>
</head>

<body>

    <h2>Aggiungi Annuncio</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Descrizione: <textarea name="descrizione" rows="4" cols="50"></textarea><br>
        Titolo: <input type="text" name="titolo"><br>
        Immagini: <input type="file" name="immagini[]" accept="image/*" multiple><br>

        <!-- Mostra le immagini caricate -->
        <?php
        if (!empty($immagini)) {
            foreach ($immagini as $immagine) {
                echo "<img src='$immagine' alt='Immagine caricata' style='width: 200px; height: auto;'>";
            }
        }
        ?>

        <!-- Scelta tra proprietà esistente e nuova -->
        <input type="checkbox" name="nuova_proprietà" value="true"> Creare nuova proprietà<br>

        <!-- Selezione proprietà esistente -->
        <label for="proprietà_id">Seleziona proprietà esistente:</label>
        <select name="proprietà_id">
            <!-- Opzioni di selezione delle proprietà esistenti dal database -->
            <?php
            // Query per ottenere le proprietà esistenti
            $sqlProprietà = "SELECT idAgenzia, nome FROM AGENZIA";
            $resultProprietà = $conn->query($sqlProprietà);

            if ($resultProprietà->num_rows > 0) {
                while ($rowProprietà = $resultProprietà->fetch_assoc()) {
                    echo "<option value='" . $rowProprietà["idAgenzia"] . "'>" . $rowProprietà["nome"] . "</option>";
                }
            }
            ?>
        </select>

        <input type="submit" value="Aggiungi Annuncio">
    </form>

</body>

</html>