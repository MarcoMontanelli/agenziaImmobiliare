<?php
// Database connection setup
// Replace placeholders with your actual database details
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

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch all dates with scheduled visits
$stmt = $pdo->query("SELECT DISTINCT dataM FROM visita");
$bookedDates = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($bookedDates);
?>