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
    <title>Product Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<style>
    body{
        background: linear-gradient(to right, yellow, orange, blue);
    }
    .container{
        width: 40%;
        display: block;
        margin: 0 auto;
    }

</style>    
<body>
    <a class="nav-link ms-3" href="../index2.php"><--Back to the Home Page</a>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Product Management</h2>
            <a href="/boutique-en-ligne/admin/add-product.php" class="btn btn-primary">Add a Product</a>
        </div>

        <ul class="list-group">
            <?php
                foreach($products as $product){
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                            {$product['nom']}
                            <div>
                                <a href='/boutique-en-ligne/admin/edit-product.php?id={$product['id']}' class='btn btn-warning btn-sm me-2'>Edit</a>
                                <a href='/boutique-en-ligne/admin/products.php?delete_id={$product['id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </div>
                          </li>";
                }
            ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
