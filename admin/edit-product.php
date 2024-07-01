<?php

if(!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])){
    return header('Location: /boutique-en-ligne/index.php');
}

require_once(__DIR__ . '/../classes/Category.php');
require_once(__DIR__ . '/../classes/Product.php');

$category = new Category();
$categories = $category->getAllCategories();

$productObject = new Product();
$product = $productObject->getProductById($_GET['id']);

if(isset($_POST['name'])){
    $errors = $productObject->updateProduct($product, $_POST, $_FILES);
    if(!$errors){
        header('Location: /boutique-en-ligne/admin/products.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
        if(isset($errors)){
            echo "<ul>";
            foreach($errors as $error){
                echo "<li>{$error}</li>";
            }
            echo "</ul>";
        }


    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Nazwa" value="<?php echo $product['nom']; ?>"/>
        <textarea name="description" placeholder="description"><?php echo $product['description']; ?></textarea>
        <input type="number" name="price" value="<?php echo $product['prix']; ?>"/>
        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" />
        <input type="file" name="image" />
        <select name="category_id">
            <?php
                
                foreach($categories as $item){
                    $isSelected = $item['id'] == $product['id_categorie'] ? 'selected' : '';
                    echo "<option {$isSelected} value='{$item['id']}'>{$item['nom']}</option>";
                }
            ?>
        </select>
        <button type="submit">Zapisz</button>
    </form>
</body>
</html>