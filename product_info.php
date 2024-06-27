<?php
require_once("inc/init.php");

    //////////////////////////////////////////
    //////////// GET PRODUCT INFOS ///////////
    //////////////////////////////////////////

    if(isset($_GET['id_product'])) {
        $id_product = $_GET['id_product'];
        $stmt = $pdo->query("SELECT * FROM products WHERE id_product = $id_product");
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        }

    
    
require_once("inc/header.php");

?>

<div class="card col-md-4">
    <img src="<?= $produit['picture']; ?>" class="card-img-top" alt="Black t-shirt">
    <div class="card-body">
        <h5 class="card-title"><?= $produit['title']; ?></h5>
        <p class="card-text"><?= $produit['description']; ?></p>
    </div>
</div>

<div class="col-md-4">
    <ul class="list-group">
        <li class="list-group-item">Catégorie : <?= $produit['category']; ?></li>
        <li class="list-group-item">Prix : <?= $produit['price']; ?></li>

        <form method="POST" action="cart.php">
            <input type="hidden" name="id_product" value="<?= $produit['id_product']; ?>"/>
            <input type="hidden" name="category" value="<?= $produit['category']; ?>"/>
            <li class="list-group-item">
                <p>Quantity :</p>
                <select name="quantity" class="custom-select" id="selectQuantity">
                    <option selected="">Choisir la quantité</option>
                    
                    <?php for($i = 1; $i <= $produit['stock']; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>

                    
                </select>
            </li>

            <input name="add_product" type="submit" id="addToCart" class="btn btn-primary mt-5 w-100" disabled value="Add to cart">

        </form>

    </ul>
</div>

<?php
require_once("inc/footer.php");
?>