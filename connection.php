<?php

require_once("inc/init.php");


if (isset($_GET['action']) && $_GET['action'] == 'disconnection') {
    // Destruction de la session
    session_unset();
    session_destroy();
    $_SESSION = array(); // Réinitialisation du tableau de session
    header("Location: index.php"); // Redirection vers la page d'accueil ou une autre page après déconnexion
    exit();
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

            if($_SESSION["member"]["status"] == 2) {
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

<section class="vh-200" style="background-image: url('assets/login.png');">
<br><br><br><br>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="assets/logo2.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST" action="">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="assets/oompaloompa.gif" class="">
                  </div>

                  <h2 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Connectez-vous à votre compte</h2>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="pseudo" class="form-control form-control-lg" id="pseudo" aria-describedby="pseudo" placeholder="Entrez votre pseudo"/>
                    <label class="form-label" for="pseudo">Nom d'utilisateur</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="pwd" class="form-control form-control-lg" id="password" placeholder="Entrez votre mot de passe"/>
                    <label class="form-label" for="password">Mot de passe</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Se Connecter</button>
                  </div>

                  <a class="small text-muted" href="connection.php">Mot de passe oublié ?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Vous n'avez pas encore de compte ? <a href="registration.php"
                      style="color: #393f81;">Inscrivez-vous ici !</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

