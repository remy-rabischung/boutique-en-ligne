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

}