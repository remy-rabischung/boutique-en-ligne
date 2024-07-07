<?php
require_once 'config/DBconfig.php';

$searchTerm = $_GET['query'];
$statement = $pdo->prepare("SELECT * FROM products WHERE name LIKE :searchTerm OR description LIKE :searchTerm");
$statement->execute(['searchTerm' => "%$searchTerm%"]);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
?>



