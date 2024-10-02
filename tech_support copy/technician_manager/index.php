<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Technicians</title>
        <link rel="stylesheet" type="text/css"
            href="/Rus_PHP_2/tech_support/main.css">
    </head>
    <body>
        <?php include '../view/header.php'; ?>
        <main>
            <?php
                require('../model/database.php');
                // require('../model/product_db.php');
                $query = 'SELECT * FROM technicians;';
                // processes to the database
                $statement = $db->prepare($query);
                $statement->execute();
                $technicians = $statement->fetchAll();  
            ?>
            <table>
                <tr>
                    <th>Tech ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th></th>
                </tr>
                <?php
                    foreach($technicians as $technician) {
                        echo'<tr>';

                        echo '<td>'.$technician['techID'].'</td>';
                        echo '<td>'.$technician['firstName'].'</td>';
                        echo '<td>'.$technician['lastName'].'</td>';
                        echo '<td>'.$technician['email'].'</td>';
                        echo '<td>'.$technician['phone'].'</td>';
                        echo '<td>'.$technician['password'].'</td>';
                        echo '
                        <td>
                            <form method="post" action="delete_technician.php">
                                <input type="hidden" name="techID" value="'.$technician['techID'].'">
                                <button>Delete</button>
                            </form>
                        </td>';

                    echo '</tr>';
                        
                    }
                ?>
            </table>
            <a href="add_technician.php">Add Technician</a>
        </main>   
    </body>
    <?php include '../view/footer.php'; ?> 
</html>