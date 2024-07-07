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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
    <style>
        
        body{
            background: linear-gradient(to right, blue,green,yellow, red);
        } 
        .form-container{
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content : center;
            display: block;
            margin: 0 auto;
        }
    </style>    
<body>
    <a class="nav-link ms-3" href="../index2.php"><--Back to the Home Page</a>
    <div class="container mt-5">
        <?php 
            if(isset($errors)){
                echo "<div class='alert alert-danger'><ul>";
                foreach($errors as $error){
                    echo "<li>{$error}</li>";
                }
                echo "</ul></div>";
            }
        ?>
        <div class = " form-container ">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label text-white ">Description</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label text-white">Price in $</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label text-white ">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label text-white ">Choose an image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label text-white ">Category</label>
                    <select class="form-select" name="category_id" id="category_id">
                        <?php
                            foreach($categories as $category){
                                echo "<option value='{$category['id']}'>{$category['nom']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include '../includes/footer.php';
?>
