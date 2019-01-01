<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:20 AM
 */
$pageTitle = "Become A Member";
include_once "header.php";

$errormsg = "";
$showform = 1;
$inputdate  = time();

    //Store the user data and sanitize it
    if(isset($_POST['submit'])){

        $formfield['firstname'] = trim($_POST['firstname']);
        $formfield['lastname'] = trim($_POST['lastname']);
        $formfield['middle'] = trim($_POST['middle']);
        $formfield['email'] = trim(strtolower($_POST['email']));
        $formfield['uname'] = trim(strtolower($_POST['uname']));
        $formfield['pwd'] = trim($_POST['pwd']);
        $formfield['pwd2'] = trim($_POST['pwd2']);
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
    if(empty($formfield['pwd'])){$errormsg .= "<p>Please enter your password.</p>";}
    if(empty($formfield['pwd2'])){$errormsg .= "<p>Please enter your password agian to confirm it.</p>";}
    if(empty($formfield['age'])){$errormsg .= "<p>Please enter your age.</p>";}
    if(empty($formfield['address1'])){$errormsg .= "<p>Please enter your address.</p>";}
    if(empty($formfield['city'])){$errormsg .= "<p>Please enter your city.</p>";}
    if(empty($formfield['state'])){$errormsg .= "<p>Please enter your state.</p>";}
    if(empty($formfield['zip'])){$errormsg .= "<p>Please enter your zip code.</p>";}

    //check to see if the passwords match
    if($formfield['pwd'] != $formfield['pwd2']){$errormsg .= "<p>Sorry but the passwords do not match.</p>";}

    //Check for duplicate users, emails and usernames that may already be in use
    try{
        //finding same username
        $sqlusers = "SELECT * FROM djrobinso_users WHERE uname = :uname";
        $stmtusers = $pdo->prepare($sqlusers);
        $stmtusers->bindValue(':uname', $formfield['uname']);
        $stmtusers->execute();
        $countusers = $stmtusers->rowCount();
        if($countusers > 0)
        {
            $errormsg .= "<p>That username is already taken.</p>";
        }

        //finding the same email
        $sqlemail = "SELECT *FROM djrobinso_users WHERE email = :email";
        $stmtemail = $pdo->prepare($sqlemail);
        $stmtemail->bindValue(':email', $formfield['email']);
        $stmtemail->execute();
        $countemail = $stmtemail->rowCount();
        if($countusers > 0){
            $errormsg .= "<p>That E-Mail address is already in use.</p>";
        }



    }catch(PDOException $e)
    {
        echo "<div class='error'><p></p>ERROR selecting users! ".$e->getMessage()."</p></div>";
        exit();
    }

    //hash the password to be stored
    $alphabet = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for($i = 0; $i < 22; $i++)
    {
        $chars .= substr($alphabet, mt_rand(0,63), 1);
    }
        $salt = '$2a$10$'.$chars;
        $securepwd = crypt($formfield['pwd'], $salt); //password to be stored into database

    //control for errors and display them
    if($errormsg!= ""){
        echo "<div class='errors'><p>THERE ARE ERRORS!</p>";
        echo $errormsg;
        echo "</div>";
    }else{

        try{

            $sql = "INSERT INTO djrobinso_users (firstname, middle, lastname, email, uname, pwd, salt, age, address1, address2, city, state, zip, inputdate)
					                  VALUES (:firstname, :middle, :lastname, :email, :uname, :pwd, :salt, :age, :address1, :address2, :city, :state, :zip, :inputdate)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':firstname', $formfield['firstname']);
            $stmt->bindValue(':middle', $formfield['middle']);
            $stmt->bindValue(':lastname', $formfield['lastname']);
            $stmt->bindValue(':email', $formfield['email']);
            $stmt->bindValue(':uname', $formfield['uname']);
            $stmt->bindValue(':pwd',$securepwd);
            $stmt->bindValue(':salt', $salt);
            $stmt->bindValue(':age', $formfield['age']);
            $stmt->bindValue(':address1', $formfield['address1']);
            $stmt->bindValue(':address2', $formfield['address2']);
            $stmt->bindValue(':city', $formfield['city']);
            $stmt->bindValue(':state', $formfield['state']);
            $stmt->bindValue(':zip', $formfield['zip']);
            $stmt->bindValue(':inputdate', $inputdate);
            $stmt->execute();
            $showform=0; //hide the form
            echo "<div class='success'><p>Thank you for becomming a member.  Go to <a href='login.php'>Log In</a></p></div>";



        }catch(PDOException $e){
            echo "<div class='errors'><p></p>ERROR inserting data into the database!" .$e->getMessage() . "</p></div>";
            include_once "footer.php";
            exit();
        }//end of the try and catch statement

        }//end of the error message
    }//end of if isset

