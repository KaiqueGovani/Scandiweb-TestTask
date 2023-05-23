<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Product</title>
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
                    <span class="navbar-brand mb-0 h1">Add Product</span>
                    <!-- Create the "Save" button to save the product details-->
                    <div class="navbaropts">
                        <div class="Save">
                            <button form="product_form" class="btn btn-outline-success" type="submit"
                                value="Save">Save</button>
                        </div>
                        <!-- Create the "Cancel" button to navigate to the Products page-->
                        <div class="delete">
                            <button class="btn btn-outline-danger" type="button"
                                onclick="location.href='index.php'">Cancel</button>
                        </div>
                    </div>
                </div>
            </nav>
            <hr>
        </div>
    </header>


    <!-- Page Content -->
    <div class="main">
        <div class="forms-container">
            <form class="needs-validation" id="product_form" action="php/save-products.php" method="post">
                

                

                <div class="row mb-3">
                    <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sku" name="sku" placeholder="XXX-XXX-XXX"
                            autocomplete="off" maxlength="15" required>
                        
                        <?php 
                        if (isset($_SESSION['error_message'])): ?>
                            <script>
                                document.getElementById("sku").classList.add("is-invalid");
                            </script>
                            <div class="invalid-feedback">
                                <?php 
                                echo $_SESSION['error_message']; 
                                unset($_SESSION['error_message']);
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
    

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Product name"
                            autocomplete="off" maxlength="255" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price" min="0" max="99999999.99" step="any"
                            autocomplete="off" required placeholder="$0.00">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="productType" class="col-sm-2 col-form-label">Product Type</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="productType" id="productType" onchange="changeProductType()"
                            required>
                            <option value="" selected disabled>Select product type</option>
                            <option value="DVD">DVD</option>
                            <option value="Book">Book</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>
                </div>
                <div id="typeSpecificAttributes">
                    <!-- DVD attributes -->
                    <div class="row mb-3 hide" id="sizeContainer">
                        <label for="size" class="col-sm-2 col-form-label">Size (MB)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="size" name="attributes[size]" min="0" step="any"
                                placeholder="MB" autocomplete="off">
                            <strong class="form-text">Please provide size in MB!</strong>
                        </div>
                    </div>
                    <!-- Book attributes -->
                    <div class="row mb-3 hide" id="weightContainer">
                        <label for="weight" class="col-sm-2 col-form-label">Weight (kg)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="weight" name="attributes[weight]" min="0" step="any"
                                placeholder="kg" autocomplete="off">
                            <strong class="form-text">Please provide weight in kg!</strong>
                        </div>
                    </div>
                    <!-- Furniture attributes -->
                    <div class="row mb-3 hide" id="dimensionsContainer">
                        <div class="col-md-4">
                            <label for="height" class="col-form-label">Height (H)</label>
                            <div>
                                <input type="number" class="form-control" id="height" name="attributes[height]" min="0" step="any"
                                    placeholder="0.00cm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="width" class="col-form-label">Width</label>
                            <div>
                                <input type="number" class="form-control" id="width" name="attributes[width]" min="0" step="any"
                                    placeholder="0.00cm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="length" class="col-form-label">Length</label>
                            <div>
                                <input type="number" class="form-control" id="length" name="attributes[length]" min="0" step="any"
                                    placeholder="0.00cm" autocomplete="off">
                                
                            </div>
                        </div>
                        <strong class="form-text">Please provide dimensions in HxWxL format!</strong>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div>
            <hr>
            <p>Scandiweb Test assignment</p>
        </div>
    </footer>

    <script>
        // Get the SKU input element
        const skuInput = document.getElementById('sku');

        // Add an input event listener
        skuInput.addEventListener('input', formatSKU);


        // Formats the SKU input value as XXX-XXX-XXX
        function formatSKU() {
            // Remove any non-digit and non-alphabetic characters from the input value
            const skuValue = skuInput.value.replace(/[^0-9a-zA-Z]/g, '');

            // Format the value as XXX-XXX-XXX
            let formattedSKU = '';
            for (let i = 0; i < skuValue.length; i++) {
                if (i > 0 && i % 3 === 0) {
                    formattedSKU += '-';
                }
                formattedSKU += skuValue[i];
            }

            // Set the formatted value back to the input
            skuInput.value = formattedSKU.toUpperCase();
        }
    </script>

</body>

</html>