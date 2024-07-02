<?php

require_once("inc/init.php");

$error = "";
$content = "";
$registrationDone = false;

if($_POST) {

    if (strlen($_POST["pseudo"]) < 3 || strlen($_POST["pseudo"]) > 20) {
        $error .= "<div class='alert alert-warning' role='alert'>
            Veuillez entrer un pseudo compris entre 3 et 20 caractères
        </div>";
    }

    if(!ctype_alnum($_POST["pseudo"])) {
        $error .= "<div class='alert alert-warning' role='alert'>
            Veuillez entrer un pseudo composé uniquement de lettres et/ou de chiffres
        </div>";
    }

    if(empty($error)) {

        foreach($_POST as $index => $value) {
            $_POST[$index] = addslashes($value);
        }
    
        $_POST["pwd"] = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    
        $count = $pdo->exec("INSERT INTO members (pseudo, password, name, first_name, email, sexe, city, 
        postal_code, address, status) 
        VALUES(
            '$_POST[pseudo]',
            '$_POST[pwd]',
            '$_POST[name]',
            '$_POST[first_name]',
            '$_POST[email]',
            '$_POST[sexe]',
            '$_POST[city]',
            '$_POST[postal_code]',
            '$_POST[address]',
            2
        ) ");
    
        if($count > 0) {
            $content .= "<div class='alert alert-success' role='alert'>
            Votre compte a bien été crée !
            </div>";

            $registrationDone = true;
            $content .= "<a href='connexion.php'>Se connecter</a>";

        }

    }

}

require_once("inc/header.php");

?>

<!-- Body content -->

    <?php if(!empty($error)) { 
        echo $error;
    } 
    if ($registrationDone) {
        echo $content;
    }
    else { ?>
        
        <div class="col-md-12">
            <form method="POST" action="" class="form-row">
                <!-- PSEUDO -->
                <div class="form-group col-md-6">
                    <label for="pseudo">Pseudo:</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="pseudo" placeholder="Enter your pseudo">
                </div>
                <!-- PASSWORD -->
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="pwd" id="password" placeholder="Enter your password">
                </div>
                <!-- Last Name -->
                <div class="form-group col-md-3">
                    <label for="lasttName">Nom de famille</label>
                    <input type="text" class="form-control" name="name" id="lastName" placeholder="Enter your last name">
                </div>
                <!-- First Name -->
                <div class="form-group col-md-3">
                    <label for="firstName">Prénom</label>
                    <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Enter your first name">
                </div>
                <!-- Email -->
                <div class="form-group col-md-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your first email">
                </div>

                <!-- Sexe -->
                <div class="form-group col-md-3">
                    <label for="sexe">Sexe:</label>
                    <div class="form-check">
                        <input class="form-check-input" name="sexe" type="radio" checked value="m" id="sexem">
                        <label class="form-check-label" for="sexem">
                            Homme
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexe" value="f" id="sexef">
                        <label class="form-check-label" for="sexef">
                            Femme
                        </label>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group col-md-12">
                    <label for="address">Adresse</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter your first address">
                </div>

                <!-- CITY -->
                <div class="form-group col-md-6">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter your first city">
                </div>

                <!-- POSTAL CODE -->
                <div class="form-group col-md-6">
                    <label for="postalCode">Code Postale</label>
                    <input type="text" class="form-control" name="postal_code" id="postalCode" placeholder="Enter your first postal code">
                </div>

                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-dark">Crée mon compte</button>
                </div>
            </form>
        </div>

    <?php } ?>

<?php
require_once("inc/footer.php");
?>