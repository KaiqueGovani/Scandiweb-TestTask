<?php

// Require all the files
require_once 'php/config.php';
require_once 'php/Product.php';
require_once 'php/DVD.php';
require_once 'php/Book.php';
require_once 'php/Furniture.php';


$config = new config();

// Check if the save button is clicked:
if (isset($_POST['sku'])) {
    // Get the product details from the form
    $sku = $_POST['sku'];
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
        // Redirect back to the product list page
        echo "SKU already exists!"; 
        exit();
    }


    // Create a string variable with the class name
    $className = $type;

    // Create a new product object
    $product = new $className(null, $sku, $name, $price, ...$attributes);

    // Save the product to the database
    $config->addProduct($product);

    // Redirect back to the product list page
    header("Location: index.php");
    exit();
}