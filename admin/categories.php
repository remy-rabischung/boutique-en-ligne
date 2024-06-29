<?php
if(!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])){
    return header('Location: /boutique-en-ligne/index.php');
}

require_once(__DIR__ . '/../classes/Category.php');
require_once(__DIR__ . '/../utils/Utils.php');

$category = new Category();

if(isset($_GET['delete_id'])){
    $category->deleteCategory($_GET['delete_id']);
}

$categories = $category->getCategoriesWithChildren();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/boutique-en-ligne/admin/add-category.php">Dodaj kategorie</a>

    <?php
        Utils::showCategoryList($categories);
    ?>

</body>
</html>