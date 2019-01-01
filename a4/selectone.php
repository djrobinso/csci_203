<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 3/31/2016
 * Time: 10:49 PM
 */

    include_once "header.php";?>

<?php

    try{

        $sql = "SELECT * FROM djrobinso4 WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt ->bindValue(":ID", $_GET['ID']);
        $stmt->execute();
        $row = $stmt->fetch();


        echo "<table><tr><th>ID:</th><td>". $row['ID']. "</td></tr>";
        echo "<tr><th>Date of Birth:</th><td>". $row['dob']. "</td></tr>";
        echo "<tr><th>Prefix:</th><td>". $row['prefix']. "</td></tr>";
        echo "<tr><th>First Name:</th><td>". $row['fname']. "</td></tr>";
        echo "<tr><th>Last Name:</th><td>". $row['mi']. "</td></tr>";
        echo "<tr><th>Username:</th><td>". $row['username']. "</td></tr>";
        echo "<tr><th>Password:</th><td>". $row['password']. "</td></tr>";
        echo "<tr><th>Phone:</th><td>". $row['phone']. "</td></tr>";
        echo "<tr><th>Address:</th><td>". $row['address']. "</td></tr>";
        echo "<tr><th>State:</th><td>". $row['state']. "</td></tr>";
        echo "<tr><th>Zipcode:</th><td>". $row['zipcode']. "</td></tr>";
        echo "<tr><th>Newsletter:</th><td>". $row['newsletter']. "</td></tr>";
        echo "<tr><th>Comments:</th><td>". $row['comments']. "</td></tr>";
        echo "</td></tr><table>";

    }catch(PDOException $e){

        echo "Error fetching users: <br />ERROR MESSAGE:<br />" .$e->getMessage();
        exit();

    }

    include_once "footer.php";

?>