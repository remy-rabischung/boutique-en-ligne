<?php
include 'includes/header.php';
require_once('classes/Database.php');
require_once('classes/Product.php');
require_once('classes/Category.php');

// Pobierz produkty i kategorie
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
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
    background: linear-gradient(to right, red, yellow, green, blue);
    }
        .form-container {
            width: 40%; /* Adjust the width as needed */
            margin: auto;
        }
        .min-vh-100 {
            min-height: 100vh;
        }
        button{
            align-items: center;
        }
        h1{
            color: white;
            font-family: 'WonkaFonts', sans-serif;
            letter-spacing: 5px;
            background-color: black;
            opacity: 0.8;
            text-align: center;
        }
        h3{
            width: 20%;
            color: white;
            font-family: 'WonkaFonts', sans-serif;
            letter-spacing: 5px;
            background-color: black;
            opacity: 0.8;
            text-align: center;
            display: block;
            margin: 160px auto 30px auto!important;
        }
     
        p{
            font-size:15px;
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
        .carousel-item {
    display: flex;
    justify-content: center;
    }

    .card {
        margin: 0 15px;
        opacity: 0.8; /* Ustawia przezroczystość karty na 90% */
        transition: opacity 0.3s ease; /* Dodaje płynne przejście dla efektu przezroczystości */
    }

    .card:hover {
        opacity: 1; /* Ustawia pełną widoczność karty podczas najechania myszką */
    }

    .card-img-top {
        height: 350px; /* Przykładowa wysokość obrazu - dostosuj w zależności od potrzeb */
    }

    .card-body {
        background-color: rgba(255, 255, 255, 0.8); /* Tło karty z przezroczystością 80% */
        /* Możesz dodać więcej stylów tutaj w zależności od potrzeb */
    }
            .card {
                margin: 0 15px;
            }
            .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: black; /* Ustawia tło ikon na czarne */
        filter: invert(1); /* Odwraca kolory, aby czarne strzałki były widoczne na czarnym tle */
    }

    .carousel-control-prev,
    .carousel-control-next {
        color: black; /* Kolor strzałek - czarny */
        margin: -70px;
    }
    .responsive-img{
        max-width: 100%;
        height: auto;
    }
    #narrow{
        display: block;
        margin: auto, 0;
    }
    #products {
    display: flex;
    flex-wrap: wrap;
   
}
    .product-item {
    width: 30%;
    list-style-type: none; 
    margin-left:1.6%;
}
    </style>
