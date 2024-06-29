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
            $errors[] = 'Należy podać adres email!';
        }
        if(!strlen($formData->password)){
            $errors[] = 'Należy podać hasło!';
        }
        if(!strlen($formData->repeat_password)){
            $errors[] = 'Należy podać powtórzone hasło!';
        }
        if(!filter_var($formData->email, FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Podany email jest nieprawidłowy!';
        }
        if($formData->password !== $formData->repeat_password){
            $errors[] = 'Podane hasła różnią się!';
        }
        if(!strlen($formData->nick)){
            $errors[] = 'Należy podać nazwe użytkownika!';
        }
        if(!strlen($formData->name)){
            $errors[] = 'Należy podać imie!';
        }
        if(!strlen($formData->phone)){
            $errors[] = 'Należy podać telefon!';
        }
        if(!strlen($formData->address)){
            $errors[] = 'Należy podać adres!';
        }

        if(!count($errors)){
           if($this->checkEmailIsUsed($formData->email) !== 0){
                $errors[] = 'Istnieje uzytkownik z takim adresem email!';
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