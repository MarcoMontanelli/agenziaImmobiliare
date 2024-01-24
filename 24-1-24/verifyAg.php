<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$agencyId = $_GET['agencyId'] ?? null;

if (!$agencyId) {
    
    header("Location: debugPage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verificationCode = $_POST['verificationCode'];

    
    $stmtCheckVerification = $conn->prepare("SELECT * FROM verificaAg WHERE id_agenziap = ? AND codiceVerifica = ? AND scadenza > NOW()");
    $stmtCheckVerification->bind_param("is", $agencyId, $verificationCode);
    $stmtCheckVerification->execute();
    $result = $stmtCheckVerification->get_result();

    if ($result->num_rows > 0) {
        
        $stmtDeleteVerification = $conn->prepare("DELETE FROM verificaAg WHERE id_agenziap = ?");
        $stmtDeleteVerification->bind_param("i", $agencyId);
        $stmtDeleteVerification->execute();

        
        $stmtDeleteTemp = $conn->prepare("DELETE FROM agenziaprovvisoria WHERE idAgenziap = ?");
        $stmtDeleteTemp->bind_param("i", $agencyId);
        $stmtDeleteTemp->execute();

        
        $stmtMoveToPermanent = $conn->prepare("INSERT INTO agenzia_immobiliare SELECT * FROM agenziaprovvisoria WHERE idAgenziap = ?");
        $stmtMoveToPermanent->bind_param("i", $agencyId);
        $stmtMoveToPermanent->execute();

        echo "Verification successful! Redirecting to home...";
        header("Refresh: 3; URL=debugPage.php");
        exit();
    } else {
        echo "Verification failed. Please try again.";
    }
}
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
        <form action="" method="post" id="verificationForm">
            <h2>Verifica Agenzia Immobiliare</h2>

            <input type="hidden" name="agencyId" value="<?php echo $agencyId; ?>">

            <label for="verificationCode">Codice di Verifica:</label>
            <input type="text" id="verificationCode" name="verificationCode" required>

            <input type="submit" value="Verifica">
        </form>

</body>
</html>
