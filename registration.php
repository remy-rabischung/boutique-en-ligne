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
            1
        ) ");
    
        if($count > 0) {
            $content .= "<div class='alert alert-success' role='alert'>
            Votre compte a bien été crée !
            </div>";

            $registrationDone = true;
            $content .= "<a href='connection.php'>Se connecter</a>";

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
        
        <!-- Section: Design Block -->
        <section class="background-radial-gradient overflow-hidden" style="background-image: url('assets/login.png');">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Le meilleur chocolat <br />
                <span style="color: hsl(218, 81%, 75%)">au monde</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                La Chocolaterie Wonka est une usine de confiserie magique et mystérieuse, dirigée par le fantasque Willy Wonka. 
                Située dans un vaste bâtiment coloré et intrigant, l'usine est réputée pour ses créations chocolatées innovantes et ses bonbons extraordinaires. 
                Les Oompa Loompas, petits êtres travailleurs venus de Loompaland, y travaillent avec dévouement. 
                La chocolaterie est célèbre pour ses surprises inattendues, comme les tickets d'or cachés dans les tablettes de chocolat, offrant des visites exclusives de l'usine.
                </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                <div class="card-body px-4 py-5 px-md-5">
                    <form method="POST" action="">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row">
                    <h2 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Formulaire d'inscription</h2>
                        <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Entrer votre prénom"/>
                            <label class="form-label" for="form3Example1">Prénom</label>
                        </div>
                        </div>
                        <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="name" id="lastName" placeholder="Entrez votre nom de famille"/>
                            <label class="form-label" for="lastName">Nom</label>
                        </div>
                        </div>
                        <!-- Sexe -->
                            <label for="sexe">Sexe :</label>
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

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email"/>
                        <label class="form-label" for="email">E-mail</label>
                    </div>


                    <!-- 2 column grid layout with text inputs for the pseudo and password -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="pseudo" placeholder="Entrez votre pseudo"/>
                            <label class="form-label" for="pseudo">Nom d'utilisateur</label>
                        </div>
                        </div>
                        <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                        <input type="password" class="form-control" name="pwd" id="password" placeholder="Entrez votre mot de passe"/>
                            <label class="form-label" for="password">Mot de passe</label>
                        </div>
                        </div>
                    </div>

                    <!-- address input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Entrez votre adresse postale"/>
                        <label class="form-label" for="address">Adresse postale</label>
                    </div>

                    <!-- 2 column grid layout with text inputs for the city and postale code -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="city" id="city" placeholder="Entrez votre ville"/>
                            <label class="form-label" for="city">Ville</label>
                        </div>
                        </div>
                        <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="postal_code" id="postalCode" placeholder="Entrer votre code postale"/>
                            <label class="form-label" for="postal_code">Code postale</label>
                        </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                        S'inscrire
                    </button>

                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <!-- Section: Design Block -->

    <?php } ?>

