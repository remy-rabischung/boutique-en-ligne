<?php
require_once("inc/init.php");
require 'vendor/autoload.php';

// Afficher les erreurs PHP pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialiser Stripe
\Stripe\Stripe::setApiKey('sk_test_51PYjoIBZAu5dkXdgYL4Gb9hm8laF2JtYrbt0LSCGJZt11SdqBwgFAA8IRNw3jWuYcnwzCdmlGnoecmzjUD38W6Qg00MsGZOMLH');

// Calculer le montant total du panier
$totalAmount = totalAmount() * 100; // Stripe travaille en cents

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['stripeToken'];

    // Créer une charge
    try {
        $charge = \Stripe\Charge::create([
            'amount' => $totalAmount,
            'currency' => 'eur',
            'description' => 'Votre description de commande',
            'source' => $token,
        ]);

        // Si le paiement est réussi, traiter la commande
        if ($charge->status == 'succeeded') {
            // Processus de commande réussi (similaire à ce que vous avez dans cart.php)
            $idMember = $_SESSION["member"]["id_member"];

            $stmt = $pdo->prepare("INSERT INTO orders(id_member, amount, date, state) VALUES (?, ?, NOW(), 'en traitement')");
            $stmt->execute([$idMember, $totalAmount / 100]);

            $idOrder = $pdo->lastInsertId();

            for ($i = 0; $i < count($_SESSION["cart"]["id_product"]); $i++) {
                $stmt = $pdo->prepare('INSERT INTO order_details (id_product, id_order, quantity, price) VALUES (?, ?, ?, ?)');
                $stmt->execute([
                    $_SESSION["cart"]["id_product"][$i],
                    $idOrder,
                    $_SESSION["cart"]["quantity"][$i],
                    $_SESSION["cart"]["price"][$i]
                ]);

                $quantity = $_SESSION["cart"]["quantity"][$i];
                $id_product = $_SESSION["cart"]["id_product"][$i];
                $stmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id_product = ?");
                $stmt->execute([$quantity, $id_product]);
            }

            unset($_SESSION["cart"]);
            header('Location: success.php'); // Rediriger vers une page de succès
            exit();
        }
    } catch (\Stripe\Exception\CardException $e) {
        // La carte a été refusée
        $error = $e->getError()->message;
    }
}

require_once("inc/header.php");
?>

<div class="container mt-5">
<br><br><br><br>
    <h2>Récapitulatif de votre commande</h2>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($_SESSION['cart']['id_product']); $i++) { ?>
                <tr>
                    <td><?= $_SESSION['cart']['title'][$i]; ?></td>
                    <td><?= $_SESSION['cart']['quantity'][$i]; ?></td>
                    <td><?= $_SESSION['cart']['price'][$i]; ?>€</td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td><?= totalAmount(); ?>€</td>
            </tr>
        </tbody>
    </table>
    <h2>Informations de paiement</h2>
    <form action="checkout.php" method="post" id="payment-form">
        <div class="form-row">
            <label for="card-element" class="mt-3">Carte de crédit ou de débit</label>
            <div id="card-element" class="form-control">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert" class="mt-3 text-danger"></div>
        </div>
        <button class="btn btn-primary mt-3">Confirmer le paiement</button>
    </form>
</div>

<br><br><br><br>

<script src="https://js.stripe.com/v3/"></script>
<script>
var stripe = Stripe('pk_test_51PYjoIBZAu5dkXdgfW98dRHiaE6oz88kcaQTfF7Haw83EdkTc4JKbODN6MOrqWwRmlXwq6fM43VuTM4siXXjc1YF00lerFeZhx');
var elements = stripe.elements();
var style = {
    base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
var card = elements.create('card', {style: style});
card.mount('#card-element');
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
});
</script>

<?php
require_once("inc/footer.php");
?>
