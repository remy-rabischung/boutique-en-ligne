<?php

require_once(__DIR__ . '/../classes/Database.php');

class Basket{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function isInBasket($user_id, $product_id){
        $sql = "SELECT * FROM panier WHERE user_id = ? AND product_id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id]);

        if(!$stmt->fetchColumn()){
            return false;
        }
        return true;
    }

    public function addToBasket($user_id, $product_id){
        $sql = "INSERT INTO panier (user_id, product_id) VALUES (?,?)";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id]);
    }

    public function removeFromBasket($user_id, $product_id){
        $sql = "DELETE FROM panier WHERE user_id = ? AND product_id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id]);
    }

    public function getUserBasket($user_id){
        $sql = "SELECT product_id FROM panier WHERE user_id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }

    public function createOrder($total, $user_id){
        $sql = "INSERT INTO commande (total, statut, id_utilisateur) VALUES (?,?,?)";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$total, 'paye', $user_id]);

        return $this->database->pdo->lastInsertId();
    }

    public function createOrderProducts($products, $quantity, $order_id){
        $sql = "INSERT INTO ligne_commande (quantite, prix_unitaire, id_commande, id_produit) VALUES (?, ?, ?, ?)";

        foreach($products as $key => $product){
            $stmt = $this->database->pdo->prepare($sql);
            $stmt->execute([$quantity[$key], $product['prix'], $order_id, $product['id']]);
        }

    }

    public function clearUserBasket($user_id){
        $sql = "DELETE FROM panier WHERE user_id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$user_id]);
    }

}