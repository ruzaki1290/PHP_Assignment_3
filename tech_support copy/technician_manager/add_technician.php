<?php
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Contact Manager - Add Technician</title>
      <link rel="stylesheet" type="text/css" href="/Rus_PHP_2/tech_support/main.css">
   </head>
   <body>
   <?php include '../view/header.php'; ?>
      <main>
         <h2>Add Technician</h2>
         <div>
            <form method="post" id="add_technician">
            <div id="technician">
            <label>Tech ID:</label>
            <input type="text" name="techId" /><br />

            <label>First Name:</label>
            <input type="text" name="firstName" /><br />

            <label>Last Name:</label>
            <input type="text" name="lastName" /><br />

            <label>Email:</label>
            <input type="text" name="email" /><br />

            <label>Phone:</label>
            <input type="text" name="phone" /><br />

            <label>Password:</label>
            <input type="text" name="password" /><br />
         </div>

         <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Save Technician" /><br />
         </div>

         </form>

         <p><a href="index.php">View Technician List</a></p>
      </main>
      <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once('../model/database.php');
            var_dump($_POST);

            $techId = $_POST['techId'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            // validate form data
            if (empty($techId) || empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password)) {
               echo "All fields are required.";
               exit;
            }
                     
            try {
               // add the technician to the database
               $query = 'INSERT INTO technicians
                  (techId, firstName, lastName, email, phone, password)
                  VALUES
                  (:techId, :firstName, :lastName, :email, :phone, :password)';
               
               $statement = $db->prepare($query);
               $statement->bindValue(':techId', $techId);
               $statement->bindValue(':firstName', $firstName);
               $statement->bindValue(':lastName', $lastName);
               $statement->bindValue(':email', $email);
               $statement->bindValue(':phone', $phone);
               $statement->bindValue(':password', $password);

               // execute the statement
               $statement->execute();
               // close the cursor
               $statement->closeCursor();
               // redirect to technician list
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