<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Wonka</title>
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Logo avec lien -->
                <a class="navbar-brand" href="index.php">
                    <img src="./assets/Wonka-logo.png" alt="Logo Wonka">
                </a>

                <!-- Bouton pour le menu mobile -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenu de la barre de navigation -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <!-- Liens principaux -->
                        <li class="nav-item">
                            <a class="nav-link" href="history.php">La Chocolaterie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Boutique</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php if (adminConnected()) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/index.php">Panel Admin</a>
                            </li>
                        <?php } ?>
                    </ul>

                    <!-- Panier avec dropdown -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Logo du panier -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCart" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="number_elem_in_cart badge rounded-pill badge-notification bg-danger"><?= numberOfProductsInCart(); ?></span>
                            </a>
                            <!-- Dropdown menu -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCart">
                                <!-- Liste des articles dans le panier -->
                                <?php if (!empty($_SESSION['cart']['title'])) : ?>
                                    <?php foreach ($_SESSION['cart']['title'] as $index => $title) : ?>
                                        <div class="dropdown-item cart-item d-flex align-items-center">
                                            <!-- Image de l'article (si disponible) -->
                                            <img src="<?= htmlspecialchars($_SESSION['cart']['picture'][$index]); ?>" alt="Image produit" class="mr-3">
                                            <!-- Détails de l'article -->
                                            <div class="cart-item-details">
                                                <h6 class="mb-0"><?= htmlspecialchars($title) ?></h6>
                                                <p class="mb-0">Quantité: <?= htmlspecialchars($_SESSION['cart']['quantity'][$index]) ?></p>
                                                <p class="mb-0">Prix unitaire: <?= htmlspecialchars($_SESSION['cart']['price'][$index]) ?> €</p>
                                            </div>
                                            <!-- Bouton de suppression -->
                                            <a href="cart.php?action=deleteProduct&id_product=<?= $_SESSION['cart']['id_product'][$index]; ?>" class="text-danger ml-3"><i class="fas fa-times"></i></a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="dropdown-item text-center">Votre panier est vide</div>
                                <?php endif; ?>

                                <!-- Ligne séparatrice -->
                                <div class="dropdown-divider"></div>

                                <!-- Bouton "Voir mon panier" -->
                                <button class="btn btn-warning btn-lg"><a class="dropdown-item text-center" href="cart.php">
                                    Voir mon panier
                                </a></button>
                            </div>
                        </li>

                        <!-- Connexion / Déconnexion -->
                        <?php if (!userConnected()) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="connection.php">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registration.php">Inscription</a>
                            </li>
                        <?php } else { ?>
                            <!-- Avatar avec dropdown -->
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">
                                        <a class="dropdown-item" href="profile.php">Profil</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="connection.php?action=disconnection">Déconnexion</a>
                                    </div>
                                </li>
                            </ul>
                        <?php } ?>

                        <!-- Champ de recherche -->
                        <form class="form-inline my-2 my-lg-0">
                            <input id="search" class="form-control mr-sm-2" type="search" placeholder="Rechercher..." aria-label="Search">
                            <div id="search-results" class="list-group position-absolute"></div>
                        </form>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>

