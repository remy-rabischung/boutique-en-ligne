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

<div class="container-fluid" id="index1">
    <div class="text-center text-light">
        <h1>Bienvenue chez Wonka!</h1>
        <p>Tentez votre chance en achetant des Tablettes Wonka pour gagner un Ticket d'Or!</p>
        <img src="assets/golden-ticket.png" alt="Ticket d'Or" class="img-fluid w-25"><br><br><br>
        <a href="shop.php" class="btn btn-primary btn-lg">Visitez la boutique</a>
    </div>
</div>

<div class="container-fluid" id="index2">
    <div class="text-center text-light">
        <h1>La Tablette Wonka Original !</h1><br>
        <p>Une chance sur 10 Millions d'obtenir le célèbre Ticket d'Or !</p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <a href="http://localhost/boutique-en-ligne/product_info.php?id_product=3" class="btn btn-primary btn-lg">Achetez des Tablettes Wonka</a>
    </div>
</div>

<div class="container-fluid" id="index3">
    <div class="text-center text-dark">
        <h2>Nos Produits Vedettes</h2>
    </div>
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card card-custom">
                <img src="assets/file2.png" class="card-img-top" alt="Creation">
                <div class="card-body">
                    <h5 class="card-title">Caramel Lava Brownie</h5>
                    <p class="card-text">Un brownie riche et dense avec un cœur coulant de caramel salé, offrant une explosion de saveurs chocolatées et sucrées-salées.</p>
                    <a href="http://localhost/boutique-en-ligne/product_info.php?id_product=5" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom">
                <img src="assets/file.png" class="card-img-top" alt="Bonbon">
                <div class="card-body">
                    <h5 class="card-title">Fizzy Fruity Fizzles</h5>
                    <p class="card-text">Ces bonbons pétillants explosent en bouche avec des saveurs de fruits tropicaux.</p>
                    <a href="http://localhost/boutique-en-ligne/product_info.php?id_product=7" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom">
                <img src="assets/choco-4.png" class="card-img-top" alt="Chocolat">
                <div class="card-body">
                    <h5 class="card-title">Triple Choco Crunch</h5>
                    <p class="card-text">Un assortiment de gâteaux avec une mousse légère et onctueuse en trois couches de chocolat.</p>
                    <a href="http://localhost/boutique-en-ligne/product_info.php?id_product=6" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("inc/footer.php");
?>
