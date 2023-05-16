<?php 

class config{

    private $connection; // Database connection

    private bool $backupDataLoaded = false; 

    private $SkuExists = false;

    public function __construct(){
        // Create database connection
        $this->connection = new mysqli('localhost', 'id20758956_dbuser', 'Kapo!123', 'id20758956_productsdatabase');

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    

    public function fetchProducts(){ // Fetch all products from the database
        // Logic to fetch products from the database
        $products = array();
        
        
        $query = "SELECT * FROM products"; // Create the query
        $result = $this->connection->query($query); // Execute the query

        // Loop through the result set and create product objects
        if ($result) { // Check if the result is valid
            while ($row = $result->fetch_assoc()) {
                // Create a new product object
                if ($row['type'] == 'DVD') {
                    $product = new DVD($row['id'], $row['sku'], $row['name'], $row['price'], $row['size']);
                } elseif ($row['type'] == 'Book') {
                    $product = new Book($row['id'], $row['sku'], $row['name'], $row['price'], $row['weight']);
                } elseif ($row['type'] == 'Furniture') {
                    $product = new Furniture($row['id'], $row['sku'], $row['name'], $row['price'], $row['height'], $row['width'], $row['length']);
                }

                // Add the product object to the products array
                $products[] = $product;
            }

            $result->free(); // Free the memory associated with the result
        
        } else {
            die("Error! Query failed: " . $this->connection->error);
        }
        
        return $products;
    }

    public function deleteProductById($productId){ // Delete a product from the database
        $deleteQuery = "DELETE FROM products WHERE id = '{$productId}'"; // Create the delete query
        $this->connection->query($deleteQuery); // Execute the query
    }

    public function deleteProductsByIds($productsIds){
        foreach ($productsIds as $productId){
            $this->deleteProductById($productId); // Delete each product
        }
    }

    public function addProduct($product){ // Add a product to the database
        $insertQuery = $product->getInsertQuery(); // Get the insert query for the product
        $this->connection->query($insertQuery); // Execute the query
    }

    public function addProducts($products){ // Add multiple products to the database
        foreach ($products as $product){
            $this->addProduct($product); // Add each product
        }
    }

    public function checkSKU($sku){
        // Check if the SKU already exists
        $query = "SELECT COUNT(*) as count FROM products WHERE sku = '{$sku}'";
        $result = $this->connection->query($query);
        if ($result && $result->num_rows > 0) { // Check if the result is valid and if there are any rows
            return $result->fetch_assoc()['count'] > 0; // Return true if the SKU exists
        }
        return false; // Return false if the SKU does not exist
    }

}