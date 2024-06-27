<?php

    function create_cart() {

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            $_SESSION['cart']['id_product'] = array();
            $_SESSION['cart']['quantity'] = array();
            $_SESSION['cart']['price'] = array();
            $_SESSION['cart']['title'] = array();
            $_SESSION['cart']['picture'] = array();
            $_SESSION['cart']['stock'] = array();
        }

    }

    function add_product_to_cart($id_product, 
        $quantity, 
        $price,
        $stock, 
        $picture, 
        $title) {
            create_cart();
            $productPosition = array_search($id_product, $_SESSION['cart']['id_product']);
            if($productPosition !== false) {
                $_SESSION['cart']['quantity'][$productPosition] += $quantity;
            } else {
                $_SESSION['cart']['id_product'][] = $id_product;
                $_SESSION['cart']['quantity'][] = $quantity;
                $_SESSION['cart']['price'][] = $price;
                $_SESSION['cart']['title'][] = $title;
                $_SESSION['cart']['stock'][] = $stock;
                $_SESSION['cart']['picture'][] = $picture;
            }
    }

    function deleteProductFromCart($id_product) {
        
        $productPosition = array_search($id_product, $_SESSION['cart']['id_product']);

        if($productPosition !== false) {

            unset($_SESSION['cart']['id_product'][$productPosition]);
            unset($_SESSION['cart']['quantity'][$productPosition]);
            unset($_SESSION['cart']['price'][$productPosition]);
            unset($_SESSION['cart']['title'][$productPosition]);
            unset($_SESSION['cart']['stock'][$productPosition]);   
            unset($_SESSION['cart']['picture'][$productPosition]);
        
        }
    
    }

    function updateIndexProductInCart() {

        $_SESSION['cart']['id_product'] = array_values($_SESSION['cart']['id_product']);
        $_SESSION['cart']['quantity'] = array_values($_SESSION['cart']['quantity']);
        $_SESSION['cart']['price'] = array_values($_SESSION['cart']['price']);
        $_SESSION['cart']['title'] = array_values($_SESSION['cart']['title']);
        $_SESSION['cart']['stock'] = array_values($_SESSION['cart']['stock']);
        $_SESSION['cart']['picture'] = array_values($_SESSION['cart']['picture']);

    }

    function totalAmount() {

        $total = 0;

        if(isset($_SESSION['cart'])) {

            for($i = 0; $i < count($_SESSION['cart']['id_product']); $i++) {

                $total += $_SESSION['cart']['quantity'][$i] * $_SESSION['cart']['price'][$i];
    
            }

        }

        return $total;

    }

    function numberOfProductsInCart() {

        $total = 0;

        if(isset($_SESSION['cart'])) {
            for($i= 0; $i < count($_SESSION['cart']['id_product']); $i++) {
                $total += $_SESSION['cart']['quantity'][$i];
            }
        }
        return $total;

    }



?>