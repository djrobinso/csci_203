<html>
<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 3/8/2016
 * Time: 5:27 PM
 */
include "header.php"; ?>

<!----Display the information that was given inside the table on index.php--->
<table>
    <tr>
        <td><?php echo "Date Of Birth"?></td>
        <td><?php echo $_POST['dob']?></td>
    </tr>
    <tr>
        <td><?php echo "Preferred Prefix:"; ?></td>
        <td><?php echo $_POST['prefix'];?></td>
    </tr>
    <tr>
        <td><?php echo "First Name";?></td>
        <td><?php echo $_POST['fname'];?></td>
    </tr>
    <tr>
        <td><?php echo "Middle Initial";?></td>
        <td><?php echo $_POST['mi'];?></td>
    </tr>
    <tr>
        <td><?php echo "Last Name";?></td>
        <td><?php echo $_POST['lname'];?></td>
    </tr>
    <tr>
        <td><?php echo "Username";?></td>
        <td><?php echo $_POST['username'];?></td>
    </tr>
    <tr>
        <td><?php echo "Password";?></td>
        <td><?php echo $_POST['password'];?></td>
    </tr>
    <tr>
        <td><?php echo "Phone Number";?></td>
        <td><?php echo $_POST['phone'];?></td>
    </tr>
    <tr>
        <td><?php echo "Address";?></td>
        <td><?php echo $_POST['address'];?></td>
    </tr>
    <tr>
        <td><?php echo "State";?></td>
        <td><?php echo $_POST['state'];?></td>
    </tr>
    <tr>
        <td><?php echo "Zip Code";?></td>
        <td><?php echo $_POST['zipcode'];?></td>
    </tr>
    <tr>
        <td><?php echo "Do you wish to sign up <br>for our monthly news letter?";?></td>
        <td><?php echo $_POST['newsletter'];?></td>
    </tr>
</table>


<?php include "footer.php"; ?>
</html>
