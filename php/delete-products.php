<?php

// Include the config file
require_once 'config.php';

$config = new config();

// Check if the delete button is clicked
if (isset($_POST['productsIds'])) {
    // Get the selected product IDs from the checkboxes
    $productsIds = $_POST['productsIds'];



    //Delete the selected products
    $config->deleteProductsByIds($productsIds);
    }

    // Redirect back to the product list page
    header("Location: ../index.php");
    exit();

?>
