
<?php
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Contact Manager - Add Product</title>
      <link rel="stylesheet" type="text/css"
            href="/Rus_PHP_3/tech_support copy/main.css">
   </head>
   <body>
   <?php include '../view/header.php'; ?>
      <main>
         <h2>Add Product</h2>
         <div>
            <form method="post" id="add_product">
            <div id="product">
            <label>Product Code:</label>
            <input type="text" name="productCode" placeholder="e.g., TEST777"/><br />

            <label>Product Name:</label>
            <input type="text" name="name" placeholder="e.g., Product-1"/><br />

            <label>Version:</label>
            <input type="text" name="version" placeholder="e.g., Version 1.0"/><br />

            <label>Release Date:</label>
            <input type="text" name="releaseDate" placeholder="e.g., October 2, 2024"/><br />
         </div>

         <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Save Product"/><br />
         </div>

         </form>

         <p><a href="index.php">View Product List</a></p>
      </main>
      <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once('../model/database.php');
            var_dump($_POST);

            $productCode = $_POST['productCode'];
            $name = $_POST['name'];
            $version = $_POST['version'];
            $releaseDate = $_POST['releaseDate'];

            // validate form data CHANGED TO SWITCH STATEMENTS
            /*
            if (empty($productCode) || empty($name) || empty($version) || empty($releaseDate)) {
               echo "All fields are required.";
               exit;
            }
            */
            $isValid = true;
            switch (true) {
               case empty($productCode):
               case empty($name):
               case empty($version):
               case empty($releaseDate):
                  $isvalid = false;
                  break;
            }

            if (!$isValid) {
               echo "All fields are required.";
               exit;
            }
                     
            try {
               // formted the release date
               $date = new DateTime($releaseDate);
               $formattedDate = $date->format('Y-m-d');
               // add the contact to the database
               $query = 'INSERT INTO products
                  (productCode, name, version, releaseDate)
                  VALUES
                  (:productCode, :name, :version, :releaseDate)';
               
               $statement = $db->prepare($query);
               $statement->bindValue(':productCode', $productCode);
               $statement->bindValue(':name', $name);
               $statement->bindValue(':version', $version);
               $statement->bindValue(':releaseDate', $formattedDate);

               // execute the statement
               $statement->execute();
               // close the cursor
               $statement->closeCursor();
               // redirect to product list
                     header("Location: index.php");
                     exit;
                  } catch (PDOException $e) {
                     echo "Error: " . $e->getMessage();
                     exit;
                  }    
         }
      ?>
   </body>
   <?php include '../view/footer.php'; ?> 
</html>