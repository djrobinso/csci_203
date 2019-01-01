<!DOCTYPE html>

<?php

    include_once "header.php";

    $errormsg = "";
    $showform = 1;
    $inputdate = time();  //Unix time stamp for right now

    if(isset($_POST['Submit']))
    {
        //Sanitizing  and storing the data
        $formfield['dob'] = trim($_POST['dob']);
        $formfield['prefix'] = $_POST['prefix'];
        $formfield['fname'] = trim($_POST['fname']);
        $formfield['mi'] = trim($_POST['mi']);
        $formfield['lname'] = trim($_POST['lname']);
        $formfield['username'] = trim(strtolower($_POST['username']));
        $formfield['password'] = trim($_POST['password']);
        $formfield['phone'] = trim($_POST['phone']);
        $formfield['address'] = trim($_POST['address']);
        $formfield['state'] = trim($_POST['state']);
        $formfield['zipcode'] = trim($_POST['zipcode']);
        $formfield['newsletter'] = $_POST['newsletter'];
        $formfield['comments'] = $_POST['comments'];

        //check for empty fields
        // except for middle initials or apartment numbers
        if(empty($formfield['dob'])){
            $errormsg .="<p>Please enter your dat of birth.</p>";
        }
        if(!isset($formfield['prefix']) || empty($formfield['prefix'])){
            $errormsg .="<p>Please choose a prefix</p>";
        }
        if(empty($formfield['fname'])){
            $errormsg.="<p>Enter your name please.</p>";
        }
        if(empty($formfield['mi'])){
            $errormsg .="<p>Enter you middle initial.</p>";
        }
        if(empty($formfield['lname'])){
            $errormsg .="<p>Enter your last name.</p>";
        }
        if(empty($formfield['username'])){
            $errormsg .="<p>Please give a username.</p>";
        }
        if(empty($formfield['password'])){
            $errormsg .= "<p>Please give a password.</p>";
        }
        if(empty($formfield['phone'])){
            $errormsg .= "<p>Enter you phone number.</p>";
        }
        if(empty($formfield['address'])){
            $errormsg .= "<p>We are gonna need you address!</p>";
        }
        if(empty($formfield['state'])){
            $errormsg .= "<p>We will need you State as well.</p>";
        }
        if(empty($formfield['zipcode'])){
            $errormsg .= "<p>Enter your zipcode.</p>";
        }
        if(empty($formfield['newsletter'])){
            $errormsg .= "<p>What about our newsletter?????.</p>";
        }
        if(empty($formfield['comments'])){
            $errormsg .= "<p>Dont you wanna win? Answer the question.</p>";
        }


        //Check for errors and display them and
        // if not then enter the code into the database
        if($errormsg != "")
        {
            echo "<div class='error'><p>Sorry There are some errors!</p>";
            echo "$errormsg";
            echo "</div>";
        }else
        {
            try{

                $sql = "INSERT INTO djrobinso4(dob, prefix, fname, mi, lname, username,password, phone, address, state, zipcode, newsletter, comments, inputdate)
                                  VALUES (:dob, :prefix, :fname, :mi, :lname, :username, :password, :phone, :address, :state, :zipcode, :newsletter, :comments, :inputdate)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindvalue('dob', $formfield['dob']);
                $stmt->bindvalue('prefix', $formfield['prefix']);
                $stmt->bindvalue('fname', $formfield['fname']);
                $stmt->bindvalue('mi', $formfield['mi']);
                $stmt->bindvalue('lname', $formfield['lname']);
                $stmt->bindvalue('username', $formfield['username']);
                $stmt->bindvalue('password', $formfield['password']);
                $stmt->bindvalue('phone', $formfield['phone']);
                $stmt->bindvalue('address', $formfield['address']);
                $stmt->bindvalue('state', $formfield['state']);
                $stmt->bindvalue('zipcode', $formfield['zipcode']);
                $stmt->bindvalue('newsletter', $formfield['newsletter']);
                $stmt->bindvalue('comments', $formfield['comments']);
                $stmt->bindvalue('inputdate', $inputdate);
                $stmt->execute();

                $showform = 0;
                echo "<div class='success'><p>There are no errors.  Thank you.</p></div>";

            }catch(PDOException $e)
            {
                echo "<div class='error'><p></p>ERROR inserting data into the database!" .$e->getMessage() . "</p></div>";
                exit();
            }

        }//end of error message


    }
