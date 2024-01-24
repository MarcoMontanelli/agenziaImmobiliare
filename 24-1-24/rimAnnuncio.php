<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_annuncio'])) {
    $annuncio_id = $_GET['remove_annuncio'];

    
    $sql_remove_annuncio = "DELETE FROM ANNUNCIO WHERE idAnnuncio = ?";
    $stmt = $conn->prepare($sql_remove_annuncio);
    $stmt->bind_param("i", $annuncio_id);

    if ($stmt->execute()) {
        
        $sql_annunci = "SELECT * FROM ANNUNCIO";
        $result_annunci = $conn->query($sql_annunci);

        
        $rows = array();
        while ($row = $result_annunci->fetch_assoc()) {
            $rows[] = $row;
        }

        $response = array("success" => true, "message" => "Annuncio rimosso con successo.", 'data' => $rows);
    } else {
        $response = array("success" => false, "message" => "Errore nella rimozione dell'annuncio: " . $stmt->error);
    }

    $stmt->close();
} else {
    
    $sql_annunci_initial = "SELECT * FROM ANNUNCIO";
    $result_annunci_initial = $conn->query($sql_annunci_initial);

    
    $rows = array();
    while ($row = $result_annunci_initial->fetch_assoc()) {
        $rows[] = $row;
    }

    $response = array("success" => true, "message" => "Dati ottenuti con successo.", 'data' => $rows);
}


header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>