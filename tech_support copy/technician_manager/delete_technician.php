<?php 
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   $techID = $_POST['techID'];
   require_once('../model/database.php');

   // code to save to MySQL Database goes here
   // validate inputs(checking if none of the inputs are = null)
   if ($techID != false)
   {
      $query = 'DELETE FROM technicians WHERE techID = :techID';
      
      $statement = $db->prepare($query);
      $statement->bindValue(':techID', $techID);

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
