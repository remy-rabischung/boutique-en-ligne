<?php

require_once(__DIR__ . '/../classes/Database.php');

class Product{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function searchProduct($searchTerm){
        $statement = $this->database->pdo->prepare("SELECT * FROM produit WHERE nom LIKE :searchTerm OR description LIKE :searchTerm");
        $statement->execute(['searchTerm' => "%$searchTerm%"]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($results);
    }

    public function getAllProducts(){
        $sql = "SELECT * FROM produit";
        $stmt = $this->database->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getProductById($id){
        $sql = "SELECT * FROM produit WHERE id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    private function validateProduct($formData, $files, $withoutImage = false){
        $errors = [];

        if(!strlen($formData['name'])){
            $errors[] = 'Należy podać nazwe!';
        }
        if(!strlen($formData['description'])){
            $errors[] = 'Należy podać opis!';
        }
        if(!strlen($formData['price'])){
            $errors[] = 'Należy podać cene!';
        }
        elseif(!is_numeric($formData['price'])){
            $errors[] = 'Cena musi być liczbą!';
        }
        if(!strlen($formData['stock'])){
            $errors[] = 'Należy podać stan magazynowy!';
        }
        elseif(!is_numeric($formData['stock'])){
            $errors[] = 'Stan magazynowy musi być liczbą!';
        }
        if($files['image']['error'] !== 0 && !$withoutImage){
            $errors[] = 'Należy podać zdjęcie produktu!';
        }

        return $errors;

    }

    private function getFileName($file){
        $fileNameArray = explode('.', $file['name']);
        $ext = $fileNameArray[count($fileNameArray) - 1];

        return time() . '.' . $ext;
    }


    public function saveProduct($formData, $files){
        
        $errors = $this->validateProduct($formData, $files);
        if(count($errors)){
            return $errors;
        }

        $fileName = $this->getFileName($files['image']);
        move_uploaded_file($files['image']['tmp_name'], __DIR__ . '/../products_images/' . $fileName);

        $sql = "INSERT INTO produit (nom, description, prix, stock, image, id_categorie) VALUES (?,?,?,?,?,?)";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$formData['name'], $formData['description'], $formData['price'], $formData['stock'], $fileName, $formData['category_id']]);
    }

    public function updateProduct($product, $formData, $files){
        $errors = $this->validateProduct($formData, $files, true);
        if(count($errors)){
            return $errors;
        }

        $fileName = $product['image'];

        if($files['image']['error'] == 0){
            unlink( __DIR__ . '/../products_images/' . $fileName);

            $fileName = $this->getFileName($files['image']);
            move_uploaded_file($files['image']['tmp_name'], __DIR__ . '/../products_images/' . $fileName);
        }

        $sql = "UPDATE produit SET nom = ?, description = ?, prix = ?, stock = ?, image = ?, id_categorie = ? WHERE id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$formData['name'], $formData['description'], $formData['price'], $formData['stock'], $fileName, $formData['category_id'], $product['id']]);
    }

    public function deleteProduct($id){
        $product = $this->getProductById($id);
        unlink( __DIR__ . '/../products_images/' . $product['image']);

        $sql = "DELETE FROM produit WHERE id = ?";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getProductsByIds($ids){
        $idsString = str_repeat('?, ', count($ids) - 1) . '?';

        $sql = "SELECT * FROM produit WHERE id IN ($idsString)";
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute($ids);

        return $stmt->fetchAll();
    }
}