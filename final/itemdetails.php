<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:22 AM
 */
$pageTitle = "Book Details";
include_once "header.php";


        //check for authentication
        if(!isset($_SESSION['ID'])) {
            echo "<p class='authorizationWarning'>This page requires authentication.</p>";
            include_once "footer.php";
            exit();
        }

        try{

            $sql = "SELECT * FROM djrobinso_items WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":ID", $_GET['ID']);
            $stmt->execute();
            $row = $stmt->fetch();

            //echo the results
            echo "<table id='detailsList'>";
            echo "<tr> <th>Title:</th> <td>".$row['title']."</td> </tr>";
            echo "<tr> <th>Author's First Name:</th> <td>".$row['afirst']."</td> </tr>";
            echo "<tr> <th>Author's Last Name:</th> <td>".$row['alast']."</td> </tr>";
            echo "<tr> <th>Summary:</th> <td>".$row['summary']."</td> </tr>";
            echo "</table>";

        }catch(PDOException $e){

            echo "Error fetching items: <br />ERROR MESSAGE:<br />" .$e->getMessage();
            include_once "footer.php";
            exit();

        }//end of the try and catch


?>

<?php include_once "footer.php"; ?>
