<?php

require_once(__DIR__ . '/../classes/Product.php');

$productObject = new Product();

$productObject->searchProduct($_GET['query']);
