<?php

require_once(__DIR__ . '/../classes/Database.php');

class Register{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    private function registerValidation($formData){
        $errors = [];

        if(!strlen($formData->email)){
            $errors[] = 'You must provide an email address!';
        }
        if(!strlen($formData->password)){
            $errors[] = 'You must provide a password!';
        }
        if(!strlen($formData->repeat_password)){
            $errors[] = 'You must provide a password again!';
        }
        if(!filter_var($formData->email, FILTER_VALIDATE_EMAIL)){
            $errors[] = 'The provided email is invalid!';
        }
        if($formData->password !== $formData->repeat_password){
            $errors[] = 'The passwords you provided do not match!';
        }
        if(!strlen($formData->nick)){
            $errors[] = 'You must provide a user nick!';
        }
        if(!strlen($formData->name)){
            $errors[] = 'You must provide the name!';
        }
        if(!strlen($formData->phone)){
            $errors[] = 'You must provided a phone number!';
        }
        if(!strlen($formData->address)){
            $errors[] = 'You must provide an addresse!';
        }

        if(!count($errors)){
           if($this->checkEmailIsUsed($formData->email) !== 0){
                $errors[] = 'There is already a user with this email address!';
           }
        }

        return $errors;
    }

    private function checkEmailIsUsed($email){
        $sql = 'SELECT count(email) FROM utilisateur WHERE email = ?';
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$email]);
        
        return $stmt->fetchColumn();
    }

    private function saveUserToDB($formData){
        $sql = 'INSERT INTO utilisateur (nom, prenom, email, mdp, adresse, tel) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->database->pdo->prepare($sql);
        $stmt->execute([$formData->nick, $formData->name, $formData->email, password_hash($formData->password, PASSWORD_BCRYPT), $formData->address, $formData->phone]);
    }

    public function register($formData){
        $validationErrors = $this->registerValidation($formData);

        if(count($validationErrors)){
            echo json_encode(['errors' => $validationErrors, 'success' => false]);
            return;
        }

        $this->saveUserToDB($formData);
    
        echo json_encode([
            'errors' => [],
            'success' => true
        ]);
    }
}