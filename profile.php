<?php
require_once("inc/init.php");

if(!userConnected()) {
    header("location:connection.php");
    exit();
}

// Récupère les informations de l'utilisateur depuis la session
$userFirstName = $_SESSION["member"]["first_name"];
$userLastName = $_SESSION["member"]["name"];
$userId = $_SESSION["member"]["id_member"]; // Récupère l'ID de l'utilisateur

try {
    // Requête SQL pour récupérer les commandes en cours avec les états 'en traitement' ou 'envoyé'
    $sqlCurrentOrders = "SELECT * FROM orders WHERE id_member = :userId AND (state = 'en traitement' OR state = 'envoyé')";
    $stmtCurrentOrders = $pdo->prepare($sqlCurrentOrders);
    $stmtCurrentOrders->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmtCurrentOrders->execute();
    $currentOrders = $stmtCurrentOrders->fetchAll(PDO::FETCH_ASSOC);

    // Requête SQL pour récupérer toutes les commandes passées de l'utilisateur
    $sqlAllOrders = "SELECT * FROM orders WHERE id_member = :userId";
    $stmtAllOrders = $pdo->prepare($sqlAllOrders);
    $stmtAllOrders->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmtAllOrders->execute();
    $allOrders = $stmtAllOrders->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage(); // Affiche l'erreur SQL en cas de problème
}


require_once("inc/header.php");

?>

<section style="background-image: url('assets/login.png');">
<br>
<div class="col-md-12 mb-5">
    <h2 class="text-center">Salutations <?= $userFirstName . " " . $userLastName ?>, bienvenue sur votre profil !</h2>
</div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="assets/oompaloompa.gif" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?= $_SESSION["member"]["first_name"] . " " . $_SESSION["member"]["name"] ?></h5>
                        <p class="text-muted mb-1"><?= $_SESSION["member"]["address"] ?></p>
                        <p class="text-muted mb-4"><?= $_SESSION["member"]["city"] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nom complet</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $_SESSION["member"]["first_name"] . " " . $_SESSION["member"]["name"] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nom d'utilisateur</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $_SESSION["member"]["pseudo"] . " " . $_SESSION["member"]["name"] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $_SESSION["member"]["email"] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Adresse</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $_SESSION["member"]["address"] ?></p>
                                <p class="text-muted mb-0"><?= $_SESSION["member"]["city"] ?></p>
                                <p class="text-muted mb-0"><?= $_SESSION["member"]["postal_code"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item text-center">
                                        <h5>Mes commandes en cours</h5>
                                    </li>
                                    <?php foreach ($currentOrders as $order): ?>
                                        <li class="list-group-item text-center">
                                            <p>Commande n°<?= $order['id_order'] ?> du <?= $order['date'] ?></p>
                                            <p class="badge badge-primary"><?= $order['state'] ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item text-center">
                                        <h5>Toutes mes commandes</h5>
                                    </li>
                                    <?php foreach ($allOrders as $order): ?>
                                        <li class="list-group-item text-center">
                                            <p>Commande n°<?= $order['id_order'] ?> du <?= $order['date'] ?></p>
                                            <p class="badge badge-primary"><?= $order['state'] ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once("inc/footer.php"); ?>
