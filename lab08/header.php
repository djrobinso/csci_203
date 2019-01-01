<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 3/2/2016
 * Time: 4:36 PM
 */
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Superglobals</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <h1>Superglobals</h1>
        <ul>
            <?php
                if($_SERVER['PHP_SELF'] != "djrobinso/csci203sp16/lab08/index.php")
                {
                    echo "<li><a href='index.php'>Home</a></li>";
                }
                if($_SERVER['PHP_SELF'] != "djrobinso/csci203sp16/lab08/form.php")
                {
                    echo "<li><a href='form.php'>Form</a></li>";
                }
            ?>
        </ul>
    </header>
</html>
