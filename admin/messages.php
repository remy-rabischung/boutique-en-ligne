<?php
require_once("../inc/init.php");

if (!userConnected() || !adminConnected()) {
    header("location:connexion.php");
    exit();
}

// Récupération des messages
try {
    $sql = "SELECT * FROM contact ORDER BY date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage(); // Affiche l'erreur SQL en cas de problème
}

// Traitement des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reply_message'])) {
        // Traitement pour répondre au message (déjà existant)
        $contactId = $_POST['contact_id'];
        $response = $_POST['response'];
        
        try {
            $sql = "UPDATE contact SET response = :response, response_state = 'read', date_response = NOW() WHERE id_contact = :id_contact";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':response', $response, PDO::PARAM_STR);
            $stmt->bindParam(':id_contact', $contactId, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: messages.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage(); // Affiche l'erreur SQL en cas de problème
        }
    } elseif (isset($_POST['delete_message'])) {
        // Suppression du message
        $contactId = $_POST['contact_id'];

        try {
            $sql = "DELETE FROM contact WHERE id_contact = :id_contact";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_contact', $contactId, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: messages.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage(); // Affiche l'erreur SQL en cas de problème
        }
    }
}

require_once("inc/header.php");
?>

<h1 class="text-center">Gestion des messages</h1>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Sujet</th>
            <th>Message</th>
            <th>Date</th>
            <th>État</th>
            <th>Réponse</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message) { ?>
            <tr>
                <th scope="row"><?= $message['id_contact'] ?></th>
                <td><?= isset($message['first_name']) ? htmlspecialchars($message['first_name'] . " " . $message['last_name']) : 'Non spécifié' ?></td>
                <td><?= isset($message['email']) ? htmlspecialchars($message['email']) : 'Non spécifié' ?></td>
                <td><?= isset($message['phone_number']) ? htmlspecialchars($message['phone_number']) : 'Non spécifié' ?></td>
                <td><?= isset($message['subject']) ? htmlspecialchars($message['subject']) : 'Non spécifié' ?></td>
                <td><?= isset($message['message']) ? htmlspecialchars($message['message']) : 'Non spécifié' ?></td>
                <td><?= isset($message['date']) ? htmlspecialchars($message['date']) : 'Non spécifié' ?></td>
                <td><?= isset($message['state']) ? htmlspecialchars($message['state']) : 'Non spécifié' ?></td>
                <td><?= isset($message['response']) ? htmlspecialchars($message['response']) : 'Aucune réponse' ?></td>
                <td>
                    <?php if ($message['state'] === 'new' || $message['state'] === 'unread') { ?>
                        <form method="post" class="form-inline">
                            <input type="hidden" name="contact_id" value="<?= $message['id_contact'] ?>">
                            <textarea name="response" class="form-control" placeholder="Réponse"></textarea>
                            <button type="submit" name="reply_message" class="btn btn-primary mt-2">Envoyer</button>
                            <!-- Bouton pour supprimer -->
                            <button type="submit" name="delete_message" class="btn btn-danger mt-2 ml-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">Supprimer</button>
                        </form>
                    <?php } else { ?>
                        <em>Répondu</em>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once("inc/footer.php"); ?>
