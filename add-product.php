<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                        <button form="product_form" class="btn btn-outline-success" type="submit" value="Save">Save</button>
                    </div>
                            <!-- Create the "Cancel" button to navigate to the Products page-->
                    <div class="delete">
                        <button class="btn btn-outline-danger" type="button" onclick="location.href='index.php'">Cancel</button>
                    </div>
                </div>
            </div>
        </nav>
        <hr>
    </div>
    </header>


    <!-- Page Content -->
    <div class="main">
        <form id="product_form" action="save-products.php" method="post">
            <div class="forms-container">


            <div class="mb-3 g-3 row align-items-center">
                <div class="col-auto">
                    <label class="col-form-label" for="sku">SKU</label>
                </div>
                <div class="col-auto">
                    <input class="form-control" type="text" id="sku" name="sku" required placeholder="XXX-XXX-XXX">
                </div>
            </div>

            <div class="mb-3 g-3 row align-items-center">
                <div class="col-auto">   
                    <label class="col-form-label" for="name">Name</label>
                </div>
                <div class="col-auto"><input class="form-control" type="text" id="name" name="name" required placeholder="Product name"></div>
            </div>

            <div class="mb-3 g-3 row align-items-center">
                <div class="col-auto"><label class="col-form-label" for="price">Price</label></div>
                <div class="col-auto"><input class="form-control" type="number" id="price" name="price" min="0" step="any" required placeholder="$0.00"></div>
            </div>

            <div class="mb-3 g-3 row align-items-center">
                <div class="col-auto"><label class="col-form-label" for="productType">Product Type</label></div>
                <div class="col-auto">
                    <select class="form-select"name="productType" id="productType" onchange="changeProductType()" required>
                    <option value="" selected disabled>Select product type</option>
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
            </div>
        

            <div id="typeSpecificAttributes">
                <!-- DVD attributes -->
                <div class="mb-3 g-3 row align-items-center hide" id="sizeContainer" >
                    <div class="col-auto"><label class="col-form-label" for="size">Size (MB)</label></div>
                    <div class="col-auto"><input class="form-control" type="number" id="size" name="size" min="0" step="any"></div>
                    <div class="col-auto"><strong class="form-text">Please provide size in MB!</strong></div>
                </div>

                <!-- Book attributes -->
                <div class="mb-3 g-3 row align-items-center hide" id="weightContainer" >
                    <div class="col-auto"><label class="col-form-label" for="weight">Weight (Kg)</label></div>
                    <div class="col-auto"><input class="form-control" type="number" id="weight" name="weight" min="0" step="any"></div>
                    <strong>Please provide weight in Kg!</strong>
                </div>

                <!-- Furniture attributes -->
                <div class="mb-3 g-3 row align-items-center hide" id="dimensionsContainer" >
                    <div class="col-auto"><label class="col-form-label" for="height">Height (H)</label></div>
                    <div class="col-auto"><input class="form-control" type="number" id="height" name="height" min="0" step="any"></div>
                    <div class="col-auto"><label class="col-form-label" for="width">Width (W)</label></div>
                    <div class="col-auto"><input class="form-control" class="form-label" type="number" id="width" name="width" min="0" step="any"></div>
                    <div class="col-auto"><label class="col-form-label" for="length">Length (L)</label></div>
                    <div class="col-auto"><input class="form-control" type="number" id="length" name="length" min="0" step="any"></div>
                    <strong>Please provide dimensions in HxWxL format!</strong>
                </div>
            </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div>
            <hr>
            <p>Scandiweb Test assignment</p>
        </div>
    </footer>

</body>
</html>