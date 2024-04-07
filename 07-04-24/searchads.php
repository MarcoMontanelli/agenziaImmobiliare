<?php
// Assuming connection setup is done
$pdo = new PDO('mysql:host=localhost;dbname=ageziamontanelli', 'root', '');

// Retrieve form data
$drawnShape = isset($_POST['drawnShape']) ? $_POST['drawnShape'] : '';
$size = $_POST['size'] ?? '';
$priceRange = $_POST['priceRange'] ?? 0;
$yearCompletion = $_POST['yearCompletion'] ?? '';
$classEnergetgetica = $_POST['classEnergetica'] ?? '';
$features = $_POST['features'] ?? [];

// Prepare SQL base
$sql = "SELECT * FROM properties WHERE 1=1";

// Filter by size
if (!empty($size)) {
$sql .= " AND size >= :size";
}

// Filter by price range
if (!empty($priceRange)) {
$sql .= " AND price <= :priceRange";
}

// Filter by year of completion
if (!empty($yearCompletion)) {
$sql .= " AND yearCompletion >= :yearCompletion";
}

// Filter by class energetica
if (!empty($classEnergetica)) {
$sql .= " AND classEnergetica = :classEnergetica";
}

// Assuming your features are stored in a way that they can be filtered like this
foreach ($features as $feature) {
$sql .= " AND features LIKE :$feature"; // Ensure your database schema supports this kind of query
}

$stmt = $pdo->prepare($sql);

// Binding parameters
if (!empty($size)) {
$stmt->bindParam(':size', $size, PDO::PARAM_INT);
}
if (!empty($priceRange)) {
$stmt->bindParam(':priceRange', $priceRange, PDO::PARAM_INT);
}
if (!empty($yearCompletion)) {
$stmt->bindParam(':yearCompletion', $yearCompletion, PDO::PARAM_INT);
}
if (!empty($classEnergetica)) {
$stmt->bindParam(':classEnergetica', $classEnergetica, PDO::PARAM_STR);
}
foreach ($features as $feature) {
$stmt->bindValue(":$feature", "%$feature%", PDO::PARAM_STR); // This is a simplistic approach; adjust as necessary
}

// Execute the query
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// You might want to return JSON for your AJAX call to handle
echo json_encode($results);
?>