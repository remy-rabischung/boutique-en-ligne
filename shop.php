<?php
    require_once("inc/init.php");

    //////////////////////////////////////////
    /////////////// CATEGORIES ///////////////
    //////////////////////////////////////////

    $stmt = $pdo->query("SELECT DISTINCT(category) FROM products");

    //////////////////////////////////////////
    ////////////// LIST PRODUCTS /////////////
    //////////////////////////////////////////

    if(isset($_GET['category'])) {
        $sql = 'SELECT * FROM products WHERE category = :selectedCategory';
        $query = $pdo->prepare($sql);
        $query->bindValue(':selectedCategory', $_GET['category'], PDO::PARAM_STR);
        $query->execute();
    }



    require_once("inc/header.php");
?>

<!-- Body content -->

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <?php while($category = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <li class="list-group-item">
                        <a class="text-dark" href="?category=<?=$category['category'];?>"> <?= $category['category']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="row">
                <?php
                if(isset($_GET['category'])) {
                    while($product = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col-md-4 pr-2 pl-2 pb-2">
                            <div class="card h-100">
                                <img src="<?= $product['picture']; ?>" class="card-img-top" alt="...">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-center"> <?= $product['title']; ?> </h5>
                                    <p class="card-text text-center"> <?= $product['description']; ?> </p>
                                    <a href="product_info.php?id_product=<?= $product['id_product']; ?>" class="btn btn-dark mt-auto">Voir le produit</a>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once("inc/footer.php");
?>