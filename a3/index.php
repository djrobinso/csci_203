<!DOCTYPE html>

<?php
    include_once "header.php";
?>

    <div class="middle">
    <form method="post" action="thanks.php" name="myform">
        <fieldset><legend>User Information</legend>
            <table>
                <tr>
                    <td><label for="dob">Date of Birth: (mm/dd/yyyy)</label></td>
                    <td><input type="date" name="dob" id="dob" required min="01-01-1900"/></td>
                </tr>
                <tr>
                    <td><label for="prefix">Preferred Prefix:</label></td>
                    <td>

                        <input type="radio" name="prefix" id="prefix" value="Mr." required/>Mr.<br>
                        <input type="radio" name="prefix" id="prefix" value="Ms."/>Ms.<br>
                        <input type="radio" name="prefix" id="prefix" value="Mrs."/>Mrs.<br>
                    </td>
                </tr>
                <tr>
                    <td><label for="fname">First Name:</label></td>
                    <td><input type="text" name="fname" id="fname" required  size="25"/></td>
                </tr>
                <tr>
                    <td><label for="mi">Middle Initial:</label></td>
                    <td><input type="text" name="mi" id="mi" size="3" maxlength="1" /></td>
                </tr>
                <tr>
                    <td><label for="lname">Last Name:</label></td>
                    <td><input name="lname" required id="lname" type="text" size="35"/></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input name="username"  id="username" required type="text"
                                    size="15" maxlength="10"/></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input name="password" id="password" required type="password"/></td>
                </tr>
                <tr>
                    <td><label>Phone Number (xxx-xxx-xxxx)</label></td>
                    <td><input type="number" name="phone" id="phone" required
                               min="000-0000" max="999-999-9999" /></td>
                </tr>
                <tr>
                    <td><label>Address</label></td>
                    <td><input name="address" id="address" required size="40"/></td>
                </tr>
                <tr>
                    <td><label>State</label></td>
                    <td><input name="state" id="state" required maxlength="3" size="1"/></td>
                </tr>
                <tr>
                    <td><label>Zip Code</label></td>
                    <td><input type="number" name="zipcode" id="zipcode" required maxlength="5" size="5"
                                    min="0" max="99999"/></td>
                </tr>
                <tr>
                    <td><label>Do you wish to sign up <br>for our monthly news letter?</label></td>
                    <td><select name="newsletter" id="newsletter" required>
                        <option VALUE="">SELECT ONE</option>
                        <option value="yes">Yea. Sounds Awsome!</option>
                        <option value="no">No. Thanks but no.</option>
                        </select></td>
                </tr>
                <!--continue your code here.... -->
            </table>
        </fieldset>

        <p id="question-thanks">Answer this question. If you were given The Flash's
                            power <br>to connect to the speed force for a day. What would you do?</p>
        <textarea name="comments" id="comments" required rows="10" cols="45"></textarea><br>

        <input type="submit" name="Submit" id="Submit" value="Submit"/>

        <!---url></url>--->

    </form>
    </div>

<?php include_once "footer.php"; ?>

