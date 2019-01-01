<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 3/24/2016
 * Time: 9:31 PM
 */
        include_once "header.php";


    try {


        $sql = "SELECT * FROM djrobinso4";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        echo "<table> <tr><th>Option</th>  <th>ID</th>  <th>Last Name</th></tr>";
        //loop through and get all the information from the database
        foreach ($results as $row) {
            echo "<tr><td><a href='selectone.php?ID=" . $row['ID'] . "'>View Member</a></td>
                   <td>" . $row['ID'] . "</td>
                   <td>" . $row['lname'] . "</td></tr>";

        }
        echo "</table>";

    }catch(PDOException $e){
        echo 'Error fetching users: <br />ERROR MESSAGE:<br />' .$e->getMessage();
        exit();
    }
?>

<?php include_once "footer.php"; ?>
