<?php
require_once 'inc/init.php';

if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'];

    // Préparation de la requête SQL pour récupérer les suggestions de produits
    $statement = $pdo->prepare("SELECT id_product, name FROM products WHERE name LIKE :searchTerm OR description LIKE :searchTerm LIMIT 10");
    $statement->execute(['searchTerm' => "%$searchTerm%"]);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Formatage des résultats pour l'autocomplétion
    $response = [];
    foreach ($results as $result) {
        $response[] = [
            'label' => $result['name'], // Champ 'label' utilisé par jQuery UI pour afficher les suggestions
            'value' => $result['id_product'], // Vous pouvez ajuster 'value' selon vos besoins
            'data' => $result // Ajoutez d'autres données si nécessaire
        ];
    }

    // Renvoyer les résultats au format JSON
    echo json_encode($response);
}
?>