if($showform == 1) {
    ?>

    <div class="middle">
        <form method="post" action="index.php" name="myform">
            <fieldset><legend>User Information</legend>
                <table>
                    <tr>
                        <td><label for="dob">Date of Birth: (yyyy/mm/dd)</label></td>
                        <td><input type="date" name="dob" id="dob" required min ="1900-01-01"
                                   value="<?php if (isset($_POST['dob'])){echo $_POST['dob'];}?>" /></td>
                    </tr>


                    <tr>
                        <td><label for="prefix">Preferred Prefix:</label></td>
                        <td>

                            <input type="radio" name="prefix" id="prefix" value="Mr." required
                                <?php if(isset($_POST['radiobutton'])){echo $_POST['prefix'];} ?>/>Mr.<br>

                            <input type="radio" name="prefix" id="prefix" value="Ms."
                                <?php if(isset($_POST['radiobutton'])){echo $_POST['prefix'];} ?>/>Ms.<br>

                            <input type="radio" name="prefix" id="prefix" value="Mrs."
                                <?php if(isset($_POST['radiobutton'])){echo $_POST['prefix'];} ?>/>Mrs.<br>
                        </td>
                    </tr>


                    <tr>
                        <td><label for="fname">First Name:</label></td>
                        <td><input type="text" name="fname" id="fname" required  size="25"
                                   value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];}?>"/></td>
                    </tr>
                    <tr>
                        <td><label for="mi">Middle Initial:</label></td>
                        <td><input type="text" name="mi" id="mi" size="3" maxlength="1"
                                   value="<?php if(isset($_POST['mi'])){echo $_POST['mi'];} ?>"; /></td>
                    </tr>
                    <tr>
                        <td><label for="lname">Last Name:</label></td>
                        <td><input name="lname" required id="lname" type="text" size="25"
                                   value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input name="username"  id="username" required type="text"
                                   size="25" maxlength="10"
                                   value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input name="password" id="password" required type="password"
                                   value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label>Phone Number (xxx-xxx-xxxx)</label></td>
                        <td><input type="number" name="phone" id="phone" required
                                   min="000-0000" max="999-999-9999"
                                   value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label>Address</label></td>
                        <td><input name="address" id="address" required size="40"
                                   value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label>State</label></td>
                        <td><input name="state" id="state" required maxlength="3" size="1"
                                   value="<?php if(isset($_POST['state'])){echo $_POST['state'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label>Zip Code</label></td>
                        <td><input type="number" name="zipcode" id="zipcode" required maxlength="5" size="5"
                                   min="0" max="99999"
                                   value="<?php if(isset($_POST['zipcode'])){echo $_POST['zipcode'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td><label>Do you wish to sign up <br>for our monthly news letter?</label></td>
                        <td><select name="newsletter" id="newsletter" required>
                                <option value="<?php if(isset($_POST['newsletter'])){echo $_POST['newsletter'];} ?>">SELECT ONE</option>
                                <option value="yes">Yea. Sounds Awsome!</option>
                                <option value="no">No. Thanks but no.</option>
                            </select></td>
                    </tr>
                    <!--continue your code here.... -->
                </table>
            </fieldset>

            <p id="question-thanks">Answer this question. If you were given The Flash's
                power <br>to connect to the speed force for a day. What would you do?</p>
            <textarea name="comments" id="comments" required rows="10" cols="45">
            <?php if(isset($_POST['comments'])){echo $_POST['comments'];} ?></textarea><br>

            <input type="submit" name="Submit" id="Submit" value="Submit"/>

            <!---url></url>--->

        </form>
    </div>

    <?php
} include_once "footer.php"; ?>

