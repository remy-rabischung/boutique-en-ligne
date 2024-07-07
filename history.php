<?php include 'includes/header.php'; ?>

<?php
    if(!isset($_COOKIE['logged'])){
        header('Location: /boutique-en-ligne/index.php');
    }

    require_once(__DIR__ . '/classes/Order.php');
    require_once(__DIR__ . '/classes/Product.php');

    $orderObject = new Order();
    $orders = $orderObject->getUserOrders($_COOKIE['logged']);
    $productObject = new Product();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div id="accordion">
    <?php foreach($orders as $order): ?>
        <div class="card">
            <div class="card-header" id="heading<?php echo $order['id']; ?>">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $order['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $order['id']; ?>">
                <?php echo $order['date']; ?> - <?php echo $order['total']; ?>$ - <span class="badge badge-success">Payed</span>
                </button>
            </h5>
            </div>

            <div id="collapse<?php echo $order['id']; ?>" class="collapse" aria-labelledby="heading<?php echo $order['id']; ?>" data-parent="#accordion">
            <div class="card-body">
                <?php 
                    $orderProducts = $orderObject->getProductsForOrder($order['id']);
                ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Unit price</th>
                        <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orderProducts as $key => $orderProduct): ?>
                            <?php $product = $productObject->getProductById($orderProduct['id_produit']); ?>
                            <tr>
                                <th scope="row"><?php echo $key + 1; ?></th>
                                <td><?php echo $product['nom'];?></td>
                                <td><?php echo $orderProduct['prix_unitaire']; ?>$</td>
                                <td><?php echo $orderProduct['quantite']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
<?php
    include 'includes/footer.php';
?> 