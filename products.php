<?php

require_once(__DIR__ . '/classes/Product.php');
require_once(__DIR__ . '/classes/Category.php');


$productObject = new Product();
$products = $productObject->getAllProducts();

$categoryObject = new Category();
$categories = $categoryObject->getAllCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <select id="category">
        <option value="all">Wszystkie kategorie</option>
        <?php
            foreach($categories as $category){
                echo "<option value='{$category['id']}'>{$category['nom']}</option>";
            }
        ?>
    </select>

    <input list="prodcuts_search_list" id="search_input" />
    <datalist id="prodcuts_search_list">
    
    </datalist>


    <ul id="products">
        <?php
            foreach($products as $product){
                echo "<li data-category={$product['id_categorie']}>{$product['nom']}<a href='/boutique-en-ligne/product.php?id={$product['id']}'>Zobacz</a></li>";
            }
        ?>

    </ul>

    <script>
        document.querySelector('#search_input').addEventListener('keyup', async e => {
            if(e.target.value.length === 0){
                document.querySelector('#prodcuts_search_list').innerHTML = '';
                return;
            }

            const request = await fetch(`/boutique-en-ligne/api/search-products.php?query=` + e.target.value);
            const response = await request.json();

            document.querySelector('#prodcuts_search_list').innerHTML = response.map(el => `<option data-id="${el.id}" value="${el.nom}" />`).join('')
        })

        document.querySelector('#search_input').addEventListener('input', async e => {
            if(e.inputType === 'insertReplacementText'){
                const options = [...document.querySelectorAll('#prodcuts_search_list option')];
                const selectedOption = options.find(el => el.value === e.target.value);

                if(selectedOption){
                    window.location.href = `/boutique-en-ligne/product.php?id=` + selectedOption.dataset.id;
                }
            }
        })

        document.querySelector('#category').addEventListener('change', e => {
            const products = document.querySelectorAll('#products li');

            if(e.target.value === 'all'){
                products.forEach(el => el.style.display = 'list-item');
            }
            else{
                products.forEach(el => {
                    if(el.dataset.category === e.target.value){
                        el.style.display = 'list-item'
                    }
                    else{
                        el.style.display = 'none';
                    }
                })
            }
        })
    </script>
</body>
</html>
