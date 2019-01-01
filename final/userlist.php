<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:19 AM
 */
$pageTitle = "See All Users";
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
        $sql = "SELECT * FROM djrobinso_users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo "<table class='userListTable'><tr> <th>Options</th> <th>User Info</th> </tr>";
        foreach($result as $data){
            echo "<tr>
                        <td>
                            <a class='userListHyperLinks' href='userdetails.php?ID=".$data['ID']."'>View  </a>
                            <a class='userListHyperLinks' href='userupdate.php?ID=".$data['ID']."'>Update  </a>"; ?>
                                <?php  /***if the uname of the server matches the login
                                        * then add the option to update password**/
                                    if($_SESSION['uname']== $data['uname'])
                                    {
                                        echo "<br><a href='userpassword.php?ID=".$data['ID']."'>Password Change</a>";
                                    }
                                    echo "
                        </td>
                        <td>
                            First Name: ".$data['firstname']."<br>
                            Last Name: ".$data['lastname']."<br>
                            Username: ".$data['uname']."<br>
                        </td>
                 </tr>";
        }echo "</table>";
    }catch(PDOException $e){

        echo "'Error fetching users: <br />ERROR MESSAGE:<br />" .$e->getMessage();
        include_once "footer.php";
        exit();

    }//end of try and catch


?>

<?php include_once "footer.php"; ?>
