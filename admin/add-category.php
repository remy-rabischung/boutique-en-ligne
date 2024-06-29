<?php 
    if(!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])){
        return header('Location: /boutique-en-ligne/index.php');
    }

    require_once(__DIR__ . '/../classes/Category.php');

    $category = new Category();
    
    $allCategories = $category->getAllCategories();

    if(isset($_POST['category_name'])){
        if(!strlen($_POST['category_name'])){
            echo 'Nazwa kategorii jest wymagana!';
        }

        $category->saveCategory($_POST['category_name'], $_POST['category_parent']);
        header('Location: /boutique-en-ligne/admin/categories.php');
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
    <form method="post">
        <input type="text" name="category_name" />
        <select name="category_parent">
            <option value="0">Wybierz kategorie rodzica</option>
            <?php
                foreach($allCategories as $item){
                    echo "<option value='{$item['id']}'>{$item['nom']}</option>";
                }
                
            ?>
        </select>

        <button type="submit">Dodaj</button>
    </form>
</body>
</html>