<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:20 AM
 */

$pageTitle = "Update User Information";
include_once "header.php";
$errormsg = "";
$showform = 1;


    //check for authentication
    if(!isset($_SESSION['ID'])) {
        echo "<p>This page requires authentication.</p>";
        include_once "footer.php";
        exit();
    }

/***************
    //check to see if this is the correct user
    //but first I must get the user informatioin bt ID then
    // I can check to see if I can update the information
    try{
        $sql = "SELECT * FROM djrobinso_users WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":ID", $_GET['ID']);
        $stmt->execute();
        $row = $stmt->fetch();

        //check if they match
        if($_SESSION['uname'] != $row['uname']){
            echo "<p class='errors'>BAD USER!!!!! You cant update someone elses information!!!!!!!</p>";
            include_once "footer.php";
            exit();
        }

    }catch(PDOException $e){
        echo "<div class='error'><p></p>ERROR checking where if this is the correct user! ".$e->getMessage()."</p></div>";
        include_once "footer.php";
        exit();
    }//end of try and catch

/******************/


    //Store the user data and sanitize it
    if(isset($_POST['submit'])) {

        $_GET['ID'] = $_POST['ID'];

        $formfield['firstname'] = trim($_POST['firstname']);
        $formfield['lastname'] = trim($_POST['lastname']);
        $formfield['middle'] = trim($_POST['middle']);
        $formfield['email'] = trim(strtolower($_POST['email']));
        $formfield['uname'] = trim(strtolower($_POST['uname']));
        $formfield['age'] = trim($_POST['age']);
        $formfield['address1'] = trim($_POST['address1']);
        $formfield['address2'] = trim($_POST['address2']);
        $formfield['city'] = trim($_POST['city']);
        $formfield['state'] = trim($_POST['state']);
        $formfield['zip'] = trim($_POST['zip']);


        //check for any empty required fields
        if(empty($formfield['firstname'])){$errormsg .= "<p>Please enter your first name.</p>";}
        if(empty($formfield['lastname'])){$errormsg .= "<p>Please enter your last name.</p>";}
        if(empty($formfield['email'])){$errormsg .= "<p>Please enter your E-mail address. </p>";}
        if(empty($formfield['uname'])){$errormsg .= "<p>Please enter a username.</p>";}
        if(empty($formfield['age'])){$errormsg .= "<p>Please enter your age.</p>";}
        if(empty($formfield['address1'])){$errormsg .= "<p>Please enter your address.</p>";}
        if(empty($formfield['city'])){$errormsg .= "<p>Please enter your city.</p>";}
        if(empty($formfield['state'])){$errormsg .= "<p>Please enter your state.</p>";}
        if(empty($formfield['zip'])){$errormsg .= "<p>Please enter your zip code.</p>";}

        //check for duplicate emails
        if($formfield['email'] != $_POST['oemail']){
            try{
                $sqltitle = "SELECT * FROM djrobinso_users WHERE email = :email";
                $stmtTitle = $pdo->prepare($sqltitle);
                $stmtTitle->bindValue(':email', $formfield['email']);
                $stmtTitle->execute();
                $countTitle = $stmtTitle->rowCount();
                if ($countTitle > 0) {
                    $errormsg .= "<p>That email is already in the system!</p>";
                }
            }catch(PDOException $e){
                echo "<div class='error'><p></p>ERROR checking for duplicate email! " . $e->getMessage() . "</p></div>";
                include_once "footer.php";
                exit();
            }
        }//end of the duplicate email

        //check for duplicate usernames
        if($formfield['uname'] != $_POST['ouname']){
            try{
                $sqltitle = "SELECT * FROM djrobinso_users WHERE uname = :uname";
                $stmtTitle = $pdo->prepare($sqltitle);
                $stmtTitle->bindValue(':uname', $formfield['uname']);
                $stmtTitle->execute();
                $countTitle = $stmtTitle->rowCount();
                if ($countTitle > 0) {
                    $errormsg .= "<p>That username is already in the system.</p>";
                }
            }catch(PDOException $e){
                echo "<div class='error'><p></p>ERROR checking for duplicate usernames! " . $e->getMessage() . "</p></div>";
                include_once "footer.php";
                exit();
            }
        }//end of the diplicate usernames




        //if theres errors then display them but if not then try
        //to send the updated information to the database
        if($errormsg != "")
        {
            echo "<div class='errors'><p>THERE ARE ERRORS!</p>";
            echo $errormsg;
            echo "</div>";
        }else{

            try{

                $sql = "UPDATE djrobinso_users SET
                    firstname = :firstname, lastname = :lastname, email = :email, uname = :uname,
                    age = :age, address1 = :address1, address2 = :address2, city = :city, state = :state,
                    zip = :zip WHERE ID = :ID";
                $stmtTitle = $pdo->prepare($sql);
                $stmtTitle->bindValue(':firstname', $formfield['firstname']);
                $stmtTitle->bindValue(':lastname', $formfield['lastname']);
                $stmtTitle->bindValue(':email', $formfield['email']);
                $stmtTitle->bindValue(':uname', $formfield['uname']);
                $stmtTitle->bindValue(':age', $formfield['age']);
                $stmtTitle->bindValue(':address1', $formfield['address1']);
                $stmtTitle->bindValue(':address2', $formfield['address2']);
                $stmtTitle->bindValue(':city', $formfield['city']);
                $stmtTitle->bindValue(':state', $formfield['state']);
                $stmtTitle->bindValue(':zip', $formfield['zip']);
                $stmtTitle->bindValue(':ID', $_POST['ID']);
                $stmtTitle->execute();
                $showform = 0;
                echo "<div class='success'><p>Your information has just been updated!</p></div>";

            }catch(PDOException $e){
                echo "<div class='errors'><p></p>ERROR inserting the new data into the database! " .$e->getMessage() . "</p></div>";
                include_once "footer.php";
                exit();

            }

        }//end of the error messages
    }//end of the if statement

