<?php
require_once("inc/init.php");

// Afficher les erreurs PHP pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$content = "";

// Vider le panier
if (isset($_GET['action']) && $_GET['action'] == 'emptyCart') {
    unset($_SESSION['cart']);
    $content .= "<div class='alert alert-success' role='alert'>
    Votre panier a bien été supprimé !
    </div>";
}

// Supprimer un produit du panier
if (isset($_GET['action']) && $_GET['action'] == 'deleteProduct') {
    deleteProductFromCart($_GET['id_product']);
    updateIndexProductInCart();
}

// Ajouter un produit au panier
if (isset($_POST['add_product'])) {
    $id_product = $_POST['id_product'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = ?");
    $stmt->execute([$id_product]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    add_product_to_cart(
        $id_product,
        $_POST['quantity'],
        $product['price'],
        $product['stock'],
        $product['picture'],
        $product['title']
    );
}

require_once("inc/header.php");
?>

<?= $content ?>

<br><br><br><br><br><br><br>
<div class="" style="">

<table class="table my-5">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix</th>
            <th scope="col">Photo</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($_SESSION['cart'])) { ?>
            <tr><td colspan="5">Votre panier est vide !</td></tr>
        <?php } else { ?>
            <?php for ($i = 0; $i < count($_SESSION['cart']['id_product']); $i++) { ?>
                <tr>
                    <td><?= $_SESSION['cart']['title'][$i]; ?></td>
                    <td>
                        <form method="POST" action="cart.php?action=updateQuantity&id_product=<?= $_SESSION['cart']['id_product'][$i]; ?>">
                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                <?php for ($j = 1; $j <= $_SESSION['cart']['stock'][$i]; $j++) { ?>
                                    <option value="<?= $j; ?>" <?= $j == $_SESSION['cart']['quantity'][$i] ? 'selected' : ''; ?>><?= $j; ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </td>
                    <td><?= $_SESSION['cart']['price'][$i]; ?>€</td>
                    <td><img style="width:50px" src="<?= $_SESSION['cart']['picture'][$i]; ?>" alt=""></td>
                    <td><a href="?action=deleteProduct&id_product=<?= $_SESSION['cart']['id_product'][$i]; ?>">Supprimer</a></td>
                </tr>
            <?php } ?>
            <tr><td colspan="5" class="text-right"><strong>Montant total :</strong> <?= totalAmount(); ?>€</td></tr>
        <?php } ?>
    </tbody>
</table>

<div class="col-md-12">
    <a class="badge badge-dark" 
        href="shop.php<?= isset($_POST['category']) ? '?category=' . $_POST['category'] : '' ?>">Retourner dans <?= isset($_POST['category']) ? $_POST['category'] : 'la boutique' ?>
    </a>
</div>
<?php if (!empty($_SESSION['cart'])) { ?>
    <div class="col-md-12">
        <a class="badge badge-danger" href="?action=emptyCart">Vider le panier</a>
    </div>
<?php } ?>

<div class="d-flex justify-content-end col-md-12">
    <?php if (!isset($_SESSION['member'])) { ?>
        <div class="alert alert-warning" role="alert">
            Vous devez être <a href="connection.php">connecté</a> pour passer commande. Si vous n'avez pas de compte, veuillez vous <a href="registration.php">inscrire</a>.
        </div>
    <?php } else { ?>
        <a href="checkout.php" class="btn btn-primary">Payer</a>
    <?php } ?>
</div>
</div>
<br><br><br>
<?php
require_once("inc/footer.php");
?>
