<?php

require_once(__DIR__ . '/../classes/Database.php');

class Category{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function saveCategory($category_name, $category_parent){
        $sql = 'INSERT INTO categorie (nom, parent) VALUES (?, ?)';
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$category_name, $category_parent]);
    }

    public function getAllCategories(){
        $sql = 'SELECT * FROM categorie';
        $stmt = $this->database->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getCategoriesWithChildren($parent = 0){
        $sql = "SELECT * FROM categorie WHERE parent = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$parent]);
        $categories = $stmt->fetchAll();

        foreach($categories as $key => $category){
            $categories[$key]['children'] = $this->getCategoriesWithChildren($category['id']);
        }

        return $categories;
    }


    public function getCategoryById($id){
        $sql = "SELECT * FROM categorie WHERE id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function editCategory($category_id, $category_name, $category_parent){
        $sql = "UPDATE categorie SET nom = ?, parent = ? WHERE id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$category_name, $category_parent, $category_id]);
    }
     
    public function deleteCategory($id){
        $children = $this->getCategoriesWithChildren($id);
        var_dump($this->getAllChildrenId())

        $ids = [];



        var_dump($children);
    }
}