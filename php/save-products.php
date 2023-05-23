<?php


// Require all the files
require_once 'config.php';
require_once 'Product.php';
require_once 'DVD.php';
require_once 'Book.php';
require_once 'Furniture.php';


$config = new config();

// Check if the save button is clicked:
if (isset($_POST['sku'])) {

    $config->createNewProduct($_POST);
    exit();
}