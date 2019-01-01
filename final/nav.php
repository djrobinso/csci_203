<ul>
    <?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:15 AM
 */

    //set the links for navigation
    $currentpage = basename($_SERVER['PHP_SELF']);

    //echo what all visitors can see
        echo ($currentpage=="index.php")?"<li>Home</li>" : "<li><a href='index.php'>Home</a></li>";
        echo ($currentpage=="useradd.php")?"<li>Become A Member</li>" : "<li><a href='useradd.php'>Become A Member</a></li>";

    //echo what only logged in visitors can see
        echo (isset($_SESSION['ID'])) ? "<li><a href='userlist.php'>User List</a></li><br>" :"";
        echo (isset($_SESSION['ID'])) ? "<li><a href='itemadd.php'>Add Item</a></li><br>" :"";
        echo (isset($_SESSION['ID'])) ? "<li><a href='itemlist.php'>Items List</a></li><br>" :"";

    //echo the login and logout nav buttons
        echo (isset($_SESSION['ID'])) ? "<li><a href='logout.php'>Log Out</a></li>" : "<li><a href='login.php'>Log In</a></li>";


    ?>
</ul>