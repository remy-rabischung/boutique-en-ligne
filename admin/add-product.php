<?php

if(!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])){
    return header('Location: /boutique-en-ligne/index.php');
}

require_once(__DIR__ . '/../classes/Category.php');
require_once(__DIR__ . '/../classes/Product.php');

$category = new Category();
$categories = $category->getAllCategories();

$product = new Product();
if(isset($_POST['name'])){
    $errors = $product->saveProduct($_POST, $_FILES);
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
        <input type="text" name="name" placeholder="Nazwa" />
        <textarea name="description" placeholder="description"></textarea>
        <input type="number" name="price" />
        <input type="number" name="stock" />
        <input type="file" name="image" />
        <select name="category_id">
            <?php
                foreach($categories as $category){
                    echo "<option value='{$category['id']}'>{$category['nom']}</option>";
                }
            ?>
        </select>
        <button type="submit">Zapisz</button>
    </form>
</body>
</html>