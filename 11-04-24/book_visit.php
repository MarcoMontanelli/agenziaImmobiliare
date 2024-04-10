<?php
// Database connection setup
$host = 'localhost';
$db = 'ageziamontanelli';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Attempt to establish a connection to the database
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Retrieve data from POST request
$userId = $_POST['userId'] ?? '';
$announcementId = $_POST['announcementId'] ?? '';
$date = $_POST['date'] ?? '';

// Validate the input
if (empty($userId) || empty($announcementId) || empty($date)) {
    echo json_encode(['error' => 'Missing required parameters']);
    exit;
}

// You should add additional validation and sanitization here

// Prepare the SQL statement to insert the new booking
$sql = "INSERT INTO visita (id_cliente, dataM, idAnnuncioIr_FK) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$userId, $date, $announcementId]);
    echo json_encode(['success' => 'Booking successful']);
} catch (\PDOException $e) {
    // Handle SQL errors or conflicts, e.g., duplicate bookings
    echo json_encode(['error' => 'Failed to book visit: ' . $e->getMessage()]);
}
?>
