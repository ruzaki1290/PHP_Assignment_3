<?php 
   $productCode = $_POST['productCode'];
   require_once('../model/database.php');
   // get the data from index.php input contact_id
   //$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);

   // code to save to MySQL Database goes here
   // validate inputs(checking if none of the inputs are = null)
   if ($productCode != false)
   {
      $query = 'DELETE FROM products WHERE productCode = :mysqlProductCode';
      
      $statement = $db->prepare($query);
      $statement->bindValue(':mysqlProductCode', $productCode);

      // processes to the database
      $statement->execute();
      // close prepared statement
      $statement->closeCursor();
   }

      // reload index page
      $url = "index.php";
      header("Location: " . $url);
       die();
?>
