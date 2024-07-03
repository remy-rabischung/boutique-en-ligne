<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    <title>Wonka</title>
</head>

<body>

        <nav class="navbar navbar-expand-lg navbar-light text-dark header-bg">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/Wonka-logo.png" width="120" height="50" class="d-inline-block align-top" alt="Logo Wonka">
            </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto flex justify-content-end" id="navBar">
                    <li class="nav-item active">
                        <a class="nav-link" href="shop.php">Boutique</a>
                    </li>

                    <?php if(!userConnected()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="connection.php">Connexion</a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">Inscription</a>
                        </li>
                    <?php } ?>

                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Mon Profil</a>
                        </li>
                    <li class="nav-item position_relative">
                        <span class="number_elem_in_cart"><?= numberOfProductsInCart(); ?></span>
                        <a class="nav-link" href="cart.php">Mon Panier</a>
                    </li>

                    <?php if(userConnected()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="connection.php?action=disconnection">Déconnexion</a>
                        </li>
                    <?php } ?>   

                    <?php if(adminConnected()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/index.php">Panel Admin</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>

        <!-- <main class="bg-light p-5">
            <div class="row col-md-10 mx-auto justify-content-center"> -->