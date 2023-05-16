<?php

session_start();

// Require all the files
require_once 'config.php';
require_once 'Product.php';
require_once 'DVD.php';
require_once 'Book.php';
require_once 'Furniture.php';


$config = new config();

// Check if the save button is clicked:
if (isset($_POST['sku'])) {
    // Get the product details from the form
    $sku = $_POST['sku'];
    //Remove - from the SKU
    $sku = str_replace("-", "",$sku);

    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['productType'];
    // Get the specific attributes based on the selected type
    if ($type === 'DVD') {
        $attributes['size'] = $_POST['size'];
    } elseif ($type === 'Book') {
        $attributes['weight'] = $_POST['weight'];
    } elseif ($type === 'Furniture') {
        $attributes['height'] = $_POST['height'];
        $attributes['width'] = $_POST['width'];
        $attributes['length'] = $_POST['length'];
    }

    // Check if the SKU already exists
    if ($config->checkSKU($sku)) {
        $_SESSION['error_message'] = "SKU already exists!";
        header("Location: ../add-product.php");
        
    } else {
        // Create a string variable with the class name
        $className = $type;

        // Create a new product object
        $product = new $className(null, $sku, $name, $price, ...$attributes);

        // Save the product to the database
        $config->addProduct($product);

        // Redirect back to the product list page
        header("Location: ../index.php");
        
    }
    exit();
}