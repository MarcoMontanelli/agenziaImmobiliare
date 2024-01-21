<?php
$agencyId = $_GET['agencyId'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['agencyId'])) {
    $agencyId = $_GET['agencyId'];
    echo "
<script>
    document.addEventListener('DOMContentLoaded', function() {
        recuperaCodice();
        setInterval(verificaScadenzaCodice, 10000); // Esegui il controllo ogni 10 secondi
    });

    function recuperaCodice() {
        console.log('Recupera codice');
        var agencyId = $agencyId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('Codice di verifica: ' + this.responseText);
                alert('Il codice di verifica è: ' + this.responseText);
            }
        };
        xhttp.open('GET', 'get_verification_codeAg.php?agencyId=' + agencyId, true);
        xhttp.send();
    }

    function verificaScadenzaCodice() {
        console.log('scadenza');
        var agencyId = $agencyId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.trim() === 'scaduto') {
                    console.log('Codice scaduto');
                    alert('Il codice di verifica è scaduto. L\'account non è stato verificato.');
                    window.location.href = 'errore_codice_verifica.php'; // Reindirizza a una pagina di errore
                } else if (this.responseText.trim() === 'non_trovato') {
                    console.log('Nessun record trovato per l\'agenzia specificata.');
                    alert('Nessun record trovato per l\'agenzia specificata.');
                    window.location.href = 'errore_codice_verifica.php'; // Reindirizza a una pagina di errore
                }
            }
        };
        xhttp.open('GET', 'verifiy_agCode_expiry.php?agencyId=' + agencyId, true);
        xhttp.send();
    }
</script>
";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agencyId = $_POST['agencyId'];
    $verificationCode = $_POST['verificationCode'];

    $stmt = $conn->prepare("SELECT * FROM verificaAg WHERE id_agenzia = ? AND codiceVerifica = ? AND scadenza > NOW() AND verificato = 0 ORDER BY scadenza DESC LIMIT 1");
    $stmt->bind_param("is", $agencyId, $verificationCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica la validità del codice
        if ($row['scadenza'] > date('Y-m-d H:i:s')) {
            // Verification successful
            $stmtUpdate = $conn->prepare("UPDATE verificaAg SET verificato = 1 WHERE id_agenzia = ?");
            $stmtUpdate->bind_param("i", $agencyId);

            if ($stmtUpdate->execute()) {
                echo "Account verificato con successo!";
            } else {
                echo "Errore nell'aggiornamento dello stato di verifica: " . $stmtUpdate->error;
            }

            // Close the update statement
            $stmtUpdate->close();
        } else {
            $stmtRemove = $conn->prepare("DELETE FROM agenzia_immobiliare WHERE idAgenzia = ?");
            $stmtRemove->bind_param("i", $agencyId);
            $stmtRemove->execute();
            echo '<script>';
            echo 'console.log("rimosso");';
            echo '</script>';
            // Rimuovi l'entry dalla tabella verificaAg
            $stmtRemoveVerification = $conn->prepare("DELETE FROM verificaAg WHERE id_agenzia = ?");
            $stmtRemoveVerification->bind_param("i", $agencyId);
            $stmtRemoveVerification->execute();
            echo '<script>';
            echo 'console.log("rimosso due");';
            echo '</script>';
            echo "Il codice di verifica è scaduto. L'account non è stato verificato.";
        }

        // Close the select statement
        $stmt->close();
    } else {
        echo "Errore nella verifica dell'account. Assicurati di inserire il codice corretto o verifica se il codice è scaduto.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica Agenzia Immobiliare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #8f00ff;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 8px;
            margin-top: 16px;
        }

        input[type="submit"]:hover {
            background-color: #6a0099;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>Verifica Agenzia Immobiliare</h2>

            <input type="hidden" name="agencyId" value="<?php echo $agencyId; ?>">

            <label for="verificationCode">Codice di Verifica:</label>
            <input type="text" id="verificationCode" name="verificationCode" required>

            <input type="submit" value="Verifica">
        </form>
    </div>
</body>
</html>
