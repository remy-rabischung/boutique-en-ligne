<?php

require_once(__DIR__ . '/../classes/Database.php');

class Order{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function getUserOrders($user_id){
        $sql = "SELECT * FROM commande WHERE commande.id_utilisateur = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }

    public function getProductsForOrder($order_id){
        $sql = "SELECT * FROM ligne_commande WHERE id_commande = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$order_id]);

        return $stmt->fetchAll();
    }

}