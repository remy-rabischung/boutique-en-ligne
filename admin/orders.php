<?php
require_once("../inc/init.php");

if (!userConnected() || !adminConnected()) {
    header("location:connexion.php");
    exit();
}

// Traitement de la modification d'état de la commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifyState'])) {
    $id_order = $_POST['id_order'];
    $new_state = $_POST['state'];
    
    try {
        // Préparation de la requête SQL UPDATE
        $sql_update = "UPDATE orders SET state = :new_state WHERE id_order = :id_order";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':new_state', $new_state, PDO::PARAM_STR);
        $stmt_update->bindParam(':id_order', $id_order, PDO::PARAM_INT);
        $stmt_update->execute();
        
        // Redirection après la mise à jour
        header("Location: orders.php?state=" . urlencode($_POST['current_state']));
        exit();
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}

// Initialisation des variables de filtrage
$current_state = isset($_GET['state']) ? $_GET['state'] : '';
$id_order_filter = isset($_GET['id_order']) ? $_GET['id_order'] : '';

// Construction de la requête SQL
$sql = "SELECT * FROM orders";

// Application du filtre d'état si spécifié
if (!empty($current_state) && $current_state !== 'tous') {
    $sql .= " WHERE state = :current_state";
}

// Application du filtre par ID de commande si spécifié
if (!empty($id_order_filter)) {
    // Ajouter la condition WHERE si nécessaire
    $sql .= (!strstr($sql, "WHERE")) ? " WHERE " : " AND ";
    $sql .= "id_order = :id_order";
}

$sql .= " ORDER BY id_order ASC";

$stmt = $pdo->prepare($sql);

// Liaison des paramètres de filtrage si nécessaires
if (!empty($current_state) && $current_state !== 'tous') {
    $stmt->bindParam(':current_state', $current_state, PDO::PARAM_STR);
}

if (!empty($id_order_filter)) {
    $stmt->bindParam(':id_order', $id_order_filter, PDO::PARAM_INT);
}

$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once("inc/header.php");
?>

<!-- BODY -->
<h1 class="mb-5 text-center">Bienvenue dans l'administration des commandes</h1>

<div class="w-100"> </div>

<h2>Liste des commandes <span class="badge badge-secondary"><?= htmlspecialchars($current_state); ?></span></h2>

<div class="w-100"> </div>

<form class="row col-md-12 align-items-center justify-content-center m-5" method="get" action="">
    <input type="hidden" name="filterCommand">
    <select class="form-control col-md-4" name="state">
        <option value="tous" <?= ($current_state == 'tous') ? 'selected' : '' ?>> Tous </option>
        <option value="en traitement" <?= ($current_state == 'en traitement') ? 'selected' : '' ?>> En Traitement </option>
        <option value="envoyé" <?= ($current_state == 'envoyé') ? 'selected' : '' ?>> Envoyé </option>
        <option value="livré" <?= ($current_state == 'livré') ? 'selected' : '' ?>> Livré </option>
    </select>

    <p class="text-center mb-0 mr-3 ml-3">Ou</p>

    <input type="text" name="id_order" class="form-control col-md-4" id="id_order" aria-describedby="id_order"
        placeholder="Entrez un numéro de commande" value="<?= htmlspecialchars($id_order_filter); ?>">

    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<table class="table mb-5">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ID Membre</th>
            <th scope="col">Date</th>
            <th scope="col">État</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($stmt->rowCount() > 0) { ?>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?= htmlspecialchars($order['id_order']); ?></td>
                    <td><?= htmlspecialchars($order['id_member']); ?></td>
                    <td><?= htmlspecialchars($order['date']); ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="id_order" value="<?= $order['id_order']; ?>">
                            <input type="hidden" name="modifyState">
                            <input type="hidden" name="current_state" value="<?= htmlspecialchars($current_state); ?>">
                            <select class="form-control" name="state" onchange="this.form.submit()">
                                <option value="en traitement" <?= ($order['state'] === 'en traitement') ? 'selected' : '' ?>> En Traitement </option>
                                <option value="envoyé" <?= ($order['state'] === 'envoyé') ? 'selected' : '' ?>> Envoyé </option>
                                <option value="livré" <?= ($order['state'] === 'livré') ? 'selected' : '' ?>> Livré </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <!-- Formulaire pour supprimer une commande -->
                        <form method="post" action="">
                            <input type="hidden" name="id_order" value="<?= $order['id_order']; ?>">
                            <input type="hidden" name="deleteOrder">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5" class="text-center">Aucune commande trouvée.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
require_once("inc/footer.php");
?>
