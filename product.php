<?php
require_once(__DIR__ . '/classes/Product.php');
require_once(__DIR__ . '/classes/Category.php');
require_once(__DIR__ . '/classes/Basket.php');

$productObject = new Product();
$product = $productObject->getProductById($_GET['id']);

$categoryObject = new Category();
$category = $categoryObject->getCategoryById($product['id_categorie']);

$basket = new Basket();
;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>body{background-color: #000}.card{border:none}.product{background-color: #eee}.brand{font-size: 13px}.act-price{color:red;font-weight: 700}.dis-price{text-decoration: line-through}.about{font-size: 14px}.color{margin-bottom:10px}label.radio{cursor: pointer}label.radio input{position: absolute;top: 0;left: 0;visibility: hidden;pointer-events: none}label.radio span{padding: 2px 9px;border: 2px solid #ff0000;display: inline-block;color: #ff0000;border-radius: 3px;text-transform: uppercase}label.radio input:checked+span{border-color: #ff0000;background-color: #ff0000;color: #fff}.btn-danger{background-color: #ff0000 !important;border-color: #ff0000 !important}.btn-danger:hover{background-color: #da0606 !important;border-color: #da0606 !important}.btn-danger:focus{box-shadow: none}.cart i{margin-right: 10px}</style>
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="/boutique-en-ligne/products_images/<?php echo $product['image']; ?>" width="250" /> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div> <i class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"><?php echo $category['nom']; ?></span>
                                <h5 class="text-uppercase"><?php echo $product['nom']; ?></h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">$<?php echo $product['prix']; ?></span>
                                    <div class="ml-2"> </div>
                                </div>
                            </div>
                            <p class="about"><?php echo $product['description']; ?></p>
                            
                            <div class="cart mt-4 align-items-center"> 
                                <?php if($basket->isInBasket($_COOKIE['logged'], $product['id'])): ?>
                                    <button class="btn btn-danger text-uppercase mr-2 px-4">Remove from cart</button> 
                                <?php else: ?>
                                    <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button> 
                                <?php endif; ?>

                                <i class="fa fa-heart text-muted"></i> 
                                <i class="fa fa-share-alt text-muted"></i> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>