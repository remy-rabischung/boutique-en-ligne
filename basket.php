<?php
ob_start();  // Start output buffering

// Start the session at the top
session_start();

// Check if the user is logged in
if (!isset($_COOKIE['logged'])) {
  header('Location: /boutique-en-ligne/index.php');
  exit();  // Add exit to stop further execution after redirection
}

// Include header.php and the rest of your PHP logic
include 'includes/header.php';

// Include the required classes
require_once(__DIR__ . '/classes/Product.php');
require_once(__DIR__ . '/classes/Basket.php');

$basket = new Basket();
$productsInBasketIds = array_map(function($item) {
    return $item['product_id'];
}, $basket->getUserBasket($_COOKIE['logged']));

$productObject = new Product();
$productsInBasket = count($productsInBasketIds) ? $productObject->getProductsByIds($productsInBasketIds) : [];

if (isset($_POST['total_price'])) {
    $order_id = $basket->createOrder($_POST['total_price'], $_COOKIE['logged']);
    $basket->createOrderProducts($productsInBasket, $_POST['quantity'], $order_id);
    $basket->clearUserBasket($_COOKIE['logged']);

    header('Location: /boutique-en-ligne/history.php');
    exit();  // Add exit to stop further execution after redirection
}

if (isset($_GET['delete'])) {
    $basket->removeFromBasket($_COOKIE['logged'], $_GET['delete']);
    header("Location: /boutique-en-ligne/basket.php");
    exit();  // Add exit to stop further execution after redirection
}

$startProdcutsPrice = array_reduce($productsInBasket, function($acc, $item) {
    return $acc + $item['prix'];
}, 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <style>
    #history_link{
        padding-left: 50px;
        font-size: 20px;
        font-weight: bold;
    }
    .gradient-custom {
        opacity: 0.8;
    }
    body{
        background-image: url('assets/images/BGM.jpg');
    }
    .btn-quantity {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    .product-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-image {
        max-width: 100%;
        max-height: 100px;
        object-fit: cover;
    }
</style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <form class="row d-flex justify-content-center my-4" method="post">
      <div class="col-md-8">
        <input type="hidden" name="total_price" value="<?php echo $startProdcutsPrice; ?>" />
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Ton panier - <?php echo count($productsInBasket); ?> produits</h5>
          </div>
          <div class="card-body">
            <hr class="my-4" />
            <?php foreach($productsInBasket as $basketProduct): ?>
            <div class="row" data-product>
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="/boutique-en-ligne/products_images/<?php echo $basketProduct['image']; ?>"
                    class="w-100" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
              </div>
              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <p><strong><?php echo $basketProduct['nom']; ?></strong></p>
                <a href="/boutique-en-ligne/basket.php?delete=<?php echo $basketProduct['id']; ?>" type="button" class="btn btn-primary btn-sm me-1 mb-2" title="Remove item">
                  <i class="fas fa-trash"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm mb-2">
                  <i class="fas fa-heart"></i>
                </button>
              </div>
              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex mb-4" style="max-width: 300px">
                  <button type="button" class="btn btn-primary px-3 me-2" data-down>
                    <i class="fas fa-minus"></i>
                  </button>
                  <div data-mdb-input-init class="form-outline">
                    <input id="form1" min="1" name="quantity[]" value="1" type="number" class="form-control" max="<?php echo $basketProduct['stock']; ?>" />
                    <label class="form-label" for="form1">Quantity</label>
                  </div>
                  <button type="button" class="btn btn-primary px-3 ms-2" data-up>
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <p class="text-start text-md-center">
                  <strong data-price="<?php echo $basketProduct['prix']; ?>">$<?php echo $basketProduct['prix']; ?></strong>
                </p>
              </div>
            </div>
            <hr class="my-4" />
            <?php endforeach; ?>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <?php
                $today = date('d.m.Y');
                $startShipingDate = date('d.m.Y', strtotime($today . ' + 2 days'));
                $endShipingDate = date('d.m.Y', strtotime($today . ' + 5 days'));
            ?>
            <p class="mb-0"><?php echo $startShipingDate; ?> - <?php echo $endShipingDate; ?></p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <i style="font-size: 30px; margin-right: 10px" class="fa-brands fa-cc-visa"></i>
            <i style="font-size: 30px; margin-right: 10px" class="fa-brands fa-cc-mastercard"></i>
            <i style="font-size: 30px; margin-right: 10px" class="fa-brands fa-cc-paypal"></i>
          </div>  <a  href = "history.php" id = "history_link" > Watch your purchase history </a>
        </div>
      </div>
      <?php if(count($productsInBasketIds)): ?>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>$<b data-finalprice><?php echo $startProdcutsPrice; ?></b></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Gratis</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span>$<b data-finalprice><?php echo $startProdcutsPrice; ?></b></span>
              </li>
            </ul>
            <button type="submit" class="btn btn-primary btn-lg btn-block">
              buy and pay
            </button>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </form>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const productEls = document.querySelectorAll('[data-product]');
    const pricesEls = document.querySelectorAll('[data-price]');
    const finalPriceEls = document.querySelectorAll('[data-finalprice]');
    const quantitiesInputs = document.querySelectorAll('[name="quantity[]"]');
    let startProductPrice = <?php echo $startProdcutsPrice; ?>;
    
    const updatePrices = () => {
        let totalPrice = 0;
        quantitiesInputs.forEach((input, index) => {
            let quantity = parseInt(input.value);
            let price = parseFloat(pricesEls[index].dataset.price);
            totalPrice += price * quantity;
            pricesEls[index].textContent = `$${(price * quantity).toFixed(2)}`;
        });
        finalPriceEls.forEach(el => {
            el.textContent = totalPrice.toFixed(2);
        });
    };

    quantitiesInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (parseInt(input.value) < 1) {
                input.value = 1;
            }
            updatePrices();
        });
    });

    document.querySelectorAll('[data-up]').forEach((button, index) => {
        button.addEventListener('click', () => {
            let input = quantitiesInputs[index];
            if (parseInt(input.value) < parseInt(input.max)) {
                input.value = parseInt(input.value) + 1;
                updatePrices();
            }
        });
    });

    document.querySelectorAll('[data-down]').forEach((button, index) => {
        button.addEventListener('click', () => {
            let input = quantitiesInputs[index];
            if (parseInt(input.value) > 0) {
                input.value = parseInt(input.value) - 1;
                updatePrices();
            }
        });
    });

    updatePrices();
});
</script>
</body>
</html>
<?php
ob_end_flush();  // Flush and turn off output buffering
?>
