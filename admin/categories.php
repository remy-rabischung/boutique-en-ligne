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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Categories</title>
    <style>
        body {
            padding: 20px;
            background: linear-gradient(to right, blue,orange, yellow)
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 18px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        ul.category-list {
            list-style-type: none;
            padding: 0;
            width: 50%;
            display:block;
            margin: 0 auto;
        }
        ul.category-list li {
            padding: 10px;
            margin: 5px 0;
            background-color: #f8f9fa;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        ul.category-list li a {
            color: #dc3545;
            text-decoration: none;
        }
        ul.category-list li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <a class="nav-link ms-3" href="../index2.php"><--Back to the Home Page</a>
    <a href="/boutique-en-ligne/admin/add-category.php" class="btn btn-primary">Add a Category</a>
    <ul class="category-list">
        <?php Utils::showCategoryList($categories); ?>
    </ul>
</body>
</html>
