<?php
require_once("inc/init.php");

//////////////////////////////////////////
/////////// GET PRODUCT INFOS ///////////
//////////////////////////////////////////

$produit = null;
if(isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
    $sql = "SELECT * FROM products WHERE id_product = :id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_product', $id_product, PDO::PARAM_INT);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
}

require_once("inc/header.php");

?>
<br><br><br><br>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="<?= $produit['picture']; ?>" class="card-img-top img-fluid" alt="<?= $produit['title']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $produit['title']; ?></h5>
                    <p class="card-text"><?= $produit['description']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">Catégorie : <?= $produit['category']; ?></li>
                <li class="list-group-item">Prix : <?= $produit['price']; ?> €</li>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="id_product" value="<?= $produit['id_product']; ?>"/>
                    <input type="hidden" name="category" value="<?= $produit['category']; ?>"/>
                    <li class="list-group-item">
                        <label for="selectQuantity">Quantité :</label>
                        <select name="quantity" class="custom-select" id="selectQuantity">
                            <option selected disabled>Choisir la quantité</option>
                            <?php for($i = 1; $i <= $produit['stock']; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </li>

                    <input name="add_product" type="submit" id="addToCart" class="btn btn-primary mt-3" disabled value="Ajouter au panier">

                </form>

            </ul>
        </div>
    </div>
</div>

<div class="mt-5"></div> <!-- Espace pour la marge -->

<?php
require_once("inc/footer.php");
?>
