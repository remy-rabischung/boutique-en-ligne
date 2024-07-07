<?php
include 'includes/header.php';

require_once(__DIR__ . '/classes/Product.php');
require_once(__DIR__ . '/classes/Category.php');

$productObject = new Product();
$products = $productObject->getAllProducts();

$categoryObject = new Category();
$categories = $categoryObject->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Existing CSS */
        body {
            background-image: url('assets/images/wonka1.jpg');
        }
        .form-container {
            width: 40%;
            margin: auto;
        }
        .min-vh-100 {
            min-height: 100vh;
        }
        button {
            align-items: center;
        }
        h1, h3 {
            color: white;
            font-family: 'WonkaFonts', sans-serif;
            letter-spacing: 5px;
            background-color: black;
            opacity: 0.8;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        h3 {
            width: 20%;
            margin: 160px auto 30px auto !important;
        }
        .product-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            background-color: black;
            color: red;
            font-weight: bold;
            padding-left: 2%;
            width: 60%;
            margin-top: 10px;
            opacity: 0.8;
        }
        .check-it-out-button {
            margin-top: auto;
        }
        .carousel-item {
            display: flex;
            justify-content: center;
        }
        .card {
            margin: 0 15px;
            opacity: 0.8; 
            transition: opacity 0.3s ease; 
        }
        .card:hover {
            opacity: 1; 
        }
        .card-img-top {
            height: 400px;
        }
        .card-body {
            background-color: rgba(255, 255, 255, 0.8);
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
            filter: invert(1);
        }
        .carousel-control-prev,
        .carousel-control-next {
            color: black;
        }
        #narrow {
            display: block;
            margin: auto;
        }
        #products {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .product-item {
            width: 30%;
            list-style-type: none;
            margin-left: 1.6%;
        }
        #category, #search_input_index {
            width: 300px;
            margin-left: 50px;
            margin-top: 100px;
        }
        /* Responsive Styles */
        @media (max-width: 768px) {
            .form-container {
                width: 80%;
            }
            h3 {
                width: 80%;
                margin: 30px auto;
            }
            .product-container {
                width: 90%;
                margin: 10px auto;
            }
            .product-item {
                width: 100%;
                margin: 10px 0;
            }
            .carousel-item .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>The chocolate river was flowing through the heart of the factory, with its rich, creamy brown color and delicious aroma.</h1><br>
    <h3> Bestsellers</h3>
    <main>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets37.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">The milky way</h5>
                                    <h6><p class="card-text">Premium chocolate offering a luxurious, gourmet experience.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=20" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets35.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Crazy vanilla</h5>
                                    <h6><p class="card-text">Smooth, luscious chocolate that melts effortlessly on your tongue.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=21" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets 34.png" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Sweet nuts</h5>
                                    <h6><p class="card-text">A bold and intense flavor for true chocolate lovers that you need.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=22" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/w11.png" alt="Sweets picture">
                                <div class="card-body">
                                    <h5 class="card-title">Caramel chocolate</h5>
                                    <h6><p class="card-text">Each bite delivers a perfect balance of sweet, buttery caramel and rich.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=23" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/w12.png" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Mint chocolate</h5>
                                    <h6><p class="card-text">Delectable treat combines smooth, creamy chocolate with a generous mix.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=24" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/w13.png" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Gluten-Free Chocolate</h5>
                                    <h6><p class="card-text">Crafted with the finest ingredients and designed to cater to those.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=25" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more carousel items as needed -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </main><br><br><br>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <select id="category" class="form-control mb-3">
                <option value="all">All categories</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category['id']; ?>"><?= $category['nom']; ?></option>
                <?php endforeach; ?>
            </select>

            <input list="products_search_list_index" id="search_input_index" class="form-control mb-3" placeholder="Search for products..." />
            <datalist id="products_search_list_index"></datalist>

            <ul id="products">
                <?php foreach($products as $product): ?>
                    <li data-category="<?= $product['id_categorie']; ?>" class="product-item">
                        <div class="product-container">
                            <div class="product-name"><?= $product['nom']; ?></div>
                            <a href="/boutique-en-ligne/product.php?id=<?= $product['id']; ?>" class="check-it-out-button">Check it out</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script>
        const handleSearchKeyup = async (e, list) => {
            if(e.target.value.length === 0){
                document.querySelector(`#${list}`).innerHTML = '';
                return;
            }

            const request = await fetch('/boutique-en-ligne/api/search-products.php?query=' + e.target.value);
            const response = await request.json();

            document.querySelector(`#${list}`).innerHTML = response.map(el => `<option data-id="${el.id}" value="${el.nom}" />`).join('');
        };

        const handleSearchInput = async (e, list) => {
            if(e.inputType === 'insertReplacementText'){
                const options = [...document.querySelectorAll(`#${list} option`)];
                const selectedOption = options.find(el => el.value === e.target.value);

                if(selectedOption){
                    window.location.href = '/boutique-en-ligne/product.php?id=' + selectedOption.dataset.id;
                }
            }
        };

        document.querySelector('#search_input_index').addEventListener('keyup', e => handleSearchKeyup(e, 'products_search_list_index'));
        document.querySelector('#search_input_index').addEventListener('input', e => handleSearchInput(e, 'products_search_list_index'));

        document.querySelector('#category').addEventListener('change', e => {
            const products = document.querySelectorAll('#products li');

            if(e.target.value === 'all'){
                products.forEach(el => el.style.display = 'list-item');
            } else {
                products.forEach(el => {
                    if(el.dataset.category === e.target.value){
                        el.style.display = 'list-item';
                    } else {
                        el.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>

<?php include 'includes/footer.php';?>
