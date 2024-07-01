<?php

if(!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])){
    return header('Location: /boutique-en-ligne/index.php');
}

require_once(__DIR__ . '/../classes/Product.php');

$product = new Product();

if(isset($_GET['delete_id'])){
    $product->deleteProduct($_GET['delete_id']);
}

$products = $product->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/boutique-en-ligne/admin/add-product.php">Dodaj produkt</a>

    <ul>
        <?php
            foreach($products as $product){
                echo "<li>{$product['nom']} <a href='/boutique-en-ligne/admin/edit-product.php?id={$product['id']}'>Edytuj</a><a href='/boutique-en-ligne/admin/products.php?delete_id={$product['id']}'>Usun</a></li>";
            }
        ?>
    </ul>

</body>
</html>