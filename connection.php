<?php

require_once("inc/init.php");


if(isset($_GET["action"]) && $_GET["action"] == "disconnection") {
    unset($_SESSION["member"]);
}

if(userConnected()) {
    header("location:profile.php");
}

$content = "";

if($_POST) {

    $stmt = $pdo->query("SELECT * FROM members WHERE pseudo = '$_POST[pseudo]' ");

    if($stmt->rowCount() > 0) {

        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($_POST["pwd"], $member["password"])) {

            $_SESSION["member"]["id_member"] = $member["id_member"];
            $_SESSION["member"]["pseudo"] = $member["pseudo"];
            $_SESSION["member"]["name"] = $member["name"];
            $_SESSION["member"]["first_name"] = $member["first_name"];
            $_SESSION["member"]["email"] = $member["email"];
            $_SESSION["member"]["sexe"] = $member["sexe"];
            $_SESSION["member"]["postal_code"] = $member["postal_code"];
            $_SESSION["member"]["address"] = $member["address"];
            $_SESSION["member"]["city"] = $member["city"];
            $_SESSION["member"]["status"] = $member["status"];

            if($_SESSION["member"]["status"] == 1) {
                header("location:admin/index.php");
            } else {
                header("location:profile.php");
            }

            exit();

        } else {
            $content .= "<div class='alert alert-danger' role='alert'>
                Vérifiez votre mot de passe !
            </div>";
        }

    } else {
        $content .= "<div class='alert alert-danger' role='alert'>
            Vérifiez votre pseudo !
        </div>";
    }

}

require_once("inc/header.php");

?>

<!-- Body content -->

<?= $content; ?>

<div class="col-md-12">
    <h3 class="text-center mb-5"> Connectez-vous pour accéder à votre profil !</h3>
</div>

<div class="col-md-5">
    <form method="POST" action="">
        <div class="form-group">
            <label for="pseudo">Pseudo:</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" aria-describedby="pseudo" placeholder="Entrez votre pseudo">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="pwd" class="form-control" id="password" placeholder="Entrez votre mot de passe">
        </div>
        <button type="submit" class="btn btn-dark">Connexion</button>
    </form>
</div>


<?php
require_once("inc/footer.php");
?>