</head>
<body>
    <img src="assets/images/indexBG5.jpg" alt="Opis obrazka" class="responsive-img">
    <h1>The chocolate river was flowing through the heart of the factory, with its rich, creamy brown color and delicious aroma.</h1><br>
    <main>
    <h3>Our products</h3>
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
                            <div class="card ">
                            <img class="card-img-top" src="assets/images/sweets/sweets24.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Pralines Alex and Ant</h5>
                                    <h6><p class="card-text">Each praline features a delicate almond center wrapped in velvety milk chocolate.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=16" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets19.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Pralines all fruits</h5>
                                    <h6><p class="card-text">Each praline is a vibrant celebration of nature’s finest fruits, skillfully blended into rich.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=19" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets23.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Pralines for Gourmet</h5>
                                    <h6><p class="card-text">These artisanal pralines are crafted for the discerning palate, featuring rich in premium chocolate.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=17" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets20.jpg" alt="Sweets picture">
                                <div class="card-body">
                                    <h5 class="card-title">Colorful lollipop</h5>
                                    <h6><p class="card-text"> This delightful treat is more than just candy; it's an experience that takes you back to the joys of childhood.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=8" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets30.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Dream box</h5>
                                    <h6><p class="card-text">Unlock the magic of indulgence with our Magic Box, best selection of premium chocolate bars. </p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=10" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets1.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Gummies</h5>
                                    <h6><p class="card-text">Delight in the whimsical world of Wonka where ever you want with our magical gummies!</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=11" class="btn btn-primary">View Details</a>
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
        <h3> New products</h3>
        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card ">
                            <img class="card-img-top" src="assets/images/sweets/sweets6.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">The edibles red fruits</h5>
                                    <h6><p class="card-text">Experience a burst of fruity magic with Berry Bliss Delights!</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=14" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets.jpg" alt="Pictur of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">The edibles all fruits</h5>
                                    <h6><p class="card-text">Step into a world of endless flavor with Wonka’s Everlasting Gobstopper!</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=12" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets25.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">The edibles garden fruits</h5>
                                    <h6><p class="card-text">Step into a Garden Fruit Bliss with these enchanting candies!</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=15" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets11.jpg" alt="Sweets picture">
                                <div class="card-body">
                                    <h5 class="card-title">Pixy sticks</h5>
                                    <h6><p class="card-text">Experience a burst of tangy sweetness with Pixy Sticks, the treat for candy lovers.</p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=26" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets16.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Marshmallow</h5>
                                    <h6><p class="card-text">Discover the fluffy delight of our Marshmallows, tasty treat that brings joy to every bite. </p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=27" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/sweets/sweets01.jpg" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Candy's Mountain Flowers</h5>
                                    <h6><p class="card-text">Step into the magical world of Wonka with our Candy's Mountain Flowers. </p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=28" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more carousel items as needed -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <h3> Bestsellers</h3>
        <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card ">
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
                                <img class="card-img-top" src="assets/images/sweets35.jpg" alt="Pictur of chocolate">
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
                                    <h6><p class="card-text"> Each bite delivers a perfect balance of sweet, buttery caramel and rich.       </p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=23" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/w12.png" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Mint chocolate</h5>
                                    <h6><p class="card-text">This best treat combines smooth, creamy chocolate with a generous mix. </p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=24" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="assets/images/w13.png" alt="Picture of chocolate">
                                <div class="card-body">
                                    <h5 class="card-title">Gluten-Free Chocolate</h5>
                                    <h6><p class="card-text">Crafted with the finest ingredients and designed to cater to those </p></h6>
                                    <a id="narrow" href="/boutique-en-ligne/product.php?id=25" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more carousel items as needed -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </main><br><br><br>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <select id="category" class="form-control mb-3">
                <option value="all">All categories</option>
                <?php
                    foreach($categories as $category){
                        echo "<option value='{$category['id']}'>{$category['nom']}</option>";
                    }
                ?>
            </select>

            <input list="products_search_list_index" id="search_input_index" class="form-control mb-3" placeholder="Search for products..." />
            <datalist id="products_search_list_index"></datalist>

            <ul id="products">
    <?php
        $firstRowProducts = array_slice($products, 0, 10);
        $secondRowProducts = array_slice($products, 10);

        foreach($firstRowProducts as $product){
            echo "<li data-category='{$product['id_categorie']}' class='product-item'>
                      <div class='product-container'>
                          <div class='product-name'>{$product['nom']}</div>
                          <a href='/boutique-en-ligne/product.php?id={$product['id']}' class='check-it-out-button'>Check it out</a>
                      </div>
                  </li>";
        }

        foreach($secondRowProducts as $product){
            echo "<li data-category='{$product['id_categorie']}' class='product-item'>
                      <div class='product-container'>
                          <div class='product-name'>{$product['nom']}</div>
                          <a href='/boutique-en-ligne/product.php?id={$product['id']}' class='check-it-out-button'>Check it out</a>
                      </div>
                  </li>";
        }
    ?>
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

            document.querySelector(`#${list}`).innerHTML = response.map(el => `<option data-id="${el.id}" value="${el.nom}" />`).join('')
        }

        const handleSearchInput = async (e, list) => {
            if(e.inputType === 'insertReplacementText'){
                const options = [...document.querySelectorAll(`#${list} option`)];
                const selectedOption = options.find(el => el.value === e.target.value);

                if(selectedOption){
                    window.location.href = '/boutique-en-ligne/product.php?id=' + selectedOption.dataset.id;
                }
            }
        }

        document.querySelector('#search_input').addEventListener('keyup', e => handleSearchKeyup(e, 'products_search_list'));
        document.querySelector('#search_input').addEventListener('input', e => handleSearchInput(e, 'products_search_list'));

        document.querySelector('#search_input_index').addEventListener('keyup', e => handleSearchKeyup(e, 'products_search_list_index'));
        document.querySelector('#search_input_index').addEventListener('input', e => handleSearchInput(e, 'products_search_list_index'));

        document.querySelector('#category').addEventListener('change', e => {
            const products = document.querySelectorAll('#products li');

            if(e.target.value === 'all'){
                products.forEach(el => el.style.display = 'list-item');
            }
            else{
                products.forEach(el => {
                    if(el.dataset.category === e.target.value){
                        el.style.display = 'list-item';
                    }
                    else{
                        el.style.display = 'none';
                    }
                });
            }
        })
    </script>
</body>
</html>
<style>

</style>    
<?php include 'includes/footer.php';?>