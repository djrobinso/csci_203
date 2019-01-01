<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:22 AM
 */

    //try and catch the data
    try{

        $sql = "SELECT * FROM djrobinso_items";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo "<table class='itemsList'><tr> <th>Book Number</th> <th>Book Title</th> </tr>";
    foreach($result as $data){
            echo "<tr>
                        <td>Book: ".$data['ID']."</td>
                        <td><a href='itemdetails.php?ID=".$data['ID']."'>".$data['title']."</a></td>
                  </tr>";
        }
        echo "</table>";

    }catch(PDOException $e){
        echo "'Error fetching users: <br />ERROR MESSAGE:<br />" .$e->getMessage();
        include_once "footer.php";
        exit();
    }//end of try and catch

?>