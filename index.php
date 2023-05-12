<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
  <title>My PHP Page</title>
  <script src="js/script.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <h1>Product List</h1>
  

  <?php
  //Include all the classes
    require_once 'php/Product.php';
    require_once 'php/DVD.php';
    require_once 'php/Book.php';
    require_once 'php/Furniture.php';
    require_once 'php/config.php';

    //Create an instance of the config class
    $config = new config();
    $products = $config->fetchProducts();

    ?>
    <form method="post" action="delete-products.php">


    <?php
      //Loop through the products array and display the product details
      foreach ($products as $product) {
        ?>
        <div class="product">
          <div>
            <input class="delete-checkbox" type="checkbox" name="productsIds[]" value="<?php echo $product->getId()?>">
          </div>
        <div>  
          <h2>SKU: <?php echo $product->getSku(); ?></h2>
          <p>Name: <?php echo $product->getName(); ?></p>
          <p>Price: <?php echo $product->getPrice(); ?> $</p>
          <p>  
            <?php
            //Check the type of the product and display the corresponding attribute
              if ($product instanceof DVD){
                echo "Size: " . $product->getSize() . " MB";
              } elseif ($product instanceof Book){
                echo "Weight: " . $product->getWeight() . " KG";
              } elseif ($product instanceof Furniture){
                echo $product->getAttributes(); 
              }?>
          </p>
        </div>  
        </div>      
              
        <?php        
      }
      ?>
    

      <!-- Create the "ADD" button to navigate to the Add Product page-->
      <div class="add">
        <button onclick="location.href='add-product.php'">ADD</button>
      </div>

      <!-- Create the "MASS DELETE" button to delete all the selected products-->
      <div class="delete">
        <button type="submit" value="Delete Selected Products">MASS DELETE</button>
      </div>
    </form>


  
  

</body>
</html>
