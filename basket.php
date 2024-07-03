<?php
require_once(__DIR__ . '/classes/Product.php');
require_once(__DIR__ . '/classes/Basket.php');

$basket = new Basket();

$productsInBasketIds = array_map(function($item){
    return $item['product_id'];
}, $basket->getUserBasket($_COOKIE['logged']));

$productObject = new Product();
$productsInBasket = $productObject->getProductsByIds($productsInBasketIds);

if(isset($_POST['total_price'])){
    $order_id = $basket->createOrder($_POST['total_price'], $_COOKIE['logged']);

    $basket->createOrderProducts($productsInBasket, $_POST['quantity'], $order_id);
}

if(isset($_GET['delete'])){
    $basket->removeFromBasket($_COOKIE['logged'], $_GET['delete']);
    header("Location: /boutique-en-ligne/basket.php");
}





$startProdcutsPrice = array_reduce($productsInBasket, function($acc, $item){
    return $acc + $item['prix'];
}, 0);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gradient-custom {
            background: #6a11cb;
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<body>
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <form class="row d-flex justify-content-center my-4" method="post">
      <div class="col-md-8" >
        <input type="hidden" name="total_price" value="<?php echo $startProdcutsPrice; ?>" />
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Panier - <?php echo count($productsInBasket); ?> produits</h5>
          </div>
          <div class="card-body">


            <hr class="my-4" />

            <?php foreach($productsInBasket as $basketProduct): ?>

            <!-- Single item -->
            <div class="row" data-product>
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="/boutique-en-ligne/products_images/<?php echo $basketProduct['image']; ?>"
                    class="w-100" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <p><strong><?php echo $basketProduct['nom']; ?></strong></p>

                <a href="/boutique-en-ligne/basket.php?delete=<?php echo $basketProduct['id']; ?>" type="button" class="btn btn-primary btn-sm me-1 mb-2" title="Remove item">
                  <i class="fas fa-trash"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm mb-2">
                  <i class="fas fa-heart"></i>
                </button>
                <!-- Data -->
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Quantity -->
                <div class="d-flex mb-4" style="max-width: 300px">
                  <button type="button" class="btn btn-primary px-3 me-2" data-down>
                    <i class="fas fa-minus"></i>
                  </button>

                  <div data-mdb-input-init class="form-outline">
                    <input id="form1" min="1" name="quantity[]" value="1" type="number" class="form-control" max="<?php echo $basketProduct['stock']; ?>" />
                    <label class="form-label" for="form1">Quantity</label>
                  </div>

                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 ms-2" data-up>
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- Quantity -->

                <!-- Price -->
                <p class="text-start text-md-center">
                  <strong data-price="<?php echo $basketProduct['prix']; ?>">$<?php echo $basketProduct['prix']; ?></strong>
                </p>
                <!-- Price -->
              </div>
            </div>
            <!-- Single item -->

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
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>$<b data-finalprice><?php echo $startProdcutsPrice; ?></b></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Gratis</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span><strong>$<?php echo $startProdcutsPrice; ?></strong></span>
              </li>
            </ul>

            <button type="submit" class="btn btn-primary btn-lg btn-block">
              Pay
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
    const recalculateBasket = () => {
        const products = document.querySelectorAll('[data-product]');

        let finalPrice = 0;

        products.forEach(el => {
            finalPrice += parseInt(el.querySelector('[data-price]').dataset.price) * el.querySelector('input[type="number"]').value;
        });

        document.querySelector('[data-finalprice]').innerText = finalPrice;
        document.querySelector('[name="total_price"]').value = finalPrice;
    }


    document.querySelectorAll("[data-down]").forEach(el => el.addEventListener('click', e => {
        e.preventDefault();
        el.parentNode.querySelector('input[type=number]').stepDown();
        recalculateBasket();
    }))

    document.querySelectorAll("[data-up]").forEach(el => el.addEventListener('click', e => {
        e.preventDefault();
        el.parentNode.querySelector('input[type=number]').stepUp();
        recalculateBasket();
    }))

</script>

</body>
</html>