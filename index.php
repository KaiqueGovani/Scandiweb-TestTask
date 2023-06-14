<?php
    require_once 'php/config.php';

    //Create an instance of the config class
    $config = new config();
    $products = $config->fetchProducts();
?>

<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>

    <!-- Header -->
    <header class="header">
        <div>
            <nav class="navbar">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Product List</span>
                    <div class="navbaropts">
                        <!-- Create the "ADD" button to navigate to the Add Product page-->
                        <div class="add">
                            <button class="btn btn-outline-success" type="button"
                                onclick="location.href='add-product.php'">ADD</button>
                        </div>
                        <!-- Create the "MASS DELETE" button to delete all the selected products-->
                        <div class="delete">
                            <button class="btn btn-outline-danger" form="delete-form" type="submit"
                                value="Delete Selected Products">MASS DELETE</button>
                        </div>
                    </div>
                </div>
            </nav>
            <hr>
        </div>
    </header>

    <!-- Page Content -->
    <div class="main">
        <form id="delete-form" method="post" action="php/delete-products.php">
            <div class="products-container">
                <?php
                $config->renderProducts($products);
                ?>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div>
            <hr>
            <p>Scandiweb Test assignment by: Kaique Govani</p>
        </div>
    </footer>



</body>

</html>