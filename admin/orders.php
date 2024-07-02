<?php

// Accueil du BACK OFFICE

require_once("../inc/init.php");

if(isset($_GET["filterCommand"])) {
    if(empty($_GET["id_order"])) {
        $stmt = $pdo->query("SELECT * FROM orders  WHERE state = '$_GET[state]' ORDER BY id_order ASC LIMIT 0, 5");
    } else {
        $stmt = $pdo->query("SELECT * FROM orders WHERE id_order = '$_GET[id_order]' ");
    }
} else {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY id_order ASC LIMIT 0, 5");

}

$state = (isset($_GET["filterCommand"])) && isset($_GET["state"]) ? $_GET["state"] : "";


require_once("inc/header.php");

?>

<!-- BODY -->
<h1 class="mb-5 text-center">Bienvenue dans l'administration des commandes</h1>

<div class="w-100"> </div>

<h2>Liste des commandes <span class="badge badge-secondary"><?= $state; ?></span></h2>

<div class="w-100"> </div>

<form class="row col-md-12 align-items-center justify-content-center m-5" method="get" action="">
    <input type="hidden" name="filterCommand">
    <select class="form-control col-md-4" name="state">

        <?php if($state == "en traitement") { ?>
            <option value="none" disabled=""> Choisissez un statut de commande </option>
            <option value="en traitement" selected> En Traitement </option>
            <option value="envoyé"> Envoyé </option>
            <option value="livré"> Livré </option>
        <?php } else if ($state == "envoyé") { ?>
            <option value="none" disabled=""> Choisissez un statut de commande </option>
            <option value="en traitement"> En Traitement </option>
            <option value="envoyé" selected> Envoyé </option>
            <option value="livré"> Livré </option>
        <?php } else if ($state == "livré"){ ?>
            <option value="none" disabled=""> Choisissez un statut de commande </option>
            <option value="en traitement"> En Traitement </option>
            <option value="envoyé"> Envoyé </option>
            <option value="livré" selected> Livré </option>
        <?php } else { ?>
            <option value="none" disabled="" selected=""> Choisissez un statut de commande </option>
            <option value="en traitement"> En Traitement </option>
            <option value="envoyé"> Envoyé </option>
            <option value="livré"> Livré </option>
        <?php } ?>

    </select>

    <p class="text-center mb-0 mr-3 ml-3">Ou</p>

    <input type="text" name="id_order" class="form-control col-md-4" id="id_order" aria-describedby="id_order"
        placeholder="Entrez un numéro de commande">

</form>


<table class="table mb-5">
    <thead class="thead-dark">
        <tr>
            <?php for($i = 0; $i < $stmt->columnCount(); $i++) {
                $col = $stmt->getColumnMeta($i); ?>
                <th scope="col"> <?= $col["name"]; ?> </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>

        <tr>
            <?php foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $index => $order) { 
                foreach($order as $index => $value) {
                    if ($index == "state") { ?>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="id_order" value="9">
                                <input type="hidden" name="modifyState">
                                <select class="form-control" name="state">
                                <?php if($value == "en traitement") { ?>
                                    <option value="en traitement" selected> En Traitement </option>
                                    <option value="envoyé"> Envoyé </option>
                                    <option value="livré"> Livré </option>
                                <?php } else if ($value == "envoyé") { ?>
                                    <option value="en traitement"> En Traitement </option>
                                    <option value="envoyé" selected> Envoyé </option>
                                    <option value="livré"> Livré </option>
                                <?php } else { ?>
                                    <option value="en traitement"> En Traitement </option>
                                    <option value="envoyé"> Envoyé </option>
                                    <option value="livré" selected> Livré </option>
                                <?php } ?>

                                </select>
                            </form>
                        </td>
                        
                    <?php } else { ?>
                        <td> <?= $order[$index]; ?> </td>
                    <?php } ?>

            <?php } ?>
                </tr>
            <?php } ?>
 
    </tbody>
</table>


<?php
require_once("inc/footer.php");
?>