<?php
session_start();

require_once 'Product.php';
require_once 'DVD.php';
require_once 'Book.php';
require_once 'Furniture.php';

define('DB_HOST', 'localhost');
define('DB_USER', 'sqluser');
define('DB_PASS', 'password');
define('DB_NAME', 'proddb');

class config
{

    private $connection; // Database connection

    private bool $backupDataLoaded = false;

    private $SkuExists = false;

    public function __construct()
    {
        // Create database connection
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function fetchProducts()
    { // Fetch all products from the database
        // Logic to fetch products from the database
        $products = array();


        $query = "SELECT * FROM products"; // Create the query
        $result = $this->connection->query($query); // Execute the query

        // Loop through the result set and create product objects
        if ($result) { // Check if the result is valid
            while ($row = $result->fetch_assoc()) {
                // Create a new product object
                $productType = $row['type'];

                $product = new $productType($row);

                // Add the product object to the products array
                $products[] = $product;
            }

            $result->free(); // Free the memory associated with the result

        } else {
            die("Error! Query failed: " . $this->connection->error);
        }

        return $products;
    }

    public function renderProducts($products)
    { // Render all products
        foreach ($products as $product) {
            ?>
            <div class="product">
                <div class="form-check checkbox">
                    <input class="form-check-label delete-checkbox" type="checkbox" name="productsIds[]"
                        value="<?php echo $product->getId() ?>">
                </div>
                <br>
                <div class="product-info">
                    <p>
                        <?php echo $product->getSku(); ?>
                    </p>
                    <p>
                        <?php echo $product->getName(); ?>
                    </p>
                    <p>Price:
                        <?php echo $product->getPrice(); ?> $
                    </p>
                    <p>
                        <?php echo $product->getAttributes(); ?>
                    </p>
                </div>
            </div>

            <?php
        }
    }
    public function deleteProductById($productId)
    { // Delete a product from the database
        $deleteQuery = "DELETE FROM products WHERE id = '{$productId}'"; // Create the delete query
        $this->connection->query($deleteQuery); // Execute the query
    }

    public function deleteProductsByIds($productsIds)
    { // Delete multiple products from the database
        foreach ($productsIds as $productId) {
            $this->deleteProductById($productId); // Delete each product
        }
    }

    public function handleFormSubmission($POST, $action)
    { // Handle the form submission
        if ($action == 'delete') {
            $this->handleDeleteFormSubmission($POST);
        } else if ($action == 'save') {
            $this->handleSaveFormSubmission($POST);
        }
    }

    public function handleDeleteFormSubmission($POST)
    { // Handle the delete form submission
        if (isset($POST['productsIds'])) {
            // Get the selected product IDs from the checkboxes
            $productsIds = $POST['productsIds'];

            //Delete the selected products
            $this->deleteProductsByIds($productsIds);
        }
        // Redirect back to the product list page
        header("Location: ../index.php");
    }

    public function handleSaveFormSubmission($POST)
    { // Handle the save form submission
        // Check if the data is received
        if (!isset($POST['data'])) {
            die("Error! No data received!");
        }

        $data = $POST['data'];

        // Sanitize the data
        $data = $this->sanitizeData($data);


        // Check if the data is valid
        if (!$this->validateData($data)) {
            // If the data is not valid, redirect back to the add product page
            header("Location: ../add-product.php");
            return false;
        } else {
            // Create a string variable with the class name
            $className = $data['type'];

            // Create a new product object
            $product = new $className($data);

            // Validate the product attributes
            $errorMsg = $product->validateAttributes($data);
            if ($errorMsg != '') {
                // If the product attributes are not valid, redirect back to the add product page
                $_SESSION['error_message'] = $errorMsg;
                header("Location: ../add-product.php");
                return;
            }

            // Save the product to the database
            $this->addProduct($product);

            // Redirect back to the product list page
            header("Location: ../index.php");
            return true;
        }
    }

    public function addProduct($product)
    { // Add a product to the database
        $insertQuery = $product->getInsertQuery(); // Get the insert query for the product
        $this->connection->query($insertQuery); // Execute the query
    }

    public function addProducts($products)
    { // Add multiple products to the database
        foreach ($products as $product) {
            $this->addProduct($product); // Add each product
        }
    }

    private function checkSKU($sku)
    { // Check if the SKU already exists
        // Create the query
        $query = "SELECT COUNT(*) as count FROM products WHERE sku = '{$sku}'";
        $result = $this->connection->query($query);
        if ($result && $result->num_rows > 0) { // Check if the result is valid and if there are any rows
            return $result->fetch_assoc()['count'] > 0; // Return true if the SKU exists
        }
        return false; // Return false if the SKU does not exist
    }

    public function checkError()
    { // Check if there is an error message
        if (isset($_SESSION['error_message'])) { ?>
            <script>
                            document.getElementById("sku").classList.add("is-invalid");
            </script>
            <div class="invalid-feedback">
                <?php
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']);
                ?>
            </div>
        <?php }
    }

    private function sanitizeString($string)
    {
        $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $string = trim($string); // Remove whitespaces from the beginning and the end of the string
        $string = mb_substr($string, 0, 255); // Limit the input to a maximum of 255 characters
        $string = preg_replace('/[^A-Za-z0-9\s]/', '', $string); // Remove non-alphanumeric characters
        return $string;
    }

    private function sanitizeFloat($var)
    {
        $var = filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT);
        return $var;
    }

