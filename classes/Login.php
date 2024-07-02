<?php

require_once(__DIR__ . '/../classes/Database.php');

class Login{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    private function validateLogin($formData){
        $errors = [];

        if(!strlen($formData->email)){
            $errors[] = 'Należy podać adres email!';
        }
        if(!strlen($formData->password)){
            $errors[] = 'Należy podać hasło!';
        }

        if(!count($errors)){
            if(!$this->checkPasswordIsCorrect($formData->email, $formData->password)){
                $errors[] = 'Podany email lub hasło jest niepoprawny!';
            }
        }

        return $errors;
    }

    private function checkPasswordIsCorrect($email, $password){
        $user = $this->getUser($email);

        if(!$user){
            return false;
        }

        if(!password_verify($password, $user['mdp'])){
            return false;
        }

        return true;
    }
    
    private function getUser($email){
        $sql = 'SELECT id, email, mdp, admin FROM utilisateur WHERE email = ?';
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        return $user;
    }

    public function login($formData){
        $validationErrors = $this->validateLogin($formData);

        if(count($validationErrors)){
            echo json_encode(['errors' => $validationErrors, 'success' => false]);
            return;
        }

        echo json_encode([
            'errors' => [],
            'success' => true,
            'user' => $this->getUser($formData->email)
        ]);

    }
}