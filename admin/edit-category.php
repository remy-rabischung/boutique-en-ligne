<?php

if (!isset($_COOKIE['logged']) || !isset($_COOKIE['admin'])) {
    header('Location: /boutique-en-ligne/index.php');
    exit;
}

require_once(__DIR__ . '/../classes/Category.php');

$category = new Category();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Invalid category ID!';
    exit;
}

$categoryId = (int)$_GET['id'];
$editedCategory = $category->getCategoryById($categoryId);
if ($editedCategory === false) {
    echo 'Category not found!';
    exit;
}

$allCategories = $category->getAllCategories();

if (isset($_POST['category_name'])) {
    if (!strlen($_POST['category_name'])) {
        echo 'The name of the category is required!';
    } else {
        $category->editCategory($editedCategory['id'], $_POST['category_name'], $_POST['category_parent']);
        header('Location: /boutique-en-ligne/admin/categories.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Category</h2>
        <form method="post">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo htmlspecialchars($editedCategory['nom']); ?>" />
            </div>
            <div class="mb-3">
                <label for="category_parent" class="form-label">Parent Category</label>
                <select id="category_parent" name="category_parent" class="form-select">
                    <option value="0">Choose the category of parent</option>
                    <?php
                        foreach($allCategories as $item) {
                            $isSelected = $item['id'] == $editedCategory['parent'] ? 'selected' : '';
                            echo "<option {$isSelected} value='{$item['id']}'>{$item['nom']}</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/boutique-en-ligne/admin/categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