if($showform == 1){
?>

<!---Create the form for users to register---->
<form method="post" action="useradd.php" name="useradd">
    <fieldset>
        <legend class="userRegistrationLegend">Registration</legend>
        <table class="userRegistrationtable">
            <tr>
                <th for="firstname">First Name:</th>
                <td><input type="text" required name="firstname" id="firstname" value="<?php if (isset($formfield['firstname'])){echo $formfield['firstname'];} ?>"/></td>
            </tr>
            <tr>
                <th for="middle">Middle Initial:</th>
                <td><input maxlength="1" type="text" name="middle" id="middle" value="<?php if (isset($formfield['middle'])){echo $formfield['middle'];} ?>"/></td>
            </tr>
            <tr>
                <th for="lastname" >Last Name:</th>
                <td><input type="text" required name="lastname" id="lastname" value="<?php if (isset($formfield['lastname'])){echo $formfield['lastname'];} ?>"/></td>
            </tr>
            <tr>
                <th for="email">Email:</th>
                <td><input type="email" required name="email" id="email" value="<?php if (isset($formfield['email'])){echo $formfield['email'];} ?>"/></td>
            </tr>
            <tr>
                <th for="uname">Username:</th>
                <td><input type="text" required name="uname" id="uname" value="<?php if (isset($formfield['uname'])){echo $formfield['uname'];} ?>"/></td>
            </tr>
            <tr>
                <th for="pwd">Password:</th>
                <td><input type="password" required name="pwd" id="pwd" /></td>
            </tr>
            <tr>
                <th for="pwd2">Confirm Password:</th>
                <td><input type="password" required name="pwd2" id="pwd2" /></td>
            </tr>
            <tr>
                <th for="age">Age:</th>
                <td><input maxlength="3" required type="text" name="age" id="age" value="<?php if (isset($formfield['age'])){echo $formfield['age'];} ?>"/></td>
            </tr>
            <tr>
                <th for="address1">Street Address:</th>
                <td><input type="text" required name="address1" id="adress1" value="<?php if (isset($formfield['address1'])){echo $formfield['address1'];} ?>"/></td>
            </tr>
            <tr>
                <th for="address2">Apt./Suite:</th>
                <td><input type="text" name="address2" id="address2" value="<?php if (isset($formfield['address2'])){echo $formfield['address2'];} ?>"/></td>
            </tr>
            <tr>
                <th for="city">City:</th>
                <td><input type="text" required name="city" id="city" value="<?php if (isset($formfield['city'])){echo $formfield['city'];} ?>"/></td>
            </tr>
            <tr>
                <th for="state">State:</th>
                <td><input maxlength="2" required type="state" name="state" id="state" value="<?php if (isset($formfield['state'])){echo $formfield['state'];} ?>"/></td>
            </tr>
            <tr>
                <th for="zip">Zip Code</th>
                <td><input maxlength="5" required type="zip" name="zip" id="age" value="<?php if (isset($formfield['zip'])){echo $formfield['zip'];} ?>"/></td>
            </tr>
            <tr>
                <th>Submit:</th>
                <td><input type="submit" name="submit" value="submit"/></td>
            </tr>
        </table>
    </fieldset>
</form>

<?php } include_once "footer.php";?>