if($showform == 1 ){
    $sql = 'SELECT * FROM djrobinso_users WHERE ID = :ID';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
?>

    <!---Create the form for users to register---->
    <form method="post" action="userupdate.php" name="userupdate">
        <fieldset>
            <legend class="userRegistrationLegend">Update Info.</legend>
            <table class="userRegistrationtable">
                <tr>
                    <th for="firstname">First Name:</th>
                    <td><input type="text" required name="firstname" id="firstname"
                               value="<?php if(isset($formfield['firstname'])&& !empty($formfield['firstname'])) {echo $formfield['firstname'];}else {echo $row['firstname'];}?>"/></td>
                </tr>
                <tr>
                    <th for="middle">Middle Initial:</th>
                    <td><input maxlength="1" type="text" name="middle" id="middle"
                               value="<?php if(isset($formfield['middle'])&& !empty($formfield['middle'])) {echo $formfield['middle'];}else {echo $row['middle'];}?>"/></td>
                </tr>
                <tr>
                    <th for="lastname" >Last Name:</th>
                    <td><input type="text" required name="lastname" id="lastname"
                               value="<?php if(isset($formfield['lastname'])&& !empty($formfield['lastname'])) {echo $formfield['lastname'];}else {echo $row['lastname'];}?>"/></td>
                </tr>
                <tr>
                    <th for="email">Email:</th>
                    <td><input type="email" required name="email" id="email"
                               value="<?php if(isset($formfield['email'])&& !empty($formfield['email'])) {echo $formfield['email'];}else {echo $row['email'];}?>"/></td>
                </tr>
                <tr>
                    <th for="uname">Username:</th>
                    <td><input type="text" required name="uname" id="uname"
                               value="<?php if(isset($formfield['uname'])&& !empty($formfield['uname'])) {echo $formfield['uname'];}else {echo $row['uname'];}?>"/></td>
                </tr>
                <tr>
                    <th for="age">Age:</th>
                    <td><input maxlength="3" required type="text" name="age" id="age"
                               value="<?php if(isset($formfield['age'])&& !empty($formfield['age'])) {echo $formfield['age'];}else {echo $row['age'];}?>"/></td>
                </tr>
                <tr>
                    <th for="address1">Street Address:</th>
                    <td><input type="text" required name="address1" id="adress1"
                               value="<?php if(isset($formfield['address1'])&& !empty($formfield['address1'])) {echo $formfield['address1'];}else {echo $row['address1'];}?>"/></td>
                </tr>
                <tr>
                    <th for="address2">Apt./Suite:</th>
                    <td><input type="text" name="address2" id="address2"
                               value="<?php if(isset($formfield['address2'])&& !empty($formfield['address2'])) {echo $formfield['address2'];}else {echo $row['address2'];}?>"/></td>
                </tr>
                <tr>
                    <th for="city">City:</th>
                    <td><input type="text" required name="city" id="city"
                               value="<?php if(isset($formfield['city'])&& !empty($formfield['city'])) {echo $formfield['city'];}else {echo $row['city'];}?>"/></td>
                </tr>
                <tr>
                    <th for="state">State:</th>
                    <td><input maxlength="2" required type="state" name="state" id="state"
                               value="<?php if(isset($formfield['state'])&& !empty($formfield['state'])) {echo $formfield['state'];}else {echo $row['state'];}?>"/></td>
                </tr>
                <tr>
                    <th for="zip">Zip Code</th>
                    <td><input maxlength="5" required type="zip" name="zip" id="age"
                               value="<?php if(isset($formfield['zip'])&& !empty($formfield['zip'])) {echo $formfield['zip'];}else {echo $row['zip'];}?>"/></td>
                </tr>
                <tr>
                    <th>Submit:</th>
                    <td><input type="submit" name="submit" value="UPDATE"/>
                        <input type="hidden" name="oemail" id="oemail" value="<?php echo $row['email'] ?>">
                        <input type="hidden" name="ouname" id="ouname" value="<?php echo $row['uname'] ?>">

                    </td>
                </tr>
            </table>
        </fieldset>
    </form>


<?php } include_once  "footer.php"; ?>