    private function sanitizeData($data)
    {
        // Sanitize the data
        if (isset($data['sku'])) {
            $data['sku'] = $this->sanitizeString($data['sku']); //Sanitize the SKU
            $data['sku'] = str_replace('-', '', $data['sku']); // Remove all dashes
            $data['sku'] = preg_replace('/\s+/', '', $data['sku']); // Remove all whitespaces
            $data['sku'] = strtoupper($data['sku']); // Convert the SKU to uppercase
        }
        if (isset($data['name'])) {
            $data['name'] = $this->sanitizeString($data['name']); //Sanitize the name
        }
        if (isset($data['price']))
            $data['price'] = $this->sanitizeFloat($data['price']); //Sanitize the price
        
        // Sanitize the attributes
        if (isset($data['height']))
            $data['height'] = $this->sanitizeFloat($data['height']); //Sanitize the height
        if (isset($data['width']))
            $data['width'] = $this->sanitizeFloat($data['width']); //Sanitize the width
        if (isset($data['length']))
            $data['length'] = $this->sanitizeFloat($data['length']); //Sanitize the length
        if (isset($data['size']))
            $data['size'] = $this->sanitizeFloat($data['size']); //Sanitize the size
        if (isset($data['weight']))
            $data['weight'] = $this->sanitizeFloat($data['weight']); //Sanitize the weight

        print_r($data);
        return $data;
    }

    private function validateData($data)
    {
        // Validate the data
        if (isset($data['sku'])) {
            if ($this->checkSKU($data['sku'])) {
                $_SESSION['error_message'] = "SKU already exists!";
                return false;
            }
            if (empty($data['sku'])) {
                $_SESSION['error_message'] = "SKU is required!";
                return false;
            }
            if (strlen($data['sku']) < 8) {
                $_SESSION['error_message'] = "SKU must be at least 8 characters long!";
                return false;
            }
        }

        if (isset($data['name'])) {
            if (empty($data['name'])) {
                $_SESSION['error_message'] = "Name is required!";
                return false;
            }
        }

        if (isset($data['price'])) {
            if (empty($data['price'])) {
                $_SESSION['error_message'] = "Price is required!";
                return false;
            }
        }

        if (isset($data['type'])) {
            if (!in_array($data['type'], ['DVD', 'Book', 'Furniture'])) {
                $_SESSION['error_message'] = "Invalid product type!";
                return false;
            }
            if (empty($data['type'])) {
                $_SESSION['error_message'] = "Type is required!";
                return false;
            }
        }

        return true;
    }
}