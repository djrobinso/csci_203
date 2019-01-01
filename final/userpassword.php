<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:20 AM
 */

$pageTitle = "Change Password";
include_once "header.php";
$errormsg = "";
$showform = 1;

    //check for authentication
    if(!isset($_SESSION['ID'])) {
        echo "<p>This page requires authentication.</p>";
        include_once "footer.php";
        exit();
    }

    //Store and sanitize the data
    if(isset($_POST['submit'])){

        $_GET['ID'] = $_POST['ID'];

        $formfield['pwd'] = trim($_POST['pwd']);
        $formfield['pwd2'] = trim($_POST['pwd2']);

        //Check for any empty field
        if(empty($formfield['pwd'])){$errormsg .= "<p>Please enter your password.</p>";}
        if(empty($formfield['pwd2'])){$errormsg .= "<p>Please enter your password agian to confirm it.</p>";}

        //if the confirmation passowrd and the passsword dont match
        //then display the error message
        if($formfield['pwd2'] != $formfield['pwd']){
            $errormsg .= "<p>Your passwords don't match!</p>";
        }


        /**********Hashing the password*********/
        $alphabet = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for($i = 0; $i < 22; $i++)
        {
            $chars .= substr($alphabet, mt_rand(0,63), 1);
        }
        $salt = '$2a$10$'.$chars;
        $securepwd = crypt($formfield['pwd'], $salt); //password to be stored into database
        /***************************************/


        if($errormsg != ""){
            echo "<div class='errors'><p>THERE ARE ERRORS!</p>";
            echo $errormsg;
            echo "</div>";
        }else {

            try {
                //Update the password
                $sql = "UPDATE djrobinso_users SET pwd = :pwd, salt = :salt WHERE ID = :ID";
                $stmtTitle = $pdo->prepare($sql);
                $stmtTitle->bindValue(':pwd', $securepwd);
                $stmtTitle->bindValue(':salt', $salt);
                $stmtTitle->bindValue(':ID', $_POST['ID']);
                $stmtTitle->execute();
                $showform = 0;
                echo "<div class='success'><p>Your password has just been updated!</p></div>";
            } catch (PDOException $e) {
                echo "<div class='errors'><p></p>ERROR inserting the new password into the database! " . $e->getMessage() . "</p></div>";
                include_once "footer.php";
                exit();
            }//end of try and catch
        }

    }//end of the submit if statment


if($showform == 1){
    $sql = 'SELECT * FROM djrobinso_users WHERE ID = :ID';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
?>

<form method="post" action="userpassword.php" name="passwordupdate">
    <fieldset>
        <legend class="passwordLegend">Password Change</legend>
        <table class="passwordChangeTable">
            <tr>
                <th>Password: </th>
                <td><input type="password" required name="pwd" id="pwd" /></td>
            </tr>
            <tr>
                <th>Confirm Password: </th>
                <td><input type="password" required name="pwd2" id="pwd2" /></td>
            </tr>
            <tr>
                <th>Submit:</th>
                <td>
                    <input type="submit" name="submit" value="UPDATE"/>
                </td>
            </tr>
        </table>
    </fieldset>
</form>

<?php } include "footer.php"; ?>
