<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_admin'])) {
    $adminId = $_GET['remove_admin'];

    
    $sql_remove_admin = "DELETE FROM admin WHERE idAdmin = ?";
    $stmt = $conn->prepare($sql_remove_admin);
    $stmt->bind_param("s", $adminId);

    if ($stmt->execute()) {
        
        $sql_admins = "SELECT * FROM admin";
        $result_admins = $conn->query($sql_admins);

        
        $rows = array();
        while ($row = $result_admins->fetch_assoc()) {
            $rows[] = $row;
        }

        $response = array("success" => true, "message" => "Admin rimosso con successo.", 'data' => $rows);
    } else {
        $response = array("success" => false, "message" => "Errore nella rimozione dell'admin: " . $stmt->error);
    }

    $stmt->close();
} else {
    
    $sql_admins_initial = "SELECT * FROM admin";
    $result_admins_initial = $conn->query($sql_admins_initial);

    
    $rows = array();
    while ($row = $result_admins_initial->fetch_assoc()) {
        $rows[] = $row;
    }

    $response = array("success" => true, "message" => "Dati ottenuti con successo.", 'data' => $rows);
}


header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
