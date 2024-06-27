<?php
    require_once("inc/init.php");

    $content = "";

    if(isset($_GET['action']) && $_GET['action'] == 'emptyCart') {

        unset($_SESSION['cart']);
        $content .= "<div class='alert alert-success' role='alert'>
        Votre panier a bien été supprimé !
        </div>";
    }


    if(isset($_GET['action']) && $_GET['action'] == 'deleteProduct') {
        
        deleteProductFromCart($_GET['id_product']);
        updateIndexProductInCart();
    
    }

    if(isset($_POST['add_product'])) {

        $id_product = $_POST['id_product'];
        $stmt = $pdo->query("SELECT * FROM products WHERE id_product = '$id_product' ");
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        add_product_to_cart($id_product, 
            $_POST['quantity'], 
            $product['price'], 
            $product['stock'], 
            $product['picture'],
            $product['title']);
    
    }

    if(isset($_SESSION["cart"])) {
        if(isset($_POST["payer"])) {
            
            $error = false;

            for($i = 0; $i < count($_SESSION["cart"]["id_product"]); $i++) {

                $id_product = $_SESSION['cart']['id_product'][$i];
                $stmt = $pdo->query("SELECT * FROM products WHERE id_product = '$id_product' ");
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if($product["stock"] < $_SESSION["cart"]["quantity"][$i]) {

                    if($product["stock"] <= 0) {
                        
                        $content .= "<div class=\"col-md-12 alert alert-warning\" role=\"alert\">
                            Le stock est épuisé pour l'article " . $_SESSION["cart"]["title"][$i] . "!
                        </div>";
                        deleteProductFromCart($_SESSION["cart"]["id_product"][$i]);
                        updateIndexProductInCart();
                        $i--;
            

                    } else {

                        // Le stock n'est pas vide du coup je mets à jour la quantité séléctionnée avec le stock dispo et msg d'info 'la quantité pour tel produit a été mise à jour'

                        $_SESSION["cart"]["quantity"][$i] = $product["stock"];
                        $_SESSION["cart"]["stock"][$i] = $product["stock"];
                        $content .= "<div class=\"col-md-12 alert alert-warning\" role=\"alert\">
                            La quantité pour le produit " . $_SESSION["cart"]["title"][$i] . "a été réduite à $product[stock] car le stock était insufisant pour vos achats !
                            </div>";

                    }

                    $erreur = true;

                }

            }

            if(!isset($error) || !$error) {

                $idMember = 1;
                $total_amount = totalAmount();
    
                $pdo->exec("INSERT INTO orders(id_member, amount, date, state)
                VALUES(
                    '$idMember',
                    '$total_amount',
                    NOW(),
                    'en traitement'
                )");
    
                $idOrder = $pdo->lastInsertId();
    
                for($i = 0; $i < count($_SESSION["cart"]["id_product"]); $i++) {
    
                    $pdo->exec('INSERT INTO order_details (id_product, id_order, quantity, price)
                    VALUES(
                        " ' . $_SESSION["cart"]["id_product"][$i] . ' ",
                        " ' . $idOrder . ' ",
                        " ' . $_SESSION["cart"]["quantity"][$i] . ' ",
                        " ' . $_SESSION["cart"]["price"][$i] . '"
                    )');
    
                    $quantity = $_SESSION["cart"]["quantity"][$i];
                    $id_product = $_SESSION["cart"]["id_product"][$i];
                    $pdo->exec("UPDATE products SET stock = stock - '$quantity' WHERE id_product = '$id_product' ");
    
                }
    
                unset($_SESSION["cart"]);
    
                $content .= "<div class=\"col-md-12 alert alert-success\" role=\"alert\">
                                Merci pour votre commande ! Numéro de commande : " . $idOrder. "
                            </div>";
    
            }

        }
 
    }



    require_once("inc/header.php");
?>

<?= $content ?>
<?php if(!empty($_SESSION['cart'])) { ?>
    <div class="col-md-12">
        <a class="badge badge-danger" href="?action=emptyCart">Vider le panier</a>
    </div>
<?php } ?>

<table class="table my-5">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix</th>
            <th scope="col">Photo</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php if(empty($_SESSION['cart'])) { ?>
            <tr><td colspan="3">Votre panier est vide !</td></tr>
        <?php } else { ?>

            <?php for ($i = 0; $i < count($_SESSION['cart']['id_product']); $i++) { ?>
            <tr>
                <td><?= $_SESSION['cart']['title'][$i]; ?></td>
                <td>  
                    <form action="">
                        <select class="form-control">
                            <?php for($j = 1; $j <= $_SESSION['cart']['stock'][$i]; $j++) { ?>
                                
                                <?php if($j == $_SESSION['cart']['quantity'][$i]) { ?>
                                    <option selected value="<?= $j; ?>"><?= $j; ?></option>
                                <?php } else { ?>
                                    <option value="<?= $j; ?>"><?= $j; ?></option>
                                <?php } ?>

                            <?php } ?>
                        </select>
                    </form>
                </td>
                <td><?= $_SESSION['cart']['price'][$i]; ?>€</td>
                <td><img style="width:50px" src="<?= $_SESSION['cart']['picture'][$i]; ?>" alt=""></td>
                <td><a href="?action=deleteProduct&id_product=<?= $_SESSION['cart']['id_product'][$i]; ?>">Delete</a></td>
            </tr>
            <?php } ?>
            <tr><td colspan="5" class="text-right"><strong>Montant total :</strong> <?= totalAmount(); ?>€</td></tr>
            <?php } ?>
    
    </tbody>
</table>

    <div class="col-md-12">
        <a class="badge badge-dark" 
            href="index.php<?= isset($_POST['category']) ? '?category=' . $_POST['category'] : '' ?>
            "> Retourner dans <?= isset($_POST['category']) ? $_POST['category'] : 'la boutique' ?> </a>
    </div>

    <div class="d-flex justify-content-end col-md-12">
        <form action="" method="POST">
            <input type="submit" name="payer" value="Pay" class="btn btn-primary">
        </form>
    </div>

<?php
require_once("inc/footer.php");
?>