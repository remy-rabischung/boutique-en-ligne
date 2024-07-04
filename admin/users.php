<?php

require_once("../inc/init.php");

// PAGINATION
$elemsForPagination = pagination(
    $pdo, "page", "SELECT COUNT(id_member) as nbrMembers FROM members", "nbrMembers", 5);

// MODIFICATION
if (isset($_GET["action"]) && $_GET["action"] == "modify") {
    // Récupérer les informations de l'utilisateur à partir de $_GET["id_member"]
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id_member = ?");
    $stmt->execute([$_GET["id_member"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si un utilisateur a été trouvé
    if ($user) {
        // Affecter les valeurs récupérées aux variables du formulaire
        $idMember = $user["id_member"];
        $pseudo = $user["pseudo"];
        $password = $user["password"];
        $name = $user["name"];
        $firstName = $user["first_name"];
        $email = $user["email"];
        $sexe = $user["sexe"];
        $city = $user["city"];
        $postalCode = $user["postal_code"];
        $address = $user["address"];
        $status = $user["status"];
    } else {
        // Gérer le cas où l'utilisateur n'existe pas
        // Par exemple, rediriger vers une page d'erreur ou afficher un message
    }
}

// SUPPRESSION
if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $count = $pdo->exec("DELETE FROM members WHERE id_member = ?");
    if ($count > 0) {
        $content = "<div class='alert alert-success' role='alert'>
        L'utilisateur a bien été supprimé !
        </div>";
    }
}

// MODIFICATION/DELETE
if ($_POST) {
    foreach ($_POST as $index => $value) {
        $_POST[$index] = addslashes($value);
    }

    // AJOUT
    if (isset($_POST["addUser"])) {
        $count = $pdo->exec("INSERT INTO members 
        (pseudo, password, name, first_name, email, sexe, city, postal_code, address, status)
        VALUES (
            '$_POST[pseudo]',
            '$_POST[password]',
            '$_POST[name]',
            '$_POST[first_name]',
            '$_POST[email]',
            '$_POST[sexe]',
            '$_POST[city]',
            '$_POST[postal_code]',
            '$_POST[address]',
            '$_POST[status]'
        )");
        if ($count > 0) {
            $content .= "<div class='alert alert-success' role='alert'>
                L'utilisateur avec le pseudo " . $_POST["pseudo"] . " a bien été ajouté dans la base de données !
            </div>";
        }
    }
    // MODIF
    else {
        $count = $pdo->exec("UPDATE members SET
        pseudo = '$_POST[pseudo]',
        password = '$_POST[password]',
        name = '$_POST[name]',
        first_name = '$_POST[first_name]',
        email = '$_POST[email]',
        sexe = '$_POST[sexe]',
        city = '$_POST[city]',
        postal_code = '$_POST[postal_code]',
        address = '$_POST[address]',
        status = '$_POST[status]'
        WHERE id_member = '$_POST[id_member]'
        ");

        if ($count > 0) {
            $content .= "<div class='alert alert-success' role='alert'>
                L'utilisateur avec le pseudo " . $_POST["pseudo"] . " a bien été modifié dans la base de données !
            </div>";
        }
    }
}

$stmt = $pdo->query("SELECT * FROM members ORDER BY id_member ASC LIMIT $elemsForPagination[first], 5 ");

$idMember = (isset($user)) ? $user["id_member"] : "";
$pseudo = (isset($user)) ? $user["pseudo"] : "";
$password = (isset($user)) ? $user["password"] : "";
$name = (isset($user)) ? $user["name"] : "";
$firstName = (isset($user)) ? $user["first_name"] : "";
$email = (isset($user)) ? $user["email"] : "";
$sexe = (isset($user)) ? $user["sexe"] : "";
$city = (isset($user)) ? $user["city"] : "";
$postalCode = (isset($user)) ? $user["postal_code"] : "";
$address = (isset($user)) ? $user["address"] : "";
$status = (isset($user)) ? $user["status"] : "";

require_once("inc/header.php");
?>

<!-- BODY -->
<h1 class="mb-5 text-center col-12">Bienvenue dans l'administration des utilisateurs</h1>

<?= $content; ?>

<!-- TABLE -->
<p class="text-center col-12">Liste des utilisateurs en base de données : </p>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <!-- En-têtes de colonne -->
                <?php for ($i = 0; $i < $stmt->columnCount(); $i++) {
                    $col = $stmt->getColumnMeta($i); ?>
                    <th scope="col"> <?= $col["name"]; ?> </th>
                <?php } ?>
                <th scope="col">Actions</th> <!-- Nouvelle colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $index => $user) { ?>
                <tr>
                    <!-- Contenu des cellules -->
                    <?php foreach ($user as $index => $value) { ?>
                        <td> <?= $value; ?> </td>
                    <?php } ?>
                    <!-- Cellule pour les actions -->
                    <td>
                        <a href="?action=modify&amp;id_member=<?= $user["id_member"]; ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="?action=delete&amp;id_member=<?= $user["id_member"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<div class="row col-12">
    <?php
    require_once("../inc/pagination.php");
    ?>
</div>

<!-- FORMULAIRE -->
<p id="add_modify">Ajouter ou modifier un utilisateur :</p>

<form action="" method="POST">
    <input type="hidden" name="id_member" value="<?= $idMember; ?>">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $password; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="first_name">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $firstName; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="sexe">Sexe</label>
            <select class="form-control" id="sexe" name="sexe">
                <option value="m" <?= ($sexe == 'm') ? 'selected' : ''; ?>>Masculin</option>
                <option value="f" <?= ($sexe == 'f') ? 'selected' : ''; ?>>Féminin</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="city">Ville</label>
            <input type="text" class="form-control" id="city" name="city" value="<?= $city; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="postal_code">Code Postal</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?= $postalCode; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= $address; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="status">Statut</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= $status; ?>">
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" name="modifyUser">Modifier l'utilisateur</button>
        </div>
    </div>
</form>

<?php
require_once("inc/footer.php");
?>
