<?php
$pagetitle = "Confirmation";
require_once "header.php";

if($_GET['state']==1)
{
    echo "<p>Logout confirmed.  Please <a href='login.php'>log in</a> again to view restricted content.<p>";
}
elseif($_GET['state']==2)
{
    echo "<p id='confirmWelcome'><b>Long Time No See! Welcome Back!</b></p>
        <table>
             <tr class='conformLoginPageTable'><th>User ID:</th><td>" . $_SESSION['ID'] . "</td></tr>
             <tr class='conformLoginPageTable'><th>Username:</th><td>" . $_SESSION['uname'] . "</td></tr>
        </table>";
}
else
{
    echo "<p>Please continue by choosing an item from the menu.</p>";
}

require_once "footer.php";
?>