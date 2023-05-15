<?php 

class config{

    private $connection; // Database connection

    private bool $backupDataLoaded = false; 

    public function __construct(){
        // Create database connection
        $this->connection = new mysqli('localhost', 'sqluser', 'password', 'proddb');

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    

    public function fetchProducts(){ // Fetch all products from the database
        // Logic to fetch products from the database
        $products = array();
        
        $backupDataLoaded = $this->isBackupDataLoaded();

        $query = "SELECT COUNT(*) as count FROM products";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $backupDataLoaded = $result->fetch_assoc()['count'] > 0;
        }

        
        if (!$backupDataLoaded){
            
            $products = $this->loadBackupData();
            $this->setBackupDataLoaded();
            return $products;
        } 

        $query = "SELECT * FROM products";
        $result = $this->connection->query($query);
        

        

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

    public function loadBackupData(){ // Load backup data from the database
        
        echo "Loading backup data";
        if ($this->backupDataLoaded){
            return;
        }

        // Logic to fetch products from the database
        $query = "SELECT * FROM productsbackup";
        $result = $this->connection->query($query);
        $products = array();
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
                // Add the product to the products array
                $products[] = $product;

                // Insert the product into the products table
                $insertQuery = "INSERT INTO products (
                    sku,
                    name, 
                    price, 
                    type, 
                    size, 
                    weight, 
                    height,
                    width, 
                    length)
                                
                VALUES (
                    '{$row['sku']}',
                    '{$row['name']}', 
                    '{$row['price']}', 
                    '{$row['type']}'";
                    $insertQuery .= isset($row['size']) ? ", '{$row['size']}'" : ", NULL";
                    $insertQuery .= isset($row['weight']) ? ", '{$row['weight']}'" : ", NULL";
                    $insertQuery .= isset($row['height']) ? ", '{$row['height']}'" : ", NULL";
                    $insertQuery .= isset($row['width']) ? ", '{$row['width']}'" : ", NULL";
                    $insertQuery .= isset($row['length']) ? ", '{$row['length']}'" : ", NULL";
                    $insertQuery .= ")";
                    

                $this->connection->query($insertQuery); // Execute the query

            }
            $result->free(); // Free the memory associated with the result
        }


        $this->backupDataLoaded = true; // Set the backup data loaded flag to true

        return $products;
    }

    public function isBackupDataLoaded(){ // Check if the backup data is loaded
        return $this->backupDataLoaded;
    }

    public function setBackupDataLoaded(){ // Set the backup data loaded flag to true
        $this->backupDataLoaded = true;
    }

    public function deleteProductById($productId){ // Delete a product from the database
        $deleteQuery = "DELETE FROM products WHERE id = '{$productId}'";
        $this->connection->query($deleteQuery);
    }

    public function deleteProductsByIds($productsIds){
        foreach ($productsIds as $productId){
            $this->deleteProductById($productId);
        }
    }

    public function addProduct($product){ // Add a product to the database
        $insertQuery = $product->getInsertQuery();
        $this->connection->query($insertQuery); // Execute the query
    }

    public function addProducts($products){ // Add multiple products to the database
        foreach ($products as $product){
            $this->addProduct($product);
        }
    }

    public function checkSKU($sku){
        $query = "SELECT COUNT(*) as count FROM products WHERE sku = '{$sku}'";
        $result = $this->connection->query($query);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['count'] > 0;
        }
        return false;
    }

}