<?php

require_once("../inc/init.php");

// PAGINATION

$elemsForPagination = pagination(
    $pdo, "page", "SELECT COUNT(id_product) as nbrProducts FROM products", "nbrProducts", 5);


// MODIFICATION

if(isset($_GET["action"]) && $_GET["action"] == "modify") {
    $r = $pdo->query("SELECT * FROM products WHERE id_product = '$_GET[id_product]' ");
    $product = $r->fetch(PDO::FETCH_ASSOC);
}


// DELETE

if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    $count = $pdo->exec("DELETE FROM products WHERE id_product = '$_GET[id_product]' ");
    if($count > 0) {
        $content = "<div class='alert alert-success' role='alert'>
        Le produit a bien été supprimé !
        </div>";
    }
}

// MODIFICATION/DELETE

if($_POST) {

    $fileLoad = false;
    $picturePath = '';

    if(!empty($_FILES) && !empty($_FILES["myPicture"]["name"])) {

        $pictureName = $_FILES["myPicture"]["name"];
        $picturePath = URL . "assets/" . $pictureName;
        $folderOnServer = SITE_ROOT . "assets/" . $pictureName;

        if(!empty($_FILES["myPicture"]["tmp_name"])) {
            if(copy($_FILES["myPicture"]["tmp_name"], $folderOnServer)) {
                $fileLoad = true;
            } else {
                $content .= "<div class='alert alert-danger' role='alert'>
                    Erreur lors du téléchargement de l'image.
                </div>";
            }
        } else {
            $content .= "<div class='alert alert-danger' role='alert'>
                Le fichier téléchargé est vide.
            </div>";
        }
    }

    foreach($_POST as $index => $value) {
        $_POST[$index] = addslashes($value);
    }

    // AJOUT

    if(isset($_POST["addProduct"])) {
        $count = $pdo->exec("INSERT INTO products 
        (reference, category, title, description, picture, stock, price)
        VALUES (
            '$_POST[reference]',
            '$_POST[category]',
            '$_POST[title]',
            '$_POST[description]',
            '$picturePath',
            '$_POST[stock]',
            '$_POST[price]'
        )");
        if($count > 0) {
            $content .= "<div class='alert alert-success' role='alert'>
                Le produit avec la référence " . $_POST["reference"] . " a bien été ajouté dans la base de données !
            </div>";
        }

    }
    // MODIF
    else {

        $pathPictureForModif = ($fileLoad) ? $picturePath : $_POST["prevPicture"];
        $count = $pdo->exec("UPDATE products SET
        reference = '$_POST[reference]',
        category = '$_POST[category]',
        title = '$_POST[title]',
        description = '$_POST[description]',
        picture = '$pathPictureForModif',
        price = '$_POST[price]',
        stock = '$_POST[stock]'
        WHERE id_product = '$_POST[id_product]'
        ");

        if($count > 0) {
            $content .= "<div class='alert alert-success' role='alert'>
                Le produit avec la référence " . $_POST["reference"] . " a bien été modifié dans la base de données !
            </div>";
        }

    }

}

$stmt = $pdo->query("SELECT * FROM products ORDER BY id_product ASC LIMIT $elemsForPagination[first], 5 ");



$idProduct = (isset($product)) ? $product["id_product"] : "";
$reference = (isset($product)) ? $product["reference"] : "";
$category = (isset($product)) ? $product["category"] : "";
$title = (isset($product)) ? $product["title"] : "";
$description = (isset($product)) ? $product["description"] : "";
$picture = (isset($product)) ? $product["picture"] : "";
$price = (isset($product)) ? $product["price"] : "";
$stock = (isset($product)) ? $product["stock"] : "";


require_once("inc/header.php");

?>


<!-- BODY -->

<h1 class="mb-5 text-center col-12">Bienvenue dans l'administration des produits</h1>

<?= $content; ?>

<!-- TABLE -->

<p class="text-center col-12">Liste des produits en base de données : </p>


<table class="table">
    <thead class="thead-dark">
        <tr>
            <?php for($i = 0; $i < $stmt->columnCount(); $i++) {
                $col = $stmt->getColumnMeta($i); ?>
                <th scope="col"> <?= $col["name"]; ?> </th>
            <?php } ?>
            <th scope="col"> Modifier </th>
            <th scope="col"> Supprimer </th>
        </tr>
    </thead>
    <tbody>
            
        <?php foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $index =>$product) { ?>
            <tr>

                <?php foreach($product as $index => $value) { 

                    if($index == "picture") { ?>
                        <td> <img style="width:50px" src="<?= $value; ?>"/> </td>
                    <?php } else { ?>
                        <td> <?= $value; ?> </td>
                    <?php } ?>

                <?php } ?>    
            
                <td> <a href="?action=modify&amp;id_product=<?= $product["id_product"]; ?>#add_modify"> Modifier </a> </td>
                <td> <a href="?action=delete&amp;id_product=<?= $product["id_product"]; ?>"> Supprimer </a> </td>
            </tr>
        <?php } ?>

    </tbody>
</table>


<div class="row col-12">
    <?php
        require_once("../inc/pagination.php");
    ?>
</div>


<p id="add_modify">Ajouter ou modifier un produit :</p>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_product" value="<?php echo $idProduct; ?>">
    <input type="hidden" name="prevPicture" value="<?php echo $picture; ?>">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="reference">Reference</label>
            <input type="text" class="form-control" id="reference" name="reference" value="<?= $reference ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="category">Catégorie</label>
            <input type="text" class="form-control" id="category" name="category" value="<?= $category ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="price">Prix</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= $price ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" value="<?= $stock ?>">
        </div>
        <div class="w-100"></div>

        <div class="custom-file mb-5">
            <input type="file" class="custom-file-input" id="myPicture" name="myPicture">
            <label class="custom-file-label" for="myPicture">Choisissez une image</label>
            
            <?php if(isset($_GET["action"]) && $_GET["action"] == "modify") { ?>
                <img class="mt-1" style="width:75px" src="<?= $picture; ?>" alt="<?= $title; ?>" title="<?= $description ?>">
            <?php } ?>

        </div>
        <div class="form-group col-md-12">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= $description ?>">
        </div>

        <?php if(isset($_GET["action"]) && $_GET["action"] == "modify") { ?>
            <button type="submit" class="btn btn-secondary" name="modifyProduct">Modifier un produit</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-secondary" name="addProduct">Ajouter un produit</button>
        <?php } ?>

    </div>

</form>

<?php
require_once("inc/footer.php");
?>

