<?php
session_start();

// Check user type and ID
$userType = $_SESSION['user_type'] ?? $_COOKIE['user_type'] ?? '';
$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? '';

if ($userType !== 'client' || empty($userId)) {
    echo "<p>Accesso non autorizzato. Verrai reindirizzato alla pagina di login.</p>";
    header("Refresh: 3; url=loginup.php");
    exit;
}

// Assuming you have the announcement ID from a form submission
$idAnnuncioIr = $_POST['idAnnuncioIr'] ?? '';

if (!empty($idAnnuncioIr)) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ageziamontanelli', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert into preferiti table
        $sql = "INSERT INTO preferiti (idCliente, idAnnuncioIr) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $idAnnuncioIr]);

        
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }
} else {
    echo "<p>ID annuncio non specificato.</p>";
}
?>
