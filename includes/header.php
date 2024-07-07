<?php
    if(isset($_GET['logout'])){
        unset($_COOKIE['logged']);
        setcookie('logged', '', time() - 3600, '/');
        header('Location: /boutique-en-ligne/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>

    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to CSS file -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Optional: Include the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Optional: Include the Popper.js library -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <!-- Link to Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid header">
                <img class="logo" src="assets/images/Wonka-logo.png" alt="Logo">
                <a class="nav-link1 ms-3" href="index.php">Home Page</a>
                <a class="nav-link1 ms-5" href="shop.php">Shop</a>
                <a class="nav-link1 ms-5" href="aboutUs.php">About us</a>
                <a class="nav-link1 ms-5" href="contact-page.php">Contact</a>
                <input list="search_results" id="search_input" placeholder="Search for products..." class="form-control">
                <datalist id="search_results"></datalist>
                <button id = "button1" class="btn btn-outline-primary" type="button" onclick="handleSearch()">Search</button>
                
                <?php if(isset($_COOKIE['logged'])): ?>
                    <a href="?logout">
                        <img class="icon" src="assets/images/logout.jpg" alt="">
                    </a>
                <?php else: ?>
                    <a href="login.php">
                        <img class="icon" src="assets/images/connect.png" alt="">
                    </a>
                <?php endif; ?>

                <a href="basket.php">
                        <img class="icon" src="assets/images/panier.png" alt="">
                    </a>
                

                
            </div>
        </nav>
    </header>


    <!-- Your content goes here -->

    <script>
        document.querySelector('#search_input').addEventListener('keyup', async e => {
            if(e.target.value.length === 0){
                document.querySelector('#search_results').innerHTML = '';
                return;
            }

            const request = await fetch(`/boutique-en-ligne/api/search-products.php?query=` + e.target.value);
            const response = await request.json();

            document.querySelector('#search_results').innerHTML = response.map(el => `<option data-id="${el.id}" value="${el.nom}"></option>`).join('');
        });

        document.querySelector('#search_input').addEventListener('input', async e => {
            if(e.inputType === 'insertReplacementText'){
                const options = [...document.querySelectorAll('#search_results option')];
                const selectedOption = options.find(el => el.value === e.target.value);

                if(selectedOption){
                    window.location.href = `/boutique-en-ligne/product.php?id=` + selectedOption.dataset.id;
                }
            }
        });

        function handleSearch() {
            const input = document.querySelector('#search_input');
            const options = [...document.querySelectorAll('#search_results option')];
            const selectedOption = options.find(el => el.value === input.value);

            if (selectedOption) {
                window.location.href = `/boutique-en-ligne/product.php?id=` + selectedOption.dataset.id;
            } else {
                alert('No matching product found');
            }
        }
    </script>

</body>
</html>

<style>

.header .nav-link1 {
    color: blue;
    font-weight: bold;

    text-decoration: none; /* Removes underline from links */
    font-family: 'WonkaFonts', sans-serif;
    font-size: 20px;
    letter-spacing: 5px;
}
@font-face {
    font-family: 'WonkaFonts';
    src: url('fonts/WillyWonka.ttf') format('truetype');
}

.header .nav-link1:hover {
    color: rgb(134, 18, 109); /* Changes color on hover */
}
.nav-link1{
    padding-bottom: 35px;
}
#search_input {
    margin-left: auto;
    margin-bottom: 35px;
    padding: 5px;
    border-radius: 5px;
    width: 20%;
}
#button1 {
    margin-bottom: 35px;
    margin-left: 5px;
}
.logo {
    width: 150px;
    height: auto;
    margin-bottom: 40px;
}
.icon:hover {
    transform: scale(1.1); /* Slightly enlarges the logo */
    opacity: 0.8; /* Slightly fades the logo */
}
.icon {
    width: 30px;
    height: auto;
    margin-bottom: 35px;
    margin-left: 20px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

</style>
