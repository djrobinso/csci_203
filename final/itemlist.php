<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:22 AM
 */
$pageTitle = "See All Items";
include_once "header.php";


    //check for authicated users
    if(!isset($_SESSION['ID'])){
    echo "<p>This page requires authentication.</p>";
    include_once "footer.php";
    exit();
    }

    //try and catch the data from the database
    try{

        $comma = ",";
        $sql = "SELECT * FROM djrobinso_items";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo "<table class='itemsList'><tr> <th>Options</th> <th>Book Title</th> <th>Author's Name (Last,First)</th> </tr>";
        //foreach to get all the data
        foreach($result as $data){

            echo "<tr>
                    <td> <a id='itemsListHyperLinks' href='itemdetails.php?ID=".$data['ID']."'>View  </a>
                         <a id='itemsListHyperLinks' href='itemupdate.php?ID=".$data['ID']."'>Update </a>
                         <a id='itemsListHyperLinks' href='itemdelete.php?ID=".$data['ID']."?title=".$data['title']." '>Delete   </a>
                    </td>
                    <td>".$data['title']."</td>
                    <td>".$data['alast']." $comma ".$data['alast']."</td>
                  </tr>";

        }//end of foreach
        echo "</table>";

    }catch(PDOException $e){

        echo "'Error fetching users: <br />ERROR MESSAGE:<br />" .$e->getMessage();
        include_once "footer.php";
		exit();

    }//end of try and catch

?>


<?php include_once "footer.php"; ?>
