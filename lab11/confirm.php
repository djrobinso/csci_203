<?php
$pagetitle = "Confirmation";
require_once "header.php";

if($_GET['state']==1)
{
    echo "<p>Logout confirmed.  Please <a href='login.php'>log in</a> again to view restricted content.<p>";
}
elseif($_GET['state']==2)
{
    echo "<p>Thank you for logging in!</p>
          <table>
             <tr><th>User ID</th><td>" . $_SESSION['ID'] . "</td></tr>
             <tr><th>Username</th><td>" . $_SESSION['uname'] . "</td></tr></table>";
}
else
{
    echo "<p>Please continue by choosing an item from the menu.</p>";
}

require_once "footer.php";
?>