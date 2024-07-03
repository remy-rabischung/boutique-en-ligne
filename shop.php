<?php
require_once("inc/init.php");

// Récupération des catégories distinctes
$stmt = $pdo->query("SELECT DISTINCT(category) FROM products");

require_once("inc/header.php");
?>

<!-- Header avec titre -->
<div class="container-fluid bg-light py-4">
    <div class="text-center">
        <h2>Nos Catégories de Produits</h2>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <ul class="nav justify-content-center">
                <?php while($category = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?= isset($_GET['category']) && $_GET['category'] == $category['category'] ? 'active' : ''; ?>" href="?category=<?= $category['category']; ?>"><?= $category['category']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- Liste des produits -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php
                if(isset($_GET['category'])) {
                    $sql = 'SELECT * FROM products WHERE category = :selectedCategory';
                    $query = $pdo->prepare($sql);
                    $query->bindValue(':selectedCategory', $_GET['category'], PDO::PARAM_STR);
                    $query->execute();

                    while($product = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="<?= $product['picture']; ?>" class="card-img-top" alt="<?= $product['title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?= $product['title']; ?></h5>
                                    <p class="card-text text-center"><?= $product['description']; ?></p>
                                    <a href="product_info.php?id_product=<?= $product['id_product']; ?>" class="btn btn-dark d-block mx-auto">Voir le produit</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {
                    // Affichage par défaut si aucune catégorie sélectionnée
                    echo '<div class="col-md-12"><p class="text-center">Sélectionnez une catégorie pour afficher les produits.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once("inc/footer.php");
?>
