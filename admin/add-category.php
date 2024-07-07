<?php 
    if(!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])){
        return header('Location: /boutique-en-ligne/index.php');
    }

    require_once(__DIR__ . '/../classes/Category.php');

    $category = new Category();
    
    $allCategories = $category->getAllCategories();

    if(isset($_POST['category_name'])){
        if(!strlen($_POST['category_name'])){
            echo 'The name of category is expected!';
        } else {
            $category->saveCategory($_POST['category_name'], $_POST['category_parent']);
            header('Location: /boutique-en-ligne/admin/categories.php');
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
            background: linear-gradient(to right, yellow, orange, green);
        }
        .container{
            width: 40%;
            display: block;
            margin: 0 auto;
        }
        .nav-link{
            color: blue;
        }
    </style>    
<body>
    <a class="nav-link ms-3" href="../index2.php"><--Back to the Home Page</a>
    <div class="container mt-5">
        <h2 class="mb-4">Add New Category</h2>
        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required>
                <div class="invalid-feedback">Please enter a category name.</div>
            </div>
            <div class="mb-3">
                <label for="category_parent" class="form-label">Parent Category</label>
                <select name="category_parent" id="category_parent" class="form-select">
                    <option value="0">Choose the category of the parent</option>
                    <?php
                        foreach($allCategories as $item){
                            echo "<option value='{$item['id']}'>{$item['nom']}</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
