<?php 

require_once("inc/init.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    
    // Validation des champs
    $first_name = !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : $errors[] = "Le prénom est requis.";
    $last_name = !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : $errors[] = "Le nom est requis.";
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : $errors[] = "L'email est invalide.";
    $phone_number = !empty($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : $errors[] = "Le téléphone est requis.";
    $motive = !empty($_POST['motive']) ? htmlspecialchars($_POST['motive']) : $errors[] = "Le motif est requis.";
    $message_content = !empty($_POST['message']) ? htmlspecialchars($_POST['message']) : $errors[] = "Le message est requis.";

    if (empty($errors)) {
        $to = "remy.rabischung@laplateforme.io";
        $from = $email;
        $subject = "Formulaire de contact";
        $subject2 = "Copie de votre formulaire de contact";
        $message = "$first_name $last_name a écrit le message suivant : \n\n$message_content";
        $message2 = "Ceci est une copie de votre message $first_name \n\n$message_content";

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;

        // Envoi des emails
        mail($to, $subject, $message, $headers);
        mail($from, $subject2, $message2, $headers2);

        // Insertion en base de données
        $stmt = $pdo->prepare("INSERT INTO contact (id_member, first_name, last_name, email, phone_number, subject, message, date, state) VALUES (:id_member, :first_name, :last_name, :email, :phone_number, :subject, :message, NOW(), 'new')");
        $stmt->bindParam(':id_member', $_SESSION["membre"]["id_membre"], PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':subject', $motive, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message_content, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $content = "<div class=\"col-md-12 alert alert-success\" role=\"alert\">
                Votre message a bien été envoyé, notre équipe s'engage à vous répondre dans un délai de 48h.
            </div>";
        } else {
            $errors[] = "Une erreur s'est produite lors de l'envoi de votre message.";
        }
    }
}

$id_membre = (isset($_SESSION["membre"]["id_membre"])) ? $_SESSION["membre"]["id_membre"] : NULL;

require_once("inc/header.php");
?>
<br><br><br>
<h1 class="text-center">Laissez-nous vos coordonnées et notre équipe reprendra contact avec vous.</h1>
<br><br><br>
<?php if (!empty($content)) { ?>
    <?php echo $content; ?>
<?php } elseif (!empty($errors)) { ?>
    <div class="col-md-12 alert alert-danger" role="alert">
        <?php foreach ($errors as $error) {
            echo $error . "<br>";
        } ?>
    </div>
<?php } ?>

<form class="row col-md-10 offset-md-1" method="post">
    <div class="form-group col-md-6">
        <input type="hidden" name="id_membre" value="<?php echo $id_membre; ?>">
        <label for="prenom">Prénom :</label>
        <input type="text" name="first_name" class="form-control" id="prenom" aria-describedby="prenom" placeholder="Entrez votre prénom" required>
    </div>
    <div class="form-group col-md-6">
        <label for="nom">Nom :</label>
        <input type="text" name="last_name" class="form-control" id="nom" placeholder="Entrez votre nom" required>
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email :</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Entrez votre email" required>
    </div>
    <div class="form-group col-md-6">
        <label for="telephone">Téléphone :</label>
        <input type="tel" name="telephone" class="form-control" id="telephone" placeholder="Entrez votre téléphone" required>
    </div>
    <div class="form-group col-md-12">
        <label for="motive">En quoi pouvons-nous vous aider?</label>
        <select class="form-control" id="motive" name="motive" required>
            <option value="J'ai une question sur une commande !">J'ai une question sur une commande !</option>
            <option value="J'ai une question sur un produit !">J'ai une question sur un produit !</option>
            <option value="Je souhaite contacter le service après vente.">Je souhaite contacter le service après vente.</option>
            <option value="Je suis fournisseur.">J'ai une question générale.</option>
            <option value="Je suis fournisseur.">Je suis fournisseur.</option>
        </select>
    </div>
    <div class="form-group col-md-12">
        <label for="message">Message :</label>
        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Entrez votre message" required></textarea>
    </div>
    <div class="form-group col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Envoyer votre message</button>
    </div>
</form>

<?php require_once("inc/footer.php"); ?>
