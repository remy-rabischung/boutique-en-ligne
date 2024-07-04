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

// Payer le panier
if (isset($_SESSION["cart"])) {
    if (isset($_POST["payer"])) {
        $error = false;

        // Récupère l'ID de l'utilisateur connecté depuis la session
        $idMember = $_SESSION["member"]["id_member"] + 1;

        for ($i = 0; $i < count($_SESSION["cart"]["id_product"]); $i++) {
            $id_product = $_SESSION['cart']['id_product'][$i];
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = ?");
            $stmt->execute([$id_product]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product["stock"] < $_SESSION["cart"]["quantity"][$i]) {
                if ($product["stock"] <= 0) {
                    $content .= "<div class=\"col-md-12 alert alert-warning\" role=\"alert\">
                        Le stock est épuisé pour l'article " . $_SESSION["cart"]["title"][$i] . "!
                    </div>";

                    deleteProductFromCart($_SESSION["cart"]["id_product"][$i]);
                    updateIndexProductInCart();
                    $i--;
                } else {
                    $_SESSION["cart"]["quantity"][$i] = $product["stock"];
                    $content .= "<div class=\"col-md-12 alert alert-warning\" role=\"alert\">
                        La quantité pour le produit " . $_SESSION["cart"]["title"][$i] . " a été réduite à $product[stock] car le stock était insuffisant pour vos achats !
                    </div>";
                }
                $error = true;
            }
        }

        if (!$error) {
            $total_amount = totalAmount();

            // Insère la commande dans la base de données
            $stmt = $pdo->prepare("INSERT INTO orders(id_member, amount, date, state) VALUES (?, ?, NOW(), 'en traitement')");
            $stmt->execute([$idMember, $total_amount]);

            $idOrder = $pdo->lastInsertId();

            // Insère les détails de la commande
            for ($i = 0; $i < count($_SESSION["cart"]["id_product"]); $i++) {
                $stmt = $pdo->prepare('INSERT INTO order_details (id_product, id_order, quantity, price) VALUES (?, ?, ?, ?)');
                $stmt->execute([
                    $_SESSION["cart"]["id_product"][$i],
                    $idOrder,
                    $_SESSION["cart"]["quantity"][$i],
                    $_SESSION["cart"]["price"][$i]
                ]);

                // Met à jour le stock du produit dans la base de données
                $quantity = $_SESSION["cart"]["quantity"][$i];
                $id_product = $_SESSION["cart"]["id_product"][$i];
                $stmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id_product = ?");
                $stmt->execute([$quantity, $id_product]);
            }

            unset($_SESSION["cart"]);

            $content .= "<div class=\"col-md-12 alert alert-success\" role=\"alert\">
                Merci pour votre commande ! Numéro de commande : " . $idOrder . "
            </div>";
        }
    }
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
        <form action="" method="POST">
            <input type="submit" name="payer" value="Payer" class="btn btn-primary">
        </form>
    <?php } ?>
</div>
</div>
<br><br><br>
<?php
require_once("inc/footer.php");
?>
