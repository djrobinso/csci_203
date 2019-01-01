<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:19 AM
 */
$pageTitle = "User Full Info";
include_once "header.php";

    //check for authentication
    if(!isset($_SESSION['ID'])) {
        echo "<p>This page requires authentication.</p>";
        include_once "footer.php";
        exit();
    }

    //try and catch all the data
    try{

        $sql = "SELECT * FROM djrobinso_users WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":ID", $_GET['ID']);
        $stmt->execute();
        $row = $stmt->fetch();

        //echo results
        echo "<table id='userDetailTable'>";
        echo "<tr> <th>Username: </th> <td>".$row['firstname']."</td> </tr>";
        echo "<tr> <th>First Name: </th> <td>".$row['lastname']."</td> </tr>";
        echo "<tr> <th>Middle Initial: </th> <td>".$row['middle']."</td> </tr>";
        echo "<tr> <th>Email: </th> <td>".$row['email']."</td> </tr>";
        echo "<tr> <th>Age: </th> <td>".$row['age']."</td> </tr>";
        echo "<tr> <th>Address: </th> <td>".$row['address1']."</td> </tr>";
        echo "<tr> <th>Apartment/Suite: </th> <td>".$row['address2']."</td> </tr>";
        echo "<tr> <th>City: </th> <td>".$row['city']."</td> </tr>";
        echo "<tr> <th>State: </th> <td>".$row['state']."</td> </tr>";
        echo "<tr> <th>Zip Code: </th> <td>".$row['zip']."</td> </tr>";
        echo "</table>";

    }catch(PDOException $e){

    }//end of try and catch

?>

<?php include_once "footer.php";?>
